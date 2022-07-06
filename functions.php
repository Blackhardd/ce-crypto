<?php

/**
 * CeCrypto functions and definitions
 * 
 * @package CeCrypto
 * @since 1.0.0
 */

if( !defined( 'CCPT_THEME_VER' ) )
    define( 'CCPT_THEME_VER', wp_get_theme()->get( 'Version' ) );

if( !defined( 'CCPT_THEME_URI' ) )
    define( 'CCPT_THEME_URI', get_template_directory_uri() );

if( !defined( 'CCPT_THEME_PATH' ) )
    define( 'CCPT_THEME_PATH', get_template_directory() );


// Includes

require CCPT_THEME_PATH . '/inc/customizer.php';
require CCPT_THEME_PATH . '/inc/framework.php';
require CCPT_THEME_PATH . '/inc/carbon-fields.php';
require CCPT_THEME_PATH . '/inc/modals.php';


// Adding theme supports

add_action( 'after_setup_theme', 'ccpt_setup_theme' );

function ccpt_setup_theme(){
    add_theme_support( 'title-tag' );
    add_theme_support( 'custom-logo', array(
        'width'         => 151,
        'height'        => 50,
        'flex-width'    => true,
        'flex-height'   => true
    ) );
    add_theme_support( 'post-thumbnails' );


    // Adding theme support for HTML5

    add_theme_support( 'html5', array(
        'search-form',
        'comment-form',
        'comment-list',
        'gallery',
        'caption',
        'script',
        'style',
        'navigation-widgets',
    ) );


    // Add theme image sizes

    add_image_size( 'article-card-large', 804, 496, true );
    add_image_size( 'article-card-small', 392, 302, true );
    add_image_size( 'article-banner', 804, 320, true );
    

    // Registering menus

    register_nav_menus( array(
        'primary-menu'  => __( 'Головне меню', 'ce-crypto' ),
        'footer-menu'   => __( 'Футер меню', 'ce-crypto' )
    ) );
}


// Enqueue theme scripts and styles

add_action( 'wp_enqueue_scripts', 'ccpt_enqueue_scripts' );

function ccpt_enqueue_scripts(){
    // Register styles

    wp_register_style( 'swiper', CCPT_THEME_URI . '/assets/css/libs/swiper-bundle.min.css', ['theme'], CCPT_THEME_VER );
    wp_register_style( 'noui-slider', CCPT_THEME_URI . '/assets/css/libs/nouislider.min.css', ['theme'], CCPT_THEME_VER );


    // Enqueue style

    wp_enqueue_style( 'fonts', CCPT_THEME_URI . '/assets/css/fonts.css', [], CCPT_THEME_VER );
    wp_enqueue_style( 'theme', get_stylesheet_uri(), ['fonts'], CCPT_THEME_VER );
    wp_enqueue_style( 'critical', CCPT_THEME_URI . '/assets/css/critical.css', ['theme'], CCPT_THEME_VER );
    wp_enqueue_style( 'theme-styles', CCPT_THEME_URI . '/assets/css/index.css', ['theme'], CCPT_THEME_VER );

    
    // Register scripts
    
    wp_register_script( 'swiper', CCPT_THEME_URI . '/assets/js/libs/swiper-bundle.min.js', [], CCPT_THEME_VER, true );
    wp_register_script( 'micromodal', CCPT_THEME_URI . '/assets/js/libs/micromodal.min.js', [], CCPT_THEME_VER, true );
    wp_register_script( 'wnumb', CCPT_THEME_URI . '/assets/js/libs/wNumb.min.js', [], CCPT_THEME_VER, true );
    wp_register_script( 'noui-slider', CCPT_THEME_URI . '/assets/js/libs/nouislider.min.js', ['wnumb'], CCPT_THEME_VER, true );
    wp_register_script( 'forms', CCPT_THEME_URI . '/assets/js/forms.js', ['jquery'], CCPT_THEME_VER, true );
    wp_register_script( 'test', CCPT_THEME_URI . '/assets/js/test.js', ['jquery'], CCPT_THEME_VER, true );
    wp_register_script( 'filter-reading-time', CCPT_THEME_URI . '/assets/js/filters/reading-time.js', ['jquery', 'noui-slider'], CCPT_THEME_VER, true );


    // Enqueue scripts

    wp_enqueue_script( 'front', CCPT_THEME_URI . '/assets/js/index.js', ['jquery'], CCPT_THEME_VER, true );
    wp_enqueue_script( 'forms' );

    if( is_singular( 'test' ) ){
        wp_enqueue_script( 'test' );
    }


    // Localize scripts

    wp_localize_script( 'front', 'ccpt_data', array(
        'ajax_url'  => admin_url( 'admin-ajax.php' ),
        'post_id'   => is_singular() ? get_the_ID() : false
    ) );

    wp_localize_script( 'forms', 'ccpt_forms_data', array(
        'ajax_url' => admin_url( 'admin-ajax.php' )
    ) );

    if( is_post_type_archive( 'term' ) ){
        global $wp_query;

        wp_localize_script( 'front', 'ccpt_terms_data', array(
            'query_vars'    => json_encode( $wp_query->query_vars )
        ) );
    }
}