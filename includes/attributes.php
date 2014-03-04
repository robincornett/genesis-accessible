<?php
/** attributes.php
	Description: Fixes accessibility issues with the headings
	Version: 1.0
	Author: Rian Rietveld
	Author URI: http://rrwd.nl
	License: GPLv2 or later
*/


//* Modify the header URL
//* remove title attribute from the link
add_filter( 'genesis_seo_title', 'wpaccgen_genesis_seo_title', 10, 3 );
function wpaccgen_genesis_seo_title( $title, $inside, $wrap )  {
	
	if ( genesis_get_option( 'genwpacc_title_attr', 'genwpacc-settings' ) == 0 ) return $title;
	
	//* Set what goes inside the wrapping tags
	$inside = sprintf( '<a href="%s" >%s</a>', trailingslashit( home_url() ), get_bloginfo( 'name' ) );
	//* Build the title
	$title  = genesis_html5() ? sprintf( "<{$wrap} %s>", genesis_attr( 'site-title' ) ) : sprintf( '<%s id="title">%s</%s>', $wrap, $inside, $wrap );
	$title .= genesis_html5() ? "{$inside}</{$wrap}>" : '';
	
	return $title;
}


// remove title attribute form the breadcrumbs
add_filter ( 'genesis_breadcrumb_link', 'wpaccgen_ggenesis_breadcrumb_link', 10, 4 );
function wpaccgen_ggenesis_breadcrumb_link( $link, $url, $title, $content ) {
    $link = sprintf( '<a href="%s">%s</a>', esc_attr( $url ), esc_html( $content ) );
	return $link;
}

?>