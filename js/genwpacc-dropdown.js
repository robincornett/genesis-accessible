/*  WP-accessible Dropdown Menu JavaScript


	Version: 1.0
 
	License: GPL-2.0+
	License URI: http://www.opensource.org/licenses/gpl-license.php

 */

( function($) { 

	$('.menu li').hover(
		function(){$(this).addClass("wpacc-hover");},
		function(){$(this).delay('250').removeClass("wpacc-hover");}
	);
	
	$('.menu li a').on('focus blur',
		function(){$(this).parents(".menu-item").toggleClass("wpacc-hover");}
	);
	
	}
	
	(jQuery)
	
);
