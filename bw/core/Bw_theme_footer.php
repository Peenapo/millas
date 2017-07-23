<?php

class Bw_theme_footer {

    static function init() {

        add_action( 'wp_footer', array( 'Bw_theme_footer', 'set_footer' ) );

    }

    static function set_footer() {

        self::custom_js();
        self::load_custom_js_footer();

    }

    static function custom_js() {
        $custom_js = Bw::get_option('custom_js');
        if ( $custom_js ) { echo "<script type='text/javascript'>" . do_shortcode( $custom_js ) . "</script>"; }
    }

    static function load_custom_js_footer() {
        $custom_js = Bw::get_option( Bw::$theme_prefix . '_custom_js_footer' );
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

}
Bw_theme_footer::init();
