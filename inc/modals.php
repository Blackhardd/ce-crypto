<?php


// Avatar cropping modal.

add_action( 'wp_footer', 'ccpt_avatar_cropping_modal' );

function ccpt_avatar_cropping_modal(){ ?>

    <div class="modal" id="modal-avatar-cropping" aria-hidden="true">
        <div class="modal__dimmer"></div>

        <div class="modal__inner">
            <div class="modal__content">
                <div class="image-cropper">
                    <div class="image-cropper__inner">
                        <img src="" class="image-cropper__image">
                    </div>
                    
                    <button class="btn btn--primary image-cropper__submit" data-micromodal-close><?=__( 'Зберегти', 'ce-crypto' ); ?></button>
                </div>
            </div>
        </div>
    </div>

    <?php
}


// Article login modal for non logged in users.

add_action( 'wp_footer', 'ccpt_article_non_logged_in_user_login_modal' );

function ccpt_article_non_logged_in_user_login_modal(){
    wp_enqueue_script( 'micromodal' );

    if( is_singular( 'article' ) && !is_user_logged_in() ) : ?>
        <div class="modal" id="modal-force-register" aria-hidden="true">
            <div class="modal__dimmer" data-micromodal-close></div>

            <div class="modal__inner">
                <button class="modal__close" data-micromodal-close><?=ccpt_get_icon( 'close' ); ?></button>

                <div class="modal__content">
                    <div class="force-login">
                        <?=ccpt_get_icon( 'force-login' ); ?>
                        <div class="force-login__title"><?=get_theme_mod( 'force_register_modal_message' ); ?></div>
                        <a href="<?=get_permalink( get_theme_mod( 'login_page' ) ); ?>" class="btn btn--primary force-login__action"><?=__( 'Зареєструватися', 'ce-crypto' ); ?></a>
                    </div>
                </div>
            </div>
        </div>
    <?php endif;
}


// Article lost password modal.

add_action( 'wp_footer', 'ccpt_lost_password_modal' );

function ccpt_lost_password_modal(){
    wp_enqueue_script( 'micromodal' );

    if( is_page( get_theme_mod( 'login_page' ) ) && !is_user_logged_in() ) : ?>
        <div class="modal" id="modal-lost-password" aria-hidden="true">
            <div class="modal__dimmer" data-micromodal-close></div>

            <div class="modal__inner">
                <div class="modal__header">
                    <div class="modal__title"><?=__( 'Забули пароль', 'ce-crypto' ); ?></div>

                    <button class="modal__close" data-micromodal-close><?=ccpt_get_icon( 'close' ); ?></button>
                </div>

                <div class="modal__content">
                    <div class="lost-password">
                        <div class="lost-password__left">
                            <div class="lost-password__desc"><?=__( 'Будь ласка, введіть адресу своєї електронної пошти у форму нижче і ми надішлемо вам тимчасовий пароль.', 'ce-crypto' ); ?></div>

                            <div class="lost-password__form">
                                <?php get_template_part( 'template-parts/forms/lost-password' ); ?>
                            </div>
                        </div>

                        <div class="lost-password__separator"><?=__( 'Або', 'ce-crypto' ); ?></div>

                        <div class="lost-password__right">
                            <?php get_template_part( 'template-parts/widgets/social-login', null, array( 'title' => __( 'Увійти як користувач', 'ce-crypto' ) ) ); ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php endif;
}