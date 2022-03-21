<?php
add_action( 'init', 'create_partners_custom_post_type' );

function create_partners_custom_post_type() 
{
    $labels = [
        'name'                => _x( 'Parnters', 'Post Type General Name', 'ict_camp' ),
        'singular_name'       => _x( 'Partner', 'Post Type Singular Name', 'ict_camp' ),
        'menu_name'           => __( 'Parnters', 'ict_camp' ),
        'parent_item_colon'   => __( 'Parent Partner', 'ict_camp' ),
        'all_items'           => __( 'All Parnters', 'ict_camp' ),
        'view_item'           => __( 'View Partner', 'ict_camp' ),
        'add_new_item'        => __( 'Add New Partner', 'ict_camp' ),
        'add_new'             => __( 'Add New', 'ict_camp' ),
        'edit_item'           => __( 'Edit Partner', 'ict_camp' ),
        'update_item'         => __( 'Update Partner', 'ict_camp' ),
        'search_items'        => __( 'Search Partner', 'ict_camp' ),
        'not_found'           => __( 'Not Found', 'ict_camp' ),
        'not_found_in_trash'  => __( 'Not found in Trash', 'ict_camp' ),
    ];

    $args = [
        'label'               => __( 'Parnters', 'ict_camp' ),
        'description'         => __( 'Parnters', 'ict_camp' ),
        'labels'              => $labels,
        'supports'            => ['title', 'editor', 'excerpt', 'thumbnail', 'revisions'],
        'taxonomies'          => ['category', 'camp_year'],
        'hierarchical'        => false,
        'public'              => true,
        'show_ui'             => true,
        'show_in_menu'        => true,
        'show_in_nav_menus'   => true,
        'show_in_admin_bar'   => true,
        'menu_icon'           => 'dashicons-groups',
        'menu_position'       => 5,
        'can_export'          => true,
        'has_archive'         => true,
        'exclude_from_search' => false,
        'publicly_queryable'  => true,
        'capability_type'     => 'post',
    ];

    register_post_type( 'partners', $args );
}