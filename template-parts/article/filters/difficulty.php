<?php

$current_url = ccpt_get_current_url();
$difficulties = ccpt_get_difficulties();
$active_filters = isset( $_GET['difficulty'] ) ? explode( ',', $_GET['difficulty'] ) : [];

?>

<?php if( !empty( $difficulties ) ) : ?>
    <div class="filter filter--difficulty">
        <div class="filter__title">
            <?=__( 'Складність', 'ce-crypto' ); ?>
        </div>

        <div class="filter__content">
            <div class="tags-group">
                <?php
                
                foreach( $difficulties as $slug => $title ) :
                    $is_active = isset( $_GET['difficulty'] ) && array_search( $slug, $active_filters ) !== false;
                    $link = ccpt_add_filter_query_params( 'difficulty', $slug, $current_url );
                    
                ?>
                    <a href="<?=$link; ?>" class="tag <?=$is_active ? 'tag--active' : ''; ?>"><?=$title; ?></a>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
<?php endif; ?>