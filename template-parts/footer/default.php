<footer class="footer">
    <div class="footer__top footer-top">
        <div class="container">
            <div class="footer__inner">
                <?php get_template_part( 'template-parts/footer/partials/logo' ); ?>

                <?php get_template_part( 'template-parts/widgets/socials' ); ?>

                <?php get_template_part( 'template-parts/footer/partials/navigation' ); ?>
            </div>
        </div>
    </div>

    <div class="footer__bot footer-bot">
        <div class="container">
            <div class="footer-bot__inner">
                <div class="footer-bot__links">
                    <?php if( $link = get_privacy_policy_url() ) : ?>
                        <a class="footer-bot__link" href="<?=$link;?>"><?=__( 'Політика конфіденційності', 'ce-crypto' ); ?></a>
                    <?php endif; ?>
                </div>

                <div class="copyright"><?=sprintf( __( 'Copyright %s', 'ce-crypto' ), date( 'Y' ) ); ?></div>

                <div class="company">
                    <a class="company__link" href="https://itua.com.ua/" target="_blank" rel="noreferrer">
                        <svg width="57" height="27" fill="none"><path d="M0 6.83v5l11.57-6.87V0L0 6.83Z" fill="#7AD4D6"/><path d="M23.07 6.74 11.57 0v4.96l4.76 2.86L0 17.28v2.96l2.57 1.4 16.3-10.09v6.12l4.2 2.52V6.74Z" fill="#FFC703"/><path d="M18.87 17.67 7.38 24.45l4.2 2.52 11.49-6.74v-.03l-4.2-2.52Z" fill="#7250B4"/><path d="M34.37 8.8v10.8h-2.22V8.8h2.22ZM39.84 17.75v1.74c-1.06.36-1.94.3-2.65-.17-.7-.46-1.05-1.3-1.04-2.5V9.95h1.93l.15 1.75h1.39v1.94h-1.39v3.17c0 .44.13.74.38.9.26.14.67.15 1.23.04ZM43.35 8.8v7.25c0 .47.19.84.57 1.1.38.27.84.4 1.37.4a2.4 2.4 0 0 0 1.4-.4c.38-.26.58-.63.58-1.1V8.8h2.23v7.24c0 1.16-.42 2.07-1.24 2.72-.82.65-1.81.98-2.97.98a4.6 4.6 0 0 1-2.94-.98 3.28 3.28 0 0 1-1.23-2.72V8.8h2.23ZM50.82 17.25c0-.85.27-1.5.8-1.92.54-.44 1.2-.66 1.97-.66.47 0 .93.09 1.4.25v-.57c0-.73-.41-1.1-1.21-1.1-.29 0-.58.08-.9.22-.3.14-.56.31-.75.52l-1.02-1.11a3.65 3.65 0 0 1 4.99-.6c.6.48.9 1.17.9 2.07v4.82c-1.01.39-2 .58-2.94.58-1.07 0-1.88-.22-2.42-.66a2.26 2.26 0 0 1-.82-1.84Zm4.1.76v-1.6a2.67 2.67 0 0 0-.95-.18c-.38 0-.67.09-.87.26a.9.9 0 0 0-.29.7c0 .62.4.93 1.22.93.32 0 .62-.04.89-.1Z" fill="#45463F"/></svg>
                    </a>
                </div>
            </div>
        </div>
    </div>
</footer>