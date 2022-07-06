<?php

$current_url = ccpt_get_current_url();
$difficulties = ccpt_get_all_article_difficulties();
$active_filters = isset( $_GET['difficulty'] ) ? explode( ',', $_GET['difficulty'] ) : [];

?>

<?php if( !empty( $difficulties ) ) : ?>
    <div class="filter filter--difficulty">
        <div class="filter__title">
            <?=__( 'Складність', 'ce-crypto' ); ?>
        </div>

        <div class="filter__content">
            <div class="tags-group">
                <?php foreach( $difficulties as $difficulty ) : ?>
                    <?php
                    
                    $is_active = isset( $_GET['difficulty'] ) && array_search( $difficulty->term_id, $active_filters ) !== false;
                    $link = ccpt_add_filter_query_params( 'difficulty', $difficulty->term_id, $current_url );
                        
                    ?>

                    <a href="<?=$link; ?>" class="tag <?=$is_active ? 'tag--active' : ''; ?>"><?=$difficulty->name; ?></a>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
<?php endif; ?>