<?php
/**
 * Change the class for sticky posts to .wp-sticky to avoid conflicts with Foundation's Sticky plugin
 *
 * @package GutenCore
 * @since GutenCore 2.2.0
 */

if ( ! function_exists( 'gutencore_sticky_posts' ) ) :
	function gutencore_sticky_posts( $classes ) {
		if ( in_array( 'sticky', $classes, true ) ) {
			$classes   = array_diff( $classes, array( 'sticky' ) );
			$classes[] = 'wp-sticky';
		}
		return $classes;
	}
	add_filter( 'post_class', 'gutencore_sticky_posts' );

endif;
