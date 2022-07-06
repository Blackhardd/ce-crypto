<?php

/**
 * Template Name: Про нас
 * 
 * @package CeCrypto
 * @since 1.0.0
 */

get_header();

?>

<section class="about-intro">
    <div class="container">
        <div class="about-intro__inner">
            <div class="about-intro__content about-intro-content">
                <h1 class="about-intro__title title"><?=the_title(); ?></h1>

                <article class="about-intro__article"><?=wpautop( carbon_get_the_post_meta( 'intro_content' ) ); ?></article>

                <?php if( $partners = carbon_get_the_post_meta( 'intro_partners' ) ) : ?>
                    <div class="about-intro__partners">
                        <?php foreach( $partners as $partner ) : ?>
                            <div class="about-intro__partners-item partner-item">
                                <div class="about-intro__partners-item-inner partner-item__inner">
                                    <?=wp_get_attachment_image( $partner, 'full' ); ?>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>
            </div>

            <?php if( $image = carbon_get_the_post_meta( 'intro_image' ) ) : ?>
                <div class="about-intro__photo about-intro-photo">
                    <div class="about-intro-photo__inner">
                        <?=wp_get_attachment_image( $image, 'full' ); ?>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </div>
</section>

<?php if( $title = carbon_get_the_post_meta( 'banner_title' ) ) : ?>
    <section class="about-quote">
        <div class="container">
            <div class="about-quote__inner">
                <div class="about-quote__title title"><?=$title; ?></div>

                <img src="<?=ccpt_get_image_url( 'spiral.svg' ); ?>">
                <img src="<?=ccpt_get_image_url( 'spiral.svg' ); ?>">
                <img src="<?=ccpt_get_image_url( 'sun.svg' ); ?>">
                <img src="<?=ccpt_get_image_url( 'sun.svg' ); ?>">
            </div>
        </div>
    </section>
<?php endif; ?>

<?php if( $title = carbon_get_the_post_meta( 'benefits_title' ) ) : ?>
    <section class="about-benefits">
        <div class="container">
            <div class="about-benefits__title"><?=$title; ?></div>

            <?php if( $benefits = carbon_get_the_post_meta( 'benefits_items' ) ) : ?>
                <div class="about-benefits__inner">
                    <?php foreach( $benefits as $benefit ) : ?>
                        <div class="about-benefits__item">
                            <div class="about-benefits__item-inner">
                                <div class="about-benefits__item-icon">
                                    <?=wp_get_attachment_image( $benefit['image'], 'full' ); ?>
                                </div>

                                <div class="about-benefits__item-title"><?=$benefit['title']; ?></div>
                                <div class="about-benefits__item-desc"><?=$benefit['description']; ?></div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
        </div>
    </section>
<?php endif; ?>

<?php if( $title = carbon_get_the_post_meta( 'contact_title' ) ) : ?>
    <section class="about-callback">
        <div class="container">
            <div class="about-callback__title title"><?=$title; ?></div>

            <?php get_template_part( 'template-parts/forms/contact' ); ?>
        </div>
    </section>
<?php endif; ?>

<?php

get_footer();