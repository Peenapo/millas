<article id="post-<?php the_ID(); ?>" <?php post_class( 'bw-masonry-item' ); ?>>

    <?php if( has_post_thumbnail() ): ?>
        <figure class="featured-image">
            <a href="<?php the_permalink(); ?>">
                <?php the_post_thumbnail('bw_407'); ?>
            </a>
        </figure>
    <?php endif; ?>

    <h3 class="entry-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>

</article>
