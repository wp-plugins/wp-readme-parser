<?php

/**
* Generate a short URL
*
* Functions to generate a shortened URL
*
* @package	Artiss-URL-Shortener
* @since	1.7
*/

/**
* Shorten URL
*
* Function to return a shortened URL
*
* @since	1.0
*
* @uses     aus_build_shortening_url    Create the shortening URL
* @uses     aus_convert_return_format   Convert the form of the returned URL
* @uses     aus_get_parameters          Extract parameters from a string
*
* @param	$url	string	The URL to shorten
* @param	$paras	string	A list of shortening parameters
* @return			string	The short URL
*/

function url_shortener( $url, $paras ) {

    // Get parameters and set up initial variable assignments

    $service_name = strtolower( aus_get_parameters( $paras, 'service' ) );
    $cache = strtolower( aus_get_parameters( $paras, 'cache' ) );
    $key = aus_get_parameters( $paras, 'apikey' );
    $login = aus_get_parameters( $paras, 'login' );
    $password = aus_get_parameters( $paras, 'password' );

    if ( $url == '' ) {
        global $post;
        $url = get_permalink( $post -> ID );
    }

    // Generate Cache details

    if ( $cache == '' ) { $cache= 24; }
    $filekey = md5( $url . $service_name . $key . $login );

    // Check if a cached version already exists - if so, return it

    $shorturl = '';
    if ( $cache != 'no' ) { $shorturl = get_transient( $filekey ); }

    // If no cached version returned, fetch and convert

    if ( $shorturl == '' ) {

        // Build service URL

        $service_url = aus_build_shortening_url( $service_name, $key, $login, $password, $url );

        if ( $service_url != '' ) {

            // If I don't yet have the short code data, fetch it

            $file_return = aus_get_file( $service_url );
            $return_data = $file_return[ 'file' ];

            // Convert the returned data into a short URL

            $shorturl = aus_convert_return_format( $return_data, $service_name );
        }

        $used_cache = false;

    } else {

        $used_cache = true;

    }

    // Return the full URL if no shortened URL was returned

    if ( $shorturl == '' ) {

        $shorturl = $url;

    } else {

        // Update the cache, if required

        if ( ( !$used_cache ) && ( $shorturl != $url ) ) { set_transient( $filekey, $shorturl, 3600 * $cache ); }

    }
    return $shorturl;
}

/**
* Build Shortening URL
*
* Function to build the shortening URL
*
* @since	1.6
*
* @uses     aus_build_service_array Build an array of services
*
* @param	$service_name	string	The URL shortening service
* @param	$key	        string	Users key
* @param    $login          string  Users login
* @param    $password       string  Users password
* @param    $url            string  URL to shorten
* @return			        string	The URL of the shortening call
*/

function aus_build_shortening_url( $service_name, $key, $login, $password, $url ) {

    // Build array of services

    $shortening_services = aus_build_services_array();

    // Get the URL of the required shortening service

    $service_url = $shortening_services[ $service_name ];

    // Encrypt password for certain services

    if ( substr( $service_name, 0, 6 ) == 'lnk.co' ) { $password = md5( $password, true ); }

    // Make any API key, login, etc changes

    $service_url = str_replace( '{key}', $key, $service_url );
    $service_url = str_replace( '{login}', $login, $service_url );
    $service_url = str_replace( '{password}', $password, $service_url );
    $service_url = str_replace( '{blog}', get_bloginfo( 'url' ), $service_url );

    // Access the service API and get the shortened URL

    if ( substr( $service_url, 0, 1 ) == '#' ) {
        $service_url = substr( $service_url, 1 ) . $url;
    } else {
        $service_url .= urlencode( $url );
    }

    return $service_url;
}

/**
* Convert Return Format
*
* Function to convert return format (if necessary)
*
* @since	1.6
*
* @uses     aus_extract_json    Extract JSON
* @uses     aus_extract_xml     Extract XML
*
* @param	$shorturl	    string	The short URL
* @param	$service_name	string  The name of the service
* @return			        string	The short URL
*/

function aus_convert_return_format( $shorturl, $service_name ) {

    // Extract the URL from XML files

    $xml_convert = build_xml_array();
    if ( isset( $xml_convert[ $service_name ] ) ) { $shorturl = aus_extract_xml( $shorturl, $xml_convert[ $service_name ] ); }

    // Extract the URL from JSON files

    $json_convert = build_json_array();
    if ( isset( $json_convert[ $service_name ] ) ) { $shorturl = aus_extract_json( $shorturl, $json_convert[ $service_name ] ); }

    // If only a short code is returned, append the rest of the URL on

    $url_addition = build_url_array();
    if ( isset( $url_addition[ $service_name ] ) ) { $shorturl = $url_addition[ $service_name ] . $shorturl; }

    // For other file modifications, treat them individually

    if ( ( $service_name == 'fon.gs' ) or ( $service_name == 'ln-s.net' ) ) { $shorturl = substr( $shorturl, 4 ); }

    if ( $service_name == 'url.co.uk' ) { $shorturl = substr( $shorturl, 9 ); }

    if ( $service_name == 'digg.com' ) {
        $xml_start = strpos( $service_name, 'short_url="' ) + 11;
        $xml_end = strpos( $service_name, '" view_count=' ) - 1;
        if ( ( $xml_end === true ) && ( $xml_end === true ) ) { $shorturl = substr( $service_name, $xml_start, $xml_end - $xml_start ); }
    }

    return $shorturl;
}
?>