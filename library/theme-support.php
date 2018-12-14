<?php
/**
 * Register theme support for languages, menus, post-thumbnails, post-formats etc.
 *
 * @package GutenCore
 * @since GutenCore 1.0.0
 */

if ( ! function_exists( 'gutencore_theme_support' ) ) :
	function gutencore_theme_support() {
		// Add language support
		load_theme_textdomain( 'gutencore', get_template_directory() . '/languages' );

		// Switch default core markup for search form, comment form, and comments to output valid HTML5
		add_theme_support(
			'html5', array(
				'search-form',
				'comment-form',
				'comment-list',
				'gallery',
				'caption',
			)
		);

		// Add menu support
		add_theme_support( 'menus' );

		// Let WordPress manage the document title
		add_theme_support( 'title-tag' );

		// Add post thumbnail support: http://codex.wordpress.org/Post_Thumbnails
		add_theme_support( 'post-thumbnails' );

		// RSS thingy
		add_theme_support( 'automatic-feed-links' );

		// Add post formats support: http://codex.wordpress.org/Post_Formats
		add_theme_support( 'post-formats', array( 'aside', 'gallery', 'link', 'image', 'quote', 'status', 'video', 'audio', 'chat' ) );

		/**
		 * Set up the WordPress core custom background feature.
		 * @todo check frontend styles for this
		 */
		add_theme_support( 'custom-background', apply_filters( 'undercore_custom_background_args', array(
			'default-color' => 'ffffff',
			'default-image' => '',
		) ) );


		/**
		 * Add support for core custom logo.
		 * @todo make height/width configurable from Theme Settings
		 * @link https://codex.wordpress.org/Theme_Logo
		 */
		add_theme_support( 'custom-logo', array(
			'height'      => 250,
			'width'       => 250,
			'flex-width'  => true,
			'flex-height' => true,
		) );


		// Add theme support for selective refresh for widgets.
		add_theme_support( 'customize-selective-refresh-widgets' );

		// Additional theme support for woocommerce 3.0.+
		add_theme_support( 'wc-product-gallery-zoom' );
		add_theme_support( 'wc-product-gallery-lightbox' );
		add_theme_support( 'wc-product-gallery-slider' );


		/**
		 *                                                  djh Dec 13, 2018
		 * Add custom color palette to the editor.
		 * Uses default Foundation 6 colors, or custom Theme Settings
		 * @link https://wordpress.org/gutenberg/handbook/designers-developers/developers/themes/theme-support/
		 */
		$editor_color_palette = gutencore_gutenberg_editor_color_palette();
		add_theme_support( 'editor-color-palette', $editor_color_palette );


		/**
		 *                                                  djh Dec 13, 2018
		 * Add custom font sizes to the editor.
		 * @link https://wordpress.org/gutenberg/handbook/designers-developers/developers/themes/theme-support/
		 */
		$editor_font_sizes = gutencore_gutenberg_editor_font_sizes();
		add_theme_support( 'editor-font-sizes', $editor_font_sizes );
		// turn off custom font sizes by default
		if ( ! get_option( 'options_uc_allow_custom_font_sizes' ) ) {
			add_theme_support('disable-custom-font-sizes');
		}


		/**
		 *                                                  djh Dec 13, 2018
		 * Add support for responsive embeds.
		 * @todo check this doesn't need additional styles
		 */
		add_theme_support( 'responsive-embeds' );


		/**
		 *                                                  djh Dec 13, 2018
		 * Add support for Block Styles.
		 * @todo set css for block styles
		 */
		add_theme_support( 'wp-block-styles' );


		/**
		 *                                                  djh Dec 13, 2018
		 * Add support for full/wide-align images.
		 * 
		 * @todo set css for align-wide images
		 */ 
		add_theme_support( 'align-wide' );


		/**
		 *                                                  djh Dec 14, 2018
		 * Comment.
		 * @todo is editor-styles for Classic Editor?
		 */
		// add_theme_support( 'editor-styles' );

		// add_editor_style( get_stylesheet_directory_uri() . '/dist/assets/css/editor.css' );

		// Add foundation.css as editor style https://codex.wordpress.org/Editor_Style
		// add_editor_style( 'dist/assets/css/' . gutencore_asset_path( 'editor.css' ) );
	}

	add_action( 'after_setup_theme', 'gutencore_theme_support' );
endif;
