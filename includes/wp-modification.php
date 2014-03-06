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


/*
Description: Removes all title tags from images and links in posts.
Based on code from Ivan Glauser, http://www.glauserconsulting.com */

// check for Joe Dolson's plugin
if ( !function_exists( 'wpa_image_titles' ) &&  get_option( 'wpa_image_titles' ) != 'on' )
	add_filter( 'the_content', 'genwpacc_remove_title_attr', 100 );

add_filter( 'genesis_footer_output', 'genwpacc_remove_title_attr', 100 );

function genwpacc_remove_title_attr( $text ) {

    // Get all title="..." tags from the html.
    $result = array();
    preg_match_all('|title="[^"]*"|U', $text, $result);

    // Replace all occurances with an empty string.
    foreach($result[0] as $title_attr)
    {
        $text = str_replace($title_attr, '', $text);
    }

    return $text;
}


?>