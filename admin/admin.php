<?php
/**
*	admin.php
*	Description: Functions for Admin editor settings
*	@since 1.0.0
*/

//* Modifying TinyMCE editor to remove items that could mess up WCAG rules, such as semantics and inline styles.
add_filter( 'tiny_mce_before_init', 'genwpacc_customformat_tinymce' );
function genwpacc_customformat_tinymce( $init ) {
	if ( genesis_get_option( 'genwpacc_tinymce', 'genwpacc-settings' ) == 0 ) return $init;
	$init['theme_advanced_blockformats'] = 'p,h2,h3,pre';
	$init['theme_advanced_disable'] = 'strikethrough,underline,forecolor,justifyfull,indent,outdent';
	return $init;
}

?>