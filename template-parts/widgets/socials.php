<?php

$socials = array(
    'telegram'          => get_theme_mod( 'telegram' ),
    'telegram_chat'     => get_theme_mod( 'telegram_chat' ),
    'instagram'         => get_theme_mod( 'instagram' ),
    'facebook'          => get_theme_mod( 'facebook' ),
    'twitter'           => get_theme_mod( 'twitter' )
);

?>

<div class="social">
    <ul class="social__list social-list">
        <?php foreach( $socials as $name => $link ) : ?>
            <li class="social-list__item">
                <a class="social-list__link" href="<?=$link; ?>"><?=ccpt_get_icon( 'socials/' . str_replace( '_', '-', $name ) ); ?></a>
            </li>
        <?php endforeach; ?>
    </ul>
</div>