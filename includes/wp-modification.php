<?php

add_filter('get_the_content_more_link', 'genwpacc_read_more_link');
add_filter('the_content_more_link', 'genwpacc_read_more_link');

/**
 * Adds the title to the read more link in archives
 *
 * @since 1.0
 */

function genwpacc_read_more_link( $link ) {

	if ( genesis_get_option( 'genwpacc_read_more', 'genwpacc-settings' )  == 0 ) return $link;

	return '...<br /> <a href="'. get_permalink() .'" class="more-link">' . __( 'Read more', 'genesis' ) . '<span class="more-link-title screen-reader-text"> ' . __( 'about ', 'genesis-accessible' ) . get_the_title() . "</span></a>";

}
