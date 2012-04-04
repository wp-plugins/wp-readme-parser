<?php
/**
* Deprecated Code
*
* Various pieces of code, now deprecated, but kept here for backwards compatibility
*
* @package	Artiss-URL-Shortener
*/

/**
* Shorten URL
*
* Function to return a shortened URL
*
* @deprecated	1.7		Use url_shortener() instead
* @since	    1.0
*
* @uses     aus_get_parameters  Extract parameters
*
* @param	$url	string	The URL to shorten
* @param	$paras	string	A list of shortening parameters
* @return			string	The short URL
*/

function simple_url_shortener( $url, $paras ) {

    $service_name = strtolower( aus_get_parameters( $paras, 'service' ) );
    if ( $service_name == '' ) { $paras = 'service=' . $paras; }

    return url_shortener( $url, $paras );
}
?>