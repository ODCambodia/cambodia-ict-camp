<?php
add_action( 'init', 'create_news_sources_hierarchical_taxonomy', 0 );

function create_news_sources_hierarchical_taxonomy()
{
	$labels = [
		'name'              => _x( 'News Sources', 'taxonomy general name' ),
		'single_name'       => _x( 'News Source', 'taxonomy singular name' ),
		'search_items'      => __( 'Search News Sources' ),
		'all_items'         => __( 'All News Sources' ),
		'parent_item'       => __( 'Parent News Source' ),
		'parent_item_colon' => __( 'Parent News Source:' ),
		'edit_item'         => __( 'Edit News Source' ),
		'update_item'       => __( 'Update News Source' ),
		'add_new_item'      => __( 'Add News Source' ),
		'new_item_name'     => __( 'New News Source' ),
		'menu_name'         => __( 'News Sources' ),
	];

	register_taxonomy( 'news_source', ['news'], [
	    'hierarchical'      => true,
	    'labels'            => $labels,
	    'show_ui'           => true,
	    'show_admin_column' => true,
	    'query_var'         => true,
	    'rewrite'           => [ 'slug' => 'news_source' ]
	]);
}
