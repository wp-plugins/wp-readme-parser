<?php
/**
* Shared Functions
*
* Various shared functions
*
* @package	Artiss-URL-Shortener
* @since	1.7
*/

/**
* Extract Parameters (1.1)
*
* Function to extract parameters from an input string
*
* @since	1.1
*
* @param	$input	string	Input string
* @param	$para	string	Parameter to find
* @return			string	Parameter value
*/

function aus_get_parameters( $input, $para, $divider = '=', $seperator = '&' ) {

    $start = strpos( strtolower( $input ), $para . $divider);
    $content = '';
    if ( $start !== false ) {
        $start = $start + strlen( $para ) + 1;
        $end = strpos( strtolower( $input ), $seperator, $start );
        if ( $end !== false ) { $end = $end - 1; } else { $end = strlen( $input ); }
        $content = substr( $input, $start, $end - $start + 1 );
    }
    return $content;
}

/**
* Fetch a file (1.6)
*
* Use WordPress API to fetch a file and check results
* RC is 0 to indicate success, -1 a failure
*
* @since	1.1
*
* @param	string	$filein		File name to fetch
* @param	string	$header		Only get headers?
* @return	string				Array containing file contents and response
*/

function aus_get_file( $filein, $header = false ) {

	$rc = 0;
	$error = '';
	if ( $header ) {
		$fileout = wp_remote_head( $filein );
		if ( is_wp_error( $fileout ) ) {
			$error = 'Header: ' . $fileout -> get_error_message();
			$rc = -1;
		}
	} else {
		$fileout = wp_remote_get( $filein );
		if ( is_wp_error( $fileout ) ) {
			$error = 'Body: ' . $fileout -> get_error_message();
			$rc = -1;
		} else {
			if ( isset( $fileout[ 'body' ] ) ) {
				$file_return[ 'file' ] = $fileout[ 'body' ];
			}
		}
	}

	$file_return[ 'error' ] = $error;
	$file_return[ 'rc' ] = $rc;
	if ( !is_wp_error( $fileout ) ) {
		if ( isset( $fileout[ 'response' ][ 'code' ] ) ) {
			$file_return[ 'response' ] = $fileout[ 'response' ][ 'code' ];
		}
	}

	return $file_return;
}

/**
* Extract XML (1.3)
*
* Function to extract from an XML compatible file
*
* @since	1.2
*
* @param	string	$filein	The XML file
* @param	string	$tag	The tag to search for
* @return	string			The tag contents
*/

function aus_extract_xml( $filein, $tag ) {

	$tag_space = strpos( $tag, ' ',1 );

	if ( $tag_space != 0 ) {
		$tag_start = strpos( $filein, '<' . $tag );
		$bracket_find = strpos( $filein, '>', $tag_start );
		$tag_end = strpos( $filein, '</' . substr( $tag, 1, $tag_space - 1 ) . '>', $tag_start );
		$tag_extend = $bracket_find - $tag_end;
	} else {
		$tag_start = strpos( $filein, '<' . $tag . '>' );
		$tag_extend = 0;
		$tag_end = strpos( $filein, '</' . $tag . '>', $tag_start );
	}

	if ( ( $tag_start === false ) or ( $tag_end === false ) ) {
		$field = '';
	} else {
		$field_start = $tag_start + strlen( $tag ) + 2;
		$field_end = $tag_end + $tag_extend - 1;
		$field = substr( $filein, $field_start, $field_end - $field_start + 1 );
	}

	return $field;
}

/**
* Extract JSON (1.1)
*
* Very simple function to extract from a JSON formtat file
*
* @since	1.2
*
* @param	$filein string	JSON file
* @param	$tag	string	Tag content to extract
* @return			string	Tag value
*/

function aus_extract_json( $filein, $tag ) {

    $tag_start = strpos( $filein, '"' . $tag . '":' );
    if ( $tag_start !== false ) {
        $tag_start = $tag_start + 3 + strlen( $tag );
        $json_start = strpos( $filein, '"', $tag_start ) + 1;
        $json_end = strpos( $filein, '"', $json_start ) - 1;
    } else {
        $tag_start = strpos( $filein, "'" . $tag . "':" );
        if ( $tag_start !== false ) {
            $tag_start = $tag_start + 3 + strlen( $tag );
            $json_start = strpos( $filein, "'", $tag_start ) + 1;
            $json_end = strpos( $filein, "'", $json_start ) - 1;
        }
    }
    if ( ( $tag_start === false ) or ( $json_start === false ) or ( $json_end === false ) ) {
        $field = '';
    } else {
        $field = str_replace( '\/', '/', substr( $filein, $json_start, $json_end - $json_start + 1 ) );
    }
    return $field;
}
?>