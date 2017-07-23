<?php
/**
 * The template for displaying 404 pages (not found)
 * Learn more: https://codex.wordpress.org/Creating_an_Error_404_Page
 */

get_header(); ?>

<?php get_template_part('templates/page-header'); ?>

<div class="container bw-row">

    <div id="primary" class="content-area">
        <main id="main" class="site-main" role="main">

            <div class="bw-404">

                <?php get_search_form(); ?>

            </div>

        </main><!-- #main -->
    </div><!-- #primary -->

    <?php if( Bw::has_sidebar() ) { get_sidebar(); } ?>

</div>

<?php
get_footer();
