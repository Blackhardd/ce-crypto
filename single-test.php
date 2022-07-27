<?php

get_header();

$questions = carbon_get_the_post_meta( 'questions' );
$result = ccpt_get_test_result();

do_action( 'ccpt_before_single_test' );

?>

<section id="test-<?=get_the_ID(); ?>">
    <div class="container container--narrow">
        <div class="test">
            <h1 class="test__title title"><?php the_title(); ?></h1>

            <form method="POST" class="test__form">
                <div class="test__questions">
                    <?php foreach( $questions as $question_key => $question ) : ?>
                        <?php
                        
                        $type = count( array_filter( $question['answers'], function( $answer ){ return boolval( $answer['is_correct'] ); } ) ) > 1 ? 'multiple' : 'single';
                            
                        ?>

                        <div class="test-question test-question--<?=$type; ?> <?=$result ? ( $result['result'][$question_key] === true ? 'test-question--succeeded' : 'test-question--failed' ) : ''; ?>">
                            <div class="test-question__header">
                                <div class="test-question__title"><?=$question_key + 1; ?>) <?=$question['title']; ?></div>

                                <?php if( $result ) : ?>
                                    <div class="test-question__status">
                                        <?php if( $result['result'][$question_key] === true ) : ?>
                                            <?=ccpt_get_icon( 'test/checkmark' ); ?>
                                        <?php else : ?>
                                            <?=ccpt_get_icon( 'test/cross' ); ?>
                                        <?php endif; ?>
                                    </div>
                                <?php endif; ?>
                            </div>

                            <div class="test-question__body">
                                <?php if( $question['image'] ) : ?>
                                    <img src="<?=wp_get_attachment_image_url( $question['image'], 'full' ); ?>">
                                <?php endif; ?>

                                <div class="test-question__answers">
                                    <?php foreach( $question['answers'] as $answer_key => $answer ) : ?>
                                        <div class="test-answer">
                                            <label class="checkbox">
                                                <input type="<?=$type === 'single' ? 'radio' : 'checkbox'; ?>" name="question-<?=$question_key; ?>" value="<?=$answer_key; ?>">

                                                <div class="checkbox__mark">
                                                    <?=ccpt_get_icon( 'checkbox/checkmark' ); ?>
                                                </div>

                                                <div class="checkbox__title"><?=$answer['answer']; ?></div>
                                            </label>
                                        </div>
                                    <?php endforeach; ?>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>

                <input type="hidden" name="count" value="<?=count( $questions ); ?>">
                <input type="hidden" name="answers">
                <input type="hidden" name="action" value="submit_test">
            </form>

            <div class="test__controls">
                <?php if( !$result ) : ?>
                    <div class="test-action test__action">
                        <button class="test-action__button test__submit btn btn--primary" disabled><?=__( 'Перевірити відповіді', 'ce-crypto' ); ?></button>
                    </div>
                <?php else : ?>
                    <?php if( $result['score'] < 85 ) : var_dump( ccpt_is_test_locked() ); var_dump( get_user_meta( get_current_user_id(), 'ccpt_test_status_353', true ) ); ?>
                        <?php if( !ccpt_is_test_locked() ) : ?>
                            <div class="test-action test__action">
                                <button class="test-action__button test__submit btn btn--primary" disabled><?=__( 'Пройти тест знову', 'ce-crypto' ); ?> *</button>
                                <div class="test-action__label">* <?=__( 'У вас залишилась ще одна спроба', 'ce-crypto' ); ?></div>
                            </div>
                        <?php endif; ?>

                        <div class="test-result test-result--failed">
                            <div class="test-result__info">
                                <div class="test-result__title"><?=sprintf( __( 'Ваш результат: <span>%s</span>%%', 'ce-crypto' ), $result['score'] ); ?></div>
                                <div class="test-result__subtitle"><?=sprintf( __( 'Для здачі тесту потрібно більше ніж %s%%', 'ce-crypto' ), 85 ); ?></div>
                            </div>
                    <?php else : ?>
                        <div class="test-result test-result--succeeded">
                            <div class="test-result__info">
                                <div class="test-result__title"><?=sprintf( __( 'Вітаємо, ваш результат: <span>%s</span>%%', 'ce-crypto' ), $result['score'] ); ?></div>
                                <div class="test-result__subtitle"><?=sprintf( __( 'Курс по “%s” успішно завершений!', 'ce-crypto' ), ccpt_get_test_course_name( get_the_ID() ) ); ?></div>
                            </div>
                    <?php endif; ?>
                            <div class="test-result__progress">
                                <svg width="44" height="44">
                                    <circle r="22" cx="22" cy="22" fill="#E8E8E8" stroke-width="0"></circle>
                                    <circle r="11" cx="22" cy="22" fill="none" stroke-width="22" stroke-dasharray="69" stroke-dashoffset="<?=69 / 100 * ( 100 - $result['score'] ); ?>"></circle>
                                </svg>
                            </div>
                        </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</section>

<?php

get_footer();