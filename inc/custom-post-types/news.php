<?php
add_action( 'init', 'create_news_custom_post_type' );

function create_news_custom_post_type() 
{
    $labels = [
        'name'                => _x( 'Related News', 'Post Type General Name', 'ict_camp' ),
        'singular_name'       => _x( 'Related News', 'Post Type Singular Name', 'ict_camp' ),
        'menu_name'           => __( 'News', 'ict_camp' ),
        'parent_item_colon'   => __( 'Parent News', 'ict_camp' ),
        'all_items'           => __( 'All News', 'ict_camp' ),
        'view_item'           => __( 'View News', 'ict_camp' ),
        'add_new_item'        => __( 'Add New News', 'ict_camp' ),
        'add_new'             => __( 'Add New', 'ict_camp' ),
        'edit_item'           => __( 'Edit News', 'ict_camp' ),
        'update_item'         => __( 'Update News', 'ict_camp' ),
        'search_items'        => __( 'Search News', 'ict_camp' ),
        'not_found'           => __( 'Not Found', 'ict_camp' ),
        'not_found_in_trash'  => __( 'Not found in Trash', 'ict_camp' ),
    ];

    $args = [
        'label'               => __( 'News', 'ict_camp' ),
        'description'         => __( 'News', 'ict_camp' ),
        'labels'              => $labels,
        'supports'            => ['title', 'editor', 'excerpt', 'thumbnail'],
        'taxonomies'          => ['category', 'news_source'],
        'hierarchical'        => false,
        'public'              => true,
        'show_ui'             => true,
        'show_in_menu'        => true,
        'show_in_nav_menus'   => true,
        'show_in_admin_bar'   => true,
        'menu_icon'           => 'dashicons-format-aside',
        'menu_position'       => 5,
        'can_export'          => true,
        'has_archive'         => true,
        'exclude_from_search' => false,
        'publicly_queryable'  => true,
        'capability_type'     => 'post',
    ];

    register_post_type( 'news', $args );
}