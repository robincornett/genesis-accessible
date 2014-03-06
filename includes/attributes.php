<?php
/** attributes.php
*	Description: Fixes accessibility issues with the headings
*	Author: Rian Rietveld
*	Plugin URI: http://genesis-accessible.org/
*	License: GPLv2 or later
*/


//* Modify the header URL
//* remove title attribute from the link
add_filter( 'genesis_seo_title', 'wpaccgen_genesis_seo_title', 10, 3 );
function wpaccgen_genesis_seo_title( $title, $inside, $wrap )  {

	//* Set what goes inside the wrapping tags
	$inside = sprintf( '<a href="%s" >%s</a>', trailingslashit( home_url() ), get_bloginfo( 'name' ) );
	//* Build the title
	$title  = genesis_html5() ? sprintf( "<{$wrap} %s>", genesis_attr( 'site-title' ) ) : sprintf( '<%s id="title">%s</%s>', $wrap, $inside, $wrap );
	$title .= genesis_html5() ? "{$inside}</{$wrap}>" : '';

	return $title;
}


/* Remove title attribute form the breadcrumbs */
add_filter ( 'genesis_breadcrumb_link', 'wpaccgen_ggenesis_breadcrumb_link', 10, 4 );
function wpaccgen_ggenesis_breadcrumb_link( $link, $url, $title, $content ) {
    $link = sprintf( '<a href="%s">%s</a>', esc_attr( $url ), esc_html( $content ) );
	return $link;
}

/* Remove all title tags from images and links in posts.
Based on code from Ivan Glauser, http://www.glauserconsting.com
The WordPress filters may become become redundant in future releases of WordPress, I hope the Genesis filters too */

add_filter( 'the_content', 'wpaccgen_remove_title_attr', 1000 );
add_filter( 'image_send_to_editor', 'wpaccgen_remove_title_attr', 1000 );
add_filter( 'post_thumbnail_html', 'wpaccgen_remove_title_attr', 1000 );
add_filter( 'wp_get_attachment_image', 'wpaccgen_remove_title_attr', 1000 );
add_filter( 'genesis_get_image', 'wpaccgen_remove_title_attr', 1000 );
add_filter( 'genesis_footer_output', 'wpaccgen_remove_title_attr', 1000 );
add_filter( 'wp_list_categories', 'wpaccgen_remove_title_attr', 1000 );
add_filter( 'genesis_post_title_output', 'wpaccgen_remove_title_attr', 1000 );
add_filter( 'genesis_do_post_permalink', 'wpaccgen_remove_title_attr', 1000 );

function wpaccgen_remove_title_attr($text) {

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