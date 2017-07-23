<?php
/**
 * The template for displaying Archive pages.
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 */

get_header(); ?>

<?php get_template_part('templates/page-header'); ?>

<div class="container bw-row bw--articles">

    <div id="primary" class="content-area">
        <main id="main" class="site-main" role="main">

        <?php if ( have_posts() ) : ?>

                <div class="bw-articles"><?php
                    while ( have_posts() ) : the_post();
                        get_template_part( 'templates/article' );
                    endwhile; ?>
                </div><?php

                Bw::pagination();

            else:

                get_template_part( 'templates/content/content', 'none' );

            endif; ?>

        </main> <!-- #main -->
    </div> <!-- #primary -->

    <?php if( Bw::has_sidebar() ) { get_sidebar(); } ?>

</div>

<?php
get_footer();
