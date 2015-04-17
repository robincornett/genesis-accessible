/**
 * genesis-accessible Dropdown Menu JavaScript
 * Version: 1.1.0
 * License: GPL-2.0+
 * License URI: http://www.opensource.org/licenses/gpl-license.php
 */

var genacc = ( function( $ ) {
	'use strict';

	/**
	 * Add class to menu item on hover.
	 *
	 * @since 1.1.0
	 */
	var menuItemEnter = function() {
		$( this ).addClass( 'genwpacc-hover' );
	},

	/**
	 * After a short delay, remove a class when mouse leaves menu item.
	 *
	 * @since 1.1.0
	 */
	menuItemLeave = function() {
		$( this ).delay( '250' ).removeClass( 'genwpacc-hover' );
	},

	/**
	 * Toggle menu item class when a link fires a focus or blur event.
	 *
	 * @since 1.0.0
	 */
	menuItemToggleClass = function() {
		$( this ).parents( '.menu-item' ).toggleClass( 'genwpacc-hover' );
	},

	/**
	 * Bind behaviour to events.
	 *
	 * @since 1.1.0
	 */
	ready = function() {
		$( '.menu li' )
			.on( 'mouseenter.genwpacc', menuItemEnter )
			.on( 'mouseleave.genwpacc', menuItemLeave )
			.find( 'a' )
			.on( 'focus.genwpacc blur.genwpacc', menuItemToggleClass );
	};

	// Only expose the ready function to the world
	return {
		ready: ready
	};
})( jQuery );

jQuery( genacc.ready );
