<?php

// if ( ! function_exists( 'gutencore_gutenberg_support' ) ) :
// 	function gutencore_gutenberg_support() {

//     // Add foundation color palette to the editor
//     add_theme_support( 'editor-color-palette', array(
//         array(
//             'name' => __( 'Primary Color', 'gutencore' ),
//             'slug' => 'primary',
//             'color' => '#1779ba',
//         ),
//         array(
//             'name' => __( 'Secondary Color', 'gutencore' ),
//             'slug' => 'secondary',
//             'color' => '#767676',
//         ),
//         array(
//             'name' => __( 'Success Color', 'gutencore' ),
//             'slug' => 'success',
//             'color' => '#3adb76',
//         ),
//         array(
//             'name' => __( 'Warning color', 'gutencore' ),
//             'slug' => 'warning',
//             'color' => '#ffae00',
//         ),
//         array(
//             'name' => __( 'Alert color', 'gutencore' ),
//             'slug' => 'alert',
//             'color' => '#cc4b37',
//         )
//     ) );

// 	}

// 	add_action( 'after_setup_theme', 'gutencore_gutenberg_support' );
// endif;






/*----------------------------------------------djh Dec 13, 2018
  NOTES
  https://www.advancedcustomfields.com/blog/acf-5-8-introducing-acf-blocks-for-gutenberg/
----------------------------------------------*/


/*----------------------------------------------djh Dec 13, 2018
  Get editor_color_palette from Theme Settings
----------------------------------------------*/
if ( ! function_exists('gutencore_gutenberg_editor_color_palette') ) {
    function gutencore_gutenberg_editor_color_palette() {
        // start with Foundation defaults
        $editor_color_palette = array(
            array(
                'name'  => __( 'Primary Color', 'gutencore' ),
                'slug'  => 'primary',
                'color' => '#1779ba',
            ),
            array(
                'name'  => __( 'Secondary Color', 'gutencore' ),
                'slug'  => 'secondary',
                'color' => '#767676',
            ),
            array(
                'name'  => __( 'Success Color', 'gutencore' ),
                'slug'  => 'success',
                'color' => '#3adb76',
            ),
            array(
                'name'  => __( 'Warning Color', 'gutencore' ),
                'slug'  => 'warning',
                'color' => '#ffae00',
            ),
            array(
                'name'  => __( 'Alert Color', 'gutencore' ),
                'slug'  => 'alert',
                'color' => '#cc4b37',
            ),
            array(
                'name'  => __( 'Simple White', 'gutencore' ),
                'slug'  => 'white',
                'color' => '#ffffff',
            ),
            array(
                'name'  => __( 'Simple Black', 'gutencore' ),
                'slug'  => 'black',
                'color' => '#000000',
            )
        );
        // get custom color palette settings (if they exist)
        if ( get_option( 'options_uc_editor_color_palette' ) ) { 
            // flush the array
            $editor_color_palette = array();
            // get custom color settings as an array of textarea lines
            $custom_colors = preg_split("/\r\n|\n|\r/", get_option( 'options_uc_editor_color_palette' ));
            // recreate array with color settings
            if ( is_array($custom_colors) ) {
                foreach ($custom_colors as $num => $row) {
                    if ( strpos($row, ' : ') === false ) {
                        continue;
                    }
                    $color_data = explode(' : ', $row);
                    $color_hex  = substr($color_data[0], -6);

                    // if this is not a hex value, skip the row
                    if ( ! ctype_xdigit( $color_hex ) && ! strlen( $color_hex ) == 6 ) {
                        continue;
                    }

                    $color_hex  = '#' . substr($color_data[0], -6);
                    $color_slug = substr_replace($color_data[0],"", -7);
                    $color_label= trim($color_data[1]);
                    $editor_color_palette[] = array(
                        'name'  => __( $color_label, 'gutencore' ),
                        'slug'  => $color_slug,
                        'color' => $color_hex
                    );
                }
            }
        }
        return $editor_color_palette;
    }
}



/*----------------------------------------------djh Dec 13, 2018
  Get editor_font_sizes from Theme Settings
----------------------------------------------*/
if ( ! function_exists('gutencore_gutenberg_editor_font_sizes') ) {
    function gutencore_gutenberg_editor_font_sizes() {
        // start with defaults
        $editor_font_sizes = array(
            array(
                'name' => __( 'Small', 'gutencore' ),
                'shortName' => __( 'S', 'gutencore' ),
                'size' => 13,
                'slug' => 'small'
            ),
            array(
                'name' => __( 'Regular', 'gutencore' ),
                'shortName' => __( 'M', 'gutencore' ),
                'size' => 16,
                'slug' => 'regular'
            ),
            array(
                'name' => __( 'Large', 'gutencore' ),
                'shortName' => __( 'L', 'gutencore' ),
                'size' => 20,
                'slug' => 'large'
            ),
            array(
                'name' => __( 'Larger', 'gutencore' ),
                'shortName' => __( 'XL', 'gutencore' ),
                'size' => 26,
                'slug' => 'larger'
            ),
            array(
                'name' => __( 'Heading', 'gutencore' ),
                'shortName' => __( 'H1', 'gutencore' ),
                'size' => 33,
                'slug' => 'heading'
            ),
            array(
                'name' => __( 'Hero', 'gutencore' ),
                'shortName' => __( 'Hero', 'gutencore' ),
                'size' => 42,
                'slug' => 'hero'
            )
        );

        // get custom color palette settings (if they exist)
        if ( get_option( 'options_uc_editor_font_sizes' ) ) { 
            // flush the array
            $editor_font_sizes = array();
            // get custom color settings as an array of textarea lines
            $custom_font_sizes = preg_split("/\r\n|\n|\r/", get_option( 'options_uc_editor_font_sizes' ));
            // recreate array with color settings
            if ( is_array( $custom_font_sizes ) ) {
                foreach ($custom_font_sizes as $num => $row) {
                    $font_size_data = explode(',', trim($row));
                    // if there are more or fewer than 4 pieces, skip it
                    if ( count( $font_size_data ) !== 4 ) {
                        continue;
                    }

                    $fs_name      = preg_replace('/[^\w-]/', '', $font_size_data[0]);
                    $fs_shortName = esc_html($font_size_data[1]);
                    $fs_size      = intval($font_size_data[2]);
                    $fs_slug      = preg_replace('/[^\w-]/', '', $font_size_data[3]);

                    $editor_font_sizes[] = array(
                        'name' => __( $fs_name, 'gutencore' ),
                        'shortName' => __( $fs_shortName, 'gutencore' ),
                        'size' => $fs_size,
                        'slug' => $fs_slug
                    );

                }
            }
        }
        return $editor_font_sizes;
    }
}



