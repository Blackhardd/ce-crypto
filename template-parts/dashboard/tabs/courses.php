<?php

$courses = ccpt_get_current_user_courses_data();

?>

<div class="subtitle dashboard-title__title"><?=__( 'Мої курси', 'ce-crypto' ); ?></div>

<div class="my-courses <?=!$courses ? 'my-courses--empty' : ''; ?>">
    <?php if( $courses ) : ?>
        <?php foreach( $courses as $id => $course ) : ?>
            <?php get_template_part( 'template-parts/dashboard/course', null, $course ); ?>
        <?php endforeach; ?>
    <?php else : ?>
        <?=__( 'Ви ще не почали жодного курсу.', 'ce-crypto' ); ?>
    <?php endif; ?>
</div>