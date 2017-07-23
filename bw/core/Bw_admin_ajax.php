<?php

class Bw_admin_ajax {

    static $child_slug;

    static $callbacks = array(

        # import
        '__call_import_theme_options',
        //'__call_import_sample_data',
        '__call_import_sample_data_part_1',
        '__call_import_sample_data_part_2',
        '__call_import_sample_data_part_3',
        '__call_import_menus',
        '__call_import_static_pages',
        '__call_import_permalink_format',
        '__call_import_custom_post_meta',
        '__call_import_custom_options',
        '__call_import_was_done',

        # gallery
        '__call_gallery_preview',

        # guide
        '__call_guide_child',
        '__call_guide_updates_envato',
        '__call_guide_updates_peenapo',
        '__call_guide_google_key',
    );

    static function init() {

        add_action( 'admin_init', array( 'Bw_admin_ajax', 'alocate_callbacks' ) );

    }

    static function alocate_callbacks() {

        foreach( self::$callbacks as $callback ) {

            add_action( 'wp_ajax_nopriv_' . $callback, array( 'Bw_admin_ajax', $callback ) );
            add_action( 'wp_ajax_' . $callback, array( 'Bw_admin_ajax', $callback ) );
        }
    }

    static function __call_guide_child() {

        $parent_slug = Bw::$theme->get_stylesheet();

        // Create child theme
        if ( ! Bw_admin_ajax::has_child_theme() ) {
            Bw_admin_ajax::create_child_theme();
        }

        switch_theme( Bw_admin_ajax::$child_slug );

        // Copy customizer settings, widgets, etc.
        /*$settings = get_option( 'theme_mods_' . Bw_admin_ajax::$child_slug );

        if ( false === $settings ) {
            $parent_settings = get_option( 'theme_mods_' . $parent_slug );
            update_option( 'theme_mods_' . Bw_admin_ajax::$child_slug, $parent_settings );
        }*/
    }

    static function __call_guide_updates_envato() {

        check_ajax_referer( 'ajax-nonce', 'security' );

        $token = isset( $_POST['token'] ) ? esc_attr( $_POST['token'] ) : false;
        $api = Bw_Envato_Market_API::instance();

        update_option( Bw::$theme_prefix . '_themeforest_updater_token', $token );
        delete_transient( 'bw_updater_can_make_request' );

        // hotswap the token
        $api->token = $token;

        wp_send_json_success(array(
            'token' => $token,
            'can_request' => $api->can_make_request_with_token(),
            'request_label' => $api->connection_status_label()
        ));

        exit();

    }

    static function __call_guide_updates_peenapo() {

        check_ajax_referer( 'ajax-nonce', 'security' );

        $username = isset( $_POST['username'] ) ? esc_attr( $_POST['username'] ) : false;

        update_option( Bw::$theme_prefix . '_peenapo_username', $username );

        Bw_updater::delete_all_update_transient();

        wp_send_json_success(array(
            'username' => $username,
            'can_request' => Bw_updater::can_update() == 'can',
            'request_label' => Bw_updater::connection_status_label()
        ));

        exit();

    }

    static function __call_guide_google_key() {

        check_ajax_referer( 'ajax-nonce', 'security' );

        $api_key = isset( $_POST['api_key'] ) ? esc_attr( $_POST['api_key'] ) : '';

        update_option( Bw::$theme_prefix . '_google_api_key', $api_key );

        $cat_request = ! empty( $api_key ) ? true : false;

        wp_send_json_success(array(
            'token' => $api_key,
            'can_request' => $cat_request,
            'request_label' => $cat_request ? Bw_guide::$strings->complete : Bw_guide::$strings->not_complete
        ));

        exit();

    }

    static function has_child_theme() {

        $themes = wp_get_themes();
        $folder_name = Bw::$theme->get_stylesheet();
        Bw_admin_ajax::$child_slug = $folder_name . '-child';

        foreach ( $themes as $theme ) {
            if ( $folder_name == $theme->get( 'Template' ) ) {
                Bw_admin_ajax::$child_slug = $theme->get_stylesheet();
                return true;
            }
        }

        return;
    }

    static function create_child_theme() {

        $parent_dir = Bw::$theme->get_stylesheet_directory();
        $child_dir = $parent_dir . '-child';

        if ( wp_mkdir_p( $child_dir ) ) {
            $credentials = request_filesystem_credentials( admin_url() );
            WP_Filesystem( $credentials );

            global $wp_filesystem;
            $wp_filesystem->put_contents( $child_dir . '/style.css', Bw_admin_ajax::child_style_css() );
            $wp_filesystem->put_contents( $child_dir . '/functions.php', Bw_admin_ajax::child_functions_php() );

            if ( ( $img = Bw::$theme->get_screenshot( 'relative' ) ) !== false ) {
                $wp_filesystem->copy( "{$parent_dir}/{$img}", "{$child_dir}/{$img}" );
            }
        }
        else {
            wp_die( esc_html__( 'Error: theme folder not writable', 'yago' ) );
        }

    }

    static function child_style_css() {
        $name = Bw::$theme->get( 'Name' ) . ' Child';
        $uri = Bw::$theme->get( 'ThemeURI' );
        $author = Bw::$theme->get( 'Author' );
        $parent = Bw::$theme->get_stylesheet();
        $output = "/*
Theme Name:     {$name}
Theme URI:      {$uri}
Author:         {$author}
Template:       {$parent}
Version:        1.0
*/
";
        return apply_filters( 'uct_style_css', $output );
    }


    static function child_functions_php() {
        $output = "<?php

// empty.
";
        return apply_filters( 'uct_functions_php', $output );
    }

    static function __call_import_theme_options() {
        include( BW_FRAME_CORE . 'Bw_import.php' );
        die( Bw_import::theme_mods() );
    }

    static function __call_import_sample_data_part_1() {
        self::__call_import_sample_data('_part_1');
    }

    static function __call_import_sample_data_part_2() {
        self::__call_import_sample_data('_part_2');
    }

    static function __call_import_sample_data_part_3() {
        self::__call_import_sample_data('_part_3');
    }

    static function __call_import_sample_data( $part = '' ) {
        include( BW_FRAME_CORE . 'Bw_import.php' );
        die( Bw_import::create_importer( $part ) );
    }

    static function __call_import_menus() {
        include( BW_FRAME_CORE . 'Bw_import.php' );
        die( Bw_import::assign_menus() );
    }

    static function __call_import_static_pages() {
        include( BW_FRAME_CORE . 'Bw_import.php' );
        die( Bw_import::assign_static_pages() );
    }

    static function __call_import_permalink_format() {
        include( BW_FRAME_CORE . 'Bw_import.php' );
        die( Bw_import::assign_permalink_format() );
    }

    static function __call_import_custom_post_meta() {
        include( BW_FRAME_CORE . 'Bw_import.php' );
        die( Bw_import::assign_custom_post_meta() );
    }

    static function __call_import_custom_options() {
        include( BW_FRAME_CORE . 'Bw_import.php' );
        die( Bw_import::assign_custom_options() );
    }

    static function __call_import_was_done() {
        include( BW_FRAME_CORE . 'Bw_import.php' );
        die( Bw_import::import_was_done() );
    }

    static function __call_gallery_preview() {

        $result = array( 'success' => false, 'output' => '' );

        $ids = isset( $_REQUEST['attachments_ids'] ) ? $_REQUEST['attachments_ids'] : null;

        $post_meta = get_post_meta( $_REQUEST['post_id'], $_REQUEST['field_name'], true );

        if( isset( $post_meta['items'] ) and is_array( $post_meta['items'] ) ) {
            $items_data = $post_meta['items'];
        }

        if( empty( $ids ) ) {
            die( json_encode( $result ) );
        }

        $default = array(
            'title' => '',
            'caption' => '',
            'video' => false,
            'video_url' => '',
            'video_autoplay' => false
        );

        foreach( explode( ',', $ids ) as $id ) {

            $attach = wp_get_attachment_image_src( $id, 'thumbnail', false );
            $item_data = array_merge( $default, isset( $items_data[$id] ) ? $items_data[$id] : array()  );

            $result["output"] .= '
            <li class="' . ( ( $item_data['video'] == true ) ? 'video' : '' ) . '">
                <div class="item-holder">
                    <img src="' . ( isset( $attach[0] ) ? $attach[0] : BW_URI_FRAME_ASSETS . 'img/admin/empty.png' ) . '">
                </div>
            </li>';
        }

        $result["success"] = true;
        die( json_encode( $result ) );
    }
}
Bw_admin_ajax::init();
