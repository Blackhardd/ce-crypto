<?php

use Carbon_Fields\Container;
use Carbon_Fields\Field;

$articles = [];

foreach( ccpt_get_articles() as $article ){
    $articles[$article->ID] = $article->post_title;
}

Container::make( 'post_meta', __( 'Налаштування сторінки', 'ce-crypto' ) )
    ->where( 'post_template', '=', 'homepage.php' )
    ->add_tab( __( 'Інтро', 'ce-crypto' ), array(
        Field::make( 'select', 'intro_primary', __( 'Головна стаття', 'ce-crypto' ) )
            ->set_options( $articles ),
        Field::make( 'select', 'intro_secondary', __( 'Друга стаття', 'ce-crypto' ) )
            ->set_options( $articles ),
        Field::make( 'select', 'intro_tertiary', __( 'Третя стаття', 'ce-crypto' ) )
            ->set_options( $articles )
    ) )
    ->add_tab( __( 'Про нас', 'ce-crypto' ), array(
        Field::make( 'text', 'about_title', __( 'Заголовок секції', 'ce-crypto' ) ),
        Field::make( 'select', 'about_title_link', __( 'Сторінка посилання заголовку', 'ce-crypto' ) )
            ->set_options( ccpt_get_page_choices() ),
        Field::make( 'rich_text', 'about_content', __( 'Контент секції', 'ce-crypto' ) ),
    ) )
    ->add_tab( __( 'Наші партнери', 'ce-crypto' ), array(
        Field::make( 'text', 'partners_title', __( 'Заголовок секції', 'ce-crypto' ) ),
        Field::make( 'media_gallery', 'partners_gallery' )
            ->set_type( array( 'image', 'video' ) )
    ) )
    ->add_tab( __( 'Підтримка', 'ce-crypto' ), array(
        Field::make( 'select', 'support_page', __( 'Сторінка підтримки', 'ce-crypto' ) )
            ->set_options( ccpt_get_page_choices() )
    ) );