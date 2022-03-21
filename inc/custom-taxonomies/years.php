<?php
add_action( 'init', 'create_camp_years_hierarchical_taxonomy', 0 );

function create_camp_years_hierarchical_taxonomy()
{
	$labels = [
		'name'              => _x( 'Years of Camp', 'taxonomy general name' ),
		'single_name'       => _x( 'Year of Camp', 'taxonomy singular name' ),
		'search_items'      => __( 'Search Years of Camp' ),
		'all_items'         => __( 'All Years of Camp' ),
		'parent_item'       => __( 'Parent Year of Camp' ),
		'parent_item_colon' => __( 'Parent Year of Camp:' ),
		'edit_item'         => __( 'Edit Year of Camp' ),
		'update_item'       => __( 'Update Year of Camp' ),
		'add_new_item'      => __( 'Add New Year of Camp' ),
		'new_item_name'     => __( 'New Year of Camp Name' ),
		'menu_name'         => __( 'Year of Camp' ),
	];

	register_taxonomy( 'camp_year', ['page', 'post', 'sessions', 'partners', 'facilitators', 'organizers', 'donors'], [
	    'hierarchical'      => true,
	    'labels'            => $labels,
	    'show_ui'           => true,
	    'show_admin_column' => true,
	    'query_var'         => true,
	    'rewrite'           => [ 'slug' => 'camp_year' ]
	]);
}
