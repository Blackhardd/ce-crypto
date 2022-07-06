<?php

$current_url = ccpt_get_current_url();
$tags = ccpt_get_all_article_tags();
$active_filters = isset( $_GET['theme'] ) ? explode( ',', $_GET['theme'] ) : [];

?>

<?php if( !empty( $tags ) ) : ?>
    <div class="filter filter--themes">
        <div class="filter__title">
            <?=__( 'Популярні теми', 'ce-crypto' ); ?>
        </div>

        <div class="filter__content">
            <div class="tags-group">
                <?php foreach( $tags as $theme ) : ?>
                    <?php
                    
                    $is_active = isset( $_GET['theme'] ) && array_search( $theme->term_id, $active_filters ) !== false;
                    $link = ccpt_add_filter_query_params( 'theme', $theme->term_id, $current_url );
                        
                    ?>

                    <a href="<?=$link; ?>" class="tag <?=$is_active ? 'tag--active' : ''; ?>"><?=$theme->name; ?></a>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
<?php endif; ?>