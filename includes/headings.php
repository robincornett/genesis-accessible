<?php
/** headings.php
*	Description: Fixes accessibility issues with the headings semantics
*	Author: Rian Rietveld
*	Plugin URI: http://genesis-accessible.org/
*	License: GPLv2 or later
*/

/** add an H1 on archives */
add_action ('genesis_before_loop', 'wpaccgen_genesis_do_archive_title', 100);
function wpaccgen_genesis_do_archive_title() {

    if ( is_page_template( 'page_blog.php' ) || is_author() ) {
        remove_filter( 'wp_title', 'genesis_doctitle_wrap', 20 );
        $title = wp_title( "", false, "" );
        echo '<div class="screen-reader-text"><h1 class="screen-reader-text">' . $title  . "</h1></div>\n";
    }

    if ( genesis_first_version_compare( '2.0.2', '>' ) )
        return;

    if ( is_category() || is_tag() || is_tax() || is_post_type_archive() || is_archive() ) {
        remove_filter( 'wp_title', 'genesis_doctitle_wrap', 20 );
        $title = wp_title( "", false, "" );
        echo '<div class="archive-description"><h1 class="archive-title">' . $title  . "</h1></div>\n";
    }

}



/** Add an H2 heading to the primary navigation */
add_filter( 'genesis_do_nav', 'genwpacc_genesis_add_header_to_primary_nav', 10, 3 );
function genwpacc_genesis_add_header_to_primary_nav( $nav_output, $nav, $args ) {

    if ( ! genesis_nav_menu_supported( 'primary' ) || ! has_nav_menu( 'primary' ) )
        return;

    $heading =  '<h2 class="screen-reader-text">'. __( 'Main navigation', GENWPACC_DOMAIN ) .'</h2>';

    $nav_markup_open = genesis_markup( array(
        'html5' => '<nav %s>',
        'xhtml' => '<div id="nav" class="nav-primary">',
        'context' => 'nav-primary',
        'echo' => false,
    ) );

    $nav_markup_open .= genesis_structural_wrap( 'menu-primary', 'open', 0 );
    $nav_markup_close = genesis_structural_wrap( 'menu-primary', 'close', 0 );
    $nav_markup_close .= genesis_html5() ? '</nav>' : '</div>';

    $nav_output = $nav_markup_open . $heading . $nav . $nav_markup_close;

    return apply_filters( 'genwpacc_genesis_add_header_to_primary_nav', $nav_output, $nav, $args );
}

/** Sidebar filter, H4 in Widgets and sidebars modified to an H2 */
add_filter( 'genesis_register_sidebar_defaults', 'genwpacc_genesis_register_sidebar_defaults' );
function genwpacc_genesis_register_sidebar_defaults( $args ) {

    $args['before_title'] = '<h2 class="widgettitle widget-title">';
    $args['after_title'] = "</h2>\n";

    return $args;
}
