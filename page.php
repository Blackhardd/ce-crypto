<?php

get_header();

if( have_posts() ) :
    while( have_posts() ) :
        the_post();

        ?>

            <div class="container container--narrow">
                <?php

                the_title( '<h1>', '</h1>' );
                the_content();

                ?>
            </div>

        <?php

    endwhile;
else :

?>

    <div class="container">
        <h2 align="center"><?=__( 'Постів не знайдено', 'ce-crypto' ); ?></h2>
    </div>

<?php

endif;

get_footer();