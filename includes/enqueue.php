<?php
/** enqueue.php
*	Description: Enqueue scripts
*	Author: Rian Rietveld
*	Plugin URI: http://genesis-accessible.org/
*	License: GPLv2 or later
*/

add_action( 'wp_enqueue_scripts', 'genwpacc_scripts_styles' );
function genwpacc_scripts_styles() {

	if ( ( 	genesis_get_option( 'genwpacc_dropdown', 'genwpacc-settings' )  == 1 ) && !function_exists( 'wpacc_genesis_dropdown_scripts'  )  ) {

		wp_register_script( 'genwpacc-dropdown-js',  GENWPACC_PLUGIN_URL . '/js/genwpacc-dropdown.js', array( 'jquery' ), false, true );
		wp_register_style( 'genwpacc-dropdown-css', GENWPACC_PLUGIN_URL .  '/css/genwpacc-dropdown.css' );
		wp_enqueue_script('genwpacc-js');
		wp_enqueue_style('genwpacc-css');

	}



}


?>