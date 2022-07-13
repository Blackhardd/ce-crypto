<?php

use Carbon_Fields\Container;
use Carbon_Fields\Field;


// Load Carbon Fields.

add_action( 'after_setup_theme', 'crb_load' );

function crb_load() {
    require_once( CCPT_THEME_PATH . '/vendor/autoload.php' );
    \Carbon_Fields\Carbon_Fields::boot();
}


// Register fields.

add_action( 'carbon_fields_register_fields', 'ccpt_register_fields' );

function ccpt_register_fields(){
    include CCPT_THEME_PATH . '/inc/carbon-fields/homepage.php';
    include CCPT_THEME_PATH . '/inc/carbon-fields/donations.php';
    include CCPT_THEME_PATH . '/inc/carbon-fields/about.php';
    include CCPT_THEME_PATH . '/inc/carbon-fields/faq.php';
    include CCPT_THEME_PATH . '/inc/carbon-fields/article.php';
    include CCPT_THEME_PATH . '/inc/carbon-fields/test.php';
}


// Disable default page editor on specific templates.

add_action( 'init', 'gti_disable_default_page_editor' );

function gti_disable_default_page_editor(){
    if( is_admin() && isset( $_GET['post'] ) ){
        $id = $_GET['post'];

        $templates = [
            'homepage.php',
            'donations.php',
            'about.php',
            'faq.php'
        ];

        $current_page_template = get_post_meta( $id, '_wp_page_template', true );

        if( in_array( $current_page_template, $templates ) || $id === get_option('page_for_posts', true ) ){
            remove_post_type_support( 'page', 'editor' );
        }
    }
}