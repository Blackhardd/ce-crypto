<?php

/**
 * Template Name: Особистий Кабінет
 * 
 * @package CeCrypto
 * @since 1.0.0
 */

get_header();

?>

<section id="dashboard">
    <div class="container">
        <div class="page-header">
            <h1 class="title page-header__title"><?php the_title(); ?></h1>
        </div>

        <div class="page-content">
            <div class="page-content__main">
                <div class="dashboard">
                    <div class="dashboard__tabs">
                        <div class="dashboard-tab dashboard-tab--active dashboard__tab" data-tab="courses">
                            <?php get_template_part( 'template-parts/dashboard/tabs/courses' ); ?>
                        </div>
                        
                        <div class="dashboard-tab dashboard__tab" data-tab="profile">
                            <div class="subtitle dashboard-tab__title"><?=__( 'Профіль', 'ce-crypto' ); ?></div>
                            <?php get_template_part( 'template-parts/dashboard/tabs/profile' ); ?>
                        </div>

                        <div class="dashboard-tab dashboard__tab" data-tab="settings">
                            <div class="subtitle dashboard-tab__title"><?=__( 'Налаштування', 'ce-crypto' ); ?></div>
                            <?php get_template_part( 'template-parts/dashboard/tabs/settings' ); ?>
                        </div>
                    </div>

                    <div class="dashboard__nav">
                        <div class="dashboard__profile">
                            <?php if( $avatar = ccpt_get_current_user_avatar() ) : ?>
                                <?=wp_get_attachment_image( $avatar, 'thumbnail', false, array( 'class' => 'dashboard__avatar' ) ); ?>
                            <?php else : ?>
                                <?php ccpt_get_icon( 'dashboard/avatar-placeholder' ); ?>
                            <?php endif; ?>

                            <div class="dashboard__name"><?=ccpt_get_current_user_fullname(); ?></div>
                            <div class="dashboard__username"><?=ccpt_get_current_user_username(); ?></div>
                        </div>

                        <ul class="dashboard-menu dashboard__menu">
                            <li class="dashboard-menu-item dashboard-menu-item--active dashboard-menu__item">
                                <a href="#courses" class="dashboard-menu-item__link" data-tab="courses">
                                    <?=ccpt_get_icon( 'dashboard/courses' ); ?>
                                    <span class="dashboard-menu-item__title"><?=__( 'Обрані курси', 'ce-crypto' ); ?></span>
                                </a>
                            </li>

                            <li class="dashboard-menu-item dashboard-menu__item">
                                <a href="#profile" class="dashboard-menu-item__link" data-tab="profile">
                                    <?=ccpt_get_icon( 'dashboard/profile' ); ?>
                                    <span><?=__( 'Профіль', 'ce-crypto' ); ?></span>
                                </a>
                            </li>

                            <li class="dashboard-menu-item dashboard-menu__item">
                                <a href="#settings" class="dashboard-menu-item__link" data-tab="settings">
                                    <?=ccpt_get_icon( 'dashboard/settings' ); ?>
                                    <span><?=__( 'Налаштування', 'ce-crypto' ); ?></span>
                                </a>
                            </li>

                            <li class="dashboard-menu-item dashboard-menu__item">
                                <a href="<?=wp_logout_url( home_url() ); ?>" class="dashboard-menu-item__link">
                                    <?=ccpt_get_icon( 'dashboard/logout' ); ?>
                                    <span><?=__( 'Вийти', 'ce-crypto' ); ?></span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?php

get_footer();