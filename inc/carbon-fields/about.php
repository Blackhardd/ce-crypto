<?php

use Carbon_Fields\Container;
use Carbon_Fields\Field;


Container::make( 'post_meta', __( 'Налаштування сторінки', 'ce-crypto' ) )
    ->where( 'post_template', '=', 'about.php' )
    ->add_tab( __( 'Інтро', 'ce-crypto' ), array(
        Field::make( 'rich_text', 'intro_content', __( 'Контент', 'ce-crypto' ) ),
        Field::make( 'image', 'intro_image', __( 'Зображення', 'ce-crypto' ) ),
        Field::make( 'media_gallery', 'intro_partners', __( 'Логотипи партнерів', 'ce-crypto' ) )
    ) )
    ->add_tab( __( 'Банер', 'ce-crypto' ), array(
        Field::make( 'text', 'banner_title', __( 'Заголовок', 'ce-crypto' ) )
    ) )
    ->add_tab( __( 'Переваги', 'ce-crypto' ), array(
        Field::make( 'text', 'benefits_title', __( 'Заголовок', 'ce-crypto' ) ),
        Field::make( 'complex', 'benefits_items', __( 'Список переваг', 'ce-crypto' ) )
            ->add_fields( array(
                Field::make( 'text', 'title', __( 'Заголовок', 'ce-crypto' ) ),
                Field::make( 'textarea', 'description', __( 'Опис', 'ce-crypto' ) ),
                Field::make( 'image', 'image', __( 'Зображення', 'ce-crypto' ) )
            ) )
            ->set_header_template( '
                <% if (title) { %>
                    <%- title %>
                <% } %>
            ' )
            ->set_collapsed( true )
    ) )
    ->add_tab( __( 'Контактна форма', 'ce-crypto' ), array(
        Field::make( 'text', 'contact_title', __( 'Заголовок', 'ce-crypto' ) )
    ) );