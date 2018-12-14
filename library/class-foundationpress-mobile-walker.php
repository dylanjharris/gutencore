<?php
/**
 * Customize the output of menus for Foundation mobile walker
 *
 * @package GutenCore
 * @since GutenCore 1.0.0
 */

/**
 * Big thanks to Brett Mason (https://github.com/brettsmason) for the awesome walker
 */

if ( ! class_exists( 'gutencore_Mobile_Walker' ) ) :
	class gutencore_Mobile_Walker extends Walker_Nav_Menu {
		function start_lvl( &$output, $depth = 0, $args = array() ) {
			$indent  = str_repeat( "\t", $depth );
			$output .= "\n$indent<ul class=\"vertical nested menu\">\n";
		}
	}
endif;
