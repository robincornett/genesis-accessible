<?php
/** widgets.php
 *    Author: Rian Rietveld
 *    Plugin URI: http://genesis-accessible.org/
 *    License: GPLv2 or later
 */

add_action( 'widgets_init', 'genwpacc_remove_genesis_widgets', 20 );
/** Remove Genesis widgets (not accessible enough at the moment)
 *
 * @since 1.0.0
 */
function genwpacc_remove_genesis_widgets() {
	unregister_widget( 'Genesis_Featured_Page' );
	unregister_widget( 'Genesis_User_Profile_Widget' );
	unregister_widget( 'Genesis_Featured_Post' );
}
