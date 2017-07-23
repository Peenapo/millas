<?php if( ! Bw::get_meta('hide_title') ): ?>
    <?php $page_404 = is_404(); ?>
    <?php $sub_title = Bw::get_meta('sub_title'); ?>
    <?php
    if( is_single() or is_page() ) {
        $cover_image = Bw::get_image_src( 'bw_1920x1080_true', get_the_ID() );
    }else{
        $cover_image = Bw::get_theme_option( 'general_cover_image' );
    }
    if( $page_404 ) {
        $general_cover_404_image = Bw::get_theme_option( 'general_cover_404_image' );
        if( ! empty( $general_cover_404_image ) ) {
            $cover_image = $general_cover_404_image;
        }
    }
    ?>
    <div class="bw-page-header">
        <?php
            if( ! empty( $cover_image ) ) {
                echo '<div class="bw-cover-image" style="background-image:url(' . esc_url( $cover_image ) . ');"></div>';
            }
        ?>
        <div class="bw-page-header-inner">
            <div class="bw-row">

                <?php $custom_title = Bw::get_meta('custom_page_title'); ?>
                <?php if( function_exists('is_shop') and is_shop() ) { $custom_title = esc_html__('Shop', 'yago'); } ?>
                <?php $title = get_the_title(); ?>
                <?php if( is_front_page() and is_home() ) { $title = Bw::get_theme_option('general_cover_home_title'); } ?>
                <?php if( is_search() ) { $title = esc_html__('Results for: ', 'yago') . esc_html( get_search_query( false ) ); } ?>
                <?php if( is_archive() ) { $title = get_the_archive_title(); } ?>
                <?php if( $page_404 ) { $title = esc_html__('404, Sorry, nothing was found here..', 'yago'); } ?>
                <h1 class="bw-page-header-title"><?php echo ! empty( $custom_title ) ? $custom_title : $title; ?></h1>

                <?php if( ! empty( $sub_title ) ) { echo '<p>' . esc_html( $sub_title ) . '</p>'; } ?>
                <?php if( is_archive() ) { echo '<p>' . get_the_archive_description() . '</p>'; } ?>
                <?php if( is_front_page() and is_home() ) { echo '<p class="bw-blog-description">' . get_bloginfo( 'description' ) . '</p>'; } ?>
                <?php if( is_single() ) : ?>
                    <div class="entry-meta">
                        <?php if( Bw::get_theme_option('blog_cats') ): ?>
                            <span class="category-list">
                                <?php echo get_the_category_list(''); ?>
                            </span>
                        <?php endif; ?>
                        <span class="post-date">
                            <a href="<?php the_permalink(); ?>">
                                <time class="entry-date"><?php echo get_the_date(); ?></time>
                            </a>
                        </span>
                    </div>
                    <?php echo previous_post_link('<strong class="bw-navi bw-navi-prev" href="">%link</strong>', '<i class="bw-arrow" data-title="%title"></i></a>'); ?>
                    <?php echo next_post_link('<strong class="bw-navi bw-navi-next" href="">%link</strong>', '<i class="bw-arrow" data-title="%title"></i></a>'); ?>
                    <!--a href="#" class="bw-navi bw-navi-prev"><i class="bw-arrow"></i></span>
                    <a href="#" class="bw-navi bw-navi-next"><i class="bw-arrow"></i></span-->
                <?php endif; ?>
            </div>
        </div>
    </div>
<?php endif; ?>
