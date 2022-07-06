<?php

$custom_logo_id = get_theme_mod( 'custom_logo' );
$logo = wp_get_attachment_image_src( $custom_logo_id , 'full' );

?>

<div class="logo header-logo">
    <?php if( is_front_page() ) : ?>
        <img src="<?=$logo[0]; ?>" width="<?=$logo[1]; ?>" height="<?=$logo[2]; ?>" alt="<?=get_bloginfo( 'name' ); ?>">
    <?php else : ?>
        <a class="logo__link" href="<?=home_url(); ?>"><img src="<?=$logo[0]; ?>" width="<?=$logo[1]; ?>" height="<?=$logo[2]; ?>" alt="<?=get_bloginfo( 'name' ); ?>"></a>
    <?php endif; ?>
</div>