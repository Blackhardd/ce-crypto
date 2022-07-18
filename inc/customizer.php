<?php

add_action( 'customize_register', 'ccpt_customize_register' );

function ccpt_customize_register( $customizer ){
    // Service pages

    $customizer->add_section( 'service_pages_section', array(
        'title'         => __( 'Службові сторінки', 'ce-crypto' ),
        'priority'      => 150
    ) );

    $customizer->add_setting( 'profile_page', array( 'default' => '' ) );
    $customizer->add_setting( 'login_page', array( 'default' => '' ) );
    $customizer->add_setting( 'courses_page', array( 'default' => '' ) );

    $customizer->add_control( 'login_page', array(
        'id'            => 'login_page_control',
        'label'         => __( 'Вхід/Реєстрація', 'ce-crypto' ),
        'section'       => 'service_pages_section',
        'type'          => 'dropdown-pages'
    ) );

    $customizer->add_control( 'profile_page', array(
        'id'            => 'profile_page_control',
        'label'         => __( 'Профіль', 'ce-crypto' ),
        'section'       => 'service_pages_section',
        'type'          => 'dropdown-pages'
    ) );

    $customizer->add_control( 'courses_page', array(
        'id'            => 'courses_control',
        'label'         => __( 'Курси', 'ce-crypto' ),
        'section'       => 'service_pages_section',
        'type'          => 'dropdown-pages'
    ) );


    // Articles archive settings

    $customizer->add_panel( 'articles_archive_panel', array(
        'title'         => __( 'Архів статей', 'ce-crypto' ),
        'priority'      => 150
    ) );

    $customizer->add_section( 'articles_archive_pinned_section', array(
        'title'         => __( 'Закріплені статті', 'ce-crypto' ),
        'panel'         => 'articles_archive_panel'
    ) );

    $article_choices = ccpt_get_articles_choices();

    $customizer->add_setting( 'articles_archive_pinned_first', array( 'default' => '' ) );
    $customizer->add_setting( 'articles_archive_pinned_second', array( 'default' => '' ) );
    $customizer->add_setting( 'articles_archive_pinned_third', array( 'default' => '' ) );

    $customizer->add_control( 'articles_archive_pinned_first', array(
        'id'            => 'articles_archive_pinned_first_control',
        'label'         => __( 'Перша', 'ce-crypto' ),
        'section'       => 'articles_archive_pinned_section',
        'type'          => 'select',
        'choices'       => $article_choices
    ) );

    $customizer->add_control( 'articles_archive_pinned_second', array(
        'id'            => 'articles_archive_pinned_second_control',
        'label'         => __( 'Друга', 'ce-crypto' ),
        'section'       => 'articles_archive_pinned_section',
        'type'          => 'select',
        'choices'       => $article_choices
    ) );

    $customizer->add_control( 'articles_archive_pinned_third', array(
        'id'            => 'articles_archive_pinned_third_control',
        'label'         => __( 'Третя', 'ce-crypto' ),
        'section'       => 'articles_archive_pinned_section',
        'type'          => 'select',
        'choices'       => $article_choices
    ) );

    $customizer->add_section( 'articles_archive_difficulties_section', array(
        'title'         => __( 'Рівні важкості', 'ce-crypto' ),
        'panel'         => 'articles_archive_panel'
    ) );

    $difficulties = ccpt_get_difficulties();

    foreach( $difficulties as $key => $title ){
        $customizer->add_setting( 'difficulty_' . $key . '_title', array( 'default' => $title, 'type' => 'option' ) );

        $customizer->add_control( 'difficulty_' . $key . '_title', array(
            'id'            => 'difficulty_' . $key . '_title' . '_control',
            'label'         => sprintf( __( 'Назва (%s)', 'ce-crypto' ), $title ),
            'section'       => 'articles_archive_difficulties_section'
        ) );
    }


    // Single article page settings

    $customizer->add_panel( 'single_article_panel', array(
        'title'         => __( 'Стаття', 'ce-crypto' ),
        'priority'      => 150
    ) );


    $customizer->add_section( 'single_article_banner_section', array(
        'title'         => __( 'Банер', 'ce-crypto' ),
        'panel'         => 'single_article_panel'
    ) );


    $customizer->add_setting( 'single_article_banner_display', array( 'default' => '' ) );
    $customizer->add_setting( 'single_article_banner_type', array( 'default' => 'default' ) );
    $customizer->add_setting( 'single_article_banner_overtitle', array( 'default' => '' ) );
    $customizer->add_setting( 'single_article_banner_title', array( 'default' => '' ) );
    $customizer->add_setting( 'single_article_banner_button_title', array( 'default' => '' ) );
    $customizer->add_setting( 'single_article_banner_button_link', array( 'default' => '' ) );
    $customizer->add_setting( 'single_article_banner_button_link_target', array( 'default' => '' ) );
    $customizer->add_setting( 'single_article_banner_image', array( 'default' => '' ) );


    $customizer->add_control( 'single_article_banner_display', array(
        'id'            => 'display_control',
        'label'         => __( 'Показувати банер?', 'ce-crypto' ),
        'section'       => 'single_article_banner_section',
        'type'          => 'checkbox',
        'std'           => '1'
    ) );

    $customizer->add_control( 'single_article_banner_type', array(
        'id'            => 'type_control',
        'label'         => __( 'Тип', 'ce-crypto' ),
        'section'       => 'single_article_banner_section',
        'type'          => 'radio',
        'choices'       => array(
            'default'       => __( 'Звичайний', 'ce-crypto' ),
            'image'         => __( 'Зображення', 'ce-crypto' )
        )
    ) );

    $customizer->add_control( 'single_article_banner_overtitle', array(
        'id'            => 'overtitle_control',
        'label'         => __( 'Заголовок', 'ce-crypto' ),
        'section'       => 'single_article_banner_section'
    ) );

    $customizer->add_control( 'single_article_banner_title', array(
        'id'            => 'title_control',
        'label'         => __( 'Надзаголовок', 'ce-crypto' ),
        'section'       => 'single_article_banner_section'
    ) );

    $customizer->add_control( 'single_article_banner_button_title', array(
        'id'            => 'button_title_control',
        'label'         => __( 'Надпис кнопки', 'ce-crypto' ),
        'section'       => 'single_article_banner_section'
    ) );

    $customizer->add_control( 'single_article_banner_button_link', array(
        'id'            => 'button_link_control',
        'label'         => __( 'Посилання', 'ce-crypto' ),
        'section'       => 'single_article_banner_section'
    ) );

    $customizer->add_control( 'single_article_banner_button_link_target', array(
        'id'            => 'display_control',
        'label'         => __( 'Відкривати у новій вкладці', 'ce-crypto' ),
        'section'       => 'single_article_banner_section',
        'type'          => 'checkbox',
        'std'           => '1'
    ) );

    $customizer->add_control( new WP_Customize_Media_Control( $customizer, 'single_article_banner_image', 
        array(
            'mime_type' => 'image',
            'label'     => __( 'Зображення', 'ce-crypto' ),
            'section'   => 'single_article_banner_section',
            'settings'  => 'single_article_banner_image'
        )
    ) );


    // Modals

    $customizer->add_panel( 'modals_panel', array(
        'title'         => __( 'Модальні вікна', 'ce-crypto' ),
        'priority'      => 150
    ) );

    $customizer->add_section( 'force_register_modal_section', array(
        'title'         => __( 'Призов зареєструватися', 'ce-crypto' ),
        'panel'         => 'modals_panel'
    ) );

    $customizer->add_setting( 'force_register_modal_message', array( 'default' => __( 'Для переходу до наступної статті  зареєструйтесь, будь ласка', 'ce-crypto' ) ) );

    $customizer->add_control( 'force_register_modal_message', array(
        'id'            => 'force_register_message_control',
        'label'         => __( 'Повідомлення', 'ce-crypto' ),
        'section'       => 'force_register_modal_section',
        'type'          => 'textarea'
    ) );

    
    // Social network links

    $customizer->add_section( 'socials_section', array(
        'title'         => __( 'Соціальні мережі', 'ce-crypto' ),
        'priority'      => 150
    ) );

    $customizer->add_setting( 'telegram', array( 'default' => '' ) );
    $customizer->add_setting( 'telegram_chat', array( 'default' => '' ) );
    $customizer->add_setting( 'instagram', array( 'default' => '' ) );
    $customizer->add_setting( 'facebook', array( 'default' => '' ) );
    $customizer->add_setting( 'twitter', array( 'default' => '' ) );

    $customizer->add_control( 'telegram', array(
        'id'            => 'telegram_control',
        'label'         => __( 'Telegram', 'ce-crypto' ),
        'section'       => 'socials_section'
    ) );

    $customizer->add_control( 'telegram_chat', array(
        'id'            => 'telegram_chat_control',
        'label'         => __( 'Telegram чат', 'ce-crypto' ),
        'section'       => 'socials_section'
    ) );

    $customizer->add_control( 'instagram', array(
        'id'            => 'instagram_control',
        'label'         => __( 'Instagram', 'ce-crypto' ),
        'section'       => 'socials_section'
    ) );

    $customizer->add_control( 'facebook', array(
        'id'            => 'facebook_control',
        'label'         => __( 'Facebook', 'ce-crypto' ),
        'section'       => 'socials_section'
    ) );

    $customizer->add_control( 'twitter', array(
        'id'            => 'twitter_control',
        'label'         => __( 'Twitter', 'ce-crypto' ),
        'section'       => 'socials_section'
    ) );
}