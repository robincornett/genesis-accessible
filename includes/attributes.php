<?php
/** attributes.php
 *    Description: Fixes accessibility issues with the headings
 *    Author: Rian Rietveld
 *    Plugin URI: http://genesis-accessible.org/
 *    License: GPLv2 or later
 */

add_filter( 'the_content', 'wpaccgen_remove_title_attr', 1000 );
/**
 * Remove all title tags from images and links in posts.
 * Based on code from Ivan Glauser, http://www.glauserconsting.com
 * This list of filter is getting shorter with every new release WordPress and Genesis
 *
 * @param $text
 *
 * @return mixed
 */
function wpaccgen_remove_title_attr( $text ) {

	// Get all title="..." tags from the html.
	$result = array();
	preg_match_all( '| title="[^"]*"|U', $text, $result );

	// Replace all occurances with an empty string.
	foreach ( $result[0] as $title_attr ) {
		$text = str_replace( $title_attr, '', $text );
	}

	return $text;
}
