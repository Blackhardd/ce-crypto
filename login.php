<?php

/**
 * Template Name: Реєстрація/Вхід
 * 
 * @package CeCrypto
 * @since 1.0.0
 */

get_header();

?>

<section>
    <div class="container">
        <div class="login">
            <div class="login__header">
                <div class="login__title subtitle" data-tab="signin"><?=__( 'Увійти', 'ce-crypto' ); ?></div>
                <div class="login__title-separator"></div>
                <div class="login__title subtitle" data-tab="signup"><?=__( 'Реєстрація', 'ce-crypto' ); ?></div>
            </div>

            <div class="login__body">
                <div class="login__tab" data-tab="signin">
                    <?php get_template_part( 'template-parts/forms/login' ); ?>
                </div>

                <div class="login__tab" data-tab="signup">
                    <?php get_template_part( 'template-parts/forms/register' ); ?>
                </div>
            </div>
        </div>
    </div>
</section>

<?php

get_footer();