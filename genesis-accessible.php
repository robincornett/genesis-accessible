<?php
/**
* This plugin fixes some accessibility issues with the Genesis Framework
*
* @package Genesis
* @author Rian Rietveld
*
* Plugin Name: Genesis Accessible
* Plugin URI: http://genesis-accessible.org/
* Description: This plugin fixes some accessibility issues with the Genesis Framework.
* Author: Rian Rietveld
* Version: 1.0.0
* Author URI: http://www.rrwd.nl/
* License: GPLv2
* Text Domain: genesis-accessible
* Domain Path: /languages/
* Function prefix genwpacc_
*/

/**
* Defining Genesis Accessible constants
 *
 * @since 1.0.0
 */
define( 'GENWPACC_VERSION','0.1.0' );

if ( ! defined( 'GENWPACC_BASE_FILE' ) )
    define( 'GENWPACC_BASE_FILE', __FILE__ );
if ( ! defined( 'GENWPACC_BASE_DIR' ) )
    define( 'GENWPACC_BASE_DIR', dirname( GENWPACC_BASE_FILE ) );
if ( ! defined( 'RC_TC_PLUGIN_URL' ) )
    define( 'GENWPACC_PLUGIN_URL', plugin_dir_url( __FILE__ ) );

define( 'GENWPACC_SETTINGS_FIELD', 'genwpacc-settings' );

/**
 * The text domain for the plugin
 *
 * @since 1.0.0
 */
define( 'GENWPACC_DOMAIN' , 'genesis-accessible' );

/**
 * Load the text domain for translation of the plugin
 *
 * @since 1.0.0
 */
load_plugin_textdomain( 'genesis-accessible', false, 'genesis-accessible/languages' );


register_activation_hook( __FILE__, 'genwpacc_activation_check' );
/**
 * Checks for activated Genesis Framework and its minimum version before allowing plugin to activate
 *
 * @author Nathan Rice, Remkus de Vries. adjusted by Rian Rietveld for this plugin
 * @uses accessible_activation_check()
 * @since 1.0.0
 */
function genwpacc_activation_check() {

	$latest = '2.0';

	$theme_info = get_theme_data( get_template_directory() . '/style.css' );

	if ( basename( get_template_directory() ) != 'genesis' ) {
		deactivate_plugins( plugin_basename( __FILE__ ) );  // Deactivate ourself
		wp_die( sprintf( __( 'Whoa.. the Genesis Accessible plugin only works, really, when you have installed the %1$sGenesis Framework%2$s', GENWPACC_DOMAIN ), '<a href="http://www.shareasale.com/r.cfm?b=346198&u=629895&m=28169&urllink=&afftrack=">Genesis Framework</a>', '</a>' ) );
	}

	$version = genwpacc_version_check( $theme_info['Version'], 3 );

	if ( version_compare( $version, $latest, '<' ) ) {
		deactivate_plugins( plugin_basename( __FILE__ ) );  // Deactivate ourself
		wp_die( sprintf( __( 'Uhm, the thing of it is, you kinda need the %1$sGenesis Framework %2$s%3$s or greater for these plugin to make any sense.', GENWPACC_DOMAIN ), '<a href="http://www.shareasale.com/r.cfm?b=346198&u=629895&m=28169&urllink=&afftrack=">Genesis Framework</a>', $latest, '</a>' ) );
	}
}


/**
 * Used to cutoff a string to a set length if it exceeds the specified length
 *
 * @author Nick Croft
 * @link http://designsbynickthegeek.com/
 *
 * @since 1.0.0
 * @param string $str Any string that might need to be shortened
 * @param string $length Any whole integer
 * @return string
 */
function genwpacc_version_check( $str, $length=10 ) {

	if ( strlen( $str ) > $length ) {
		return substr( $str, 0, $length );

	} else {
		$res = $str;
	}

	return $res;
}

/**
 * Include all files in dir includes/
 *
 * @since 1.0.0
 */

foreach ( glob( plugin_dir_path( __FILE__ )."includes/*.php" ) as $file )
    include_once $file;

//* Load Admin
	if ( is_admin() ) {
		add_action( 'genesis_init', 'genwpacc_genesis_init', 12 );
	}

//* Include admin files
function genwpacc_genesis_init() {
	require_once( plugin_dir_path( __FILE__ ) . '/admin/accessible-theme-settings.php' );
	require_once( plugin_dir_path( __FILE__ ) . '/admin/admin.php' );

}

/**
 * Redirect 404 and archive templates to accessible templates
 *
 * @since 1.0.0
 */

add_action( 'template_redirect', 'genwpacc_template_redirect' );
function genwpacc_template_redirect() {
	if ( get_page_template_slug() == 'page_archive.php' ) {
		include ( plugin_dir_path( __FILE__ ).'/templates/sitemap.php' );
		exit();
	}
	if ( is_404() ) {
		include ( plugin_dir_path( __FILE__ ).'/templates/404.php' );
		exit();
	}


}


?>