<?php

if ( ! function_exists('martua_custom_post_type') ) {
	
    /**
     * Register a custom post type.
     *
     * @link http://codex.wordpress.org/Function_Reference/register_post_type
     */
    function martua_custom_post_type() {

        //portfolio
        register_post_type(
            'portfolio', array(
            'labels'                 => array(
                'name'               => _x( 'Portfolio', 'post type general name', 'martua' ),
                'singular_name'      => _x( 'Portfolio', 'post type singular name', 'martua' ),
                'menu_name'          => _x( 'Portfolio', 'admin menu', 'martua' ),
                'name_admin_bar'     => _x( 'Portfolio', 'add new on admin bar', 'martua' ),
                'add_new'            => _x( 'Add New', 'Portfolio', 'martua' ),
                'add_new_item'       => __( 'Add New Portfolio', 'martua' ),
                'new_item'           => __( 'New Portfolio', 'martua' ),
                'edit_item'          => __( 'Edit Portfolio', 'martua' ),
                'view_item'          => __( 'View Portfolio', 'martua' ),
                'all_items'          => __( 'All Portfolio', 'martua' ),
                'search_items'       => __( 'Search Portfolio', 'martua' ),
                'parent_item_colon'  => __( 'Parent Portfolio:', 'martua' ),
                'not_found'          => __( 'No Portfolio found.', 'martua' ),
                'not_found_in_trash' => __( 'No Portfolio found in Trash.', 'martua' )
            ),

            'description'        => __( 'Description.', 'martua' ),
            'menu_icon'          => 'dashicons-layout',
            'public'             => true,
            'show_in_menu'       => true,
            'has_archive'        => false,
            'hierarchical'       => true,
            'rewrite'            => array( 'slug' => 'portfolio' ),
            'supports'           => array( 'title', 'editor', 'thumbnail' )
        ));

        // portfolio taxonomy
        register_taxonomy(
            'portfolio_category',
            'portfolio',
            array(
                'labels' => array(
                    'name' => __( 'Portfolio Category', 'martua' ),
                    'add_new_item'      => __( 'Add New Category', 'martua' ),
                ),
                'hierarchical' => true,
                'show_admin_column'     => true
        ));
    }

    add_action( 'init', 'martua_custom_post_type' );

}