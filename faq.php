<?php

/**
 * Template Name: FAQ
 * 
 * @package CeCrypto
 * @since 1.0.0
 */

get_header();

$current_url = ccpt_get_current_url();

$posts_per_page = carbon_get_the_post_meta( 'items_per_page' );
$items = carbon_get_the_post_meta( 'items' );

$current_page = isset( $_GET['offset'] ) ? $_GET['offset'] : 1;
$max_num_pages = intval( ceil( count( $items ) / $posts_per_page ) );

?>

<section id="faq">
    <div class="container container--narrow">
        <div class="page-header page-header--faq">
            <h1 class="title page-header__title"><?php the_title(); ?></h1>
        </div>

        <?php if( $items ) : ?>
            <div class="accordeon accordeon--faq">
                <?php foreach( $items as $index => $item ) : ?>
                    <?php if( ( $max_num_pages > 1 && $index >= $current_page * $posts_per_page - $posts_per_page && $index < $current_page * $posts_per_page ) || $max_num_pages === 1 ) : ?>
                        <div class="accordeon-item accordeon-item--faq">
                            <div class="accordeon-item__header">
                                <div class="accordeon-item__title"><?=$item['title']; ?></div>

                                <div class="accordeon-item__icon"></div>
                            </div>

                            <div class="accordeon-item__body">
                                <div class="accordeon-item__content">
                                    <?=wpautop( $item['description'] ); ?>
                                </div>
                            </div>
                        </div>
                    <?php endif; ?>
                <?php endforeach; ?>
            </div>

            <?php if( count( $items ) > $posts_per_page ) : ?>
                <div class="pagination">
                        <?php if( $current_page > 1 ) : ?>
                            <a href="<?=ccpt_add_pagination_query_params( $current_page - 1, $current_url, 'offset' ); ?>" class="arrow-button arrow-button--left pagination__prev">
                                <div class="arrow-button__icon">
                                    <?=ccpt_get_icon( 'arrow-left/circle' ); ?>
                                    <?=ccpt_get_icon( 'arrow-left/arrow' ); ?>
                                </div>
                            </a>
                        <?php endif; ?>

                        <div class="pagination__pages">
                            <?php for( $index = 1; $index <= $max_num_pages; $index++ ) : ?>
                                <?php
                                    
                                $is_active = ( !isset( $_GET['offset'] ) && $index === 1 ) || ( isset( $_GET['offset'] ) && $_GET['offset'] == $index );
                                $link = ccpt_add_pagination_query_params( $index, $current_url, 'offset' );
                                
                                ?>

                                <a <?=!$is_active ? "href='{$link}'" : ""; ?> class="pagination__link <?=$is_active ? 'pagination__link--active' : ''; ?>"><?=$index; ?></a>
                            <?php endfor; ?>
                        </div>

                        <?php if( $current_page < $max_num_pages ) : ?>
                            <a href="<?=ccpt_add_pagination_query_params( $current_page + 1, $current_url, 'offset' ); ?>" class="arrow-button arrow-button--right pagination__next">
                                <div class="arrow-button__icon">
                                    <?=ccpt_get_icon( 'arrow-right/arrow' ); ?>
                                    <?=ccpt_get_icon( 'arrow-right/circle' ); ?>
                                </div>
                            </a>
                        <?php endif; ?>
                    </div>
            <?php endif; ?>
        <?php endif; ?>
    </div>
</section>

<?php

get_footer();