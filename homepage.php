<?php

/**
 * Template Name: Головна
 * 
 * @package CeCrypto
 * @since 1.0.0
 */

get_header();

?>

<section id="home-intro">
    <div class="container">
        <?php
        
        $intro_articles = array(
            carbon_get_the_post_meta( 'intro_primary' ),
            carbon_get_the_post_meta( 'intro_secondary' ),
            carbon_get_the_post_meta( 'intro_tertiary' )
        );
        
        ?>

        <div class="intro">
            <div class="intro__pinned">
                <?php foreach( $intro_articles as $key => $article_id ) : ?>
                    <?php if( $article_id ) : ?>
                        <?php $article = get_post( $article_id ); ?>
                        <?php ccpt_get_article_card_template( $article, $key === 0 ? 'large' : 'small' ); ?>
                    <?php endif; ?>
                <?php endforeach; ?>
            </div>

            <?php if( $recent_articles = wp_get_recent_posts( array( 'post_type' => 'article' ), OBJECT ) ) : ?>
                <div class="recent-articles recent-articles--default recent-articles--home intro__recent">
                    <ul class="recent-articles__list">
                        <?php foreach( $recent_articles as $article ) : ?>
                            <li class="recent-article-item">
                                <div class="recent-article-item__header">
                                    <div class="recent-article-item__category"><?=ccpt_get_article_category( $article->ID )->name; ?></div>
                                    <div class="recent-article-item__date"><?=get_the_date( 'd.m.Y', $article->ID ); ?></div>
                                </div>

                                <div class="recent-article-item__title">
                                    <a class="recent-article-item__link" href="<?=get_permalink( $article->ID ); ?>"><?=$article->post_title; ?></a>
                                </div>
                            </li>
                        <?php endforeach; ?>
                    </ul>

                    <div class="recent-articles__footer">
                        <a href="<?=get_post_type_archive_link( 'article' ); ?>" class="arrow-button arrow-button--right">
                            <div class="arrow-button__title"><?=__( 'Всі статті', 'ce-crypto' ); ?></div>
                            
                            <div class="arrow-button__icon">
                                <?=ccpt_get_icon( 'arrow-right/arrow' ); ?>
                                <?=ccpt_get_icon( 'arrow-right/circle' ); ?>
                            </div>
                        </a>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </div>
</section>

<section class="main-about">
    <div class="container">
        <?php
        
        $about_title = carbon_get_the_post_meta( 'about_title' );
        $about_content = carbon_get_the_post_meta( 'about_content' );

        ?>

        <div class="main-about__inner">
            <div class="main-about__content main-about-content">
                <?php if( $about_title ) : ?>
                    <div class="main-about-content__title title"><?=$about_title; ?></div>
                <?php endif; ?>

                <?php if( $about_content ) : ?>
                    <article class="main-about-content__article">
                        <?=wpautop( $about_content ); ?>
                    </article>
                <?php endif; ?>
            </div>
            <div class="main-about__content main-about-desc">
                <img class="main-about-desc__bg" src="<?=ccpt_get_image_url( 'spiral.svg' ); ?>">
                <img class="main-about-desc__bg" src="<?=ccpt_get_image_url( 'spiral.svg' ); ?>">

                <div class="main-about-desc__title title">
                    <div class="main-about-desc__title-text">Це просто, це цікаво, це весело.</div>
                    <div class="main-about-desc__title-text">Зрозумiло про свiт криптовалют</div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="main-partners">
    <div class="container">
        <?php
        
        $partners_title = carbon_get_the_post_meta( 'partners_title' );
        $partners_gallery = carbon_get_the_post_meta( 'partners_gallery' );
        
        ?>

        <?php if( $partners_title ) : ?>
            <div class="main-partners__title title"><?=$partners_title; ?></div>
        <?php endif; ?>

        <?php if( $partners_gallery ) : ?>
            <?php
            
            wp_enqueue_style( 'swiper' );
            wp_enqueue_script( 'swiper' );
            
            ?>

            <div class="carousel carousel--partners swiper">
                <div class="swiper-wrapper">
                    <?php foreach( $partners_gallery as $item ) : ?>
                        <?php
                        
                        $alt = get_post_meta( $item, '_wp_attachment_image_alt', true );
                        $title = get_the_title( $item );
                            
                        ?>

                        <div class="partner-item swiper-slide">
                            <div class="partner-item__inner">
                                <img src="<?=wp_get_attachment_image_url( $item, 'full' ); ?>" <?=$alt ? "alt='{$alt}'" : ''; ?>>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>

                <div class="carousel__footer">
                    <button class="arrow-button arrow-button--left carousel__prev">
                        <div class="arrow-button__icon">
                            <?=ccpt_get_icon( 'arrow-left/circle' ); ?>
                            <?=ccpt_get_icon( 'arrow-left/arrow' ); ?>
                        </div>
                    </button>

                    <button class="arrow-button arrow-button--right carousel__next">
                        <div class="arrow-button__icon">
                            <?=ccpt_get_icon( 'arrow-right/arrow' ); ?>
                            <?=ccpt_get_icon( 'arrow-right/circle' ); ?>
                        </div>
                    </button>
                </div>
            </div>
        <?php endif; ?>
    </div>
</section>

<?php get_template_part( 'template-parts/banners/support', null, array( 'page' => carbon_get_the_post_meta( 'support_page' ) ) ); ?>

<?php

get_footer();