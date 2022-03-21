<?php
add_action( 'init', 'create_session_types_hierarchical_taxonomy', 0 );

function create_session_types_hierarchical_taxonomy()
{
	$labels = [
		'name'              => _x( 'Types', 'taxonomy general name' ),
		'single_name'       => _x( 'Type', 'taxonomy singular name' ),
		'search_items'      => __( 'Search Type' ),
		'all_items'         => __( 'All Type' ),
		'parent_item'       => __( 'Parent Type' ),
		'parent_item_colon' => __( 'Parent Type:' ),
		'edit_item'         => __( 'Edit Type' ),
		'update_item'       => __( 'Update Type' ),
		'add_new_item'      => __( 'Add New Type' ),
		'new_item_name'     => __( 'New Type Name' ),
		'menu_name'         => __( 'Types' ),
	];

	register_taxonomy( 'session_type', ['sessions'], [
	    'hierarchical'      => true,
	    'labels'            => $labels,
	    'show_ui'           => true,
	    'show_admin_column' => true,
	    'query_var'         => true,
	    'rewrite'           => [ 'slug' => 'session_type' ]
	]);
}