<div class="term-item" id="term-<?=get_the_ID(); ?>">
    <div class="term-item__inner">
        <span class="term-item__title"><?php the_title(); ?></span> – <span class="term-item__description"><?php the_content(); ?></span>
    </div>

    <button class="term-item__readmore"><?=ccpt_get_icon( 'readmore' ); ?></button>
</div>