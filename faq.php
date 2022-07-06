<?php

/**
 * Template Name: FAQ
 * 
 * @package CeCrypto
 * @since 1.0.0
 */

get_header();

?>

<section id="faq">
    <div class="container container--narrow">
        <div class="page-header page-header--faq">
            <h1 class="title page-header__title"><?php the_title(); ?></h1>
        </div>

        <?php if( $accordeon_items = carbon_get_the_post_meta( 'items' ) ) : ?>
            <div class="accordeon accordeon--faq">
                <?php foreach( $accordeon_items as $item ) : ?>
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
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
    </div>
</section>

<?php

get_footer();