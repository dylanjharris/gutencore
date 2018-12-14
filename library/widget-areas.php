<?php
/**
 * Register widget areas
 *
 * @package GutenCore
 * @since GutenCore 1.0.0
 */

if ( ! function_exists( 'gutencore_sidebar_widgets' ) ) :
	function gutencore_sidebar_widgets() {
		register_sidebar(
			array(
				'id'            => 'sidebar-widgets',
				'name'          => __( 'Sidebar widgets', 'gutencore' ),
				'description'   => __( 'Drag widgets to this sidebar container.', 'gutencore' ),
				'before_widget' => '<section id="%1$s" class="widget %2$s">',
				'after_widget'  => '</section>',
				'before_title'  => '<h6>',
				'after_title'   => '</h6>',
			)
		);

		register_sidebar(
			array(
				'id'            => 'footer-widgets',
				'name'          => __( 'Footer widgets', 'gutencore' ),
				'description'   => __( 'Drag widgets to this footer container', 'gutencore' ),
				'before_widget' => '<section id="%1$s" class="widget %2$s">',
				'after_widget'  => '</section>',
				'before_title'  => '<h6>',
				'after_title'   => '</h6>',
			)
		);
	}

	add_action( 'widgets_init', 'gutencore_sidebar_widgets' );
endif;
