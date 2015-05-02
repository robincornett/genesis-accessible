<?php
/** headings.php
*	Description: Fixes accessibility issues with the headings semantics
*	Author: Rian Rietveld
*	Plugin URI: http://genesis-accessible.org/
*	License: GPLv2 or later
*/

/** add an H1 on archives when the title is not added by meta value */
add_action ('genesis_before_loop', 'wpaccgen_genesis_do_archive_title', 100);
function wpaccgen_genesis_do_archive_title() {

    if ( is_page_template( 'page_blog.php' ) ) {
        echo '<div class="archive-description page-blog">';
            genesis_do_post_title();
        echo '</div>';
    }

    if ( ! is_category() && ! is_tag() && ! is_tax() && ! is_post_type_archive() && ! is_archive() && is_author() ) {
        return;
    }

    $headline = '';


    if ( is_category() || is_tag() || is_tax() ) {

        global $wp_query;

        $term = is_tax() ? get_term_by( 'slug', get_query_var( 'term' ), get_query_var( 'taxonomy' ) ) : $wp_query->get_queried_object();
        if ( isset( $term->meta['headline'] ) ) {
            return;
        }

        $headline = sprintf( '<h1 class="archive-title">%s</h1>', strip_tags( $term->name ) );
        printf( '<div class="archive-description taxonomy-description">%s</div>', $headline );

    } elseif ( is_post_type_archive() && genesis_has_post_type_archive_support() ) {

        if (  '' != genesis_get_cpt_option( 'headline' ) ) {
            return;
        }

        $headline = sprintf( '<h1 class="archive-title">%s</h1>', strip_tags( post_type_archive_title( '', false ) ) );
        printf( '<h1 class="archive-description cpt-archive-description">%s</h1>', strip_tags( $headline ) );

    } elseif ( is_author() ) {

        if ( '' != get_the_author_meta( 'headline', (int) get_query_var( 'author' ) )  ) {
            return;
        }

        $headline = sprintf( '<h1 class="archive-title">%s</h1>', strip_tags( get_the_author_meta( 'display_name', (int) get_query_var( 'author' ) ) ) );
        printf( '<div class="archive-description author-description">%s</div>', $headline );

    } elseif ( is_date() ) {

        if ( is_day() ) {
            $headline = __( 'Archives for ', 'genesis' ) . get_the_date();
        } elseif ( is_month() ) {
            $headline = __( 'Archives for ', 'genesis' ) . single_month_title( ' ', false );
        } elseif ( is_year() ) {
            $headline = __( 'Archives for ', 'genesis' ) . get_query_var( 'year' );
        }

        if ( $headline ) {
            printf( '<div class="archive-description archive-date"><h1 class="archive-title">%s</h1></div>', $headline );
        }

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
