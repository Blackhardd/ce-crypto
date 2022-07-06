<?php

get_header();

if( have_posts() ) :
    while( have_posts() ) :
        the_post();

        ?>
            <div class="container">
                <?php the_post_thumbnail(); ?>
                <?php the_content(); ?>
            </div>
        <?php

    endwhile;
else :

?>
    <div class="container">
        <h2 align="center"><?=__( 'Posts not found', 'ce-crypto' ); ?></h2>
    </div>
<?php

endif;

get_footer();