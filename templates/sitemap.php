<?php
/**
 * Template Name: Sitemap
 * This file creates a site map 
 *
 * This file is based on the core Genesis file page_archive.
 *
 * @category Page Template
 * @package  Templates
 * @author   Rian Rietveld
 * @license  http://www.opensource.org/licenses/gpl-license.php GPL v2.0 (or later)
 * @link     http://www.rrwd.nl
 */

/** Remove standard post content output **/
remove_action( 'genesis_entry_content', 'genesis_page_archive_content' );
remove_action( 'genesis_post_content', 'genesis_page_archive_content' );

add_action( 'genesis_entry_content', 'genwpacc_page_archive_content' );
add_action( 'genesis_post_content', 'genwpacc_page_archive_content' );

/**
 * This function outputs sitemap-esque columns displaying all pages,
 * categories, authors, monthly archives, and recent posts.
 *
 * @since 1.0
 */
function genwpacc_page_archive_content() { ?>

	<h2><?php _e( 'Pages:', 'genesis' ); ?></h2>
	<ul>
		<?php wp_list_pages( 'title_li=' ); ?>
	</ul>

	<h2><?php _e( 'Categories:', 'genesis' ); ?></h2>
	<ul>
		<?php wp_list_categories( 'sort_column=name&title_li=' ); ?>
	</ul>

	<h2><?php _e( 'Authors:', 'genesis' ); ?></h2>
	<ul>
		<?php wp_list_authors( 'exclude_admin=0&optioncount=1' ); ?>
	</ul>

	<h2><?php _e( 'Monthly:', 'genesis' ); ?></h2>
	<ul>
		<?php wp_get_archives( 'type=monthly' ); ?>
	</ul>

	<h2><?php _e( 'Recent Posts:', 'genesis' ); ?></h2>
	<ul>
		<?php wp_get_archives( 'type=postbypost&limit=100' ); ?>
	</ul>

<?php
}

genesis();