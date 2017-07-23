<?php

class Bw_import {

    static $importer;
    static $menus = array(
        'primary'               => 'Peenapo Primary',
        //'mobile'                => 'Peenapo Primary',
    );
    static $static_pages = array(
        //'home_page_name' => 'Homepage',
        //'blog_page_name' => 'Blog'
    );

    # 1.
    static function theme_mods() {

        $export_file = BW_DEMO . (int)$_POST['demo_index'] . DS . 'theme-mods.txt';

        if( file_exists( $export_file ) ) {

            # initialize the wordpress filesystem
            /*global $wp_filesystem;
            if ( empty( $wp_filesystem ) ) {
                require_once( ABSPATH . '/wp-admin/includes/file.php' );
                WP_Filesystem();
            }

            $mods_content = $wp_filesystem->get_contents( $export_file );*/

            $mods_content = file_get_contents( $export_file );

            if( ! empty( $mods_content ) ) {

                $mods_content_obj = maybe_unserialize( $mods_content );

                # validate json file then set new theme options
                if ( function_exists( 'json_last_error' ) ) {

                    if ( json_last_error() == '0' ) {

                        $site_url = get_site_url();

                        # loop through mods and add them
                        foreach ( $mods_content_obj as $theme_mod => $value ) {

                            if( strpos( $value, '%BW_SITE_URL%' ) !== false  ) {
                                $value = str_replace( '%BW_SITE_URL%', $site_url, $value );
                            }

                            update_option( $theme_mod, $value );
                        }
                    }
                }
            }
            exit;
        }
    }

    static function import( $part = '' ) {

        set_time_limit(0);

        $demo = BW_DEMO . (int)$_POST['demo_index'] . DS . 'theme-demo' . $part . '.xml';

        ob_start();

        self::$importer->import( $demo );

        $output = ob_get_clean();

        wp_send_json( array( 'part' => $part, 'importer_result' => $output ) );

    }

    # 2.
    static function create_importer( $part = '' ) {

        if( ! class_exists( "WP_Import" ) ) {
            if( ! defined( "WP_LOAD_IMPORTERS" ) ) { define( "WP_LOAD_IMPORTERS", true ); }
            if( PCODES_ROOT ) { require_once( PCODES_ROOT . "lib/wordpress-importer/wordpress-importer.php" ); }
        }

        self::$importer = new WP_Import();
        self::$importer->fetch_attachments = true;

        self::import( $part );
    }

    # 3.
    static function assign_menus() {

        $locations = array();

        foreach( self::$menus as $menu_location => $menu_name ) {

            $menu = get_term_by( 'name', $menu_name, 'nav_menu' );

            if( is_object( $menu ) ) {
                $locations[$menu_location] = $menu->term_id;
            }
        }

        if( count( $locations ) ) {
            set_theme_mod( 'nav_menu_locations', $locations );
        }
    }

    # 4.
    static function assign_static_pages() {

        # Front page displays: a static page
        update_option( 'show_on_front', 'page' );

        # static front page
        $about = get_page_by_title( self::$static_pages['home_page_name'] );
        if( is_object( $about ) ) {
            update_option( 'page_on_front', $about->ID );
        }

        # static blog page
        $blog = get_page_by_title( self::$static_pages['blog_page_name'] );
        if( is_object( $blog ) ) {
            update_option( 'page_for_posts', $blog->ID );
        }
    }

    # 5.
    static function assign_permalink_format() {

        global $wp_rewrite;
        $wp_rewrite->set_permalink_structure('/%postname%/');
        $wp_rewrite->flush_rules();

    }

    # 6.
    static function assign_custom_post_meta() {

        /*$post_metas = array(
            array('post_id' => '9',  'meta_key' => 'bw_megamenu_layout', 'meta_value' => 'latest_posts'),
        );

        if( count( $post_metas ) ) {
            foreach( $post_metas as $post_meta ) {
                add_post_meta( $post_meta['post_id'], $post_meta['meta_key'], $post_meta['meta_value'] );
            }
        }*/
    }

    # 7.
    static function assign_custom_options() {

        # assing widgets data
        /*$import_array = array(
            'sidebars_widgets'          => 'a:8:{s:19:"wp_inactive_widgets";a:0:{}s:7:"sidebar";a:4:{i:0;s:18:"bw_peenapo_about-1";i:1;s:14:"recent-posts-1";i:2;s:19:"bw_peenapo_banner-3";i:3;s:17:"recent-comments-1";}s:16:"footer_instagram";a:0:{}s:18:"info_section_col_1";a:1:{i:0;s:6:"text-1";}s:18:"info_section_col_2";a:1:{i:0;s:17:"bw_peenapo_info-3";}s:7:"contact";a:1:{i:0;s:6:"text-3";}s:5:"about";a:1:{i:0;s:6:"text-4";}s:13:"array_version";i:3;}',
            'widget_recent-posts'       => 'a:2:{i:1;a:3:{s:5:"title";s:0:"";s:6:"number";i:4;s:9:"show_date";b:0;}s:12:"_multiwidget";i:1;}',
        );

        if( count( $import_array ) ) {
            foreach( $import_array as $import_option => $import_value ) {
                update_option( $import_option, unserialize( trim( $import_value ) ) );
            }
        }*/

        /*add_option( 'category_2_category_color', '#a10eb7' );*/
    }

    # 8. import has finished
    static function import_was_done() {
        update_option( Bw::$theme_prefix . '_demo_was_imported', true );
    }

}
