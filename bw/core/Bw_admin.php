<?php

class Bw_admin {

    static function init() {

        # enqueue scripts for admin area
        add_action( 'admin_enqueue_scripts', array( 'Bw_admin', 'enqueue_assets' ) );

    }

    static function enqueue_assets() {

        # css
        wp_enqueue_style( 'bw-admin', BW_URI_FRAME_ASSETS . 'css/admin.css' );
        wp_enqueue_style( 'bw-guide', BW_URI_FRAME_ASSETS . 'css/guide.css' );
        wp_enqueue_style( 'pe-7-stroke', BW_URI_FRAME_ASSETS . 'fonts/pe-7stroke/pe-icon-7-stroke.css' );

        # js
        wp_enqueue_script( 'bw-qjax', BW_URI_FRAME_ASSETS . 'js/vendors/jquery.qjax/jquery.qjax.min.js', array(), false, true );
        wp_enqueue_script( 'bw-admin', BW_URI_FRAME_ASSETS . 'js/admin.js', array( 'jquery' ), false, true );

        wp_localize_script( 'bw-admin', 'bw_admin_vars', array(
            'ajax' => admin_url( 'admin-ajax.php' ),
            'nonce' => wp_create_nonce('ajax-nonce')
        ));
    }

}
Bw_admin::init();
