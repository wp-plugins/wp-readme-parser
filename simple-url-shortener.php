<?php
/*
Plugin Name: Artiss URL Shortener
Plugin URI: http://www.artiss.co.uk/url-shortener
Description: Shorten a URL using one of over 100 shortening services
Version: 1.7.1
Author: David Artiss
Author URI: http://www.artiss.co.uk
*/

/**
* Artiss URL Shortener
*
* Main code - include various functions
*
* @package	Artiss-URL-Shortener
* @since	1.7
*/

$functions_dir = WP_PLUGIN_DIR . '/simple-url-shortener/includes/';

// Include all the various functions

if ( is_admin() ) {

    include_once( $functions_dir . 'aus-admin-config.php' );		        // Assorted admin configuration changes

} else {

	include_once( $functions_dir . 'aus-shared-functions.php' );       		// Various short functions

	include_once( $functions_dir . 'aus-set-up-arrays.php' );       		// Set up URL Shortening data

	include_once( $functions_dir . 'aus-deprecated.php' );	        		// Deprecated functions

	include_once( $functions_dir . 'aus-generate-short-url.php' );			// Generate a short URL

	include_once( $functions_dir . 'aus-validate-shortener.php' );			// Validate shortener services

}
?>