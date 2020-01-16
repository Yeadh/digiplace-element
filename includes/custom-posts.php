<?php

if ( ! function_exists('digiplace_custom_post_type') ) {
	
    /**
     * Register a custom post type.
     *
     * @link http://codex.wordpress.org/Function_Reference/register_post_type
     */
    function digiplace_custom_post_type() {

        //portfolio
        register_post_type(
            'portfolio', array(
            'labels'                 => array(
                'name'               => _x( 'Portfolio', 'post type general name', 'digiplace' ),
                'singular_name'      => _x( 'Portfolio', 'post type singular name', 'digiplace' ),
                'menu_name'          => _x( 'Portfolio', 'admin menu', 'digiplace' ),
                'name_admin_bar'     => _x( 'Portfolio', 'add new on admin bar', 'digiplace' ),
                'add_new'            => _x( 'Add New', 'Portfolio', 'digiplace' ),
                'add_new_item'       => __( 'Add New Portfolio', 'digiplace' ),
                'new_item'           => __( 'New Portfolio', 'digiplace' ),
                'edit_item'          => __( 'Edit Portfolio', 'digiplace' ),
                'view_item'          => __( 'View Portfolio', 'digiplace' ),
                'all_items'          => __( 'All Portfolio', 'digiplace' ),
                'search_items'       => __( 'Search Portfolio', 'digiplace' ),
                'parent_item_colon'  => __( 'Parent Portfolio:', 'digiplace' ),
                'not_found'          => __( 'No Portfolio found.', 'digiplace' ),
                'not_found_in_trash' => __( 'No Portfolio found in Trash.', 'digiplace' )
            ),

            'description'        => __( 'Description.', 'digiplace' ),
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
                    'name' => __( 'Portfolio Category', 'digiplace' ),
                    'add_new_item'      => __( 'Add New Category', 'digiplace' ),
                ),
                'hierarchical' => true,
                'show_admin_column'     => true
        ));
    }

    add_action( 'init', 'digiplace_custom_post_type' );

}