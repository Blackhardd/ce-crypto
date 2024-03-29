<?php

get_header();

do_action( 'ccpt_before_articles_category' );

$current_url = ccpt_get_current_url();
$query = ccpt_get_articles_category_query();

?>

<section id="articles-category">
    <div class="container">
        <div class="page-header page-header--course">
            <div class="breadcrumbs breadcrumbs--course page-header__breadcrumbs">
                <a href="<?=get_permalink( get_theme_mod( 'courses_page' ) ); ?>" class="breadcrumbs__link breadcrumbs__link--home"><?=__( 'Статті', 'ce-crypto' ); ?></a><h1 class="breadcrmubs__current"><?php single_term_title(); ?></h1>
            </div>

            <div class="page-header__actions">
                <div class="order-select">
                    <button type="button" class="order-select__button order-select__button--desktop">
                        <span><?=isset( $_GET['order'] ) ? __( 'За датою', 'ce-crypto' ) : __( 'За послідовністю', 'ce-crypto' ); ?></span>
                        <?=ccpt_get_icon( 'sort' ); ?>
                    </button>

                    <button type="button" class="order-select__button order-select__button--mobile">
                        <span><?=__( 'Сортувати', 'ce-crypto' ); ?></span>
                        <?=ccpt_get_icon( 'sort' ); ?>
                    </button>

                    <div class="order-select__options">
                        <a href="<?=remove_query_arg( 'order' ); ?>" class="order-select__option"><?=__( 'За послідовністю', 'ce-crypto' ); ?></a>
                        <a href="<?=add_query_arg( 'order', 'DESC' ); ?>" class="order-select__option"><?=__( 'За датою', 'ce-crypto' ); ?></a>
                    </div>
                </div>

                <div class="sidebar-toggle page-header__sidebar-toggle">
                    <button type="button" class="sidebar-toggle__button">
                        <span><?=__( 'Фільтр', 'ce-crypto' ); ?></span>
                        <?=ccpt_get_icon( 'filter' ); ?>
                    </button>
                </div>
            </div>
        </div>

        <div class="page-content page-content--sidebar-right">
            <div class="page-content__main">
                <?php if( $query->have_posts() ) : ?>
                    <div class="articles-grid">
                        <?php while( $query->have_posts() ) : ?>
                            <?php

                            $query->the_post();
                            ccpt_get_article_card_template( get_post() );

                            ?>
                        <?php endwhile; ?>
                    </div>
                <?php else : ?>
                    <div class="nothing-found">
                        <div class="nothing-found__title"><?=__( 'Статтей не знайдено.', 'ce-crypto' ); ?></div>
                    </div>
                <?php endif; ?>

                <?php if( $query->max_num_pages > 1 ) : ?>
                    <?php $current_page = max( 1, get_query_var( 'paged' ) ); ?>

                    <div class="pagination">
                        <?php if( $current_page > 1 ) : ?>
                            <a href="<?=get_pagenum_link( $current_page - 1 ); ?>" class="arrow-button arrow-button--left pagination__prev">
                                <div class="arrow-button__icon">
                                    <?=ccpt_get_icon( 'arrow-left/circle' ); ?>
                                    <?=ccpt_get_icon( 'arrow-left/arrow' ); ?>
                                </div>
                            </a>
                        <?php endif; ?>

                        <div class="pagination__pages">
                            <?php for( $index = 1; $index <= $query->max_num_pages; $index++ ) : ?>
                                <?php
                                    
                                $is_active = $current_page == $index;
                                $link = get_pagenum_link( $index );
                                
                                ?>

                                <a <?=!$is_active ? "href='{$link}'" : ""; ?> class="pagination__link <?=$is_active ? 'pagination__link--active' : ''; ?>"><?=$index; ?></a>
                            <?php endfor; ?>
                        </div>

                        <?php if( $current_page < $query->max_num_pages ) : ?>
                            <a href="<?=get_pagenum_link( $current_page + 1 ); ?>" class="arrow-button arrow-button--right pagination__next">
                                <div class="arrow-button__icon">
                                    <?=ccpt_get_icon( 'arrow-right/arrow' ); ?>
                                    <?=ccpt_get_icon( 'arrow-right/circle' ); ?>
                                </div>
                            </a>
                        <?php endif; ?>
                    </div>
                <?php endif; ?>

                <?php wp_reset_postdata(); ?>
            </div>

            <aside class="sidebar sidebar--article-category page-content__sidebar">
                <div class="sidebar__inner">
                    <div class="sidebar__header">
                        <button type="button" class="sidebar__close"><?=ccpt_get_icon( 'close' ); ?></button>
                        <div class="subtitle"><?=__( 'Фільтр', 'ce-crypto' ); ?></div>
                    </div>

                    <div class="sidebar__body">
                        <?php get_template_part( 'template-parts/article/filters/themes' ); ?>
                        <?php get_template_part( 'template-parts/article/filters/difficulty' ); ?>
                        <?php get_template_part( 'template-parts/article/filters/reading-time' ); ?>
                        <?php get_template_part( 'template-parts/article/filters/courses' ); ?>
                    </div>

                    <div class="sidebar__footer">
                        <button type="button" class="btn btn--primary"><?=__( 'Закрити', 'ce-crypto' ); ?></button>
                    </div>
                </div>
            </aside>
        </div>
    </div>
</section>

<?php

get_footer();