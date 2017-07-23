<?php
/**
 * Template Name: Portfolio Template
 */

get_header(); ?>

<?php get_template_part('templates/page-header'); ?>

<div class="container bw-row bw--masonry">

    <div id="primary" class="content-area">
        <main id="main" class="site-main" role="main">

            <?php

                $bw_page_id = get_the_ID();

                global $post;
                $output = new WP_Query(array(
                    'post_type'             => 'bw_pt_portfolio',
                    'post_status'           => 'publish',
                    'paged'                 => Bw::current_page()
                ));

                if ( $output->have_posts() ) {

                    ?><div class="bw-masonry bw-portfolio"><?php
                        while ( $output->have_posts() ): $output->the_post();
                            get_template_part( 'templates/portfolio/grid' );
                        endwhile; ?>
                    </div><?php

                    Bw::paging_nav( $output->max_num_pages );

                    wp_reset_postdata();

                }else{
                    get_template_part('templates/content/content-none');
                }

            ?>

        </main><!-- #main -->
    </div><!-- #primary -->

</div>

<?php
get_footer();
