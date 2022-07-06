<?php

use Carbon_Fields\Container;
use Carbon_Fields\Field;


Container::make( 'post_meta', __( 'Налаштування тесту', 'ce-crypto' ) )
    ->where( 'post_type', '=', 'test' )
    ->add_fields( array(
        Field::make( 'complex', 'questions', __( 'Список запитань', 'ce-crypto' ) )
            ->set_layout( 'tabbed-vertical' )
            ->add_fields( array(
                Field::make( 'text', 'title', __( 'Запитання', 'ce-crypto' ) ),
                Field::make( 'image', 'image', __( 'Зображення', 'ce-crypto' ) ),
                Field::make( 'complex', 'answers', __( 'Відповіді', 'ce-crypto' ) )
                    ->add_fields( array(
                        Field::make( 'text', 'answer', __( 'Текст відповіді', 'ce-crypto' ) ),
                        Field::make( 'checkbox', 'is_correct', __( 'Вірна відповідь', 'ce-crypto' ) )
                    ) )
                    ->set_collapsed( true )
                    ->set_header_template( '
                        <% if (answer) { %>
                            <%- answer %>
                        <% } %>
                    ' )
            ) )
            ->set_header_template( '
                <% if (title) { %>
                    <%- title %>
                <% } %>
            ' )
    ) );