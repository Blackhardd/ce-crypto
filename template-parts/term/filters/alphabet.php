<?php

$archive_link = get_post_type_archive_link( 'term' );

?>

<div class="filter filter--alphabet">
    <div class="filter__title">
        <?=__( 'Пошук по алфавіту', 'ce-crypto' ); ?>
    </div>
    
    <div class="filter__content">
        <?php foreach( ccpt_get_alphabet_filter_items() as $filter_items ) : ?>
            <div class="tags-group">
                <?php foreach( $filter_items as $key => $letter ) : ?>
                    <?php
                        
                    $is_active = isset( $_GET['letter'] ) && intval( $_GET['letter'] ) === $key;
                    $link = '';

                    if( $_GET['letter'] == $key ){
                        $link = $archive_link;
                    }
                    else{
                        $link = add_query_arg( 'letter', $key );
                    }
                    
                    ?>

                    <a href="<?=$link; ?>" class="tag <?=$is_active ? 'tag--active' : ''; ?>"><?=$letter; ?></a>
                <?php endforeach; ?>
            </div>
        <?php endforeach; ?>
    </div>
</div>