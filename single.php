<?php
/**
 * The Template for displaying all single posts.
 * Learn more: https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 */

get_header(); ?>

<?php //get_template_part('templates/page-header'); ?>

<div class="container<?php if( Bw::has_sidebar() ) { echo ' bw-has-sidebar'; } ?>">

    <div id="primary" class="content-area">
        <main id="main" class="site-main" role="main">

        <?php
        while ( have_posts() ) : the_post();

            get_template_part( 'templates/content/content', get_post_format() );

            // if comments are open or we have at least one comment, load up the comment template.
            if ( comments_open() or get_comments_number() ) :
                comments_template();
            endif;

        endwhile;
        ?>

        </main><!-- #main -->
    </div><!-- #primary -->

    <?php if( Bw::has_sidebar() ) { get_sidebar(); } ?>

</div>

<?php
get_footer();
