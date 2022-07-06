<?php

get_header();

global $wp_query;

?>

<section id="articles">
    <div class="container">
        <div class="page-header page-header--articles-archive">
            <div class="breadcrumbs breadcrumbs--course page-header__breadcrumbs">
                <a href="<?=get_permalink( get_theme_mod( 'courses_page' ) ); ?>" class="breadcrumbs__link breadcrumbs__link--home"><?=__( 'Статті', 'ce-crypto' ); ?></a><h1 class="breadcrmubs__current"><?=__( 'Усі статті', 'ce-crypto' ); ?></h1>
            </div>

            <div class="page-header__actions">
                <div class="sidebar-toggle">
                    <button type="button" class="sidebar-toggle__button">
                        <span><?=__( 'Фільтр', 'ce-crypto' ); ?></span>
                        <?=ccpt_get_icon( 'filter' ); ?>
                    </button>
                </div>
            </div>
        </div>

        <div class="page-content page-content--sidebar-right">
            <div class="page-content__main">
                <?php if( have_posts() ) : ?>
                    <div class="articles-grid">
                        <?php while( have_posts() ) : ?>
                            <?php

                            the_post();
                            ccpt_get_article_card_template( get_post() );

                            ?>
                        <?php endwhile; ?>
                    </div>
                <?php else : ?>
                    <div class="nothing-found">
                        <div class="nothing-found__title"><?=__( 'Статтей не знайдено.', 'ce-crypto' ); ?></div>
                    </div>
                <?php endif; ?>

                <?php if( $wp_query->max_num_pages > 1 ) : ?>
                    <?php $current_page = isset( $_GET['page'] ) ? $_GET['page'] : 1; ?>

                    <div class="pagination">
                        <?php if( $current_page > 1 ) : ?>
                            <a href="<?=ccpt_add_pagination_query_params( $current_page - 1, $current_url ); ?>" class="arrow-button arrow-button--left pagination__prev">
                                <div class="arrow-button__icon">
                                    <?=ccpt_get_icon( 'arrow-left/circle' ); ?>
                                    <?=ccpt_get_icon( 'arrow-left/arrow' ); ?>
                                </div>
                            </a>
                        <?php endif; ?>

                        <div class="pagination__pages">
                            <?php for( $index = 1; $index <= $wp_query->max_num_pages; $index++ ) : ?>
                                <?php
                                    
                                $is_active = ( !isset( $_GET['page'] ) && $index === 1 ) || ( isset( $_GET['page'] ) && $_GET['page'] == $index );
                                $link = ccpt_add_pagination_query_params( $index, $current_url );
                                
                                ?>

                                <a <?=!$is_active ? "href='{$link}'" : ""; ?> class="pagination__link <?=$is_active ? 'pagination__link--active' : ''; ?>"><?=$index; ?></a>
                            <?php endfor; ?>
                        </div>

                        <?php if( $current_page < $query->max_num_pages ) : ?>
                            <a href="<?=ccpt_add_pagination_query_params( $current_page + 1, $current_url ); ?>" class="arrow-button arrow-button--right pagination__next">
                                <div class="arrow-button__icon">
                                    <?=ccpt_get_icon( 'arrow-right/arrow' ); ?>
                                    <?=ccpt_get_icon( 'arrow-right/circle' ); ?>
                                </div>
                            </a>
                        <?php endif; ?>
                    </div>
                <?php endif; ?>
            </div>

            <aside class="sidebar sidebar--articles page-content__sidebar">
                <div class="sidebar__inner">
                    <div class="sidebar__header">
                        <button type="button" class="sidebar__close"><?=ccpt_get_icon( 'close' ); ?></button>
                        <div class="subtitle"><?=__( 'Пошук', 'ce-crypto' ); ?></div>
                    </div>

                    <div class="sidebar__body">
                        <?php get_template_part( 'template-parts/article/filters/themes' ); ?>
                        <?php get_template_part( 'template-parts/article/filters/difficulty' ); ?>
                        <?php get_template_part( 'template-parts/article/filters/reading-time' ); ?>
                        <?php get_template_part( 'template-parts/article/filters/courses' ); ?>
                    </div>
                    
                    <div class="sidebar__footer">
                        <button type="button" class="btn btn--secondary"><?=__( 'Закрити', 'ce-crypto' ); ?></button>
                    </div>
                </div>
            </aside>
        </div>
    </div>
</section>

<?php

get_footer();