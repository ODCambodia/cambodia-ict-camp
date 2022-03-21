<?php
add_action( 'add_meta_boxes', 'create_custom_link_meta_box' );
add_action( 'save_post', 'save_custom_link_data' );

function create_custom_link_meta_box()
{
	add_meta_box( 'custom_link', __( 'Custom link to' ), 'add_custom_link_callback', array('presentations', 'organizers', 'partners', 'donors'), 'advanced' );
}

function add_custom_link_callback( $post )
{
	wp_nonce_field( 'save_custom_link_data', 'custom_link_meta_box_nonce' );

	$value = get_post_meta( $post->ID, '_custom_link_value_key', true );

	echo '<input type="text" id="custom_link_field" name="custom_link_field" value="'. esc_attr( $value ) .'" size="60" />';
}

function save_custom_link_data( $post_id )
{
	if( ! isset( $_POST['custom_link_meta_box_nonce'] ) ) {
		return;
	}

	if( ! wp_verify_nonce( $_POST['custom_link_meta_box_nonce'], 'save_custom_link_data' ) ) {
		return;
	}

	if( ! current_user_can( 'edit_post', $post_id ) ) {
		return;
	}

	if( ! isset( $_POST['custom_link_field'] ) ) {
		return;
	}

	$custom_links_field = sanitize_text_field( $_POST['custom_link_field'] );

	update_post_meta( $post_id, '_custom_link_value_key', $custom_links_field );
}
