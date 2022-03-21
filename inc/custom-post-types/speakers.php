<?php
add_action( 'init', 'create_speakers_custom_post_type' );

function create_speakers_custom_post_type() 
{
    $labels = [
        'name'                => _x( 'Speakers', 'Post Type General Name', 'ict_camp' ),
        'singular_name'       => _x( 'Speaker', 'Post Type Singular Name', 'ict_camp' ),
        'menu_name'           => __( 'Speakers', 'ict_camp' ),
        'parent_item_colon'   => __( 'Parent Speaker', 'ict_camp' ),
        'all_items'           => __( 'All Speakers', 'ict_camp' ),
        'view_item'           => __( 'View Speaker', 'ict_camp' ),
        'add_new_item'        => __( 'Add New Speaker', 'ict_camp' ),
        'add_new'             => __( 'Add New', 'ict_camp' ),
        'edit_item'           => __( 'Edit Speaker', 'ict_camp' ),
        'update_item'         => __( 'Update Speaker', 'ict_camp' ),
        'search_items'        => __( 'Search Speaker', 'ict_camp' ),
        'not_found'           => __( 'Not Found', 'ict_camp' ),
        'not_found_in_trash'  => __( 'Not found in Trash', 'ict_camp' ),
    ];

    $args = [
        'label'               => __( 'Speakers', 'ict_camp' ),
        'description'         => __( 'Speakers', 'ict_camp' ),
        'labels'              => $labels,
        'supports'            => ['title', 'editor', 'excerpt', 'thumbnail'],
        'taxonomies'          => ['category', 'camp_year'],
        'hierarchical'        => false,
        'public'              => true,
        'show_ui'             => true,
        'show_in_menu'        => true,
        'show_in_nav_menus'   => true,
        'show_in_admin_bar'   => true,
        'menu_icon'           => 'dashicons-businessman',
        'menu_position'       => 5,
        'can_export'          => true,
        'has_archive'         => true,
        'exclude_from_search' => false,
        'publicly_queryable'  => true,
        'capability_type'     => 'post',
    ];

    register_post_type( 'speakers', $args );
}