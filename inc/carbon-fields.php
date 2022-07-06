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