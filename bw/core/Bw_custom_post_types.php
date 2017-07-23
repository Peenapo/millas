<?php

class Bw_custom_post_types {

    static function init() {

        //add_filter( 'bwpt_register_post_types', array( 'Bw_custom_post_types', 'register_post_types' ) );
        //add_filter( 'bwpt_register_taxonomies', array( 'Bw_custom_post_types', 'register_taxonomies' ) );

    }

    static function register_post_types() {

        $singular  = esc_html__( 'Menu Item', 'yago' );
		$plural    = esc_html__( 'Menu Item', 'yago' );

        return array(
            'bw_pt_menu' => array(
                'taxonomies' => array( 'bw_tx_menu' ),
                'menu_icon' => 'dashicons-carrot',
                'labels' => array(
                    'name' 					=> $plural,
					'singular_name' 		=> $singular,
					'menu_name'             => $plural,
					'all_items'             => sprintf( esc_html__('All %s', 'yago' ), $plural ),
					'add_new' 				=> esc_html__('Add New', 'yago' ),
					'add_new_item' 			=> sprintf( esc_html__('Add %s', 'yago' ), $singular ),
					'edit' 					=> esc_html__('Edit', 'yago' ),
					'edit_item' 			=> sprintf( esc_html__('Edit %s', 'yago' ), $singular ),
					'new_item' 				=> sprintf( esc_html__('New %s', 'yago' ), $singular ),
					'view' 					=> sprintf( esc_html__('View %s', 'yago' ), $singular ),
					'view_item' 			=> sprintf( esc_html__('View %s', 'yago' ), $singular ),
					'search_items' 			=> sprintf( esc_html__('Search %s', 'yago' ), $plural ),
					'not_found' 			=> sprintf( esc_html__('No %s found', 'yago' ), $plural ),
					'not_found_in_trash' 	=> sprintf( esc_html__('No %s found in trash', 'yago' ), $plural ),
					'parent' 				=> sprintf( esc_html__('Parent %s', 'yago' ), $singular ),
                ),
                'exclude_from_search' => true,
                //'menu_position' => '55.4',
                'has_archive' => false,
                'rewrite' => array( 'slug' => 'menu' ),
                'public' => false,
                'publicly_queryable' => false,
                'show_ui' => true,
                'supports' => array( 'title', 'thumbnail', 'page-attributes', 'excerpt' )
            )
        );

    }

    static function register_taxonomies() {

        return array(
		    'bw_tx_menu' => array(
		        'post_type' => 'bw_pt_menu',
		        'body' => array(
		            'label' => esc_html__( 'Menu Categories', 'yago' ),
		            'capabilities' => array(
		                'manage__terms' => 'edit_posts',
		                'edit_terms' => 'manage_categories',
		                'delete_terms' => 'manage_categories',
		                'assign_terms' => 'edit_posts'
		            ),
		            'hierarchical' => true,
		            'public' => true,
		            'rewrite' => array(
		                'slug' => 'galleries'
		            ),
		            'show_admin_column' => true
		        )
		    ),
		);

    }

}
Bw_custom_post_types::init();
