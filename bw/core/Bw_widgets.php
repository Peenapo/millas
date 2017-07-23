<?php

class Bw_widgets {

    static $widgets = array(
        'bw_widgets_recent_posts',
    );

    static function init() {

        # register sidebars
        add_action( 'widgets_init', array( 'Bw_widgets', 'register_sidebars' ) );

        # register and require widgets
        add_action( 'after_setup_theme', array( 'Bw_widgets', 'require_widgets' ) );
        add_action( 'widgets_init', array( 'Bw_widgets', 'register_widgets' ) );

    }

    static function register_sidebars() {

        /*register_sidebar(array(
            'name'          => esc_html__( 'Sidebar', 'yago' ),
            'id'            => 'sidebar',
            'description'   => 'Main sidebar',
            'before_widget' => '<aside id="%1$s" class="widget %2$s">',
            'after_widget'  => '</aside>',
            'before_title'  => '<h2 class="widget-title">',
            'after_title'   => '</h2>',
        ));*/

    }

    static function require_widgets() {
        foreach ( self::$widgets as $widget ) {
            require_once BW_FRAME_ROOT . 'widgets/' . $widget . '.php';
        }
    }

    static function register_widgets() {
        foreach ( self::$widgets as $widget ) {
            register_widget( $widget );
        }
    }
}

Bw_widgets::init();
