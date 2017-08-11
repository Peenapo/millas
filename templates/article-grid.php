<?php
global $bw_k;
$post_format = get_post_format();
$classes = 'bw-masonry-item';
?>

<article id="post-<?php the_ID(); ?>" <?php post_class( $classes ); ?>>
    <div class="bw-item-inner">

        <?php if( has_post_thumbnail() ): ?>
            <figure class="featured-image">
                <a href="<?php the_permalink(); ?>">
                    <?php the_post_thumbnail( 'bw_500x750_true' ); ?>
                </a>
            </figure>
        <?php endif; ?>

        <span class="category-list">
            <?php the_category(','); ?>
        </span>

        <h3 class="entry-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
        <div class="entry-content"><?php the_excerpt(); ?></div>
        <time class="entry-date"><a href="<?php the_permalink(); ?>"><?php echo get_the_date(); ?></a></time>

    </div>
</article>
