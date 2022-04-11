<?php
add_action('init', 'create_themes_custom_post_type');

function create_themes_custom_post_type()
{
    $labels = [
        'name'                => _x( 'Camp themes', 'Post Type General Name', 'ict_camp' ),
        'singular_name'       => _x( 'Camp theme', 'Post Type Singular Name', 'ict_camp' ),
        'menu_name'           => __( 'Camp themes', 'ict_camp' ),
        'parent_item_colon'   => __( 'Parent Camp theme', 'ict_camp' ),
        'all_items'           => __( 'All Camp themes', 'ict_camp' ),
        'view_item'           => __( 'View Camp theme', 'ict_camp' ),
        'add_new_item'        => __( 'Add New Camp theme', 'ict_camp' ),
        'add_new'             => __( 'Add New', 'ict_camp' ),
        'edit_item'           => __( 'Edit Camp theme', 'ict_camp' ),
        'update_item'         => __( 'Update Camp theme', 'ict_camp' ),
        'search_items'        => __( 'Search Camp theme', 'ict_camp' ),
        'not_found'           => __( 'Not Found', 'ict_camp' ),
        'not_found_in_trash'  => __( 'Not found in Trash', 'ict_camp' ),
    ];

    $args = [
        'label'               => __( 'camp announcements', 'ict_camp' ),
        'description'         => __( 'camp announcements', 'ict_camp' ),
        'labels'              => $labels,
        'supports'            => ['title', 'editor', 'thumbnail', 'revisions'],
        'taxonomies'          => ['camp_year'],
        'hierarchical'        => true,
        'public'              => true,
        'show_ui'             => true,
        'show_in_menu'        => true,
        'show_in_nav_menus'   => true,
        'show_in_admin_bar'   => true,
        'menu_icon'           => 'dashicons-screenoptions',
        'menu_position'       => null,
        'can_export'          => true,
        'has_archive'         => true,
        'exclude_from_search' => false,
        'publicly_queryable'  => true,
        'capability_type'     => 'post',
    ];

    register_post_type( 'camp-themes', $args );
}
