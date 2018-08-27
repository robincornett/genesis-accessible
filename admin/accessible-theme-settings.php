<?php
/**
 * Genesis Accessible Theme Settings.
 *
 * Registers a new admin page, providing content and corresponding menu item for the Accessible Theme Settings page.
 * Author: Rian Rietveld
 * Plugin URI: http://genesis-accessible.org/
 * License: GPLv2 or later
 *
 */

class Genesis_Accessible_Theme_Settings extends Genesis_Admin_Boxes {

	/**
	 * Current child theme support for Genesis accessibility settings.
	 *
	 * @var array
	 */
	protected $theme_supports = array();

	/**
	 * Create an admin menu item and settings page.
	 * http://www.billerickson.net/admin-pages-with-genesis/
	 * @since 1.0.0
	 */
	public function __construct() {

		// Specify a unique page ID.
		$page_id = 'genesis-accessible';

		$theme                = new GenesisAccessibleThemeSupport();
		$this->theme_supports = $theme->get_theme_support();

		// Set it as a child to genesis, and define the menu and page titles
		$menu_ops = array(
			'submenu' => array(
				'parent_slug' => 'genesis',
				'page_title'  => __( 'Genesis - Accessibility Settings', 'genesis-accessible' ),
				'menu_title'  => __( 'Accessibility Settings', 'genesis-accessible' ),
			),
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
	public function sanitization_filters() {

		genesis_add_option_filter( 'one_zero', $this->settings_field,
			array(
				'genwpacc_screen_reader_text',
				'genwpacc_skiplinks',
				'genwpacc_skiplinks_css',
				'genwpacc_widget_headings',
				'genwpacc_no_title_attr',
				'genwpacc_read_more',
				'genwpacc_tinymce',
				'genwpacc_dropdown',
				'genwpacc_remove_genesis_widgets',
			)
		);
	}

	/**
	 * Set up Help Tab
	 * Genesis automatically looks for a help() function, and if provided uses it for the help tabs
	 * @link  http://wpdevel.wordpress.com/2011/12/06/help-and-screen-api-changes-in-3-3/
	 *
	 * @since 1.0.0
	 */
	public function help() {
		$screen = get_current_screen();

		$screen->add_help_tab( array(
			'id'      => 'genwpacc-help',
			'title'   => 'Genesis Accessible Help',
			'content' => '<p>' . __( 'For documentation, help, and support, please visit <a href="http://genesis-accessible.org/">genesis-accessible.org</a>.', 'genesis-accessible' ) . '</p>',
		) );
	}

	/**
	 * Register metaboxes on Child Theme Settings page
	 *
	 * @since 1.0
	 */
	public function metaboxes() {
		$boxes = array(
			array(
				'metabox'  => 'plugin-documentation',
				'title'    => __( 'Genesis - Accessibility Documentation', 'genesis-accessible' ),
				'callback' => 'plugin_documentation',
			),
			array(
				'metabox'  => 'genesis-settings',
				'title'    => __( 'Genesis - Accessibility Settings', 'genesis-accessible' ),
				'callback' => 'modify_settings_genesis',
			),
			array(
				'metabox'  => 'wordpress-settings',
				'title'    => __( 'WordPress - Accessibility Settings', 'genesis-accessible' ),
				'callback' => 'modify_settings_wordpress',
			),
		);

		foreach ( $boxes as $box ) {
			add_meta_box(
				$box['metabox'],
				$box['title'],
				array( $this, $box['callback'] ),
				$this->pagehook,
				'main',
				'high'
			);
		}
	}

	/**
	 * Callback for Genesis - Accessibility Settings metabox
	 *
	 * @since 1.0.0
	 *
	 * @see   Genesis_Accessible_Theme_Settings::metaboxes()
	 */
	public function modify_settings_genesis() {

		?>
		<p><span class="description"><?php echo wp_kses_post( __( 'These settings are for the Genesis framework only. Together with the WordPress setting below, your theme can be a lot more accessible.', 'genesis-accessible' ) ); ?></span></p>

		<table class="form-table">
			<tbody>
			<tr>
				<th scope="row">
					<?php esc_html_e( 'Settings for Genesis:', 'genesis-accessible' ); ?>
				</th>
				<td>
					<fieldset>
						<legend class="screen-reader-text"><?php esc_html_e( 'Settings for Genesis:', 'genesis-accessible' ); ?></legend>

						<?php
						$settings = $this->define_genesis_settings();
						foreach ( $settings as $setting ) {
							$this->do_checkbox( $setting );
						}
						?>
					</fieldset>
				</td>
			</tr>
			</tbody>
		</table>
		<?php
	}

	/**
	 * Callback for WordPress - Accessibility Settings metabox
	 *
	 * @since 1.0.0
	 *
	 * @see   Genesis_Accessible_Theme_Settings::metaboxes()
	 */
	public function modify_settings_wordpress() {

		?>
		<p><span class="description"><?php echo wp_kses_post( __( 'These settings are for WordPress itself. If you have installed <a href="http://wordpress.org/plugins/wp-accessibility/">WP Accessibility</a> by Joe Dolson too: don\'t worry you can use both plugins together.', 'genesis-accessible' ) ); ?></span></p>

		<p><span class="description"><?php echo wp_kses_post( __( 'Read more about WP Accessibility’s compatibility with Genesis Accessible in the online <a href="http://genesis-accessible.org/documentation/compatibility-wp-accessibility/">Genesis Accessible Documentation</a>', 'genesis-accessible' ) ); ?></span></p>
		<table class="form-table">
			<tbody>
			<tr>
				<th scope="row">
					<?php esc_html_e( 'Settings for WordPress:', 'genesis-accessible' ); ?>
				</th>
				<td>
					<fieldset>
						<legend class="screen-reader-text"><?php esc_html_e( 'Settings for WordPress:', 'genesis-accessible' ); ?></legend>

						<?php
						$settings = $this->define_wordpress_settings();
						foreach ( $settings as $setting ) {
							$this->do_checkbox( $setting );
						}
						?>
					</fieldset>
				</td>
			</tr>
			</tbody>
		</table>
		<?php
	}

	/**
	 * Get the Genesis Framework specific settings for the plugin.
	 * @since 1.3.0
	 *
	 * @return array
	 */
	protected function define_genesis_settings() {
		$settings = array(
			array(
				'setting'  => 'genwpacc_skiplinks',
				'label'    => __( 'Add skiplinks', 'genesis-accessible' ),
				'supports' => 'skip-links',
			),
			array(
				'setting'  => 'genwpacc_skiplinks_css',
				'label'    => __( 'Add CSS for screen readers (screen-reader-text) and skiplinks', 'genesis-accessible' ),
				'supports' => 'skip-links',
			),
			array(
				'setting'     => 'genwpacc_widget_headings',
				'label'       => __( 'Use a semantic heading structure', 'genesis-accessible' ),
				'description' => $this->get_semantic_headings_description(),
				'supports'    => 'headings',
			),
			array(
				'setting'     => 'genwpacc_dropdown',
				'label'       => __( 'Add keyboard accessibility to the dropdown menu', 'genesis-accessible' ),
				'description' => __( '(only select this if you have a dropdown submenu in the main or sub navigation menu)', 'genesis-accessible' ),
				'supports'    => 'drop-down-menu',
			),
		);
		if ( ! function_exists( 'genesis_a11y' ) ) {
			$settings = array_merge( $settings, array(
				array(
					'setting' => 'genwpacc_remove_genesis_widgets',
					'label'   => __( 'Remove less accessible Genesis widgets', 'genesis-accessible' ),
				),
				array(
					'setting' => 'genwpacc_sitemap',
					'label'   => __( 'Use an accessible sitemap', 'genesis-accessible' ),
				),
				array(
					'setting' => 'genwpacc_404',
					'label'   => __( 'Use an accessible 404 page', 'genesis-accessible' ),
				),
			) );
		}

		return $settings;
	}

	/**
	 * Check if the semantic headings setting has been disabled before showing the related description.
	 * Checks if current theme supports HTML5, has semantic headings enabled, and is prior to Genesis 2.5.
	 *
	 * @return string
	 */
	protected function get_semantic_headings_description() {
		if ( ! genesis_html5() ) {
			return '';
		}
		if ( ! genesis_get_option( 'semantic_headings' ) ) {
			return '';
		}
		if ( genesis_get_option( 'db_version', null, false ) < '2501' ) {
			return '';
		}

		return __( '(Note: also disable "Use semantic HTML5 page and section headings throughout site?" in the Genesis SEO Settings)', 'genesis-accessible' );
	}

	/**
	 * Get the WordPress settings for the plugin.
	 * @since 1.3.0
	 *
	 * @return array
	 */
	protected function define_wordpress_settings() {
		$settings = array(
			array(
				'setting' => 'genwpacc_no_title_attr',
				'label'   => __( 'Remove title attribute from links', 'genesis-accessible' ),
			),
			array(
				'setting' => 'genwpacc_tinymce',
				'label'   => __( 'Remove h1 from editor toolbar', 'genesis-accessible' ),
			),
		);
		if ( ! function_exists( 'genesis_a11y' ) ) {
			$settings = array_merge( array(
				array(
					'setting' => 'genwpacc_read_more',
					'label'   => __( 'Add the post title to the read more links', 'genesis-accessible' ),
				),
			), $settings );
		}

		return $settings;
	}

	/**
	 * Print out the checkbox setting.
	 * @since 1.3.0
	 *
	 * @param $setting
	 */
	protected function do_checkbox( $setting ) {
		?>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( $setting['setting'] ) ); ?>">
				<input type="checkbox" name="<?php echo esc_attr( $this->get_field_name( $setting['setting'] ) ); ?>" id="<?php echo esc_attr( $this->get_field_id( $setting['setting'] ) ); ?>" value="1" <?php checked( esc_attr( $this->get_field_value( $setting['setting'] ) ) ); ?> />
				<?php echo esc_html( $setting['label'] ); ?></label>
			<?php
			$description = $this->get_description( $setting );
			if ( $description ) {
				echo '<br /><span class="description">' . esc_html( $description ) . '</span>';
			}
			?>
		</p>
		<?php
	}

	/**
	 * Get the description for the setting.
	 * @since 1.3.0
	 *
	 * @param $setting
	 *
	 * @return string
	 */
	protected function get_description( $setting ) {
		$description = ! empty( $setting['description'] ) ? $setting['description'] : '';
		$supports    = $this->theme_supports;
		if ( empty( $setting['supports'] ) || ! in_array( $setting['supports'], $supports, true ) ) {
			return $description;
		}
		$addendum = __( 'Your theme already supports this feature.', 'genesis-accessible' ) . ' ';
		if ( 'genwpacc_skiplinks_css' === $setting['setting'] ) {
			$addendum = __( 'Since your theme includes support for skip links, it may already support this feature.', 'genesis-accessible' ) . ' ';
		}

		return $addendum . $description;
	}

	/**
	 * Callback for Genesis - Accessibility Documentation metabox
	 *
	 * @since 1.0.0
	 *
	 * @see   Genesis_Accessible_Theme_Settings::metaboxes()
	 */
	public function plugin_documentation() {
		?>
		<p><span class="description"><?php echo wp_kses_post( __( 'For documentation, help, and support, please visit <a href="http://genesis-accessible.org/">genesis-accessible.org</a>.', 'genesis-accessible' ) ); ?></span></p>
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
	$genwpacc_theme_settings = new Genesis_Accessible_Theme_Settings();
}
