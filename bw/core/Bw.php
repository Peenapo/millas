<?php

/* This file is property of Peenapo Themes. You may NOT copy, or redistribute
 * it. Please see the license that came with your copy for more information.
 */

/**
 * @package    Bw
 * @category   functions
 * @author     Peenapo
 * @copyright  (c) 2014, Peenapo
 */

class Bw {

    # theme info wp_get_theme
    static $child_theme;
    static $theme;
    static $theme_prefix;

    # initiate defined modules in $startup_classes
    static function init() {

        self::get_theme_info();

        include( BW_FRAME_CORE . 'Bw_setup.php' );
        include( BW_FRAME_CORE . 'Bw_theme.php' );
        include( BW_FRAME_CORE . 'Bw_theme_ajax.php' );
        include( BW_FRAME_CORE . 'Bw_widgets.php' );
        include( BW_FRAME_CORE . 'Bw_page_builder.php' );

        if ( ! is_admin() ) {

            include( BW_FRAME_CORE . 'Bw_theme_fonts.php' );
            include( BW_FRAME_CORE . 'Bw_theme_header.php' );
            include( BW_FRAME_CORE . 'Bw_theme_footer.php' );

        }else{

            include( BW_FRAME_CORE . 'Bw_admin.php' );
            include( BW_FRAME_CORE . 'Bw_admin_ajax.php' );
            include( BW_FRAME_CORE . 'Bw_after_activation.php' );
            include( BW_FRAME_CORE . 'Bw_guide.php' );

        }
    }

    # get theme info
    static function get_theme_info() {

        // if the current theme is a child theme find the parent
		self::$child_theme = wp_get_theme();

		if ( self::$child_theme->parent() !== false ) {
			self::$theme = wp_get_theme( self::$child_theme->get_template() );
		} else {
			self::$theme = wp_get_theme();
		}

        self::$theme_prefix = self::$theme->get_template();

        // get the current theme version and define as a static variable
        define( 'BW_VERSION', self::$theme->exists() ? self::$theme->get('Version') : '1.0' );

    }

    # display navigation to next/previous set of posts when applicable
    static function paging_nav( $max_num_pages = false ) {

        $max_num_pages = $max_num_pages == false ? $GLOBALS['wp_query']->max_num_pages : $max_num_pages;

        # Don't print empty markup if there's only one page
        if ( $max_num_pages < 2 ) { return; }
        ?>

        <nav class="bw-post-navigation">
            <div class="nav-posts-holder">
                <div class="nav-posts">

                    <div class="nav-previous<?php echo ! get_next_posts_link( '', $max_num_pages ) ? ' bw-nav-empty' : ''; ?>">
                        <?php if ( get_next_posts_link( '', $max_num_pages ) ) : ?>
                            <?php next_posts_link( esc_html__( 'Previous', 'yago' ), $max_num_pages ); ?>
                        <?php else: ?>
                            <?php esc_html_e( 'Previous', 'yago' ); ?>
                        <?php endif; ?>
                    </div>

                    <div class="nav-next<?php echo ! get_previous_posts_link() ? ' bw-nav-empty' : ''; ?>">
                        <?php if ( get_previous_posts_link() ) : ?>
                            <?php previous_posts_link( esc_html__( 'Next', 'yago' ) ); ?>
                        <?php else: ?>
                            <?php esc_html_e( 'Next', 'yago' ); ?>
                        <?php endif; ?>
                    </div>

                </div>
            </div>
        </nav><?php
    }

    # get the current page
    static function current_page() {

        if( $bw_page = get_query_var( 'page' ) ) {
            return $bw_page;
        }elseif( $bw_paged = get_query_var( 'paged' ) ) {
            return $bw_paged;
        }
        return 1;
    }

    # display numeric pagination
    static function pagination( $pages = '', $range = 4, $show_map = false ) {

        $showitems = ( $range * 2 ) + 1;

        $paged = Bw::current_page();

        if( $pages == '' ) {
            global $wp_query;
            $pages = $wp_query->max_num_pages;
            if( ! $pages ) { $pages = 1; }
        }

        if( $pages !== 1 ) {

            echo "<div class='bw-pagination'>";

            if( $show_map ) {
                echo "<span>Page {$paged} of {$pages}</span>";
            }

            if( $paged > 1 ) { echo "<a class='bw-pag bw-pag-prev' href='" . get_pagenum_link($paged - 1) . "'>&larr; " . esc_html__('Previous Page', 'yago') . "</a>"; }
            if( $paged > 2 && $paged > $range+1 && $showitems < $pages ) { echo "<a href='".get_pagenum_link(1)."'>1</a><span>...</span>"; }

            for ( $i=1; $i <= $pages; $i++ ) {
                if ( $pages !== 1  && ( !( $i >= $paged+$range+1 || $i <= $paged-$range-1 ) || $pages <= $showitems ) ) {
                    echo ($paged == $i)? "<span class='current'>{$i}</span>":"<a href='" . get_pagenum_link($i) . "' class='inactive'>{$i}</a>";
                }
            }

            if( $paged < $pages-1 &&  $paged + $range-1 < $pages && $showitems < $pages ) { echo "<span>...</span><a href='" . get_pagenum_link( $pages ) . "'>" . $pages . "</a>"; }
            if( $paged < $pages ) {
                $preloader = '<div class="bw-pre"><div class="bw-pre-child bw-pre1"></div><div class="bw-pre-child bw-pre2"></div></div>';
                echo "<a class='bw-pag bw-pag-next' href='" . add_query_arg( 'nodjax', 'true', get_pagenum_link( $paged + 1 ) ) . "'><i class='bw-arrow'></i>" . $preloader . esc_html__('Load older articles', 'yago') . "</a>";
            }
            if( $paged == $pages and $paged > 1 ) {
                echo '<span class="bw-pag-no">' . esc_html__('No more articles', 'yago') . '</span>';
            }

            echo "</div>";
        }
    }

    # display navigation to next/previous post when applicable.
    static function post_nav() {

        # Don't print empty markup if there's nowhere to navigate.
        $previous = ( is_attachment() ) ? get_post( get_post()->post_parent ) : get_adjacent_post( false, '', true );
        $next = get_adjacent_post( false, '', false );

        if ( ! $next && ! $previous ) { return; } ?>

        <div class="nav-links-holder">
            <nav class="navigation post-navigation">
                <h1 class="screen-reader-text"><?php esc_html_e( 'Post navigation', 'yago' ); ?></h1>
                <div class="nav-links">
                    <?php
                        previous_post_link( '<div class="nav-previous">%link</div>', _x( '<span class="meta-nav">&larr;</span> %title', 'Previous post link', 'yago' ) );
                        next_post_link( '<div class="nav-next">%link</div>', _x( '%title <span class="meta-nav">&rarr;</span>', 'Next post link', 'yago' ) );
                    ?>
                </div>
            </nav>
        </div><?php
    }

    # logo html
    static function logo( $option_logo = '_general_logo_img' ) {

        $retina_img = Bw::get_option( Bw::$theme_prefix . $option_logo );

        if( ! empty( $retina_img ) ) {

            // get image width and height
            $image_id = self::get_image_id_by_src( $retina_img );
            $obj_image = wp_get_attachment_image_src( $image_id, 'original' );
            $image_width = 0;
            $image_height = 0;

            if( isset( $obj_image[1] ) ) {
                $image_width = intval($obj_image[1] * .5 );
            }
            if( isset( $obj_image[2] ) ) {
                $image_height = intval( $obj_image[2] * .5 );
            }

            if( $image_width > 0 && $image_height > 0 ) {
                echo '<a class="bw-blog-name" href="' . esc_url( home_url( '/' ) ) . '" rel="home">';
                echo '<img width="' . $image_width . '" height="' . $image_height . '" src="' . esc_url( $retina_img ) . '" alt="' . get_bloginfo( 'name' ) . '" />';
                echo '</a>';
            }

        }else{

            $tag = is_front_page() ? 'h1' : 'p';
            echo '<' . $tag . ' class="site-title"><a class="bw-blog-name" href="' . esc_url( home_url( '/' ) ) . '" rel="home">' . get_bloginfo( 'name' ) . '</a></' . $tag . '>';

        }
    }

    # logo html for mobile
    static function logo_mobile() {

        $custom_logo = get_custom_logo();

        if( function_exists('get_custom_logo') and ! empty( $custom_logo ) ) {
            echo $custom_logo;
        }else{
            echo '<a href="' . esc_url( home_url( '/' ) ) . '">' . get_bloginfo( 'name' ) . '</a>';
        }
    }

    # generate page title
    static function page_title() {
        return ! is_front_page() ? the_title() : bloginfo('name');
    }

    # returns option
    static function get_option( $meta_key, $default = '' ) {
        return get_option( $meta_key, $default );
    }

    # returns prefixed option
    static function get_theme_option( $meta_key, $default = '' ) {
        return get_option( Bw::$theme_prefix . '_' . $meta_key, $default );
    }

    # returns custom meta box
    static function get_meta( $meta_key, $post_id = 0, $single = true ) {
        return get_post_meta( ( ( (int)$post_id > 0 ) ? $post_id : get_the_ID() ), $meta_key, $single );
    }

	/**
	 * Helper function to return decoded strings
	 *
	 * @return    string
	 *
	 * @access    public
	 * @since     2.0.13
	*/
	static function ot_decode( $value ) {

		$func = 'base' . '64' . '_decode';
		return $func( $value );

	}

    # generates a list of social icons
    static function go_social() {
        global $bw_social_arr;
        $social_icons = Bw::get_option('social_icons');
        if( is_array( $social_icons ) ) {
            $output = '<ul class="bw-social">';
            foreach( $social_icons as $id => $url ) {
                if( ! empty( $url ) ) {
                    $output .= '<li><a class="bw-icon-' . esc_attr( $id ) . '" href="' . esc_url( $url ) . '" target="_blank"></a></li>';
                }
            }
            $output .= '</ul>';
            echo $output;
        }
    }

    static function the_breadcrumb() {

        echo '<nav class="bw-breadcrumb" itemprop="breadcrumb">';

        if ( ! is_home() ) {
    		echo '<li><a href="' . home_url() . '">' . esc_html__('Home', 'yago') . '</a></li>';
    		if ( is_category() || is_single() ) {
    			echo '<li>';
    			the_category(' </li><li> ');
    			if ( is_single() ) {
    				echo "</li><li>" . get_the_title() . '</li>';
    			}
    		} elseif ( is_page() ) {
    			echo '<li>' . get_the_title() . '</li>';
    		}
    	}
    	elseif ( is_tag() ) { single_tag_title(); }
    	elseif ( is_day() ) { echo '<li>' . esc_html__('Archive for ', 'yago'); the_time('F jS, Y'); echo '</li>'; }
    	elseif ( is_month() ) { echo '<li>' . esc_html__('Archive for ', 'yago'); the_time('F, Y'); echo '</li>'; }
    	elseif ( is_year() ) { echo '<li>' . esc_html__('Archive for ', 'yago'); the_time('Y'); echo '</li>'; }
    	elseif ( is_author() ) { echo '<li>' . esc_html__('Author Archive', 'yago') . '</li>'; }
    	elseif ( isset($_GET['paged'] ) && !empty( $_GET['paged'] ) ) { echo '<li>' . esc_html__('Blog Archives', 'yago'); echo '</li>'; }
    	elseif ( is_search() ) { echo '<li>' . esc_html__('Search Results', 'yago') . '</li>'; }

        echo '</nav>';

    }

    # returns array with image info based on string of ids
    static function gallerize_by_id($ids, $size = 'thumbnail', $icon = false) {

        $ids_array = array_filter(explode(',', $ids));
        $output = array();

        if( !empty($ids_array) ) {
            foreach($ids_array as $id) {
                $info = get_post($id);
                if(is_object($info)) {
                    $output[] = array(
                        'id' => $id,
                        'permalink' => get_permalink( $info->ID ),
                        'title' => $info->post_title,
                        'caption' => $info->post_excerpt,
                        'alt' => get_post_meta( $id, '_wp_attachment_image_alt', true ),
                        'info' => $info->post_content,
                        'thumb' => wp_get_attachment_image_src( $id, $size, $icon ),
                    );
                }
            }
        }
        return $output;
    }

    # native wp truncate string
    static function truncate( $text, $num_words = 55, $more = null ) {
        return wp_trim_words( $text, $num_words, $more );
    }

    # returns empty img or placeholder
    static function empty_img( $size = false ) {
        return BW_URI_ASSETS . 'img/empty/' . ( $size ? $size : 'pixel' ) . '.png';
    }

    # returns featured image src
    static function get_image_src( $size = 'thumbnail', $id = 0 ) {
        $id = ( $id == 0 ) ? get_the_ID() : $id;
        $thumb_id = get_post_thumbnail_id( $id );
        $thumb_img = wp_get_attachment_image_src( $thumb_id, $size );
        if( isset( $thumb_img[0] ) ) {
            return $thumb_img[0];
        }
        return;
    }

    static function get_image_attachment( $size = 'thumbnail', $id ) {
        $img_data = wp_get_attachment_image_src( $id, $size );
        return $img_data[0];
    }

    static function get_image_data( $size = 'thumbnail', $id ) {
        return wp_get_attachment_image_src( $id, $size );
    }

    static function avatar( $size = 96, $id = false ) {
        if( ! $id ) {
            global $current_user;
            $current_user = wp_get_current_user();
            $id = $current_user->ID;
        }
        $user_avatar = get_the_author_meta( 'bw_avatar' , $id );
        if( ! empty( $user_avatar ) ) {
            return '<img class="" src="' .  esc_url( $user_avatar ) . '" alt="">';
        }else{
            return get_avatar( $id, $size );
        }
    }

    static function bwpb_active() {
        return class_exists( 'Bwpb' ) and Bwpb::bw_check_status();
    }

    static function has_sidebar() {
        $page_layout = Bw::get_meta('page_layout');
        if( self::bwpb_active() ) { return; }
        return $page_layout == 'sidebar';
    }

    static function container_class( $class = '' ) {
        $output = $class;
        if( self::bwpb_active() ) {
            return;
        }else{
            $output = ' bw-row';
            $page_layout = Bw::get_meta('page_layout');
            if( $page_layout == 'sidebar' ) { $output .= ' bw-has-sidebar'; }
        }
        return $output;
    }

    static function get_image_id_by_src( $image_url ) {

        global $wpdb;

        $prefix = $wpdb->prefix;
    	$attachment = $wpdb->get_col( $wpdb->prepare("SELECT ID FROM " . $prefix . "posts" . " WHERE guid='%s';", $image_url ) );

        if( isset( $attachment[0] ) ) {
        	return $attachment[0];
        }

        return '';

    }

}
