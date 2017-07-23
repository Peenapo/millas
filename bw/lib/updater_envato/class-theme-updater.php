<?php
if ( ! class_exists( 'Bw_theme_updater' ) ) :
/**
 * @package Bw_theme_updater
 */
class Bw_theme_updater {

	/**
	 * The single class instance.
	 *
	 * @since 1.0.0
	 * @access private
	 *
	 * @var object
 	 */
	private static $_instance = null;

	/**
	 * The strings used for any output in the drop-ins.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @var array
	 */
	public static $strings = array();

	/**
	 * Main Envato_Market_API Instance
	 *
	 * Ensures only one instance of this class exists in memory at any one time.
	 *
	 * @see Bw_Envato_Market_Updater()
	 *
	 * @since 1.0.0
	 * @static
	 * @return object The one true Bw_Envato_Market_API.
	 * @codeCoverageIgnore
	 */
	public static function instance() {
		if ( is_null( self::$_instance ) ) {
			self::$_instance = new self();
			self::init();
		}

		return self::$_instance;
	}

	/**
	 * Set things up.
	 *
	 * @since 1.0.0
	 *
	 * @return void
	 * @codeCoverageIgnore
	 */
	public static function init() {
		self::includes();
	}

	/**
	 * Set the strings to be used inside the other drop in files.
	 *
	 * @since 1.0.0
	 *
	 * @return self::$strings
	 */
	public static function set_strings( $strings = array() ) {
		$defaults = array(
			'cheating' => 'Cheating?',
			'no-token' => 'An API token is required.',
			'api-error' => 'API error.',
			'api-connected' => 'API Connection: Connected',
			'api-disconnected' => 'API Connection: Disconnected',
		);

		$strings = wp_parse_args( $strings, $defaults );

		self::$strings = $strings;
	}

	/**
	 * Get strings.
	 *
	 * Set the defaults if none are available.
	 *
	 * @since 1.0.0
	 * @return self::$strings
	 */
	public static function get_strings() {
		if ( empty( self::$strings ) ) {
			self::set_strings();
		}

		return self::$strings;
	}

	/**
	 * Include necessary files.
	 *
	 * @since 1.0.0
	 *
	 * @return void
	 * @codeCoverageIgnore
	 */
	public static function includes() {
		include( BW_FRAME_ROOT . '/lib/updater_envato/class-envato-market-api.php' );
		include( BW_FRAME_ROOT . '/lib/updater_envato/class-envato-market-updater.php' );
	}

}
endif;
