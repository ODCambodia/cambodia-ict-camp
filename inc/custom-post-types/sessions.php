<?php
add_action( 'init', 'create_sessions_custom_post_type' );

function create_sessions_custom_post_type() 
{
    $labels = [
        'name'                => _x( 'Sessions', 'Post Type General Name', 'ict_camp' ),
        'singular_name'       => _x( 'Session', 'Post Type Singular Name', 'ict_camp' ),
        'menu_name'           => __( 'Sessions', 'ict_camp' ),
        'parent_item_colon'   => __( 'Parent Session', 'ict_camp' ),
        'all_items'           => __( 'All Sessions', 'ict_camp' ),
        'view_item'           => __( 'View Session', 'ict_camp' ),
        'add_new_item'        => __( 'Add New Session', 'ict_camp' ),
        'add_new'             => __( 'Add New', 'ict_camp' ),
        'edit_item'           => __( 'Edit Session', 'ict_camp' ),
        'update_item'         => __( 'Update Session', 'ict_camp' ),
        'search_items'        => __( 'Search Session', 'ict_camp' ),
        'not_found'           => __( 'Not Found', 'ict_camp' ),
        'not_found_in_trash'  => __( 'Not found in Trash', 'ict_camp' ),
    ];

    $args = [
        'label'               => __( 'sessions', 'ict_camp' ),
        'description'         => __( 'Agenda Sessions', 'ict_camp' ),
        'labels'              => $labels,
        'supports'            => ['title', 'editor', 'excerpt', 'thumbnail', 'revisions'],
        'taxonomies'          => ['category', 'session_type', 'camp_year'],
        'hierarchical'        => false,
        'public'              => true,
        'show_ui'             => true,
        'show_in_menu'        => true,
        'show_in_nav_menus'   => true,
        'show_in_admin_bar'   => true,
        'menu_icon'           => 'dashicons-clock',
        'menu_position'       => 5,
        'can_export'          => true,
        'has_archive'         => true,
        'exclude_from_search' => false,
        'publicly_queryable'  => true,
        'capability_type'     => 'post',
    ];

    register_post_type( 'sessions', $args );
}