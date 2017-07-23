<?php
/**
 * Template Name: Homepage
 */

 get_header(); ?>

<!-- carousel -->
<?php

$carousel_slides = get_field('carousel_slides');
$carousel_slides_total = count( $carousel_slides );

if( $carousel_slides_total > 0 ):

    echo '<div class="bw-carousel">';

    $slide_num = 0;

    while ( have_rows('carousel_slides') ) : the_row();

        $title      = get_sub_field('carousel_title');
        $subtitle   = get_sub_field('carousel_subtitle');
        $position   = get_sub_field('title_position');
        $image      = get_sub_field('carousel_image');
        $url        = get_sub_field('carousel_url');
        $dark_image = get_sub_field('dark_image');

        echo '<article class="bw-carousel-slide' . ( $dark_image ? ' bw-call-readability' : '' ) . '"' . ( $slide_num == 0 ? ' style="z-index:1;"' : '' ) . '>';

            if( isset( $image['sizes'] ) ) {
                if( isset( $image['sizes']['bw_1920x1080_true'] ) ) {

                    echo '<figure class="featured-image">';
                    echo '<img src="' . esc_url( $image['sizes']['bw_1920x1080_true'] ) . '" alt="">';
                    echo '</figure>';
                }
            }

            switch( $position ) {
                case 'top_left':        $style = 'vertical-align:top;text-align:left'; break;
                case 'top_middle':      $style = 'vertical-align:top;text-align:center'; break;
                case 'top_right':       $style = 'vertical-align:top;text-align:right'; break;
                case 'center_left':     $style = 'vertical-align:middle;text-align:left'; break;
                case 'center_middle':   $style = 'vertical-align:middle;text-align:center'; break;
                case 'center_right':    $style = 'vertical-align:middle;text-align:right'; break;
                case 'bottom_left':     $style = 'vertical-align:bottom;text-align:left'; break;
                case 'bottom_middle':   $style = 'vertical-align:bottom;text-align:center'; break;
                case 'bottom_right':    $style = 'vertical-align:bottom;text-align:right'; break;
                default:                $style = '';
            }

            echo '<div class="bw-carousel-text bw-row bw-table">';
                echo '<div class="bw-cell" style="' . $style . '">';
                    echo '<a href="' . esc_url( $url ) . '"><p>' . esc_attr( $subtitle ) . '</p><h1>' . esc_attr( $title ) . '</h1></a>';
                echo '</div>';
            echo '</div>';

        echo '</article>';
        $slide_num++;

    endwhile;

    if( $carousel_slides_total > 1 ) {
        echo '<a href="#" class="bw-carousel-nav bw-carousel-nav-prev"><i class="bw-arrow"></i>' . esc_html__('Previous', 'italias') . '</a>';
        echo '<a href="#" class="bw-carousel-nav bw-carousel-nav-next">' . esc_html__('Next', 'italias') . '<i class="bw-arrow bw-arrow-right"></i></a>';
    }
    echo '</div>';

endif;

?><!-- end carousel -->

<div class="container bw-row-wide">

    <!-- block sections -->
    <?php

    $block_sections = get_field('block_sections');

    if( count( $block_sections ) > 0 ):

        echo '<ul class="bw-block-sections">';

        while ( have_rows('block_sections') ) : the_row();

            $title      = get_sub_field('title');
            $url        = get_sub_field('url');
            $image      = get_sub_field('image');
            $text_color = get_sub_field('text_color');
            $style = $style_h = '';
            $tag        = ! empty( $url ) ? 'a' : 'div';

            if( isset( $image['sizes'] ) ) {
                if( isset( $image['sizes']['bw_650x350_true'] ) ) {
                    $style .= 'background-image:url(' . esc_url( $image['sizes']['bw_650x350_true'] ) . ');';
                }
            }
            if( $text_color == 'white' ) {
                $style_h .= 'color:#fff;';
            }

            echo '<li class="bw-block-section">';
                echo '<figure class="bw-block-section-image" style="' . $style . '"></figure>';
                echo '<' . $tag . ( ! empty( $url ) ? ' href="' . esc_url( $url ) . '"' : '' ) . ' class="bw-block-section-inner bw-table">';
                echo '<div class="bw-cell">';
                echo '<h3 style="' . $style_h . '">' . esc_html( $title ) . '</h3>';
                echo '</div>';
                echo '</' . $tag . '>';
            echo '</li>';

        endwhile;

        echo '</ul>';

    endif;

    ?><!-- end block sections -->

    <div id="primary" class="content-area">
        <main id="main" class="site-main" role="main">

        <?php
            if ( have_posts() ) : ?>

                <header>
                    <h1 class="page-title screen-reader-text"><?php single_post_title(); ?></h1>
                </header>

                <div class="bw-masonry"><?php
                    while ( have_posts() ) : the_post();
                        the_content();
                    endwhile; ?>
                </div><?php

            else:

                get_template_part( 'templates/content/content', 'none' );

            endif; ?>

        </main><!-- #main -->
    </div><!-- #primary -->

</div>

<?php
get_footer();
