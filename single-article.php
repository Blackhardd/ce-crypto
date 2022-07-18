<?php

get_header();


do_action( 'ccpt_before_single_article' );

?>

<?php if( have_posts() ) : ?>
    <?php while( have_posts() ) : ?>
        <?php the_post(); ?>
        <section id="article-<?php the_ID(); ?>">
            <div class="container container--narrow">
                <div class="breadcrumbs breadcrumbs--article">
                    <a href="<?=get_post_type_archive_link( 'article' ); ?>" class="breadcrumbs__link breadcrumbs__link--home"><?=__( 'Статті', 'ce-crypto' ); ?></a>

                    <?php $category = get_the_terms( get_the_ID(), 'article_category' )[0]; ?>
                    <a href="<?=get_term_link( $category->term_id ); ?>" class="breadcrumbs__link"><?=$category->name; ?></a>
                </div>

                <article class="article">
                    <?php
                    
                    the_post_thumbnail( 'article-card-large', array(
                        'class' => 'article__thumbnail'
                    ) );
                    
                    ?>

                    <?php if( $themes = get_the_terms( get_the_ID(), 'article_tag' ) ) : ?>
                        <div class="article__tags">
                            <?php foreach( $themes as $theme ) : ?>
                                <div class="tag"><?=$theme->name; ?></div>
                            <?php endforeach; ?>
                        </div>
                    <?php endif; ?>

                    <h1 class="article__title"><?php the_title(); ?></h1>

                    <div class="article__meta">
                        <div class="article__author meta meta--author">
                            <div class="meta__icon"><?=ccpt_get_icon( 'meta/author' ); ?></div>
                            <div class="meta__value"><?php the_author(); ?></div>
                        </div>

                        <div class="article__date meta meta--date">
                            <div class="meta__icon"><?=ccpt_get_icon( 'meta/calendar' ); ?></div>
                            <div class="meta__value"><?php the_date( 'd.m.Y' ); ?></div>
                        </div>

                        <?php if( $reading_time = carbon_get_the_post_meta( 'reading_time' ) ) : ?>
                            <div class="article__duration meta meta--duration">
                                <div class="meta__icon"><?=ccpt_get_icon( 'meta/clock' ); ?></div>
                                <div class="meta__value"><?=$reading_time; ?> хв.</div>
                            </div>
                        <?php endif; ?>

                        <div class="article__views meta meta--views">
                            <div class="meta__icon"><?=ccpt_get_icon( 'meta/eye' ); ?></div>
                            <div class="meta__value"><?=ccpt_get_views(); ?></div>
                        </div>

                        <div class="article__likes meta meta--likes">
                            <div class="meta__icon"><?=ccpt_get_icon( 'meta/like' ); ?></div>
                            <div class="meta__value"><?=ccpt_get_likes(); ?></div>
                        </div>
                    </div>

                    <div class="article__content">
                        <?php the_content(); ?>
                    </div>

                    <?php if( boolval( get_theme_mod( 'single_article_banner_display' ) ) ) : ?>
                        <?php
                        
                        $type = get_theme_mod( 'single_article_banner_type' );
                        $overtitle = get_theme_mod( 'single_article_banner_overtitle' );
                        $title = get_theme_mod( 'single_article_banner_title' );
                        $button_title = get_theme_mod( 'single_article_banner_button_title' );
                        $button_link = get_theme_mod( 'single_article_banner_button_link' );
                        $button_link_target = get_theme_mod( 'single_article_banner_button_link_target' );
                        $image = get_theme_mod( 'single_article_banner_image' );
                            
                        ?>

                        <?php if( $type === 'default' ) : ?>
                            <div class="banner banner--default banner--article article__banner">
                                <div class="banner__content">
                                    <?php if( $overtitle ) : ?>
                                        <div class="banner__overtitle"><?=$overtitle; ?></div>
                                    <?php endif; ?>

                                    <?php if( $title ) : ?>
                                        <div class="banner__title"><?=$title; ?></div>
                                    <?php endif; ?>

                                    <?php if( $button_title && $button_link ) : ?>
                                        <div class="banner__action">
                                            <a href="<?=$button_link; ?>" <?=$button_link_target ? 'target="_blank"' : '' ; ?> class="btn btn--primary"><?=$button_title; ?></a>
                                        </div>
                                    <?php endif; ?>
                                </div>
                                
                                <img src="<?=wp_get_attachment_image_url( $image, 'article-banner' ); ?>" class="banner__image">
                            </div>
                        <?php elseif( $type === 'image' ) : ?>
                            <div class="banner banner--image banner--article article__banner">
                                <a href="<?=$button_link; ?>" <?=$button_link_target ? 'target="_blank"' : '' ; ?>>
                                    <img src="<?=wp_get_attachment_image_url( $image, 'article-banner' ); ?>" class="banner__image">
                                </a>
                            </div>
                        <?php endif; ?>
                    <?php endif; ?>

                    <div class="article__footer">
                        <a href="<?=get_term_link( get_the_terms( get_the_ID(), 'article_category' )[0]->term_id ); ?>" class="arrow-button arrow-button--left">
                            <div class="arrow-button__icon">
                                <?=ccpt_get_icon( 'arrow-left/circle' ); ?>
                                <?=ccpt_get_icon( 'arrow-left/arrow' ); ?>
                            </div>

                            <div class="arrow-button__title"><?=__( 'Назад до категорії', 'ce-crypto' ); ?></div>
                        </a>

                        <?php
                        
                        $previous_post = get_previous_post( true, '', 'article_category' );
                        
                        if( empty( $previous_post ) ) :
                            ccpt_maybe_add_article_to_readed( get_the_ID() );

                            $test_id = ccpt_get_article_category_test( get_the_ID() );
                            $is_test_available = ccpt_get_user_course_data( 0, ccpt_get_article_category( get_the_ID() )->term_id )['progress'] === 100;
                            
                            if( $test_id ) :
                                $link = get_permalink( $test_id );
                            
                        ?>
                            <a <?=$is_test_available ? "href='{$link}'" : '' ?> class="btn btn--secondary <?=!$is_test_available ? 'btn--disabled' : ''; ?>"><?=__( 'Пройти тестування', 'ce-crypto' ); ?></a>
                        <?php

                            endif;
                        else :
                            $link = is_user_logged_in() ? add_query_arg( 'prev_article', get_the_ID(), get_permalink( $previous_post ) ) : '#modal-force-register';
                        
                        ?>
                            <a href="<?=$link; ?>" class="arrow-button arrow-button--right">
                                <div class="arrow-button__title"><?=__( 'Наступна стаття', 'ce-crypto' ); ?></div>
                                
                                <div class="arrow-button__icon">
                                    <?=ccpt_get_icon( 'arrow-right/arrow' ); ?>
                                    <?=ccpt_get_icon( 'arrow-right/circle' ); ?>
                                </div>
                            </a>
                        <?php endif; ?>
                    </div>
                </article>
            </div>
        </section>
    <?php endwhile; ?>
<?php endif; ?>

<?php

get_footer();