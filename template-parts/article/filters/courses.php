<?php

$current_url = ccpt_get_current_url();
$courses_groups = ccpt_get_courses_filter_items();

?>

<?php if( !empty( $courses_groups ) ) : ?>
    <div class="filter filter--courses">
        <div class="filter__title">
            <?=__( 'Категорії', 'ce-crypto' ); ?>
        </div>

        <div class="filter__content">
            <?php foreach( $courses_groups as $courses_group ) : ?>
                <div class="tags-group">
                    <?php foreach( $courses_group as $course ) : ?>
                        <?php

                        $course = get_term( $course, 'article_category' );
                        $link = get_term_link( $course->term_id );
                        $is_active = $course->term_id === get_queried_object_id();

                        ?>

                        <a <?=!$is_active ? "href='{$link}'" : ''; ?> class="tag <?=$is_active ? 'tag--active' : ''; ?>"><?=$course->name; ?></a>
                    <?php endforeach; ?>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
<?php endif; ?>