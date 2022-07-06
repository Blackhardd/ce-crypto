<?php

wp_enqueue_style( 'noui-slider' );
wp_enqueue_script( 'filter-reading-time' );

?>

<div class="filter filter--reading-time">
    <div class="filter__title">
        <?=__( 'Час читання', 'ce-crypto' ); ?>
    </div>

    <div class="filter__body">
        <div class="slider">
            <div class="slider__pips">
                <div class="pip">
                    <div class="pip__label">0 хв</div>
                </div>

                <div class="pip">
                    <div class="pip__label">15 хв</div>
                </div>

                <div class="pip">
                    <div class="pip__label">30 хв</div>
                </div>
            </div>

            <div class="slider__slider"></div>
        </div>
    </div>
</div>