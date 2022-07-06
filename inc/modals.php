<?php

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