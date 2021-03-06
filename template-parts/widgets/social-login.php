<?php

wp_enqueue_script( 'facebook-login' );


$title = isset( $args['title'] ) && $args['title'] !== false ? $args['title'] : ( isset( $args['title'] ) && $args['title'] === false ? false : __( 'Увійти через соціальні мережі', 'ce-crypto' ) );

?>

<div class="social-login">
    <?php if( $title !== false ) : ?>
        <div class="social-login__title"><?=$title; ?></div>
    <?php endif; ?>

    <div class="social-login__buttons">
        <?php if( true ) : ?>
            <a class="social-login-button social-login-button--facebook" href="#" data-login="facebook"><?=ccpt_get_icon( 'social-login/facebook' ); ?></a>
        <?php endif; ?>

        <?php if( $link = ccpt_get_google_auth_link() ) : ?>
            <a class="social-login-button social-login-button--google" href="<?=$link; ?>"><?=ccpt_get_icon( 'social-login/google' ); ?></a>
        <?php endif; ?>
    </div>
</div>