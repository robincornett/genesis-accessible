<?php
/** skip-links.php
 *    Description: Adds skiplinks after the header to content, menu's and asides.
 *    Author: Rian Rietveld
 *    Plugin URI: http://genesis-accessible.org/
 *    License: GPLv2 or later
 */


add_action( 'genesis_before_header', 'genwpacc_skip_links', 5 );
/** Add skiplinks for screen readers and keyboard navigation for Genesis version < 2.2
 *
 * @since 1.0.0
 */
function genwpacc_skip_links() {

	// Call function to add IDs to the markup
	genwpacc_skiplinks_markup();

	// Determine which skip links are needed
	$links = array();

	if ( has_nav_menu( 'primary' ) ) {
		$links['genesis-nav-primary'] = __( 'Skip to primary navigation', 'genesis-accessible' );
	}

	$links['genesis-content'] = __( 'Skip to content', 'genesis-accessible' );

	if ( in_array( genesis_site_layout(), array(
		'sidebar-content',
		'content-sidebar',
		'sidebar-sidebar-content',
		'sidebar-content-sidebar',
		'content-sidebar-sidebar',
	) ) ) {
		$links['genesis-sidebar-primary'] = __( 'Skip to primary sidebar', 'genesis-accessible' );
	}

	if ( in_array( genesis_site_layout(), array(
		'sidebar-sidebar-content',
		'sidebar-content-sidebar',
		'content-sidebar-sidebar',
	) ) ) {
		$links['genesis-sidebar-secondary'] = __( 'Skip to secondary sidebar', 'genesis-accessible' );
	}

	if ( current_theme_supports( 'genesis-footer-widgets' ) ) {
		$footer_widgets = get_theme_support( 'genesis-footer-widgets' );
		if ( isset( $footer_widgets[0] ) && is_numeric( $footer_widgets[0] ) ) {
			if ( is_active_sidebar( 'footer-1' ) ) {
				$links['genesis-footer-widgets'] = __( 'Skip to footer', 'genesis-accessible' );
			}
		}
	}

	/**
	 * Filter the skip links.
	 *
	 * @since 1.2.0
	 *
	 * @param array $links {
	 *                     Default skiplinks.
	 *
	 * @type string HTML ID attribute value to link to.
	 * @type string Anchor text.
	 * }
	 */
	$links = apply_filters( 'genesis_skip_links_output', $links );

	// write HTML, skiplinks in a list with a heading
	$skiplinks  = '<section>';
	$skiplinks .= '<h2 class="screen-reader-text">' . __( 'Skip links', 'genesis-accessible' ) . '</h2>';
	$skiplinks .= '<ul class="genesis-skip-link genwpacc-genesis-skip-link">';

	// Add markup for each skiplink
	foreach ( $links as $key => $value ) {
		$skiplinks .= '<li><a href="' . esc_url( '#' . $key ) . '" class="screen-reader-shortcut"> ' . $value . '</a></li>';
	}

	$skiplinks .= '</ul>';
	$skiplinks .= '</section>' . "\n";

	echo $skiplinks;
}

/**
 * Add ID markup to the elements to jump to  for Genesis version < 2.2
 *
 * @since 1.2.0
 *
 * @link  https://gist.github.com/salcode/7164690
 * @link  genesis_markup() http://docs.garyjones.co.uk/genesis/2.0.0/source-function-genesis_parse_attr.html#77-100
 *
 */
function genwpacc_skiplinks_markup() {

	add_filter( 'genesis_attr_nav-primary', 'genwpacc_skiplinks_attr_nav_primary' );
	add_filter( 'genesis_attr_content', 'genwpacc_skiplinks_attr_content' );
	add_filter( 'genesis_attr_sidebar-primary', 'genwpacc_skiplinks_attr_sidebar_primary' );
	add_filter( 'genesis_attr_sidebar-secondary', 'genwpacc_skiplinks_attr_sidebar_secondary' );
	add_filter( 'genesis_attr_footer-widgets', 'genwpacc_skiplinks_attr_footer_widgets' );

}

/**
 * Add ID markup to primary navigation
 *
 * @since  1.2.0
 *
 * @param array $attributes Existing attributes.
 *
 * @return $attributes plus id and aria-label
 *
 */
function genwpacc_skiplinks_attr_nav_primary( $attributes ) {
	$attributes['id']         = 'genesis-nav-primary';
	$attributes['aria-label'] = __( 'Main navigation', 'genesis-accessible' );

	return $attributes;
}

/**
 * Add ID markup to content area
 *
 * @since  1.2.0
 *
 * @param array $attributes Existing attributes.
 *
 * @return $attributes plus id
 *
 */
function genwpacc_skiplinks_attr_content( $attributes ) {
	$attributes['id'] = 'genesis-content';

	return $attributes;
}

/**
 * Add ID markup to primary sidebar
 *
 * @since  1.2.0
 *
 * @param array $attributes Existing attributes.
 *
 * @return $attributes plus id
 *
 */
function genwpacc_skiplinks_attr_sidebar_primary( $attributes ) {
	$attributes['id'] = 'genesis-sidebar-primary';

	return $attributes;
}

/**
 * Add ID markup to secondary sidebar
 *
 * @since  1.2.0
 *
 * @param array $attributes Existing attributes.
 *
 * @return $attributes plus id
 *
 */
function genwpacc_skiplinks_attr_sidebar_secondary( $attributes ) {
	$attributes['id'] = 'genesis-sidebar-secondary';

	return $attributes;
}

/**
 * Add ID markup to footer widget area
 *
 * @since  1.2.0
 *
 * @param array $attributes Existing attributes.
 *
 * @return $attributes plus id
 *
 */
function genwpacc_skiplinks_attr_footer_widgets( $attributes ) {
	$attributes['id'] = 'genesis-footer-widgets';

	return $attributes;
}

add_action( 'wp_enqueue_scripts', 'genwpacc_skiplinks_scripts' );
/**
 * Enqueue the skip links js.
 */
function genwpacc_skiplinks_scripts() {
	wp_enqueue_script( 'genwpacc-skiplinks-js', GENWPACC_PLUGIN_URL . 'js/genwpacc-skiplinks.js' );
}
