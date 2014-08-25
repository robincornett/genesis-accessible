<?php
/**
*	admin.php
*	Description: Functions for Admin editor settings
*	Author: Rian Rietveld
*	Plugin URI: http://genesis-accessible.org/
*	License: GPLv2 or later
*/

//* Modifying TinyMCE editor to remove items that could mess up WCAG rules, the H1 and the address element (address is often used in the wrong context).
add_filter( 'tiny_mce_before_init', 'genwpacc_customformat_tinymce' );
function genwpacc_customformat_tinymce( $init ) {
	if ( genesis_get_option( 'genwpacc_tinymce', 'genwpacc-settings' ) == 0 ) return $init;
	$init['block_formats'] = 'Paragraph=p; Heading 2=h2; Heading 3=h3; Heading 4=h4; Heading 5=h5; Heading 6=h6; pre=pre; address=address';
	return $init;
}
