<?php
/*
Plugin Name: Artiss README Parser
Plugin URI: http://www.artiss.co.uk/readme-parser
Description: Show WordPress Plugin README in your Posts
Version: 1.2
Author: David Artiss
Author URI: http://www.artiss.co.uk
*/

/**
* README Parser
*
* Main code - include various functions
*
* @package	Artiss-README-Parser
*/

define( 'artiss_readme_parser_version', '1.2' );

/**
* Plugin initialisation
*
* Loads the plugin's translated strings
*
* @since	1.2
*/

function arp_plugin_init() {

    $language_dir = plugin_basename( dirname( __FILE__ ) ) . '/languages/';

	load_plugin_textdomain( 'wp-readme_parser', false, $language_dir );

}

add_action( 'init', 'arp_plugin_init' );

/**
* Main Includes
*
* Include all the plugin's functions
*
* @since	1.2
*/

$functions_dir = WP_PLUGIN_DIR . '/wp-readme-parser/includes/';

// Include all the various functions

if ( is_admin() ) {

    include_once( $functions_dir . 'arp-admin-config.php' );     				        // Various admin. functions

}

include_once( WP_PLUGIN_DIR . '/wp-readme-parser/PHP Markdown Extra/markdown.php' );    // PHP Markdown Extra

include_once( $functions_dir . 'arp-functions.php' );     				                // Various functions

include_once( $functions_dir . 'arp-generate-output.php' );				                // Generate the output

include_once( $functions_dir . 'arp-deprecated.php' );					                // Deprecated functionality

?>