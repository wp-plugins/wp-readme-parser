<?php
/*
Plugin Name: WP README Parser
Plugin URI: http://www.artiss.co.uk/wp-readme-parser
Description: Show WordPress Plugin README in your Posts
Version: 1.1.1
Author: David Artiss
Author URI: http://www.artiss.co.uk
*/

add_shortcode('readme','wp_readme_parser');

define('wp_readme_parser_version','1.1.1');

function wp_readme_parser($paras="",$content="") {
    
    // Extract parameters
    extract(shortcode_atts(array('exclude'=>'','ext'=>'','hide'=>'','scr_url'=>'','scr_ext'=>'','target'=>'','nofollow'=>'','ignore'=>''),$paras));
    
    // Set parameter values
    $plugin_url=$content; 
    $exclude=strtolower($exclude);
    $hide=strtolower($hide);
    $ignore=get_ignore_list($ignore,',,');
    if ($target=="") {$target="_blank";}
    if (strtolower($nofollow)=="yes") {$nofollow=" rel=\"nofollow\"";}
    if ($ext=="") {$ext="png";} else {$ext=strtolower($ext);}
    
    // Work out filename and fetch the contents
    if (strpos($plugin_url,"://")===false) {
        $plugin_name=str_replace(" ","-",strtolower($plugin_url));
        $plugin_url="http://plugins.svn.wordpress.org/".$plugin_name."/trunk/readme.txt";
    }
    $file_data=markdown_get_file($plugin_url);
    
    // Ensure the file is valid
    if (($file_data['rc']>0)&&($file_data['file']!="")&&(substr($file_data['file'],0,9)!="<!DOCTYPE")&&(substr_count($file_data['file'],"\n")!=0)) {
        
        // Include PHP Markdown code
        include_once(WP_PLUGIN_DIR."/".str_replace(basename( __FILE__),"",plugin_basename(__FILE__))."PHP Markdown Extra/markdown.php");

        // Split file into array based on CRLF
        $file_array=preg_split("/((\r(?!\n))|((?<!\r)\n)|(\r\n))/",$file_data['file']);

        // Set initial variables
        $section="";
        $prev_section="";
        $last_line_blank=true;
        $div_written=false;
        $screenshot=1;
        $code=false;
        $crlf="\r\n";

        // Count the number of lines and read through the array
        $count=count($file_array);
        for ($i = 0; $i < $count; $i++) {
            $add_to_output=true;

            // Remove non-visible character from input - various characters can sneak into
            // text files and this can affect output
            $file_array[$i]=rtrim(ltrim(ltrim($file_array[$i],"\x80..\xFF"),"\x00..\x1F"));

            // If the line begins with equal signs, replaced with the standard hash equivalent
            if (substr($file_array[$i],0,4)=="=== ") {
                $file_array[$i]=str_replace("===","#",$file_array[$i]);
                $section=get_section_name($file_array[$i],1);
            } else {
                if (substr($file_array[$i],0,3)=="== ") {
                    $file_array[$i]=str_replace("==","##",$file_array[$i]);
                    $section=get_section_name($file_array[$i],2);
                } else {
                    if (substr($file_array[$i],0,2)=="= ") {
                        $file_array[$i]=str_replace("=","###",$file_array[$i]);
                    }
                }
            }

            // If an asterisk is used for a list, but it doesn't have a space after it, add one!
            // This only works if no other asterisks appear in the line
            if ((substr($file_array[$i],0,1)=="*")&&(substr($file_array[$i],0,2)!=" ")&&(strpos($file_array[$i],"*",1)===false)) {
                $file_array[$i]="* ".substr($file_array[$i],1);
            }

            // Track current section. If very top, make it "head" and save as plugin name
            if (($section!=$prev_section)&&($prev_section=="")) {
                if ($plugin_name=="") {$plugin_name=str_replace(" ","-",strtolower($section));}
                $plugin_title=$section;
                $add_to_output=false;
                $section="head";
            }

            // Is this an excluded section?
            if (is_it_excluded($section,$exclude)) {
                $add_to_output=false;
            } else {
                if ($section!=$prev_section) {
                    if ($div_written) {$file_combined.="</div>".$crlf;}
                    $file_combined.=$crlf."<div markdown=\"1\" id=\"np-".str_replace(" ","-",strtolower($section))."\">".$crlf;
                    $div_written=true;
                }
            }
            
            // Is it an excluded line?
            if ($add_to_output===true) {
                $exclude_loop=1;
                while ($exclude_loop<=$ignore[0]) {
                    if (strpos($file_array[$i],$ignore[$exclude_loop],0)!==false) {$add_to_output=false;}
                    $exclude_loop++;
                }
            }

            $prev_section=$section;

            if ($add_to_output) {
                
                // Process meta data from top
                if ((substr($file_array[$i],0,13)=="Contributors:")or(substr($file_array[$i],0,12)=="Donate link:")or(substr($file_array[$i],0,5)=="Tags:")or(substr($file_array[$i],0,18)=="Requires at least:")or(substr($file_array[$i],0,13)=="Tested up to:")or(substr($file_array[$i],0,11)=="Stable tag:")) {
                    if (is_it_excluded("meta",$exclude)) {$add_to_output=false;}
                    if ((substr($file_array[$i],0,18)=="Requires at least:")&&(is_it_excluded("requires",$exclude))) {$add_to_output=false;}
                    if ((substr($file_array[$i],0,13)=="Tested up to:")&&(is_it_excluded("tested",$exclude))) {$add_to_output=false;}

                    // Show contributors and tags using links to WordPress pages
                    if (substr($file_array[$i],0,13)=="Contributors:") {
                        if (is_it_excluded("contributors",$exclude)) {
                            $add_to_output=false;
                        } else {
                            $file_array[$i]=substr($file_array[$i],0,14).strip_list(substr($file_array[$i],14),"c");
                        }
                    }
                    if (substr($file_array[$i],0,5)=="Tags:") {
                        if (is_it_excluded("tags",$exclude)) {
                            $add_to_output=false;
                        } else {
                            $file_array[$i]=substr($file_array[$i],0,6).strip_list(substr($file_array[$i],6),"t");
                        }
                    }
                    
                    // If displaying the donation link, convert it to a hyperlink
                    if (substr($file_array[$i],0,12)=="Donate link:") {
                        if (is_it_excluded("donate",$exclude)) {
                            $add_to_output=false;
                        } else {
                            $text=substr($file_array[$i],13);
                            $file_array[$i]=substr($file_array[$i],0,13).'<a href="'.$text.'">'.$text.'</a>';
                        }
                    }
                    
                    // If displaying the latest version, link to download
                    if (substr($file_array[$i],0,11)=="Stable tag:") {
                        $version=substr($file_array[$i],12);
                        $download="http://downloads.wordpress.org/plugin/".$plugin_name.".".$version.".zip";
                        if (strtolower($version)=="trunk") {
                            $screenshot_url="http://plugins.svn.wordpress.org/".$plugin_name."/trunk/";
                        } else {
                            $screenshot_url="http://plugins.svn.wordpress.org/".$plugin_name."/tags/".$version."/";
                        }
                        if (is_it_excluded("stable",$exclude)) {
                            $add_to_output=false;
                        } else {
                            $file_array[$i]=substr($file_array[$i],0,12).'<a href="'.$download.'">'.$version.'</a>';
                        }
                    }
                    
                    // If one of the header tags, add a BR tag to the end of the line
                    $file_array[$i].="<br />";
                }
            }

            // Display screenshots
            if (($section=="Screenshots")&&($add_to_output)&&($screenshot_url!="")) {
                if (substr($file_array[$i],0,strlen($screenshot)+2)==$screenshot.". ") {
                    $this_screenshot=$screenshot_url."screenshot-".$screenshot.".".$ext;
                    $file_array[$i]="<img src=\"".$this_screenshot."\" alt=\"".$plugin_title." Screenshot ".$screenshot."\" title=\"".$plugin_title." Screenshot ".$screenshot."\" id=\"np-screenshot".$screenshot."\" /><br />".$crlf."*".substr($file_array[$i],strlen($screenshot)+2)."*";
                    if ($screenshot!=1) {$file_array[$i]="<br /><br />".$file_array[$i];}
                    $screenshot++;
                }
            }

            // Add current line to output, assuming not compressed and not a second blank line
            if ((($file_array[$i]!="")OR(!$last_line_blank))&&($add_to_output)) {
                $file_combined.=$file_array[$i].$crlf;
                if ($file_array[$i]=="") {$last_line_blank=true;} else {$last_line_blank=false;}
            }
        }
        $file_combined.="</div>".$crlf;
        if (is_it_excluded("links",$exclude)===false) {
            $file_combined.="<div markdown=\"1\" id=\"np-links\">".$crlf."## Links ##".$crlf.$crlf;
            if ($version!="") {
                $file_combined.="<a id=\"np-download-link\" href=\"".$download."\" target=\"".$target."\"".$nofollow.">Download the latest version</a> (".$version.")<br /><br />".$crlf;
            } else {
                $file_combined="<span id=\"np-download-link\" style=\"color: #f00;\">No download link is available as the version number could not be found</span><br /><br />".$crlf;
            }
            $file_combined.="<a href=\"http://wordpress.org/extend/plugins/".$plugin_name."/\" target=\"".$target."\"".$nofollow.">Visit the official WordPress plugin page</a><br />".$crlf;
            $file_combined.="<a href=\"http://wordpress.org/tags/".$plugin_name."\" target=\"".$target."\"".$nofollow.">View for WordPress forum for this plugin</a><br />".$crlf."</div>".$crlf;
        }
        // Call Markdown code to convert
        $my_html=Markdown($file_combined);

        // Split HTML again
        $file_array=preg_split("/((\r(?!\n))|((?<!\r)\n)|(\r\n))/",$my_html);
        $my_html="";
        
        // Count lines of code and process one-at-a-time
        $titles_found=0;
        $count=count($file_array);
        
        for ($i = 0; $i < $count; $i++) {
            
            // If Simple Content Reveal plugin is active
            if (function_exists('simple_content_reveal')) {
                
                // If line is a sub-heading add the first part of the code
                if (substr($file_array[$i],0,4)=="<h2>") {
                    
                    // Extract title and check if it should be hidden or shown by default
                    $title=substr($file_array[$i],4,strpos($file_array[$i],"</h2>")-4);
                    if (is_it_excluded(strtolower($title),$hide)) {$state="hide";} else {$state="show";}
                    // Call Simple Content Reveal with heading details and replace current line
                    $file_array[$i]=return_scr_start("<h2>%image% ".$title."</h2>",$title,$state,$scr_url,$scr_ext);
                    $titles_found++;
                }
                
                // If a DIV is found and previous section is not hidden add the end part of code
                if (($file_array[$i]=="</div>")&&($titles_found>0)) {
                    $file_array[$i]=return_scr_end().$crlf.$file_array[$i];
                }
            }

            // If first line of code multi-line, replace CODE with PRE tag
            if ((strpos($file_array[$i],"<code>",0))&&(!strpos($file_array[$i],"</code>",0))) {
                $file_array[$i]=str_replace("<code>","<pre>",$file_array[$i]);
            }
            
            // If final line to code multi-line, replace /CODE with /PRE tag
            if ((strpos($file_array[$i],"</code>",0))&&(!strpos($file_array[$i],"<code>",0))) {
                $file_array[$i]=str_replace("</code>","</pre>",$file_array[$i]);
            }
            
            // If all code is one line, replace CODE with PRE tags
            if ((strpos($file_array[$i],"<code>",0))&&(strpos($file_array[$i],"</code>",0))) {
                if (ltrim(strip_tags(substr($file_array[$i],0,strpos($file_array[$i],"<code>",0))))=="") {$file_array[$i]=str_replace("code>","pre>",$file_array[$i]);}
            }

            $my_html.=$file_array[$i].$crlf;
        }
    } else {
        if ((strlen($file_data['file'])>0)&&(substr_count($file_data['file'],"\n")==0)) {
            $my_html=markdown_report_error("Malformed README file - no carriage returns found","WP README Parser");
        } else {
            $my_html=markdown_report_error("README file could not be found or is malformed - ".$plugin_url,"WP README Parser");
        }
    }
    
    // Send the resultant code back, plus encapsulating DIV and version comments
    $content = "<!-- WP README Parser v".wp_readme_parser_version." | http://www.artiss.co.uk/wp-readme-parser -->\n<div id=\"np-notepad\">\n".$my_html."</div>\n<!-- End of WP README Parser code -->\n";
    return $content;
}

// Function to check if the current section is excluded or not
function is_it_excluded($tofind,$exclude) {
    $tofind=strtolower($tofind);
    $return=true;
    if ($tofind!=$exclude) {
        // Search in the middle
        $pos=strpos($exclude,",".$tofind.",");
        if ($pos===false) {
            // Search on the left
            $pos=strpos(substr($exclude,0,strlen($tofind)+1),$tofind.",");
            if ($pos===false) {
                // Search on the right
                $pos=strpos(substr($exclude,(strlen($tofind)+1)*-1,strlen($tofind)+1),",".$tofind);
                if ($pos===false) {$return=false;}
            }
        }
    }
    return $return;
}

// Function to get name of README section
function get_section_name($readme_line,$start_pos) {
    $hash_pos=strpos($readme_line,"#",$start_pos+1);
    if ($hash_pos) {
        $section=substr($readme_line,$start_pos+1,$hash_pos-$start_pos-2);
    } else {
        $section=substr($readme_line,$start_pos+1);
    }
    return $section;
}

// Function to strip user or tag lists and add links
function strip_list($list,$type) {
    if ($type=="c") {$url="http://profiles.wordpress.org/users/";} else {$url="http://wordpress.org/extend/plugins/tags/";}
    $startpos=0;
    $number=0;
    $endpos=strpos($list,",",0);
    while ($endpos!==false) {
        $number++;
        $name=trim(substr($list,$startpos,$endpos-$startpos));
        if ($number>1) {$return.=", ";}
        $return.='<a href="'.$url.$name.'" target="'.$target.'"'.$nofollow.'>'.$name.'</a>';
        $startpos=$endpos+1;
        $endpos=strpos($list,",",$startpos);
    }
    $name=trim(substr($list,$startpos));
    if ($number>0) {$return.=", ";}
    $return.='<a href="'.$url.$name.'" target="'.$target.'"'.$nofollow.'>'.$name.'</a>';
    return $return;
}

// Function to get a file (1.5)
function markdown_get_file($filein) {
    $fileout=wp_remote_get($filein);
    if (is_wp_error($fileout)) {
        $rc=-1;
    } else {
        $rc=1;
        $file_return['file']=$fileout['body'];
    }
    $file_return['rc']=$rc;
    return $file_return;  
}

// Function to extract a comma seperated list into an array (1.1)
function get_ignore_list($input,$seperator="") {
    if ($seperator=="") {$seperator=",";}
    $comma=strpos(strtolower($input),$seperator);
    $item=0;
    while ($comma!==false) {
        $item++;
        $content[$item]=substr($input,$start,$comma);
        $input=substr($input,$comma+strlen($seperator));
        $comma=strpos($input,$seperator);
    }
    if ($input!="") {
        $item++;
        $content[$item]=substr($input,$start);
    }
    $content[0]=$item;
    return $content;
}

// Function to report an error (1.2) (MOD)
function markdown_report_error($errorin,$plugin_name) {
    return "<p style=\"color: #f00; font-weight: bold;\">".$plugin_name.": ".__($errorin)."</p>\n";
}