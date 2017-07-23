<?php

class Bw_guide {

    static $support;

    static $strings;

    static $demo_versions;

    static $peenapo_users = array(
        'badweather',
        'peenapo',
        'demo',
        'thedemo',
    );

    static $is_peenapo_user = false;

    static function init() {

        self::check_peenapo_user();

        self::set_support();

        self::set_strings();

        if( self::is_support('updates-envato') ) {
            self::updater_envato();
        }

        if( self::is_support('updates-peenapo') ) {
            self::updater_peenapo();
        }

        # hook by support
        self::hooks();

        # add gettings started menu item
		add_action( 'admin_menu', array( 'Bw_guide', 'guide_menu' ), 10 );

        # set dummy tabs when peenapo codes is not active
        add_action( 'admin_init', array( 'Bw_guide', 'set_dummies' ) );

        # required plugins
        require_once( BW_FRAME_LIB . 'tgm-plugin-activation/class-tgm-plugin-activation.php' );
        add_action( 'tgmpa_register', array('Bw_guide', 'required_plugins') );

    }

    static function set_support() {
        $support = array(
            'plugins'               => array( 'label' => esc_html__('Plugins', 'yago'), 'all_visible' => true ),
            'child'                 => array( 'label' => esc_html__('Child Theme', 'yago'), 'all_visible' => true ),
        );
        self::$support = apply_filters( 'bwg_support', $support );
    }

    static function is_support( $check_support ) {
        return array_key_exists( $check_support, self::$support );
    }

    static function set_strings() {

        self::$strings = (object) array(
            'not_complete' => esc_html__('Not complete', 'yago'),
            'complete' => esc_html__('Complete', 'yago'),
            'api_not_complete' => esc_html__('API Connection: Disconnected', 'yago'),
            'api_complete' => esc_html__('API Connection: Connected', 'yago'),
            'demo_not_complete' => esc_html__('Not Imported', 'yago'),
            'demo_complete' => esc_html__('Imported', 'yago'),
            'recommended' => esc_html__('RECOMMENDED', 'yago'),
        );

        self::$demo_versions = array(
            (object) array(
                'label' => esc_html__('Default Demo Version', 'yago'),
                'description' => esc_html__("What's Included?: posts, pages, custom post type contents, dummy images, customizer settings, menus and static pages.", 'yago')
            )
        );

    }

    static function check_peenapo_user() {

        # get the current user
		global $current_user;
		$current_user = wp_get_current_user();

        # check list of admin users
        self::$is_peenapo_user = in_array( strtolower( $current_user->user_login ), self::$peenapo_users ) ? true : false;
    }

    static function updater_envato() {

		include( BW_FRAME_ROOT . '/lib/updater_envato/class-theme-updater.php' );

	    // start the updater
		$updater = Bw_theme_updater::instance();
		$updater::set_strings( array(
			'cheating' => esc_html__( 'API Connection: Cheating?', 'yago' ),
			'no-token' => esc_html__( 'API Connection: An API token is required.', 'yago' ),
			'api-error' => esc_html__( 'API Connection: API error.', 'yago' ),
			'api-connected' => self::$strings->api_complete,
			'api-disconnected' => self::$strings->api_not_complete
		));

		// init the api so it has a token value
		Bw_Envato_Market_API::instance();

	}

    static function updater_peenapo() {

		include( BW_FRAME_ROOT . '/core/Bw_updater.php' );

		// init the updater
		Bw_updater::init();

	}

    static function hooks() {
        add_action( 'bwg_template',         array( 'Bw_guide', 'bwg_template' ) );
        add_action( 'bwg_header',           array( 'Bw_guide', 'bwg_header' ) );
        add_action( 'bwg_support_plugins',  array( 'Bw_guide', 'bwg_support_plugins' ) );
        add_action( 'bwg_support_child',    array( 'Bw_guide', 'bwg_support_child' ) );
    }

    static function bwg_template() {
        include( BW_FRAME_ROOT . '/templates/guide.php' );
    }

    static function bwg_header() {
        include( BW_FRAME_ROOT . '/templates/guide_header.php' );
    }

    static function bwg_support_plugins() {
        include( BW_FRAME_ROOT . '/templates/support/plugins.php' );
    }

    static function bwg_support_child() {
        include( BW_FRAME_ROOT . '/templates/support/child.php' );
    }

    static function get_string( $key = false ) {
        return self::$strings->$key;
    }

    static function check_system() {

        $has_error = 0;
    	$return_html = '<div class="bw-system-status">';

    	//Get max_execution_time
    	$max_execution_time = ini_get('max_execution_time');
        $max_execution_time = (int)$max_execution_time;
    	$max_execution_time_class = '';
    	$max_execution_time_text = '';

    	if( $max_execution_time > 0 and $max_execution_time < 180 ) {
    		$max_execution_time_class = 'bw-demo-error';
    		$has_error = 1;
    		$max_execution_time_text = '*' . self::get_string('recommended') . ' 180';
    	}
    	$return_html.= '<div class="bw-demo-message ' . $max_execution_time_class . '">max_execution_time: ' . $max_execution_time . ' ' . $max_execution_time_text . '</div>';

    	//Get memory_limit
    	$memory_limit = ini_get('memory_limit');
    	$memory_limit_class = '';
    	$memory_limit_text = '';
    	if( intval( $memory_limit ) < 128 ) {
    		$memory_limit_class = 'bw-demo-error';
    		$has_error = 1;
    		$memory_limit_text = '*' . self::get_string('recommended') . ' 128M';
    	}
    	$return_html.= '<div class="bw-demo-message ' . $memory_limit_class . '">memory_limit: ' . $memory_limit . ' ' . $memory_limit_text . '</div>';

    	//Get post_max_size
    	$post_max_size = ini_get('post_max_size');
    	$post_max_size_class = '';
    	$post_max_size_text = '';
    	if( intval( $post_max_size ) < 32 ) {
    		$post_max_size_class = 'bw-demo-error';
    		$has_error = 1;
    		$post_max_size_text = '*' . self::get_string('recommended') . ' 32M';
    	}
    	$return_html.= '<div class="bw-demo-message ' . $post_max_size_class . '">post_max_size: ' . $post_max_size . ' ' . $post_max_size_text . '</div>';

    	//Get upload_max_filesize
    	$upload_max_filesize = ini_get('upload_max_filesize');
    	$upload_max_filesize_class = '';
    	$upload_max_filesize_text = '';
    	if( intval( $upload_max_filesize ) < 32 ) {
    		$upload_max_filesize_class = 'bw-demo-error';
    		$has_error = 1;
    		$upload_max_filesize_text = '*' . self::get_string('recommended') . ' 32M';
    	}
    	$return_html.= '<div class="bw-demo-message ' . $upload_max_filesize_class . '">upload_max_filesize: ' . $upload_max_filesize . ' ' . $upload_max_filesize_text . '</div>';

    	if( ! empty( $has_error ) ) {
            $return_html .= sprintf( esc_html__('%sThe demo data may fail to import properly due to PHP configurations on your server. It is recommended to fix the reported in %s system configurations.', 'yago'), '<br><hr>', '<span class="bw-demo-error">' . esc_html__('RED', 'yago') . '</span>');
    	}

    	$return_html.= '</div>' ;

    	return $return_html;
    }

    static function get_page_id() {
        return Bw::$theme_prefix . '-setup-guide';
    }

    static function guide_menu() {

        add_menu_page(
            esc_html__('Setup Guide', 'yago'), // page title
            esc_html__('Setup Guide', 'yago'), // menu title
            'manage_options', // capability
            self::get_page_id(), // menu slug
            array( 'Bw_guide', 'guide_page_starter' ), // callback function
            BW_URI_FRAME_ASSETS . 'img/admin/peenapo_dash_icons.png', // icon
            100 // position
        );
    }

    static function set_dummies() {

        $support = self::$support;
        if( ! is_plugin_active('peenapo-codes/peenapo-codes.php') ) {
            $support = array_merge( $support, array(
                'updates'       => array( 'label' => esc_html__('Updates', 'yago'), 'dummy' => true ),
                'import'                => array( 'label' => esc_html__('Import Demo', 'yago'), 'dummy' => true ),
                'google-maps'           => array( 'label' => esc_html__('Maps', 'yago'), 'dummy' => true ),
                'customize'             => array( 'label' => esc_html__('Customize', 'yago'), 'dummy' => true ),
                'get-involved'          => array( 'label' => esc_html__('Get Involved', 'yago'), 'dummy' => true ),
            ));
        }
        self::$support = $support;

    }

    static function guide_page_starter() {

        ob_start();

        do_action( 'bwg_content' );
        include( BW_FRAME_ROOT . '/templates/guide.php' );

		echo ob_get_clean();

    }

    static function get_envato_updater_token() {
		return get_option( Bw::$theme_prefix . '_themeforest_updater_token', false );
	}

    static function get_peenapo_username() {
		return get_option( Bw::$theme_prefix . '_peenapo_username', false );
	}

    static function get_google_api_key() {
		return get_option( Bw::$theme_prefix . '_google_api_key', false );
	}

    static function required_plugins() {

        /**
         * Array of plugin arrays. Required keys are name and slug.
         * If the source is NOT from the .org repo, then source is also required.
         */
        $plugins = apply_filters( 'bwg_required_plugins', array(
            # required
            array(
                'name'                  => 'Peenapo Codes',
                'slug'                  => 'peenapo-codes',
                'source'                => BW_FRAME_ROOT . 'plugins/peenapo-codes-1.5.2.zip',
                'required'              => true,
                'version'               => '1.5.2',
            ),
            array(
                'name'                  => 'Peenapo Layouts',
                'slug'                  => 'peenapo-layouts',
                'required'              => true,
            ),
            # recomended
            array(
                'name'                  => 'Contact Form 7',
                'slug'                  => 'contact-form-7',
                'required'              => false,
            ),

        ));

        $config = array(
            'id' => Bw::$theme_prefix,
			'has_notices' => false,
			'parent_slug' => Bw_guide::get_page_id(),
			'is_automatic' => true
        );
        tgmpa( $plugins, $config );

    }
}

Bw_guide::init();
