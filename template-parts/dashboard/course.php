<?php

$course = $args;

?>

<div class="course course--<?=$course['status']; ?>">
    <div class="course__header">
        <div class="subtitle course__title"><?=$course['name']; ?></div>

        <?php get_template_part( 'template-parts/widgets/progress-bar', null, array( 'progress' => $course['progress'] ) ); ?>
    </div>

    <div class="course__body">
        <div class="course__last-opened">
            <?php ccpt_get_article_card_template( $course['last_opened'] ); ?>
        </div>

        <div class="course__info">
            <div class="course__status-label"><?=__( 'Статус:', 'ce-crypto' ); ?></div>
            <div class="course__status"><?=ccpt_get_course_status_title( $course['status'] ); ?></div>

            <div class="course__continue">
                <?php

                $continue_link = get_term_link( $course['id'] );

                if( ccpt_is_test_locked( 0, $course['test'] ) ){
                    $continue_link = add_query_arg( 'unlock_test', true, $continue_link );
                }

                ?>
                <a href="<?=$continue_link; ?>" class="arrow-button arrow-button--right">
                    <?php if( $course['status'] === 'in-progress' ) : ?>
                        <div class="arrow-button__title"><?=__( 'Продовжити курс', 'ce-crypto' ); ?></div>
                    <?php else : ?>
                        <div class="arrow-button__title"><?=__( 'Переглянути курс', 'ce-crypto' ); ?></div>
                    <?php endif; ?>

                    <div class="arrow-button__icon">
                        <?=ccpt_get_icon( 'arrow-right/arrow' ); ?>
                        <?=ccpt_get_icon( 'arrow-right/circle' ); ?>
                    </div>
                </a>
            </div>
        </div>
    </div>
</div>