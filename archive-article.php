<?php

get_header();

?>

<section id="articles">
    <div class="container">
        <div class="page-header page-header--articles-archive">
            <h1 class="title page-header__title"><?=__( 'Статті', 'ce-crypto' ); ?></h1>

            <div class="page-header__actions">
                <div class="subtitle"><?=__( 'Всі статті', 'ce-crypto' ); ?></div>

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
                <div class="articles-hero">
                    <?php if( $pinned = ccpt_get_pinned_articles() ) : ?>
                        <div class="articles-hero__pinned">
                            <?php

                            foreach( $pinned as $article ) :
                                ccpt_get_article_card_template( $article );
                            endforeach;
                                
                            ?>
                        </div>
                    <?php endif; ?>

                    <?php if( $recent = ccpt_get_recent_articles( ccpt_get_pinned_article_ids(), 4 ) ) : ?>
                        <div class="recent-articles recent-articles--default articles-hero__recent">
                            <ul class="recent-articles__list">
                                <?php foreach( $recent as $article ) : ?>
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
                                <a href="#" class="arrow-button arrow-button--right">
                                    <div class="arrow-button__title"><?=__( 'Більше статей', 'ce-crypto' ); ?></div>
                                                
                                    <div class="arrow-button__icon">
                                        <?=ccpt_get_icon( 'arrow-right/arrow' ); ?>
                                        <?=ccpt_get_icon( 'arrow-right/circle' ); ?>
                                    </div>
                                </a>
                            </div>
                        </div>
                    <?php endif; ?>
                </div>
            
                <?php if( $categories = ccpt_get_article_categories() ) : ?>
                    <?php foreach( $categories as $category ) : ?>
                        <?php


                        $course_user_data = ccpt_get_user_course_data( 0, $category->term_id );
                        $most_recent_article = ccpt_get_category_most_recent_article( $category->term_id );
                        $recent_articles = ccpt_get_category_recent_articles( $category->term_id, 2, $most_recent_article->ID );

                        ?>

                        <div class="articles-category <?="articles-category--{$course_user_data['status']}"; ?>">
                            <div class="articles-category__header">
                                <div class="articles-category__title"><?=$category->name?></div>

                                <?php if( is_user_logged_in() ) : ?>
                                    <div class="articles-category__progress">
                                        <div class="progress-bar">
                                            <div class="progress-bar__label"><?=__( 'Прогрес', 'ce-crypto' ); ?></div>
                                            <div class="progress-bar__bar">
                                                <div data-percentage="<?=$course_user_data['progress']; ?>" style="width: <?=$course_user_data['progress']; ?>%"></div>
                                            </div>
                                        </div>
                                    </div>

                                    <a class="articles-category__link" href="<?=add_query_arg( array( 'begin_course' => 'true' ), get_term_link( $category->term_id ) ); ?>"><?=__( 'Обрати курс', 'ce-crypto' ); ?></a>
                                <?php endif; ?>
                            </div>

                            <div class="articles-category__body">
                                <div class="articles-category__pinned">
                                    <?php ccpt_get_article_card_template( $most_recent_article ); ?>
                                </div>

                                <?php if( $recent_articles ) : ?>
                                    <div class="recent-articles recent-articles--category articles-category__recent">
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
                                            <a href="<?=get_term_link( $category->term_id ); ?>" class="arrow-button arrow-button--right">
                                                <div class="arrow-button__title"><?=__( 'Більше статей', 'ce-crypto' ); ?></div>
                                                
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
                    <?php endforeach; ?>
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