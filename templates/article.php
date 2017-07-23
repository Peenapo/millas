<article id="post-<?php the_ID(); ?>" <?php post_class( 'bw-article' ); ?>>

    <?php /*if( has_post_thumbnail() ): ?>
        <figure class="featured-image">
            <a href="<?php the_permalink(); ?>">
                <?php the_post_thumbnail('bw_407'); ?>
            </a>
        </figure>
    <?php endif;*/ ?>

    <div class="entry-meta">
        <span class="category-list">
            <?php echo get_the_category_list(''); ?>
        </span>
        <span class="post-date">
            <a href="<?php the_permalink(); ?>">
                <time class="entry-date"><?php echo get_the_date(); ?></time>
            </a>
        </span>
    </div>

    <h2 class="entry-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>

    <div class="entry-content">
        <p><?php echo get_the_excerpt(); ?></p>
    </div>

</article>
