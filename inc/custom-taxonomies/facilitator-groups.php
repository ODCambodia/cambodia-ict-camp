<?php
add_action( 'init', 'create_facilitator_groups_hierarchical_taxonomy', 0 );

function create_facilitator_groups_hierarchical_taxonomy()
{
	$labels = [
		'name'              => _x( 'Groups', 'taxonomy general name' ),
		'single_name'       => _x( 'Group', 'taxonomy singular name' ),
		'search_items'      => __( 'Search Group' ),
		'all_items'         => __( 'All Group' ),
		'parent_item'       => __( 'Parent Group' ),
		'parent_item_colon' => __( 'Parent Group:' ),
		'edit_item'         => __( 'Edit Group' ),
		'update_item'       => __( 'Update Group' ),
		'add_new_item'      => __( 'Add New Group' ),
		'new_item_name'     => __( 'New Group Name' ),
		'menu_name'         => __( 'Groups' ),
	];

	register_taxonomy( 'facilitator_group', ['sessions'], [
	    'hierarchical'      => true,
	    'labels'            => $labels,
	    'show_ui'           => true,
	    'show_admin_column' => true,
	    'query_var'         => true,
	    'rewrite'           => [ 'slug' => 'facilitator_group' ]
	]);
}