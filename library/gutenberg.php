<?php

if ( ! function_exists( 'gutencore_gutenberg_support' ) ) :
	function gutencore_gutenberg_support() {

    // Add foundation color palette to the editor
    add_theme_support( 'editor-color-palette', array(
        array(
            'name' => __( 'Primary Color', 'gutencore' ),
            'slug' => 'primary',
            'color' => '#1779ba',
        ),
        array(
            'name' => __( 'Secondary Color', 'gutencore' ),
            'slug' => 'secondary',
            'color' => '#767676',
        ),
        array(
            'name' => __( 'Success Color', 'gutencore' ),
            'slug' => 'success',
            'color' => '#3adb76',
        ),
        array(
            'name' => __( 'Warning color', 'gutencore' ),
            'slug' => 'warning',
            'color' => '#ffae00',
        ),
        array(
            'name' => __( 'Alert color', 'gutencore' ),
            'slug' => 'alert',
            'color' => '#cc4b37',
        )
    ) );

	}

	add_action( 'after_setup_theme', 'gutencore_gutenberg_support' );
endif;
