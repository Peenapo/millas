<?php
global $post;
$tags = wp_get_post_tags($post->ID);

if ( $tags ) {

    $tag_ids = array();

    foreach( $tags as $individual_tag ) {
        $tag_ids[] = $individual_tag->term_id;
    }

    $args = array(
        'post_type'	=> get_post_type(),
        'category__in' => wp_get_post_categories( $post->ID ),
        'post__not_in' => array( $post->ID ),
        'posts_per_page'=> 3,
        'ignore_sticky_posts'=> true
    );

    $my_query = new WP_Query( $args );

    if( $my_query->have_posts() ) { ?>
        <div class="bw-related">
            <h3 class="bw-related-title"><?php esc_html_e('Related articles:', 'yago'); ?></h3>
            <ul>
                <?php $c = 0; while( $my_query->have_posts() ):
                    $c++;$my_query->the_post(); ?>
                    <li <?php if( $c == 3 ) { echo 'class="bw-last"'; } ?>>
                        <article>
                            <?php if( has_post_thumbnail() ): ?>
                                <div class="bw-cell bw-thumb">
                                    <div class="bw-image">
                                        <a class="bw-relative bw-star-center" href="<?php the_permalink(); ?>">
                                            <?php the_post_thumbnail('thumbnail'); ?>
                                        </a>
                                    </div>
                                </div>
                            <?php endif; ?>
                            <div class="bw-cell bw-cont">
                                <a href="<?php the_permalink(); ?>"><strong><?php the_title(); ?></strong></a>
                                <?php /* ?><p><?php echo Bw::truncate( get_the_excerpt(), 20 ); ?></p><?php */ ?>
                            </div>
                        </article>
                    </li>
                <?php endwhile; ?>
            </ul>
        </div><?php

    }else{
        echo '<p class="no-related">' . esc_html__('No related articles found.', 'yago') . '</p>';
    }
}else{

    echo '<p class="no-related">' . esc_html__('No related articles found.', 'yago') . '</p>';

}

wp_reset_postdata();
