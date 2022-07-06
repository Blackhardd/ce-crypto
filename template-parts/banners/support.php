<?php

$link = get_permalink( $args['page'] );

?>

<section class="support">
    <div class="container">
        <div class="support__inner">
            <div class="support__content">
                <div class="support__title title"><?=__( 'Підтримати Україну', 'ce-crypto' ); ?></div>

                <div class="support__btn-wrapper">
                    <a class="support__btn btn btn--primary" href="<?=$link; ?>"><?=__( 'підтримати', 'ce-crypto' ); ?></a>
                </div>
            </div>

            <div class="support__photo">
                <img src="<?=ccpt_get_image_url( 'banners/support/photo.png' ); ?>">
                <img src="<?=ccpt_get_image_url( 'banners/support/border-1.svg' ); ?>">
                <img src="<?=ccpt_get_image_url( 'banners/support/border-2.svg' ); ?>">
            </div>
        </div>
    </div>
</section>