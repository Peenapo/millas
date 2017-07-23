<?php

class Bw_page_builder {

    static $modules = array(
        //'theme_on_focus',
    );

    static $post_filter = array();

    static function init() {

        // don't load if page builder is not enabled.
        // TODO

        if( class_exists( 'Bwpb_map' ) ) {

            add_action( 'after_setup_theme', array( 'Bw_page_builder', 'setup' ) );

            // modules
            foreach( self::$modules as $module ) {
                if( is_admin() ) {
                    add_action( 'admin_init', array( 'Bw_page_builder', $module ) );
                }else{
                    if( method_exists( 'Bwpb_shortcode_definition', 'the_shortcode' ) ) {
                        Bwpb_shortcode_definition::the_shortcode( $module, array( 'Bw_page_builder', "pb_shortcode_{$module}" ) );
                    }
                }
            }
        }
    }

    static function setup() {
        /*
        Bwpb_map::add_param('bw_row', array(
            'type' => 'true_false',
            'heading' => esc_html__( 'Show on paging', 'yago' ),
            'param_name' => 'show_on_paging',
            'description' => esc_html__( 'Activate if you want to display this row while navigation between pages (if required). By default, leave unactive.', 'yago' ),
        ));
        */
    }

    /*static function theme_on_focus() {

        Bwpb_map::map(array(
            'name' => esc_html__( 'On focus', 'yago' ),
            'base' => 'theme_on_focus',
            'icon' => 'bwpb-icon',
            'open_settings_on_create' => true,
            'category' => esc_html__( 'Theme', 'yago' ),
            'params' => array_merge( self::$post_filter, array(
                array(
                    'type' => 'textfield',
                    'param_name' => 'class'
                )
            ))
        ));

    }

    /*----------------------------------*/
    /* shortcodes
    /*----------------------------------*/

    /*static function pb_shortcode_theme_on_focus( $atts, $content ) {

        extract(shortcode_atts(array(
            'source'            => 'latest',
            'category'          => '',
            'post_format'       => '',
            'class'             => '',
        ), $atts));

        ob_start();

        require( BW_ROOT . 'templates/query-source.php' );

        if ( $output->have_posts() ) {
            echo '<div class="bw-on-focus bw-clearfix ' . esc_attr( $class ) . '">';
            $c = 0;
            while ( $output->have_posts() ) { $output->the_post();
                require( BW_ROOT . 'templates/bwpb-elements/article-focus-' . ( $c == 2 ? 'main' : 'small' )  . '.php' );
                $c++;
                if( $c >= 5 ) { break; }
            }
            echo '</div>';
        }

        wp_reset_postdata();

        return ob_get_clean();
    }*/

}
Bw_page_builder::init();
