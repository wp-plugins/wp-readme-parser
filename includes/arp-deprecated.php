<?php
/**
* Deprecated Code
*
* Various pieces of code, now deprecated, but kept here for backwards compatibility
*
* @package	Artiss-README-Parser
* @since	1.2
*/

/**
* Output the README
*
* Function to output the results of the README
*
* @deprecated	1.2		Use readme_parser() instead.
* @since		1.2
*
* @uses		readme_parser   	Output README
*
* @param    string  $content    README filename
* @param	string	$paras		Parameters
*/

function wp_readme_parser( $paras = '', $content = '' ) {
    return readme_parser( $paras, $content );
}
?>