<?php

/*
 * Sets up theme defaults
 */
class Bw_setup {

    static $post_formats = array(
        'default' => array(),
        //'post' => array( 'gallery', 'video' ),
    );

    static function init() {

        add_action( 'after_setup_theme', array( 'Bw_setup', 'setup' ) );

        # assign post formats depending on the post type
        add_action( 'admin_head', array( 'Bw_setup', 'assign_post_formats' ) );

    }

    /**
     * Sets up theme defaults and registers support for various WordPress features.
     *
     * Note that this function is hooked into the after_setup_theme hook, which
     * runs before the init hook. The init hook is too late for some features, such
     * as indicating support for post thumbnails.
     */
    static function setup() {

        /**
         * http://codex.wordpress.org/Content_Width
         */
        if( ! isset( $content_width ) ) {
            $content_width = 960;
        }

        /*
         * set translation
         * Theme translations can be filed in the my_theme/languages/ directory
         */
        global $locale;
        if ( isset( $locale ) ) { if ( defined( 'WPLANG' ) ) { $locale = WPLANG; } }
        load_theme_textdomain( 'yago', get_template_directory() . '/languages' );

        # assign default post formats
        self::default_post_formats();

        # menu locations
        register_nav_menus( array(
            'primary' => esc_html__( 'Primary Menu', 'yago' ),
        ));

        // Add default posts and comments RSS feed links to head.
        add_theme_support( 'automatic-feed-links' );

        /*
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
        add_theme_support( 'title-tag' );

        # enable support for HTML5 markup.
        add_theme_support( 'html5', array(
            'comment-list',
            'search-form',
            'comment-form',
            'gallery',
			'caption',
        ));

        /*
		 * Enable support for Post Thumbnails on posts and pages.
		 *
		 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		 */
        add_theme_support( 'post-thumbnails' );

        # enable support for custom logo
        /*add_theme_support( 'custom-logo', array(
    		'height'      => 240,
    		'width'       => 240,
    		'flex-height' => true,
    	));*/

        # custom excerpt text
        add_filter( 'excerpt_more', array( 'Bw_setup', 'new_excerpt_more' ) );

        # custom excerpt length
        add_filter( 'excerpt_length', array( 'Bw_setup', 'new_excerpt_length' ), 999 );

        # return wp title
        add_filter( 'wp_title', array( 'Bw_setup', 'title' ) );

        # escape comment results
        add_filter( 'comment_text', array( 'Bw_setup', 'bw_comment_kses' ) );
        add_filter( 'comment_text_rss', array( 'Bw_setup', 'bw_comment_kses' ) );
        add_filter( 'comment_excerpt', array( 'Bw_setup', 'bw_comment_kses' ) );

        # move comment field at bottom of the form
        //add_filter( 'comment_form_fields', array( 'Bw_setup', 'move_comment_field_to_bottom' ) );

        # fix issue with homepage pagination redirect.
        add_filter( 'redirect_canonical', array( 'Bw_setup', 'disable_redirect_canonical' ) );

		# check password of protected posts
		add_filter('wp', array('Bw_setup', 'check_post_pass'));

        # fix wp link pages, wrap active with span
        add_filter( 'wp_link_pages_link', array( 'Bw_setup', 'wrap_current_wp_link_pages' ) );

    }

    static function wrap_current_wp_link_pages( $link ) {
        if ( ctype_digit( $link ) ) { return '<span>' . $link . '</span>'; }
        return $link;
    }

    static function disable_redirect_canonical( $redirect_url ) {
        if ( is_singular() ) $redirect_url = false;
        return $redirect_url;
    }

    static function move_comment_field_to_bottom( $fields ) {
        $comment_field = $fields['comment'];
        unset( $fields['comment'] );
        $fields['comment'] = $comment_field;
        return $fields;
    }

    static function default_post_formats() {

        $default = self::$post_formats['default'];
        if( isset( $default ) and ! empty( $default ) ) {
            add_theme_support( 'post-formats', $default );
        }
    }

    static function assign_post_formats() {

        global $post;
        if( isset( $post->ID ) ) {
            if( array_key_exists( $post->post_type, self::$post_formats ) ) {
                add_theme_support( 'post-formats', self::$post_formats[$post->post_type] );
            }
        }
    }

    static function bw_comment_kses( $data ) {
        return addslashes( wp_kses( stripslashes( $data ), '' ) );
    }

    static function title( $title ) {
        if( empty( $title ) && ( is_home() or is_front_page() ) ) {
            return get_bloginfo( 'name' ) . ' | ' . get_bloginfo( 'description' );
        }elseif( is_author() ) {
            return sprintf( esc_html__( 'Author: %s', 'yago' ), get_the_author() );
        }elseif( is_archive() ) {
            return single_cat_title();
        }
        return $title;
    }

    static function new_excerpt_more() {
        return ' ...';
    }

    static function new_excerpt_length( $length ) {
        return 60;
    }

	static function check_post_pass() {

		if( ! is_single() || ! post_password_required() ) return;

		global $post;

		if( isset( $_COOKIE['wp-postpass_'.COOKIEHASH] ) && $_COOKIE['wp-postpass_'.COOKIEHASH] !== $post->post_password ) {

			define('BW_INVALID_POST_PASS', true);

			// tell the browser to remove the cookie so the message doesn't show up every time
			setcookie('wp-postpass_'.COOKIEHASH, NULL, -1, COOKIEPATH);
		}
	}
}
Bw_setup::init();
