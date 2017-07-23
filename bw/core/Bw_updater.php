<?php

if ( ! class_exists( 'Bw_updater' ) ):

class Bw_updater {

    /**
     * Let us debug
     *
     */
    protected static $debug = false;

    /**
     * Themes purchased on Peenapo.
     *
     */
    private static $purchased_themes = array();
    private static $purchased_plugins = array();

    /**
     * Themes that are currently installed.
     *
     */
    private static $installed_themes = array();
    private static $installed_plugins = array();

    /**
	 * Add hooks and filters.
	 *
	 */
    static function init() {

        add_filter( 'site_transient_update_themes',         array( 'Bw_updater', 'check_theme_updates' ) );
        add_filter( 'site_transient_update_plugins',        array( 'Bw_updater', 'check_plugin_updates' ) );

        add_filter( 'delete_site_transient_update_themes',  array( 'Bw_updater', 'delete_theme_update_transient' ) );
        add_action( 'load-update-core.php',                 array( 'Bw_updater', 'delete_theme_update_transient' ) );
        add_action( 'load-themes.php',                      array( 'Bw_updater', 'delete_theme_update_transient' ) );

        add_action( 'load-update-core.php',                 array( 'Bw_updater', 'delete_plugin_update_transient' ) );
        add_action( 'load-plugins.php',                     array( 'Bw_updater', 'delete_plugin_update_transient' ) );

        // deferred download
        add_action( 'upgrader_package_options',             array( 'Bw_updater', 'maybe_deferred_download' ), 99 );

    }

    /**
     * Check for theme updates.
     *
     * Only check for themes that have both been installed and purchased.
     *
     */
    public static function check_theme_updates( $transient ) {

        if ( ! isset( $transient->checked ) ) {
            return $transient;
        }

        if ( self::can_update() !== 'can' ) {
            #self::delete_theme_update_transient();

            return $transient;
        }

        $installed_and_purchased = self::get_installed_and_purchased_themes();

        if( count( $installed_and_purchased ) <= 0 ) {
            #self::delete_theme_update_transient();

            return $transient;
        }

        foreach ( $installed_and_purchased as $slug => $items ) {
            $installed_version = $items['installed']->get('Version');
            $purchased_version = $items['purchased']['version'];

            if ( version_compare( $installed_version, $purchased_version, '<' ) ) {
                $transient->response[ $slug ] = array(
                    'theme'       => $slug,
                    'new_version' => $purchased_version,
                    'url'         => $items['installed']->get_template_directory_uri() . '/readme.txt',
                    'package'     => self::deferred_download( $items['purchased']['id'] ),
                );
            }
        }

        return $transient;
    }

    public static function check_plugin_updates( $transient ) {

        if ( ! isset( $transient->checked ) ) {
            return $transient;
        }

        if ( self::can_update() !== 'can' ) {
            #self::delete_theme_update_transient();

            return $transient;
        }

        $installed_and_purchased = self::get_installed_and_purchased_plugins();

        if( count( $installed_and_purchased ) <= 0 ) {
            #self::delete_theme_update_transient();

            return $transient;
        }

        foreach ( $installed_and_purchased as $slug => $items ) {

            $installed_version = $items['installed']['Version'];
            $purchased_version = $items['purchased']['version'];

            if ( version_compare( $installed_version, $purchased_version, '<' ) ) {

                $transient->response[ 'peenapo-page-builder/bwpb.php' ] = (object)array(
                    'slug'          => 'peenapo-page-builder/bwpb.php',
                    'new_version'   => $purchased_version,
                    'url'           => 'http://peenapo.com',
                    'package'       => self::deferred_download( $items['purchased']['id'] )
                );
            }
        }

        return $transient;
    }

    /**
	 * Get a list of themes that are both installed and purchased.
	 *
	 */
	public static function get_installed_and_purchased_themes() {
		$installed = self::get_installed_themes();
		$purchased = self::get_purchased_themes();

		$installed_and_purchased = array();
        #self::delete_theme_update_transient();

		foreach ( $installed as $theme_slug => $theme ) {
			if ( array_key_exists( $theme_slug, $purchased ) ) {
				$installed_and_purchased[$theme_slug] = array(
					'installed' => $theme,
					'purchased' => $purchased[$theme_slug]
				);
			}
		}

		return $installed_and_purchased;
	}
    public static function get_installed_and_purchased_plugins() {
        $installed = self::get_installed_plugins();
        $purchased = self::get_purchased_plugins();

        $installed_and_purchased = array();
        #self::delete_theme_update_transient();

        foreach ( $installed as $plugin_slug => $plugin ) {
            if ( array_key_exists( $plugin_slug, $purchased ) ) {
                $installed_and_purchased[$plugin_slug] = array(
                    'installed' => $plugin,
                    'purchased' => $purchased[$plugin_slug]
                );
            }
        }

        return $installed_and_purchased;
    }

    private static function themes() {

        $themes = array();

        $url = 'https://peenapo.com/api/?type=items&username=' . Bw_guide::get_peenapo_username();

        $response = wp_remote_get( esc_url_raw( $url ) );

        // Check the response code.
		$response_code = wp_remote_retrieve_response_code( $response );
		$response_message = wp_remote_retrieve_response_message( $response );

        if( $response_code == 200 and ! empty( $response_message ) ) {

            $return = json_decode( wp_remote_retrieve_body( $response ), true );

            if ( $return !== null and isset( $return['themes'] ) and isset( $return['verified'] ) and $return['verified'] == true ) {

                $themes = $return['themes'];

            }
        }

        return $themes;

    }

    private static function plugins() {

        $plugins = array();

        $url = 'https://peenapo.com/api/?type=items&username=' . Bw_guide::get_peenapo_username();

        $response = wp_remote_get( esc_url_raw( $url ) );

        // Check the response code.
        $response_code = wp_remote_retrieve_response_code( $response );
        $response_message = wp_remote_retrieve_response_message( $response );

        if( $response_code == 200 and ! empty( $response_message ) ) {

            $return = json_decode( wp_remote_retrieve_body( $response ), true );

            if ( $return !== null and isset( $return['plugins'] ) and isset( $return['verified'] ) and $return['verified'] == true ) {

                $plugins = $return['plugins'];

            }
        }

        return $plugins;

    }

	/**
	 * Get a list of all purchased themes.
	 *
	 */
	public static function get_purchased_themes() {

        if ( ! empty( self::$purchased_themes ) ) {
			return self::$purchased_themes;
		}

		if ( self::can_update() !== 'can' ) {
			#self::delete_theme_update_transient();

			return;
		}

		// @see https://core.trac.wordpress.org/ticket/15058
		$transient = 'atu_purchased_themes';

		self::$purchased_themes = get_transient( $transient );

		if ( false === self::$purchased_themes ) {
			self::$purchased_themes = self::themes();

			set_transient( $transient, self::$purchased_themes, DAY_IN_SECONDS );
		}

		return self::$purchased_themes;
	}

    public static function get_purchased_plugins() {

        if ( ! empty( self::$purchased_plugins ) ) {
			return self::$purchased_plugins;
		}

		if ( self::can_update() !== 'can' ) {
			#self::delete_theme_update_transient();

			return;
		}

		// @see https://core.trac.wordpress.org/ticket/15058
		$transient = 'atu_purchased_plugins';

		self::$purchased_plugins = get_transient( $transient );

		if ( false === self::$purchased_plugins ) {
			self::$purchased_plugins = self::plugins();

			set_transient( $transient, self::$purchased_plugins, DAY_IN_SECONDS );
		}

		return self::$purchased_plugins;
	}

	/**
	 * Get a list of all installed themes.
	 *
	 */
	public static function get_installed_themes() {
		if ( ! empty( self::$installed_themes ) ) {
			return self::$installed_themes;
		}

		// @see https://core.trac.wordpress.org/ticket/15058
		$transient = 'atu_installed_themes';

		self::$installed_themes = get_transient( $transient );

		if ( false === self::$installed_themes ) {
			self::$installed_themes = wp_get_themes();

			set_transient( $transient, self::$installed_themes, DAY_IN_SECONDS );
		}

		return self::$installed_themes;
	}

    public static function get_installed_plugins() {
        if ( ! empty( self::$installed_plugins ) ) {
            return self::$installed_plugins;
        }

        $transient = 'atu_installed_plugins';

        self::$installed_plugins = get_transient( $transient );

        if ( false === self::$installed_plugins ) {
            self::$installed_plugins = get_plugins();

            set_transient( $transient, self::$installed_plugins, DAY_IN_SECONDS );
        }

        return self::$installed_plugins;
    }

	/**
	 * Deferred item download URL.
	 *
     */
	static function deferred_download( $id ) {

        if ( empty( $id ) ) { return ''; }

		$args = array(
			'deferred_download' => true,
			'item_id' => $id,
		);

		$page = admin_url( 'themes.php' );

		return add_query_arg( $args, esc_url( $page ) );
	}

	/**
	* Defers building the API download url until the last responsible moment to limit file requests.
	*
	* Filter the package options before running an update.

	* @param array $options {
	*     Options used by the upgrader.
	*
	*     @type string $package                     Package for update.
	*     @type string $destination                 Update location.
	*     @type bool   $clear_destination           Clear the destination resource.
	*     @type bool   $clear_working               Clear the working resource.
	*     @type bool   $abort_if_destination_exists Abort if the Destination directory exists.
	*     @type bool   $is_multi                    Whether the upgrader is running multiple times.
	*     @type array  $hook_extra                  Extra hook arguments.
	* }
	*/
	public static function maybe_deferred_download( $options ) {
		$package = $options['package'];

		if ( false !== strrpos( $package, 'deferred_download' ) && false !== strrpos( $package, 'item_id' ) ) {
			parse_str( parse_url( $package, PHP_URL_QUERY ), $vars );

			if ( isset( $vars['item_id'] ) ) {
				$options['package'] = self::download( $vars['item_id'] );
			}
		}

		return $options;
	}

	/**
	 * Get the item download.
	 *
	 */
	public function download( $id) {

        if ( empty( $id ) ) { return; }

		$url = 'https://peenapo.com/api/?type=download&username=' . Bw_guide::get_peenapo_username() . '&item_id=' . $id;
		$response = self::request( $url );

		if ( is_wp_error( $response ) || empty( $response ) || ! empty( $response['error'] ) ) {
            return;
        }

		if ( ! empty( $response['source'] ) ) {
			return htmlspecialchars_decode( $response['source'] );
		}

		return;
	}

    /**
	 * Query the Peenapo API.
	 *
	 * @uses wp_remote_get() To perform an HTTP request.
	 *
	 */
	static function request( $url ) {

        // todo: do some token authentification

        $response = wp_remote_get( esc_url_raw( $url ) );

        // Check the response code.
        $response_code = wp_remote_retrieve_response_code( $response );
        $response_message = wp_remote_retrieve_response_message( $response );

        if( $response_code == 200 and ! empty( $response_message ) ) {

            $return = json_decode( wp_remote_retrieve_body( $response ), true );

            if ( $return !== null ) {
            	return $return;
			}

        }
	}

    static function can_update() {

        $can = get_transient( 'bw_can_update' );

        if ( $can == false ) {

            $can = 'cannot';

            $url = 'https://peenapo.com/api/?type=auth&username=' . Bw_guide::get_peenapo_username();

            $response = wp_remote_get( esc_url_raw( $url ) );

            // Check the response code.
    		$response_code = wp_remote_retrieve_response_code( $response );
    		$response_message = wp_remote_retrieve_response_message( $response );

            if( $response_code == 200 and ! empty( $response_message ) ) {

                $return = json_decode( wp_remote_retrieve_body( $response ), true );

                if ( $return !== null and isset( $return['verified'] ) and $return['verified'] == true ) {
                    $can = 'can';
                }

            }

            set_transient( 'bw_can_update', $can, DAY_IN_SECONDS );

        }

        return $can;

    }

    static function delete_all_update_transient() {
        self::delete_theme_update_transient();
        self::delete_plugin_update_transient();
        self::delete_user_update_transient();
    }

    static function delete_theme_update_transient() {
        /*delete_transient( 'atu_installed_themes' );
        delete_transient( 'atu_purchased_themes' );
        delete_transient( 'update_themes' );*/
    }

    static function delete_plugin_update_transient() {
        /*delete_transient( 'atu_installed_plugins' );
        delete_transient( 'atu_purchased_plugins' );
        delete_transient( 'update_plugins' );*/
    }

    static function delete_user_update_transient() {
        delete_transient( 'bw_can_update' );
    }

    static function connection_status_label() {
        return self::can_update() == 'can' ? Bw_guide::get_string('api_complete') : Bw_guide::get_string('api_not_complete');
    }

}
endif;
