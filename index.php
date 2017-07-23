<?php
/**
 * The main template file.
 */

get_header(); ?>

<?php get_template_part('templates/page-header'); ?>

<div class="container bw-row bw--articles">

    <div id="primary" class="content-area">
        <main id="main" class="site-main" role="main">

        <?php
            if ( have_posts() ) : ?>

                <div class="bw-articles"><?php
                    while ( have_posts() ) : the_post();
                        get_template_part( 'templates/article' );
                    endwhile; ?>
                </div>

                <?php
                //the_posts_navigation();
                //Bw::paging_nav();
                Bw::pagination();

            else:

                get_template_part( 'templates/content/content', 'none' );

            endif; ?>

        </main><!-- #main -->
    </div><!-- #primary -->

</div>

<?php
get_footer();
