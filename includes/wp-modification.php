<?php
/** wp-modification.php
*	Description: Fixes accessibility issues with the Genesis Fraemework
*	Version: 1.0.0
*	Author: Rian Rietveld
*	Plugin URI: http://genesis-accessible.org/
*	License: GPLv2 or later
*/


// Remove read more - basicWP.com
// keping the link on the post title

// check for Joe's plugin
if ( !function_exists( 'wpa_custom_excerpt_more' ) && get_option('wpa_more') != 'on' ) {
	add_filter( 'get_the_excerpt', 'genwpacc_excerpt_more',100 );
	add_filter( 'get_the_content_more_link', 'genwpacc_read_more_link',100 );
	add_filter( 'excerpt_more', 'genwpacc_excerpt_more',100 );
	add_filter( 'the_content_more_link', 'genwpacc_read_more_link', 100 );
}

function genwpacc_read_more_link() {

	if ( has_excerpt() && !is_attachment() ) {
		global $id;
		$output .=  genwpacc_continue_reading( $id );
	}

	return $output;
}

function genwpacc_continue_reading( $id ) {
    return ' <a href="'. get_permalink( $id ) .'" class="more-link">' . __( 'Read more', 'genesis' ) . '<span class="more-link-title"> ' . __( 'about', GENWPACC_DOMAIN ) . " " . get_the_title($id) . "</span></a>";
}

function genwpacc_excerpt_more( $more ) {
	global $id;
	return '&hellip; '. genwpacc_continue_reading( $id );
}

function genwpacc_content_more( $more ) {
	global $id;
	return genwpacc_continue_reading( $id );
}


/*
Description: Removes all title tags from images and links in posts.
Based on code from Ivan Glauser, http://www.glauserconsulting.com */

// check for Joe's plugin
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