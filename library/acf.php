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