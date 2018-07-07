<?php
/**
 * 404.php
 * Author: Rian Rietveld
 * Author URI: http://genesis-accessible.org/
 * License: GPLv2 or later
 */

//* Remove default loop
remove_action( 'genesis_loop', 'genesis_do_loop' );

add_action( 'genesis_loop', 'genwpacc_404' );
/**
 * This function outputs a 404 "Not Found" error message
 *
 * @since 1.0
 */
function genwpacc_404() {

	echo genesis_html5() ? '<article class="entry">' : '<div class="post hentry">';

	printf( '<h1 class="entry-title">%s</h1>', __( 'Page not found', 'genesis-accessible' ) );
	echo '<div class="entry-content">';

	?>
	<p><?php printf( __( 'The page you are looking for no longer exists. Perhaps you can return back to the site\'s <a href="%s">homepage</a> and see if you can find what you are looking for. Or, you can try finding it with the information below.', 'genesis' ), home_url() ); ?></p><?php

	echo '<p>' . wpaccgen_get_search_form_uniqueid() . '</p>';

	?>

	<h2><?php _e( 'Sitemap', 'genesis' ); ?></h2>

	<h3><?php _e( 'Pages:', 'genesis' ); ?></h3>
	<ul>
		<?php wp_list_pages( 'title_li=' ); ?>
	</ul>

	<h3><?php _e( 'Categories:', 'genesis' ); ?></h3>
	<ul>
		<?php wp_list_categories( 'sort_column=name&title_li=' ); ?>
	</ul>

	<h3><?php _e( 'Authors:', 'genesis' ); ?></h3>
	<ul>
		<?php wp_list_authors( 'exclude_admin=0&optioncount=1' ); ?>
	</ul>

	<h3><?php _e( 'Monthly:', 'genesis' ); ?></h3>
	<ul>
		<?php wp_get_archives( 'type=monthly' ); ?>
	</ul>

	<h3><?php _e( 'Recent Posts:', 'genesis' ); ?></h3>
	<ul>
		<?php wp_get_archives( 'type=postbypost&limit=100' ); ?>
	</ul>

	<?php

	echo '</div>';

	echo genesis_html5() ? '</article>' : '</div>';

}

genesis();
