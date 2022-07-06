<?php

/**
 * Template Name: Донати
 * 
 * @package CeCrypto
 * @since 1.0.0
 */


get_header();

?>

<section class="donate-intro">
    <div class="container">
        <div class="donate-intro__inner">
            <div class="donate-intro__content donate-intro-content">
                <h1 class="donate-intro__title title"><?php the_title(); ?></h1>

                <article class="donate-intro__article"><?=wpautop( carbon_get_the_post_meta( 'intro_content' ) ); ?></article>
            </div>

            <?php if( $image = carbon_get_the_post_meta( 'intro_image' ) ) : ?>
                <div class="donate-intro__photo donate-intro-photo">
                    <div class="donate-intro-photo__inner">
                        <img src="<?=wp_get_attachment_image_url( $image, 'full' ); ?>">
                    </div>
                </div>
            <?php endif; ?>
        </div>

        <?php if( $funds = carbon_get_the_post_meta( 'funds_list' ) ) : ?>
            <div class="donate-intro__list">
                <?php foreach( $funds as $fund ) : ?>
                    <div class="donate-intro__item">
                        <div class="donate-intro__item-inner">
                            <a href="<?=$fund['link']; ?>" target="_blank">
                                <div class="donate-intro__item-preview">
                                    <?=wp_get_attachment_image( $fund['image'], 'full' ); ?>
                                </div>
                            </a>
                            
                            <div class="donate-intro__item-title"><?=$fund['title']; ?></div>
                            <p class="donate-intro__item-desc"><?=$fund['description']; ?></p>
                            <a class="donate-intro__item-link" href="<?=$fund['link']; ?>" target="_blank"><?=str_replace( 'https://', '', $fund['link'] ); ?></a>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
    </div>
</section>

<?php

get_footer();