<?php

class Bw_theme {

    static function init() {

        # theme thumbnails
        add_action( 'after_setup_theme', array( 'Bw_theme', 'theme_thumbnails' ) );

        if( ! is_admin() ) {
            # main components
            add_action( 'after_setup_theme', array( 'Bw_theme', 'theme' ) );
        }

    }

    static function theme() {
        # assets
        add_action( 'wp_enqueue_scripts', array('Bw_theme', 'enqueue_assets') );
        # google fonts
        self::declare_fonts();
        # add customizer styles
        self::customizer_styles();
    }

    // thumb sizes
    static function theme_thumbnails() {

        add_image_size( 'bw_1920x1080_true', 1920, 1080, true );

    }

    static function customizer_styles() {

        $dropcap_selector = '.single-post .entry-content > p:first-of-type:first-letter, .bw-dropcap:first-letter';

        if( Bw::get_theme_option('fonts_vintage_bigger') ) {
            Bw_theme_header::add_css('.bw-blog-description, .bw-page-header p, .bw-carousel-slide .bw-carousel-text p {font-size:37px;}');
        }

        $enable_dropcap = Bw::get_theme_option('blog_dropcap');
        if( $enable_dropcap ) {
            Bw_theme_header::add_css( $dropcap_selector . ' {color:#000;float:left;font-size:6.3em;font-weight:400;line-height:1;margin:-0.15em 0.2em -0.2em -0.15em;text-shadow:3px 3px 0px white, 5px 5px 0px #ccc;}');

            $colors_dropcap_text = Bw::get_theme_option('colors_dropcap_text');
            if( $colors_dropcap_text ) {
                Bw_theme_header::add_css( $dropcap_selector . ' {color:' . esc_attr( $colors_dropcap_text ) . ';}');
            }

            $colors_dropcap_shadow = Bw::get_theme_option('colors_dropcap_shadow');
            if( $colors_dropcap_shadow ) {
                Bw_theme_header::add_css( $dropcap_selector . ' {text-shadow:2px 2px 0px white, 4px 4px 0px ' . esc_attr( $colors_dropcap_shadow ) . ';}');
            }
        }
    }

    static function declare_fonts() {

        // fonts
        Bw_theme_fonts::$google_fonts = array(

            Bw::$theme_prefix . '_fonts_body_font' => array(
                'default' => array( 'family' => 'Rubik' ),
                'selectors' => 'body, .main-navigation .bw-header-line, .bw-masonry-item .entry-title',
                //'self' => true
            ),
            Bw::$theme_prefix . '_fonts_logo_font' => array(
                'default' => array( 'family' => 'Source Sans Pro' ),
                //'self' => true,
                'selectors' => '.site-branding .site-title'
            ),
            Bw::$theme_prefix . '_fonts_navigation_font' => array(
                'default' => array( 'family' => 'Cabin' ),
                //'self' => true,
                'selectors' => '.main-navigation'
            ),
            Bw::$theme_prefix . '_fonts_headings_font' => array(
                'default' => array( 'family' => 'Cabin' ),
                //'self' => true,
                'selectors' => 'h1,h2,h3,h4,h5,h6, blockquote p'
            ),
            Bw::$theme_prefix . '_fonts_vintage_font' => array(
                'default' => array( 'family' => 'Cabin' ),
                //'self' => true,
                'selectors' => '.bw-page-header p, .bw-blog-description, .bw-carousel-slide .bw-carousel-text p'
            ),
            Bw::$theme_prefix . '_fonts_dropcap_font' => array(
                'default' => array( 'family' => 'Cabin' ),
                //'self' => true,
                'selectors' => '.single-post .entry-content > p:first-of-type:first-letter, .bw-dropcap:first-letter'
            ),

        );

    }

    static function additional_scripts() {

        if( is_singular() and comments_open() and get_option( 'thread_comments' ) == 1 ) {
            wp_enqueue_script( 'comment-reply' );
        }

    }

    static function enqueue_assets() {

        self::additional_scripts();

        # css
        wp_enqueue_style( 'bw-style-wp', BW_URI . 'style.css' );
        wp_enqueue_style( 'bw-style-theme', BW_URI . 'assets/css/style.css', array('bw-style-wp') );

        if( is_child_theme() ) {
            wp_enqueue_style( 'bw-child', get_stylesheet_directory_uri() . '/style.css', array('bw-style-theme') );
        }

        # js
        wp_enqueue_script( 'bw-vendors', BW_URI . 'assets/js/vendors.js', array('jquery'), false, true );
        wp_enqueue_script( 'bw-main', BW_URI . 'assets/js/main.js', array('jquery', 'bw-vendors'), false, true );

        wp_localize_script( 'bw-main', 'bw_theme_vars', array(
            'ajax' => admin_url( 'admin-ajax.php' ),
            'is_mobile' => wp_is_mobile(),
        ));

    }

}
Bw_theme::init();
