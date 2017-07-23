<?php

class Bw_theme_ajax {

    static $funcs = array(
        '__call_example',
    );

    static function init() {

        self::alocate_callbacks();

    }

    static function alocate_callbacks() {

        foreach( self::$funcs as $func ) {

            add_action( 'wp_ajax_nopriv_' . $func, array( 'Bw_theme_ajax', $func ) );
            add_action( 'wp_ajax_' . $func, array( 'Bw_theme_ajax', $func ) );

        }
    }

    static function __call_example() {

        echo 123456;
        exit;

    }

}

Bw_theme_ajax::init();
