<?php
/**
 * Genesis Accessible Theme Settings.
 *
 * Registers a new admin page, providing content and corresponding menu item for the Accessible Theme Settings page.
 *
 *
 * @package Genesis Accessible\Admin
 *
 * @since 1.0.0
 */

class Genesis_Accessible_Theme_Settings extends Genesis_Admin_Boxes {

	/**
	 * Create an admin menu item and settings page.
	 * http://www.billerickson.net/admin-pages-with-genesis/
	 * @since 1.0.0
	 */
	function __construct() {

		// Specify a unique page ID.
		$page_id = 'genesis-accessible';


		// Set it as a child to genesis, and define the menu and page titles
		$menu_ops = array(
			'submenu' => array(
				'parent_slug' => 'genesis',
				'page_title'  => __( 'Genesis - Accessibility Settings', 'GENWPACC_DOMAIN' ),
				'menu_title'  => __( 'Accessibility Settings', 'GENWPACC_DOMAIN' )
			)
		);

		// Set up page options. These are optional, so only uncomment if you want to change the defaults
		$page_ops = array();

		// Give it a unique settings field.
		// You'll access them from genesis_get_option( 'option_name', 'child-settings' );
		$settings_field = 'genwpacc-settings';

		// Set the default values
		$default_settings = array();

		// Create the Admin Page
		$this->create( $page_id, $menu_ops, $page_ops, $settings_field, $default_settings );

		// Initialize the Sanitization Filter
		add_action( 'genesis_settings_sanitizer_init', array( $this, 'sanitization_filters' ) );

	}

	/**
	 * Set up Sanitization Filters
	 *
	 * See /lib/classes/sanitization.php for all available filters.
	 *
	 * @since 1.0.0
	 */
	function sanitization_filters() {

		genesis_add_option_filter( 'one_zero', $this->settings_field,
			array(
				'genwpacc_skiplinks',
				'genwpacc_skiplinks_css',
				'genwpacc_title_attr',
				'genwpacc_label_search',
				'genwpacc_read_more',
				'genwpacc_headings',
				'genwpacc_widget_headings',
				'genwpacc_tinymce',
				'genwpacc_dropdown'
			) );
	}

	/**
	 * Set up Help Tab
	 * Genesis automatically looks for a help() function, and if provided uses it for the help tabs
	 * @link http://wpdevel.wordpress.com/2011/12/06/help-and-screen-api-changes-in-3-3/
	 *
	 * @since 1.0.0
	 */
	 function help() {
	 	$screen = get_current_screen();

		$screen->add_help_tab( array(
			'id'      => 'genwpacc-help',
			'title'   => 'Genesis Accessible Help',
			'content' => '<p>For documentation, help and support visit <a href="http://genesis-accessible.org/">genesis-accessible.org</a></p>',
		) );
	 }

	/**
	 * Register metaboxes on Child Theme Settings page
	 *
	 * @since 1.0
	 */
	function metaboxes() {

		add_meta_box('plugin-documentation',  __( 'Genesis - Accessibility Documentation', 'GENWPACC_DOMAIN' ), array( $this, 'plugin_documentation' ), $this->pagehook, 'main', 'high');
		add_meta_box('genesis-settings',  __( 'Genesis - Accessibility Settings', 'GENWPACC_DOMAIN' ), array( $this, 'modify_settings_genesis' ), $this->pagehook, 'main', 'high');
		add_meta_box('wordpress-settings',  __( 'WordPress - Accessibility Settings', 'GENWPACC_DOMAIN' ), array( $this, 'modify_settings_wordpress' ), $this->pagehook, 'main', 'high');

	}

	/**
	 * Callback forGenesis - Accessibility Settings metabox
	 *
	 * @since 1.0.0
	 *
	 * @see Genesis_Accessible_Theme_Settings::metaboxes()
	 */
	function modify_settings_genesis() {

		?><p><span class="description"><?php printf( __( 'These settings are for the Genesis framework only.<br />Together with the WordPress setting below, your theme can be a lot more accessible.', GENWPACC_DOMAIN ) ); ?></span></p>


		<fieldset>
        	<legend><?php _e( 'Settings for Genesis:', GENWPACC_DOMAIN ); ?></legend>

			<p><label for="<?php echo $this->get_field_id( 'genwpacc_skiplinks' ); ?>"><input type="checkbox" name="<?php echo $this->get_field_name( 'genwpacc_skiplinks' ); ?>" id="<?php echo $this->get_field_id( 'genwpacc_skiplinks' ); ?>" value="1" <?php checked( $this->get_field_value( 'genwpacc_skiplinks' ) ); ?> />
			<?php printf( __( 'Add skiplinks?', GENWPACC_DOMAIN ) ); ?></label></p>

 			<p><label for="<?php echo $this->get_field_id( 'genwpacc_skiplinks_css' ); ?>"><input type="checkbox" name="<?php echo $this->get_field_name( 'genwpacc_skiplinks_css' ); ?>" id="<?php echo $this->get_field_id( 'genwpacc_skiplinks_css' ); ?>" value="1" <?php checked( $this->get_field_value( 'genwpacc_skiplinks_css' ) ); ?> />
			<?php printf( __( 'Add CSS for skiplinks?', GENWPACC_DOMAIN ) ); ?></label></p>

            <p><label for="<?php echo $this->get_field_id( 'genwpacc_label_search' ); ?>"><input type="checkbox" name="<?php echo $this->get_field_name( 'genwpacc_label_search' ); ?>" id="<?php echo $this->get_field_id( 'genwpacc_label_search' ); ?>" value="1" <?php checked( $this->get_field_value( 'genwpacc_label_search' ) ); ?> />
			<?php printf( __( 'Add an HTML label to the search widget?', GENWPACC_DOMAIN ) ); ?></label></p>

            <p><label for="<?php echo $this->get_field_id( 'genwpacc_headings' ); ?>"><input type="checkbox" name="<?php echo $this->get_field_name( 'genwpacc_headings' ); ?>" id="<?php echo $this->get_field_id( 'genwpacc_headings' ); ?>" value="1" <?php checked( $this->get_field_value( 'genwpacc_headings' ) ); ?> />
			<?php printf( __( 'Add H1 headings to archives and other pages that lacks an H1?', GENWPACC_DOMAIN ) ); ?></label></p>

            <p><label for="<?php echo $this->get_field_id( 'genwpacc_widget_headings' ); ?>"><input type="checkbox" name="<?php echo $this->get_field_name( 'genwpacc_widget_headings' ); ?>" id="<?php echo $this->get_field_id( 'genwpacc_widget_headings' ); ?>" value="1" <?php checked( $this->get_field_value( 'genwpacc_widget_headings' ) ); ?> />
			<?php printf( __( 'Change the H4 Widget Heading into an H2?', GENWPACC_DOMAIN ) ); ?></label></p>

            <p><label for="<?php echo $this->get_field_id( 'genwpacc_title_attr' ); ?>"><input type="checkbox" name="<?php echo $this->get_field_name( 'genwpacc_title_attr' ); ?>" id="<?php echo $this->get_field_id( 'genwpacc_title_attr' ); ?>" value="1" <?php checked( $this->get_field_value( 'genwpacc_title_attr' ) ); ?> />
			<?php printf( __( 'Remove title attributes link site title?', GENWPACC_DOMAIN ) ); ?></label></p>

            <p><label for="<?php echo $this->get_field_id( 'genwpacc_dropdown' ); ?>"><input type="checkbox" name="<?php echo $this->get_field_name( 'genwpacc_dropdown' ); ?>" id="<?php echo $this->get_field_id( 'genwpacc_dropdown' ); ?>" value="1" <?php checked( $this->get_field_value( 'genwpacc_dropdown' ) ); ?> />
			<?php printf( __( 'Add keyboard accessiblility to the dropdown menu (only select this if you have a dropdown ikn the main or sub navigation menu)?', GENWPACC_DOMAIN ) ); ?></label></p>


		</fieldset>



        <?php
	}

	/**
	 * Callback for WordPress - Accessibility Settings metabox
	 *
	 * @since 1.0.0
	 *
	 * @see Genesis_Accessible_Theme_Settings::metaboxes()
	 */
	function modify_settings_wordpress() {

		?><p><span class="description"><?php printf( __( 'These settings are for WordPress itself. If you have installed <a href=\"http://wordpress.org/plugins/wp-accessibility/\">WP Accessibility</a> by Joe Dolson too: don\'t worry you can use both plugins together.', GENWPACC_DOMAIN ) ); ?></span></p>


        <fieldset>
        	<legend><?php _e( 'Settings for WordPress:', GENWPACC_DOMAIN ); ?></legend>

            <p><label for="<?php echo $this->get_field_id( 'genwpacc_read_more' ); ?>"><input type="checkbox" name="<?php echo $this->get_field_name( 'genwpacc_read_more' ); ?>" id="<?php echo $this->get_field_id( 'genwpacc_read_more' ); ?>" value="1" <?php checked( $this->get_field_value( 'genwpacc_read_more' ) ); ?> />
			<?php printf( __( 'Add the post title to the read more links?', GENWPACC_DOMAIN ) ); ?></label></p>

            <p><label for="<?php echo $this->get_field_id( 'genwpacc_tinymce' ); ?>"><input type="checkbox" name="<?php echo $this->get_field_name( 'genwpacc_tinymce' ); ?>" id="<?php echo $this->get_field_id( 'genwpacc_tinymce' ); ?>" value="1" <?php checked( $this->get_field_value( 'genwpacc_tinymce' ) ); ?> />
			<?php printf( __( 'Remove h1, address, strikethrough, underline, forecolor, justifyfull, indent, outdent from editor?', GENWPACC_DOMAIN ) ); ?></label></p>


  		</fieldset>

        <?php
	}

	/**
	 * Callback for Genesis - Accessibility Documentation metabox
	 *
	 * @since 1.0.0
	 *
	 * @see Genesis_Accessible_Theme_Settings::metaboxes()
	 */
	function plugin_documentation() {

		?><p><span class="description"><?php printf( __( 'For documentation, help and support please visit <a href="http://genesis-accessible.org/">genesis-accessible.org</a>.', GENWPACC_DOMAIN ) ); ?></span></p>

        <?php
	}


}



add_action( 'genesis_admin_menu', 'genwpacc_theme_settings' );
/**
 * Add the Theme Settings Page
 *
 * @since 1.0.0
 */
function genwpacc_theme_settings() {
	global $_genwpacc_theme_settings;
	$_genwpacc_theme_settings = new Genesis_Accessible_Theme_Settings;
}