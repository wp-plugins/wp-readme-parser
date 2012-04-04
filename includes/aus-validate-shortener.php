<?php
/**
* Validate URL Shortener
*
* Function to validate a URL shortening service
*
* @package	Artiss-URL-Shortener
* @since	1.1
*
* @uses     aus_build_services_array    Create an array of shortening services
*
* @return	string	                    Array of values
*/

function validate_url_shortener( $validate_text, $validate_mask ) {

    // Ensure that the service tag is in the mask

    if ( strpos( $validate_mask, '{service}' ) === false ) { $validate_mask = '{service}'; }

    // Build array of services

    $shortening_services = aus_build_services_array();

    // Read through each service name and attempt to find it in the text,
    // applying any masks

    foreach ( $shortening_services as $key => $value ) {
        $find_in_text = str_replace( '{service}', $key, $validate_mask );
        if ( strpos( $validate_text, $find_in_text ) !== false ) { $shorturl = $key; }
    }
    return $shorturl;
}
?>