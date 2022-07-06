<?php

use Carbon_Fields\Container;
use Carbon_Fields\Field;

Container::make( 'post_meta', __( 'Налаштування сторінки', 'ce-crypto' ) )
    ->where( 'post_template', '=', 'faq.php' )
    ->add_fields( array(
        Field::make( 'complex', 'items', __( 'Питання', 'ce-crypto' ) )
            ->add_fields( array(
                Field::make( 'text', 'title', __( 'Заголовок', 'ce-crypto' ) ),
                Field::make( 'rich_text', 'description', __( 'Опис', 'ce-crypto' ) )
            ) )
            ->set_header_template( '
                <% if (title) { %>
                    <%- title %>
                <% } %>
            ' )
            ->set_collapsed( true )
    ) );