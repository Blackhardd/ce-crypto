<?php

get_header();

?>

<section id="page-not-found">
    <div class="container container--narrow">
        <div class="page-not-found">
            <img src="<?=ccpt_get_image_url( '404.svg' ); ?>" class="page-not-found__image">

            <div class="page-not-found__content">
                <div class="page-not-found__title"><?=__( 'Сторінка не знайдена', 'ce-crypto' ); ?></div>

                <div class="page-not-found__subtitle"><?=sprintf( __( 'Неправильна адреса, або такої сторінки більше не існує.<br/><br/>Перейдіть на <a href="%s">головну</a> сторінку', 'ce-crypto' ), home_url() ); ?></div>
            </div>
        </div>
    </div>
</section>

<?php

get_footer();