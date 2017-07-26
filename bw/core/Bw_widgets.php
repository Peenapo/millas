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

        register_sidebar(array(
            'name'          => esc_html__( 'Sidebar', 'yago' ),
            'id'            => 'sidebar',
            'description'   => 'Main sidebar',
            'before_widget' => '<aside id="%1$s" class="widget %2$s">',
            'after_widget'  => '</aside>',
            'before_title'  => '<h4 class="widget-title">',
            'after_title'   => '</h4>',
        ));

        register_sidebar(array(
            'name'          => esc_html__( 'Footer Column 1', 'yago' ),
            'id'            => 'footer_1',
            'description'   => 'Footer area widgets',
            'before_widget' => '<aside id="%1$s" class="widget %2$s">',
            'after_widget'  => '</aside>',
            'before_title'  => '<h4 class="widget-title">',
            'after_title'   => '</h4>',
        ));

        register_sidebar(array(
            'name'          => esc_html__( 'Footer Column 2', 'yago' ),
            'id'            => 'footer_2',
            'description'   => 'Footer area widgets',
            'before_widget' => '<aside id="%1$s" class="widget %2$s">',
            'after_widget'  => '</aside>',
            'before_title'  => '<h4 class="widget-title">',
            'after_title'   => '</h4>',
        ));

        register_sidebar(array(
            'name'          => esc_html__( 'Footer Column 3', 'yago' ),
            'id'            => 'footer_3',
            'description'   => 'Footer area widgets',
            'before_widget' => '<aside id="%1$s" class="widget %2$s">',
            'after_widget'  => '</aside>',
            'before_title'  => '<h4 class="widget-title">',
            'after_title'   => '</h4>',
        ));

        register_sidebar(array(
            'name'          => esc_html__( 'Footer Column 4', 'yago' ),
            'id'            => 'footer_4',
            'description'   => 'Footer area widgets',
            'before_widget' => '<aside id="%1$s" class="widget %2$s">',
            'after_widget'  => '</aside>',
            'before_title'  => '<h4 class="widget-title">',
            'after_title'   => '</h4>',
        ));

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
