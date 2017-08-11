<?php
/**
 * The main template file.
 */

get_header(); ?>

<?php get_template_part('templates/page-header'); ?>

<div class="container bw-row">

    <div id="primary" class="content-area">
        <main id="main" class="site-main" role="main">

        <?php
            if ( have_posts() ) : ?>

                <div class="bw-masonry"><div class="bw-masonry-sizer"></div><?php
                    while ( have_posts() ) : the_post();
                        get_template_part( 'templates/article-grid' );
                        $bw_k++;
                    endwhile; ?>
                </div>

                <div class="bw-load-more" data-text-empty="<?php esc_html_e( 'No more articles', 'millas' ); ?>">
                    <div class="bw-load-more-button">
                        <span><?php next_posts_link( 'Older Entries' ); ?></span>
                        <div class="bw-pre"><div class="bw-pre-child bw-pre1"></div><div class="bw-pre-child bw-pre2"></div></div>
                    </div>
                </div><?php

            else:

                get_template_part( 'templates/content/content', 'none' );

            endif; ?>

        </main><!-- #main -->
    </div><!-- #primary -->

</div>

<?php
get_footer();
