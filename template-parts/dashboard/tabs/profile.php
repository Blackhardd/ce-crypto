<?php

$profile = ccpt_get_current_user_profile();

?>

<div class="profile">
    <?php if( $profile['avatar'] ) : ?>
        <?=wp_get_attachment_image( $profile['avatar'], 'thumbnail', false, array( 'class' => 'profile__avatar' ) ); ?>
    <?php else : ?>
        <?=ccpt_get_avatar_placeholder_image( ['profile__avatar'] ); ?>
    <?php endif; ?>

    <div class="profile__info">
        <div class="profile__header">
            <div class="profile__name"><?=$profile['full_name']; ?></div>
            <div class="profile__username"><?=$profile['username']; ?></div>
        </div>

        <?php $tests = ccpt_get_user_tests(); ?>
        <div class="profile-achievments <?=empty( $tests ) ? 'profile-achievments--empty' : ''; ?> profile__achievments">
            <div class="profile-achievments__title"><?=__( 'Мої досягнення:', 'ce-crypto' ); ?></div>

            <div class="profile-achievments__items">
                <?php if( empty( $tests ) ) : ?>
                    <?=__( 'У вас поки немає досягнень.', 'ce-crypto' ); ?>
                <?php else : ?>
                    <?php foreach( $tests as $test ) : ?>
                        <?php $result = ccpt_get_test_result( 0, $test ); ?>

                        <div class="achievment">
                            <div class="achievment__title"><?=$result['course']; ?></div>

                            <div class="achievment__result">
                                <div class="achievment__percent"><?=sprintf( __( 'Результат: %s%%', 'ce-crypto' ), $result['score'] ); ?></div>
                                <div class="achievment__progress">
                                    <?=ccpt_get_progress_circle_template( $result['score'] ); ?>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>