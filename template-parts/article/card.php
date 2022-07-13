<?php

$article = $args['article'];
$size = $args['size'];

?>

<div class="article-card article-card--<?=$size; ?>">
    <?php if( $category = wp_get_post_terms( $article->ID, 'article_category' )[0] ) : ?>
        <a class="article-card__category" href="<?=get_term_link( $category->term_id, 'article_category' ); ?>"><?=$category->name; ?></a>
    <?php endif; ?>

    <a href="<?=get_permalink( $article->ID ); ?>">
        <div class="article-card__content">
            <div class="article-card__date"><?=get_the_date( 'd.m.Y', $article->ID ); ?></div>
            <div class="article-card__title"><?=$article->post_title; ?></div>

            <?php if( $size !== 'small' ) : ?>
                <div class="article-card__excerpt"><?=$article->post_excerpt . '...'; ?></div>
            <?php endif; ?>
        </div>

        <?php if( $thumbnail = get_the_post_thumbnail_url( $article->ID, "article-card-{$size}" ) ) : ?>
            <img src="<?=$thumbnail; ?>">
        <?php else : ?>
            <img src="<?=ccpt_get_image_url( 'placeholder.png' ); ?>">
        <?php endif; ?>
    </a>
</div>