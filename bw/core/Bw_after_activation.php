<?php

class Bw_after_activation {

    static function init() {

        add_action( 'admin_init', array( 'Bw_after_activation', 'on_theme_installation' ) );

        add_action( 'after_switch_theme', array( 'Bw_after_activation', 'on_theme_activation' ), 10, 2 );

    }

    static function on_theme_activation() {

        // do something.

    }

    static function on_theme_installation() {

        if( ! self::is_theme_installed() ) {

            # tell wp that the configuration was done
            self::theme_was_installed();

            # redirect to setup guide after the theme was activate
            self::redirect_to_guide();

        }

    }

    static function theme_was_installed() {
        update_option( 'bw_theme_was_installed_' . ( Bw::$theme->exists() ? Bw::$theme_prefix : 'bw_theme_name' ), true );
    }

    static function is_theme_installed() {
        return get_option( 'bw_theme_was_installed_' . ( Bw::$theme->exists() ? Bw::$theme_prefix : 'bw_theme_name' ), false );
    }

    static function redirect_to_guide() {
        wp_safe_redirect( admin_url( '/admin.php?page=' . Bw_guide::get_page_id(), 'http' ), 301 );
    }
}
Bw_after_activation::init();
