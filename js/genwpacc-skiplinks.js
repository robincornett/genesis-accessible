/**
 * genesis-accessible skiplinks
 * Version: 2.0
 * License: GPL-2.0+
 * License URI: http://www.opensource.org/licenses/gpl-license.php
 */

function ga_skiplinks() {
    'use strict';
    var element = document.getElementById( location.hash.substring( 1 ) );

    if ( element ) {
        if ( ! /^(?:a|select|input|button|textarea)$/i.test( element.tagName ) ) {
            element.tabIndex = -1;
        }
        element.focus();
    }
}

if ( window.addEventListener ) {
    window.addEventListener( 'hashchange', ga_skiplinks, false );
} else { // IE8 and earlier
    window.attachEvent( 'onhashchange', ga_skiplinks, false );
}
