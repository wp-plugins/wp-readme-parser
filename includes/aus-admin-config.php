<?php
/**
* Admin Menu Functions
*
* Various functions relating to the various administration screens
*
* @package	Artiss-URL-Shortener
*/

/**
* Add meta to plugin details
*
* Add options to plugin meta line
*
* @since	1.0
*
* @param	string  $links	Current links
* @param	string  $file	File in use
* @return   string			Links, now with settings added
*/

function aus_set_plugin_meta( $links, $file ) {

	if ( strpos( $file, 'simple-url-shortener.php' ) !== false ) {
		$links = array_merge( $links, array( '<a href="http://www.artiss.co.uk/forum">' . __( 'Support' ) . '</a>' ) );
		$links = array_merge( $links, array( '<a href="http://www.artiss.co.uk/donate">' . __( 'Donate' ) . '</a>' ) );
	}

	return $links;
}
add_filter( 'plugin_row_meta', 'aus_set_plugin_meta', 10, 2 );
?>