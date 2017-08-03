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
    }

    // thumb sizes
    static function theme_thumbnails() {

        add_image_size( 'bw_1920x1080_true', 1920, 1080, true );

    }

    static function declare_fonts() {

        // fonts
        Bw_theme_fonts::$google_fonts = array(

            Bw::$theme_prefix . '_fonts_body_font' => array(
                'default' => array( 'family' => 'Nunito' ),
                'selectors' => 'body, .main-navigation .bw-header-line, .bw-masonry-item .entry-title', //'self' => true
            ),
            Bw::$theme_prefix . '_fonts_logo_font' => array(
                'default' => array( 'family' => 'Overpass' ),
                'selectors' => '.site-branding .site-title'
            ),
            Bw::$theme_prefix . '_fonts_navigation_font' => array(
                'default' => array( 'family' => 'Overpass' ),
                'selectors' => '.main-navigation'
            ),
            Bw::$theme_prefix . '_fonts_headings_font' => array(
                'default' => array( 'family' => 'Overpass' ),
                'selectors' => 'h1,h2,h3,h4,h5,h6, blockquote, .bw-footer-logo span'
            ),
            Bw::$theme_prefix . '_fonts_sub_headings_font' => array(
                'default' => array( 'family' => 'Overpass' ),
                'selectors' => '.bw-page-header span'
            ),
            Bw::$theme_prefix . '_fonts_footer_font' => array(
                'default' => array( 'family' => 'Nunito' ),
                'selectors' => '.site-footer'
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
