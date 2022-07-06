<header class="header">
    <div class="container">
        <div class="header__inner">
            <?php get_template_part( 'template-parts/header/partials/logo' ); ?>

            <div class="header__mobile">
                <?php get_template_part( 'template-parts/header/partials/search' ); ?>

                <?php get_template_part( 'template-parts/header/partials/navigation' ); ?>

                <?php get_template_part( 'template-parts/header/partials/profile-control' ); ?>
            </div>

            <button class="burger">
                <span></span>
                <span></span>
                <span></span>
            </button>
        </div>
    </div>
</header>