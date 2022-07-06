<div class="social-login">
    <div class="social-login__title"><?=__( 'Увійти через соціальні мережі', 'ce-crypto' ); ?></div>

    <div class="social-login__buttons">
        <?php if( true ) : ?>
            <a class="social-login-button social-login-button--facebook" href="#"><?=ccpt_get_icon( 'social-login/facebook' ); ?></a>
        <?php endif; ?>

        <?php if( $link = ccpt_get_google_auth_link() ) : ?>
            <a class="social-login-button social-login-button--google" href="<?=$link; ?>"><?=ccpt_get_icon( 'social-login/google' ); ?></a>
        <?php endif; ?>
    </div>
</div>