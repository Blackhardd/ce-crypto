<?php

use Carbon_Fields\Container;
use Carbon_Fields\Field;


Container::make( 'post_meta', __( 'Налаштування статті', 'ce-crypto' ) )
    ->where( 'post_type', '=', 'article' )
    ->add_fields( array(
        Field::make( 'checkbox', 'sticky_archive', __( 'Закріпити в архіві', 'ce-crypto' ) )
            ->set_option_value( '1' ),
        Field::make( 'text', 'reading_time', __( 'Час читання (хв.)', 'ce-crypto' ) )
            ->set_attribute( 'type', 'number' )
            ->set_default_value( 5 )
    ) );