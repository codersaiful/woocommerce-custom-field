<?php

/**
 * Adding menu as WooCommerce's menu's Submenu
 * check inside Woocommerce Menu
 * 
 * @since 1.0
 */
function wccf_add_menu(){
    
    add_submenu_page( 'woocommerce', 'Variations Custom Field', 'WC Custom Field', 'manage_options', 'wc-custom-field', 'wccf_option_panel' );
}
add_action( 'admin_menu','wccf_add_menu' );


function wccf_script_enqueue() {
    wp_enqueue_script('jquery');
    wp_register_script( 'wccf_js', WCCF_BASE_URL . 'js/wccf.js', false, WC_Custom_Field::getVersion() );
    wp_enqueue_script( 'wccf_js' );
}
add_action( 'admin_enqueue_scripts', 'wccf_script_enqueue' );