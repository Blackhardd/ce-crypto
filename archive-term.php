<?php

get_header();

?>

<div class="container">
    <div class="page-header">
        <h1 class="title page-header__title"><?=__( 'Словник', 'ce-crypto' ); ?></h1>

        <div class="page-header__actions">
            <div class="sidebar-toggle">
                <button type="button" class="sidebar-toggle__button">
                    <span><?=__( 'Пошук по словнику', 'ce-crypto' ); ?></span>
                    <?=ccpt_get_icon( 'search-large' ); ?>
                </button>
            </div>
        </div>
    </div>

    <div class="page-content page-content--sidebar-right">
        <div class="page-content__main">
            <?php if( have_posts() ) : ?>
                <div class="terms-list">
                    <?php
                    
                    $current_char = '';
                    
                    while( have_posts() ) :
                        the_post();

                        if( $current_char !== ccpt_get_string_first_char( get_the_title() ) ){
                            $current_char = ccpt_get_string_first_char( get_the_title() );

                            ccpt_get_terms_separator_template( $current_char );
                        }

                        get_template_part( 'template-parts/term/item' );
                        
                    endwhile;
                    
                    ?>
                </div>

                <input type="hidden" name="current_char" value="<?=$current_char; ?>">
            <?php else : ?>
                <?php if( isset( $_GET['letter'] ) ) : ?>
                    <div class="nothing-found nothing-found--terms">
                        <div class="nothing-found__title"><?=sprintf( __( 'За літерою «%s» термінів не знайдено', 'ce-crypto' ), ccpt_get_alphabet_filter_items( true )[$_GET['letter']] ); ?></div>
                    </div>
                <?php else : ?>
                    <div class="nothing-found nothing-found--terms">
                        <div class="nothing-found__title"><?=sprintf( __( 'За запитом «%s» термінів не знайдено', 'ce-crypto' ), $_GET['search'] ); ?></div>
                    </div>
                <?php endif; ?>
            <?php endif; ?>
        </div>

        <aside class="sidebar sidebar--terms page-content__sidebar">
            <div class="sidebar__inner">
                <div class="sidebar__header">
                    <button type="button" class="sidebar__close"><?=ccpt_get_icon( 'close' ); ?></button>
                    <div class="subtitle"><?=__( 'Пошук', 'ce-crypto' ); ?></div>
                </div>

                <div class="sidebar__body">
                    <?php get_template_part( 'template-parts/term/filters/alphabet' ); ?>
                    <?php get_template_part( 'template-parts/term/filters/search' ); ?>
                </div>
                
                <div class="sidebar__footer">
                    <button type="button" class="btn btn--primary"><?=__( 'Закрити', 'ce-crypto' ); ?></button>
                </div>
            </div>
        </aside>
    </div>
</div>

<?php

get_footer();