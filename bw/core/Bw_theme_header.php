<?php

class Bw_theme_header {

    static $inline_css = '';

    static function init() {
        # assign header settings
        add_action( 'wp_head', array( 'Bw_theme_header', 'wp_head' ) );
        # run at the very start of the "get_header" function call
        add_action( 'get_header', array( 'Bw_theme_header', 'inline_styles' ) );
        # enqueue additional styles
        add_action( 'wp_enqueue_scripts', array( 'Bw_theme_header', 'wp_enqueue_scripts' ), 11 );
		# custom body classes
		add_filter( 'body_class', array( 'Bw_theme_header', 'custom_body_class' ) );
    }

    static function add_css( $css ) {
        self::$inline_css .= $css;
    }

    static function wp_head() {

        self::fav_icon();
        self::load_custom_js_header();

    }

    static function inline_styles() {
        self::add_css('.site-content {margin-top:' . (int) Bw::get_theme_option( 'fonts_navigation_height', 100 ) . 'px;}');
        if( is_admin_bar_showing() ) {
            self::add_css("
                .site-header {top:32px;}
                @media screen and ( max-width: 782px ) {
                    .site-header {top:46px;}
                }
            ");
        }
    }

    static function custom_body_class( $classes ) {

        $classes[] = wp_is_mobile() ? 'bw-is-mobile' : 'bw-is-desktop';
        if( is_front_page() or is_home() ) { $classes[] = 'bw-homepage'; }
        if( Bw::bwpb_active() ) { $classes[] = 'bwpb-is-active'; }

        if( is_page_template('page-homepage.php') and have_rows('carousel_slides') ) { $classes[] = 'bw-is-carousel'; }

		return $classes;

    }

    static function fav_icon() {

        // if the `wp_site_icon` function does not exist (ie we're on < WP 4.3)
        if ( ! function_exists( 'wp_site_icon' ) ) { // show the user your favicon theme option
            self::get_fav_icon();
        }else { // display a message advising the user to use the site icon feature
            if ( ! ( function_exists( 'has_site_icon' ) && has_site_icon() ) ) { // If the `has_site_icon` function doesn't exist if the site icon has not been set
                // output your theme favicon code to the page source
                self::get_fav_icon();
            }
        }
    }

    static function get_fav_icon() {
        $fav = Bw::get_option( 'fav_icon' );
        if( ! empty( $fav ) ) {
            echo "<link rel='shortcut icon' href='" . esc_url( $fav ) . "'>";
        }
    }

    static function load_custom_js_header() {
        $custom_js = Bw::get_option( Bw::$theme_prefix . '_custom_js_header' );
        if ( ! empty( $custom_js ) ) {
            //first lets test is the js code is clean or has <script> tags and such
            //if we have <script> tags than we will not enclose it in anything - raw output
            if ( strpos( $custom_js, '</script>' ) !== false ) {
                echo $custom_js . "\n";
            } else {
                echo "<script type='text/javascript'>\n;(function($){\n" . $custom_js . "\n})(jQuery);\n</script>\n";
            }
        }
    }

    static function wp_enqueue_scripts() {

        $inline_css = self::$inline_css;
        if( $inline_css ) {
            wp_add_inline_style( 'bw-style-theme', wp_strip_all_tags( $inline_css ) );
        }
    }
}
Bw_theme_header::init();
