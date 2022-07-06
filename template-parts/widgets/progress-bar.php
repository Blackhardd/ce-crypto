<?php

$progress = $args['progress'];

?>

<div class="progress-bar">
    <div class="progress-bar__label"><?=__( 'Прогрес', 'ce-crypto' ); ?></div>

    <div class="progress-bar__bar">
        <div data-percentage="<?=$progress; ?>" style="width: <?=$progress; ?>%"></div>
    </div>
</div>