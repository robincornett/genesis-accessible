<?php
/**
 * This plugin implements the accessibility features for the Genesis Framework.
 *
 * @package GenesisAccessible
 * @author  Rian Rietveld
 * @author  Robin Cornett
 * @license GPL-2.0+
 *
 * Plugin Name: Genesis Accessible
 * Plugin URI: https://wordpress.org/plugins/genesis-accessible/
 * Description: This plugin implements the accessibility features for the Genesis Framework.
 * Author: Rian Rietveld, Robin Cornett
 * Author URI: https://genesis-accessible.org/
 * Version: 1.2.3
 * License: GPL-2.0+
 * Text Domain: genesis-accessible
 * Domain Path: /languages/
 * Function prefix genwpacc_
 */

/**
* Defining Genesis Accessible constants
 *
 * @since 1.0.0
 */

define( 'GENWPACC_VERSION','1.2.3' );

if ( ! defined( 'GENWPACC_BASE_FILE' ) ) {
    define( 'GENWPACC_BASE_FILE', __FILE__ );
}

if ( ! defined( 'GENWPACC_BASE_DIR' ) ){
    define( 'GENWPACC_BASE_DIR', dirname( GENWPACC_BASE_FILE ) );
}

if ( ! defined( 'GENWPACC_PLUGIN_URL' ) ){
    define( 'GENWPACC_PLUGIN_URL', plugin_dir_url( __FILE__ ) );
}

if ( ! defined( 'GENWPACC_PLUGIN_PATH' ) ){
    define( 'GENWPACC_PLUGIN_PATH', plugin_dir_path( __FILE__ ) );
}

define( 'GENWPACC_SETTINGS_FIELD', 'genwpacc-settings' );

/**
 * The text domain for the plugin
 *
 * @since 1.0.0
 */
define( 'GENWPACC_DOMAIN', 'genesis-accessible' );

/**
 * Load the text domain for translation of the plugin
 *
 * @since 1.0.0
 */
load_plugin_textdomain( 'genesis-accessible', false, 'genesis-accessible/languages' );


register_activation_hook( __FILE__, 'genwpacc_activation_check' );
//add_action( 'admin_init', 'genwpacc_activation_check' );
/**
 * Checks for activated Genesis Framework and its minimum version before allowing plugin to activate
 *
 * @author Nathan Rice, Remkus de Vries. adjusted by Rian Rietveld for this plugin
 * @since  1.0
 */
function genwpacc_activation_check() {

	// Restrict activation to only when the Genesis Framework is activated
	if ( basename( get_template_directory() ) !== 'genesis' ) {
		deactivate_plugins( plugin_basename( __FILE__ ) );  // Deactivate ourself
		add_action( 'admin_notices', 'genwpacc_deactivation_message' );
	}

	// Find Genesis Theme Data
	$theme = wp_get_theme( 'genesis' );

	// Get the version
	$version = $theme->get( 'Version' );

	// Set what we consider the minimum Genesis version
	$minimum_genesis_version = '2.3.1';

	// Set a minimum version of the Genesis Framework to be activated on
	if ( version_compare( $version, $minimum_genesis_version, '<' ) ) {
		deactivate_plugins( plugin_basename( __FILE__ ) );  // Deactivate ourself
		add_action( 'admin_notices', 'genwpacc_deactivation_message' );
	}
}

/**
 * Genesis Accessible deactivation message.
 * @since 1.3.0
 */
function genwpacc_deactivation_message() {

	/* translators: link to the Genesis Framework */
	$message = sprintf( __( 'Uhm, the thing of it is, you kinda need the %1$s 2.3.1 or greater for this plugin to make any sense. Genesis Accessible has been deactivated.', 'genesis-accessible' ),
		'<a href="https://my.studiopress.com/themes/genesis/">Genesis Framework</a>'
	);

	echo '<div class="error"><p>' . wp_kses_post( $message ) . '</p></div>';

	if ( isset( $_GET['activate'] ) ) {
		unset( $_GET['activate'] );
	}
}

add_action( 'genesis_init', 'genwpacc_genesis_init', 12 );
/**
 * Include plugin admin files and files per option from directory includes/
 * @since 1.0.0
 */
function genwpacc_genesis_init() {
	require_once GENWPACC_PLUGIN_PATH . 'includes/class-genesisaccessible.php';
	$genesis_accessible = new GenesisAccessible();
	$genesis_accessible->init();
}

/**
 * Redirect archive templates to accessible template
 *
 * @since 1.2.0
 */
function genwpacc_template_sitemap() {
	if ( get_page_template_slug() === 'page_archive.php' ) {
		include GENWPACC_PLUGIN_PATH . 'templates/sitemap.php';
		exit();
	}
}

/**
 * Redirect 404 to accessible template
 *
 * @since 1.2.0
 */
function genwpacc_template_404() {
	if ( is_404() ) {
		include GENWPACC_PLUGIN_PATH . 'templates/404.php';
		exit();
	}
}

/**
 * Adds css for the screen-reader-text class
 *
 * @since 1.2.0
 */
function genwpacc_srt_css() {
	wp_register_style( 'genwpacc-srt-css', GENWPACC_PLUGIN_URL . 'css/genwpacc-skiplinks.css' );
	wp_enqueue_style( 'genwpacc-srt-css' );
}

