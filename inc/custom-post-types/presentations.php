<?php
add_action( 'init', 'create_slide_presentation_custom_post_type' );

function create_slide_presentation_custom_post_type()
{
    $labels = [
        'name'                => _x( 'Slide Presentations', 'Post Type General Name', 'ict_camp' ),
        'singular_name'       => _x( 'Slide Presentation', 'Post Type Singular Name', 'ict_camp' ),
        'menu_name'           => __( 'Slide Presentations', 'ict_camp' ),
        'parent_item_colon'   => __( 'Parent Slide Presentation', 'ict_camp' ),
        'all_items'           => __( 'All Slide Presentations', 'ict_camp' ),
        'view_item'           => __( 'View Slide Presentation', 'ict_camp' ),
        'add_new_item'        => __( 'Add New Slide Presentation', 'ict_camp' ),
        'add_new'             => __( 'Add New', 'ict_camp' ),
        'edit_item'           => __( 'Edit Slide Presentation', 'ict_camp' ),
        'update_item'         => __( 'Update Slide Presentation', 'ict_camp' ),
        'search_items'        => __( 'Search Slide Presentation', 'ict_camp' ),
        'not_found'           => __( 'Not Found', 'ict_camp' ),
        'not_found_in_trash'  => __( 'Not found in Trash', 'ict_camp' ),
    ];

    $args = [
        'label'               => __( 'Slide Presentations', 'ict_camp' ),
        'description'         => __( 'Slide Presentations', 'ict_camp' ),
        'labels'              => $labels,
        'supports'            => ['title', 'editor', 'excerpt', 'thumbnail', 'revisions'],
        'taxonomies'          => ['category', 'camp_year'],
        'hierarchical'        => false,
        'public'              => true,
        'show_ui'             => true,
        'show_in_menu'        => true,
        'show_in_nav_menus'   => true,
        'show_in_admin_bar'   => true,
        'menu_icon'           => 'dashicons-media-interactive',
        'menu_position'       => 5,
        'can_export'          => true,
        'has_archive'         => true,
        'exclude_from_search' => false,
        'publicly_queryable'  => true,
        'capability_type'     => 'post',
    ];

    register_post_type( 'presentations', $args );
}
