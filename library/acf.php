<?php
/*----------------------------------------------djh Dec 12, 2018
  ACF: Add Theme Settings page
----------------------------------------------*/
if( function_exists('acf_add_options_page') ) {
    
    acf_add_options_page(array(
        'page_title'    => 'Theme Settings',
        'menu_title'    => 'Theme Settings',
        'menu_slug'     => 'theme-general-settings',
        'capability'    => 'edit_posts',
        'icon_url'      => 'dashicons-admin-settings',
        'redirect'      => false
    ));
  
    // acf_add_options_sub_page(array(
        //   'page_title'    => 'Theme Header Settings',
        //   'menu_title'    => 'Header',
        //   'parent_slug'   => 'theme-general-settings',
    // ));

    // acf_add_options_sub_page(array(
        //   'page_title'    => 'Theme Footer Settings',
        //   'menu_title'    => 'Footer',
        //   'parent_slug'   => 'theme-general-settings',
    // ));
}


/*----------------------------------------------djh Dec 12, 2018
  ACF Theme Setting: WooCommerce Cart Fragments
----------------------------------------------*/
if ( ! function_exists('undercore_disable_cart_fragments') ) {
    function undercore_disable_cart_fragments() {
        if ( get_option( 'options_uc_disable_cart_fragments' ) ) {
            $cart_fragments_status = get_option( 'options_uc_disable_cart_fragments' );
            if ( $cart_fragments_status === 'disabled' ) {
                // disable site wide
                wp_dequeue_script( 'wc-cart-fragments' );
                return true;
            } else if ( $cart_fragments_status === 'woo_only' && ! is_woocommerce() ) {
                // disable non-woocommerce only
                wp_dequeue_script( 'wc-cart-fragments' );
                return true;
            }
        }
    }
    add_action( 'wp_print_scripts', 'undercore_disable_cart_fragments', 100 );
}




/*----------------------------------------------djh Dec 12, 2018
  ACF Theme Settings: Generate GutenCore Styles override
                NOTE: see library/enqueue-scripts.php
----------------------------------------------*/
if ( ! function_exists('gutencore_theme_settings_override') ) {
    function gutencore_theme_settings_override() {
        $custom_css = '';
        // .main-container max-width
        if ( get_option( 'options_uc_main_container_max_width' ) ) {
            $main_container_max_width = get_option( 'options_uc_main_container_max_width' );
            if ( intval($main_container_max_width) !== 75 ) { // if not default of 75
                $custom_css .= 'body .main-container{max-width:'.$main_container_max_width.'rem}';
            }
        }
        // .footer-container max-width
        if ( get_option( 'options_uc_footer_container_max_width' ) ) {
            $footer_container_max_width = get_option( 'options_uc_footer_container_max_width' );
            if ( intval($footer_container_max_width) !== 75 ) { // if not default of 75
                $custom_css .= '.footer-container{max-width:'.$footer_container_max_width.'rem}';
            }
        }
        if ( get_option( 'options_uc_sidebar_right_grid_width' ) ) {
            $sidebar_right_grid_width = get_option( 'options_uc_sidebar_right_grid_width' );
            if ( intval( $sidebar_right_grid_width !== 4 ) ) {
                $grid_chunks = calc_grid_chunks(array($sidebar_right_grid_width),12); // see library/helpers.php
                $custom_css .= '@media print, screen and (min-width: 40em) {
                        .main-grid .sidebar {
                            width: calc('.$grid_chunks["sidebar0"].' - 1.875rem);
                        }
                    }
                    @media print, screen and (min-width: 40em) {
                        .main-grid .main-content {
                            width: calc('.$grid_chunks["content"].' - 1.875rem);
                        }
                    }
                ';

            }

        }
        if ( get_option( 'options_uc_sidebar_left_grid_width' ) ) {
            $sidebar_left_grid_width = get_option( 'options_uc_sidebar_left_grid_width' );
            if ( intval( $sidebar_left_grid_width !== 4 ) ) {
                $grid_chunks = calc_grid_chunks(array($sidebar_left_grid_width),12); // see library/helpers.php
                $custom_css .= '@media print, screen and (min-width: 40em) {
                        .main-grid.sidebar-left .sidebar {
                            width: calc('.$grid_chunks["sidebar0"].' - 1.875rem);
                        }
                    }
                    @media print, screen and (min-width: 40em) {
                        .main-grid.sidebar-left .main-content {
                            width: calc('.$grid_chunks["content"].' - 1.875rem);
                        }
                    }
                ';

            }

        }
        if ( get_option( 'uc_sidebars_left_grid_width' ) && get_option( 'uc_sidebars_right_grid_width' ) ) {
            $sidebars_left_grid_width  = get_option( 'uc_sidebars_left_grid_width' );
            $sidebars_right_grid_width = get_option( 'uc_sidebars_right_grid_width' );
            // see library/helpers.php
            $grid_chunks = calc_grid_chunks(array($sidebars_left_grid_width,$sidebars_right_grid_width),12);

            $custom_css .= '@media print, screen and (min-width: 40em) {
                    .main-grid.sidebar-both .sidebar.sidebar-left {
                        width: calc('.$grid_chunks["sidebar0"].' - 1.875rem);
                    }
                }
                @media print, screen and (min-width: 40em) {
                    .main-grid.sidebar-both .sidebar.sidebar-right {
                        width: calc('.$grid_chunks["sidebar1"].' - 1.875rem);
                    }
                }
                @media print, screen and (min-width: 40em) {
                    .main-grid.sidebar-both .main-content.narrow {
                        width: calc('.$grid_chunks["content"].' - 1.875rem);
                    }
                }
            ';

        }
        return $custom_css;
    }
}











