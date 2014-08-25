<?php
/** wp-modification.php
*	Description: Fixes accessibility issues with the Genesis Fraemework
*	Author: Rian Rietveld
*	Plugin URI: http://genesis-accessible.org/
*	License: GPLv2 or later
*/


// Remove read more - basicWP.com
// keping the link on the post title
add_filter('get_the_content_more_link', 'genwpacc_read_more_link');
add_filter('the_content_more_link', 'genwpacc_read_more_link');

function genwpacc_read_more_link() {
    if ( genesis_get_option( 'genwpacc_read_more', 'genwpacc-settings' )  == 0 ) return;
	// http://wpfab.com/edit-the-read-more-link-on-blog-or-content-archive-pages/
	return '...<br /> <a href="'. get_permalink() .'" class="more-link">' . __( 'Read more', 'genesis' ) . '<span class="more-link-title"> ' . __( 'about', GENWPACC_DOMAIN ) . " " . get_the_title() . "</span></a>";
}
