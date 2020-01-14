<?php

/**
 * The main class for the Genesis Accessible plugin.
 *
 * Class GenesisAccessible
 */
class GenesisAccessible {

	/**
	 * The plugin setting.
	 *
	 * @var array
	 */
	protected $setting;

	/**
	 * The current theme's accessibility support.
	 *
	 * @var array
	 */
	protected $theme_support;

	/**
	 * The plugin's settings page ID.
	 *
	 * @var string
	 */
	protected $settings_page_id = 'genesis_page_genesis-accessible';

	/**
	 * Include plugin admin files and files per option from directory includes/
	 * @since 1.0.0
	 */
	public function init() {

		add_action( 'init', array( $this, 'check_genesis_accessibility' ), 100 );

		if ( is_admin() ) {

			require_once GENWPACC_PLUGIN_PATH . 'admin/accessible-theme-settings.php';

			if ( $this->get_setting( 'genwpacc_tinymce' ) ) {
				require_once GENWPACC_PLUGIN_PATH . 'admin/admin.php';
			}
		}

		if ( $this->get_setting( 'genwpacc_no_title_attr' ) ) {
			require_once GENWPACC_PLUGIN_PATH . 'includes/attributes.php';
		}

		if ( $this->get_setting( 'genwpacc_skiplinks_css' ) ) {
			add_action( 'wp_enqueue_scripts', 'genwpacc_srt_css' );
		}
	}

	/**
	 * Check if Genesis accessibility functions are available and prefer those.
	 * Moved to genesis_setup hook to allow for checking if the theme already enables.
	 * @since 1.3.0
	 */
	public function check_genesis_accessibility() {
		if ( function_exists( 'genesis_a11y' ) ) {
			$this->add_genesis_theme_support();
			return;
		}
		add_action( 'admin_notices', array( $this, 'deprecated_genesis_notice' ) );
	}

	/**
	 * Activate Genesis 2.2 default a11y functionality if selected
	 * add_theme_support( 'genesis-accessibility', array( '404-page', 'drop-down-menu', 'headings', 'search-form', 'skip-links', ) );
	 * @since 1.3.0
	 */
	protected function add_genesis_theme_support() {
		$theme_support  = $this->get_genesis_theme_support();
		$plugin_support = $this->get_plugin_support();

		if ( ! empty( $theme_support ) ) {
			add_action( 'admin_notices', array( $this, 'theme_already_supports_notice' ) );
		}

		add_theme_support( 'genesis-accessibility', array_unique( array_merge( $theme_support, $plugin_support ) ) );
	}

	/**
	 * Get the Genesis accessibility features defined by the plugin settings.
	 * @since 1.3.0
	 * @return array
	 */
	protected function get_plugin_support() {
		$plugin_support = array( 'search-form' );
		/**
		 * As of Genesis 3.0.0, the 404 page accessibility feature has been removed.
		 */
		if ( ! function_exists( 'genesis_get_theme_version' ) ) {
			$plugin_support[] = '404-page';
		}

		if ( $this->get_setting( 'genwpacc_skiplinks' ) ) {
			$plugin_support[] = 'skip-links';
		}

		if ( $this->get_setting( 'genwpacc_widget_headings' ) ) {
			$plugin_support[] = 'headings';
		}

		if ( $this->get_setting( 'genwpacc_dropdown' ) ) {
			$plugin_support[] = 'drop-down-menu';
		}

		return $plugin_support;
	}

	/**
	 * Get the theme accessibility settings.
	 * @since 1.3.0
	 *
	 * @return array
	 */
	protected function get_genesis_theme_support() {
		if ( isset( $this->theme_support ) ) {
			return $this->theme_support;
		}
		$theme_support       = new GenesisAccessibleThemeSupport();
		$this->theme_support = $theme_support->get_theme_support();

		return $this->theme_support;
	}

	/**
	 * Pre Genesis 2.2: add a11y functionality if selected.
	 * @since 1.3.0
	 */
	protected function pre_22() {
		require_once GENWPACC_PLUGIN_PATH . 'includes/forms.php';
		require_once GENWPACC_PLUGIN_PATH . 'includes/wp-modification.php';

		if ( $this->get_setting( 'genwpacc_skiplinks' ) ) {
			require_once GENWPACC_PLUGIN_PATH . 'includes/skip-links.php';
		}

		if ( $this->get_setting( 'genwpacc_widget_headings' ) ) {
			require_once GENWPACC_PLUGIN_PATH . 'includes/headings.php';
		}

		if ( $this->get_setting( 'genwpacc_dropdown' ) ) {
			require_once GENWPACC_PLUGIN_PATH . 'includes/dropdown.php';
		}

		if ( $this->get_setting( 'genwpacc_sitemap' ) ) {
			add_action( 'template_redirect', 'genwpacc_template_sitemap' );
		}

		if ( $this->get_setting( 'genwpacc_404' ) ) {
			add_action( 'template_redirect', 'genwpacc_template_404' );
		}

		if ( $this->get_setting( 'genwpacc_remove_genesis_widgets' ) ) {
			require_once GENWPACC_PLUGIN_PATH . 'includes/widgets.php';
		}
	}

	/**
	 * Add a notice to the admin if the installed theme already supports the Genesis Accessible features.
	 * @since 1.3.0
	 *
	 */
	public function theme_already_supports_notice() {
		$screen = get_current_screen();
		if ( $this->settings_page_id !== $screen->id ) {
			return;
		}
		$supports = implode( ', ', $this->get_genesis_theme_support() );
		/* translators: list of already supported accessibility features */
		$message = sprintf( __( 'It looks like your theme may already support these Genesis accessibility features: %s.', 'genesis-accessible' ), $supports );
		$this->print_notice( $message, 'notice-success' );
	}

	/**
	 * Warning notice for users on old versions of Genesis.
	 * @since 1.3.0
	 */
	public function deprecated_genesis_notice() {
		$message = __( 'The version of Genesis you are using is no longer supported by the Genesis Accessible plugin, which now strongly suggests a minimum version of Genesis 2.8.1 and WordPress 4.9.', 'genesis-accessible' );

		$this->print_notice( $message );
	}

	/**
	 * Print the admin notice.
	 * @since 1.3.0
	 *
	 * @param $message
	 * @param string $class
	 */
	protected function print_notice( $message, $class = 'notice-warning' ) {
		printf(
			'<div class="notice %s"><p>%s</p></div>',
			esc_attr( $class ),
			wp_kses_post( $message )
		);
	}

	/**
	 * Get the plugin setting, merged with defaults.
	 * @since 1.3.0
	 *
	 * @param string $key
	 *
	 * @return boolean
	 */
	protected function get_setting( $key ) {
		return (bool) genesis_get_option( $key, 'genwpacc-settings' );
	}
}
