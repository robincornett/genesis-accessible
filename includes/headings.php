<?php
/** headings.php
*	Description: Fixes accessibility issues with the headings
*	Version: 1.0.0
*	Author: Rian Rietveld
*	Plugin URI: http://genesis-accessible.org/
*	License: GPLv2 or later
*/


/** add an H1 on date archives */
add_action ('genesis_before_loop', 'wpaccgen_genesis_do_archive_title', 100);
function wpaccgen_genesis_do_archive_title() {
	if ( is_category() || is_tag() || is_tax() || is_author() || is_post_type_archive() ) return;
	if ( is_archive() ) {
		remove_filter( 'wp_title', 'genesis_doctitle_wrap', 20 );
  		$title = wp_title( "", false, "" );
		echo '<div class="archive-description"><h1 class="archive-title">' . $title  . "</h1></div>\n";
	}
}


/** Add an H2 heading to the primary navigation */
add_filter( 'genesis_do_nav', 'wpaccgen_genesis_add_header_to_primary_nav', 10, 1 );
function wpaccgen_genesis_add_header_to_primary_nav( $nav_output ) {
        echo '<h2 class="screen-reader-text">'. __( 'Main navigation', GENWPACC_DOMAIN ) .'</h2>';
    return $nav_output;
}

/** Sidebar filter, H4 in Widgets and sidebars modified to an H2 */
add_filter( 'genesis_register_sidebar_defaults', 'wpaccgen_genesis_register_sidebar_defaults' );
function wpaccgen_genesis_register_sidebar_defaults( $args ) {

    $args['before_title'] = '<h2 class="widgettitle widget-title">';
    $args['after_title'] = "</h2>\n";

    return $args;
}

?>