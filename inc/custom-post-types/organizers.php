<?php
add_action( 'init', 'create_organizers_custom_post_type' );

function create_organizers_custom_post_type() 
{
    $labels = [
        'name'                => _x( 'Organizers', 'Post Type General Name', 'ict_camp' ),
        'singular_name'       => _x( 'Organizer', 'Post Type Singular Name', 'ict_camp' ),
        'menu_name'           => __( 'Organizers', 'ict_camp' ),
        'parent_item_colon'   => __( 'Parent Organizer', 'ict_camp' ),
        'all_items'           => __( 'All Organizers', 'ict_camp' ),
        'view_item'           => __( 'View Organizer', 'ict_camp' ),
        'add_new_item'        => __( 'Add New Organizer', 'ict_camp' ),
        'add_new'             => __( 'Add New', 'ict_camp' ),
        'edit_item'           => __( 'Edit Organizer', 'ict_camp' ),
        'update_item'         => __( 'Update Organizer', 'ict_camp' ),
        'search_items'        => __( 'Search Organizer', 'ict_camp' ),
        'not_found'           => __( 'Not Found', 'ict_camp' ),
        'not_found_in_trash'  => __( 'Not found in Trash', 'ict_camp' ),
    ];

    $args = [
        'label'               => __( 'Organizers', 'ict_camp' ),
        'description'         => __( 'Organizers', 'ict_camp' ),
        'labels'              => $labels,
        'supports'            => ['title', 'editor', 'excerpt', 'thumbnail', 'revisions'],
        'taxonomies'          => ['category', 'camp_year'],
        'hierarchical'        => false,
        'public'              => true,
        'show_ui'             => true,
        'show_in_menu'        => true,
        'show_in_nav_menus'   => true,
        'show_in_admin_bar'   => true,
        'menu_icon'           => 'dashicons-nametag',
        'menu_position'       => null,
        'can_export'          => true,
        'has_archive'         => true,
        'exclude_from_search' => false,
        'publicly_queryable'  => true,
        'capability_type'     => 'post',
    ];

    register_post_type( 'organizers', $args );
}