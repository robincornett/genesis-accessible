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
	 * Include plugin admin files and files per option from directory includes/
	 * @since 1.0.0
	 */
	public function init() {

		add_action( 'genesis_setup', array( $this, 'check_genesis_accessibility' ), 100 );

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
		} else {
			$this->pre_22();
		}
	}

	/**
	 * Activate Genesis 2.2 default a11y functionality if selected
	 * add_theme_support( 'genesis-accessibility', array( 'skip-links', 'search-form', 'drop-down-menu', 'headings' ) );
	 * @since 1.3.0
	 */
	protected function add_genesis_theme_support() {
		$genwpacc_options = array( 'search-form' );

		if ( $this->get_setting( 'genwpacc_skiplinks' ) ) {
			$genwpacc_options[] = 'skip-links';
		}

		if ( $this->get_setting( 'genwpacc_widget_headings' ) ) {
			$genwpacc_options[] = 'headings';
		}

		if ( $this->get_setting( 'genwpacc_dropdown' ) ) {
			$genwpacc_options[] = 'drop-down-menu';
		}

		add_theme_support( 'genesis-accessibility', $genwpacc_options );
	}

	/**
	 * Pre Genesis 2.2: add a11y functionality if selected.
	 * @since 1.3.0
	 */
	protected function pre_22() {
		add_action( 'admin_notices', 'genwpacc_deprecated_genesis_notice' );
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

		if ( genesis_get_option( 'genwpacc_404', 'genwpacc-settings' ) ) {
			add_action( 'template_redirect', 'genwpacc_template_404' );
		}

		if ( $this->get_setting( 'genwpacc_remove_genesis_widgets' ) ) {
			require_once GENWPACC_PLUGIN_PATH . 'includes/widgets.php';
		}
	}

	/**
	 * Warning notice for users on old versions of Genesis.
	 * @since 1.3.0
	 */
	public function deprecated_genesis_notice() {
		$message = __( 'The version of Genesis you are using is no longer supported by the Genesis Accessible plugin, which now requires a minimum version of Genesis 2.3.1 and WordPress 4.6.', 'genesis-accessible' );

		echo '<div class="notice notice-warning"><p>' . wp_kses_post( $message ) . '</p></div>';
	}

	/**
	 * Get the plugin setting, merged with defaults.
	 * @since 1.3.0
	 *
	 * @param string $key
	 *
	 * @return array
	 */
	protected function get_setting( $key = '' ) {
		if ( isset( $this->setting ) ) {
			return $key ? $this->setting[ $key ] : $this->setting;
		}
		$defaults = array(
			'genwpacc_screen_reader_text'     => 0,
			'genwpacc_skiplinks'              => 0,
			'genwpacc_skiplinks_css'          => 0,
			'genwpacc_widget_headings'        => 0,
			'genwpacc_no_title_attr'          => 0,
			'genwpacc_read_more'              => 0,
			'genwpacc_tinymce'                => 0,
			'genwpacc_dropdown'               => 0,
			'genwpacc_remove_genesis_widgets' => 0,
		);

		$option        = get_option( 'genwpacc-settings', array() );
		$this->setting = wp_parse_args( $option, $defaults );

		return $key ? $this->setting[ $key ] : $this->setting;
	}
}
