<?php

use Carbon_Fields\Container;
use Carbon_Fields\Field;

Container::make( 'post_meta', __( 'Налаштування сторінки', 'ce-crypto' ) )
    ->where( 'post_template', '=', 'donations.php' )
    ->add_tab( __( 'Інтро', 'ce-crypto' ), array(
        Field::make( 'rich_text', 'intro_content', __( 'Контент', 'ce-crypto' ) ),
        Field::make( 'image', 'intro_image', __( 'Зображення', 'ce-crypto' ) )
    ) )
    ->add_tab( __( 'Фонди', 'ce-crypto' ), array(
        Field::make( 'complex', 'funds_list', __( 'Фонди', 'ce-crypto' ) )
            ->add_fields( array(
                Field::make( 'image', 'image', __( 'Зображення', 'ce-crypto' ) ),
                Field::make( 'text', 'title', __( 'Заголовок', 'ce-crypto' ) ),
                Field::make( 'rich_text', 'description', __( 'Опис', 'ce-crypto' ) ),
                Field::make( 'text', 'link', __( 'Посилання', 'ce-crypto' ) )
                    ->set_attribute( 'type', 'url' )
            ) )
            ->set_header_template( '
                <% if (title) { %>
                    <%- title %>
                <% } %>
            ' )
            ->set_collapsed( true )
    ) );