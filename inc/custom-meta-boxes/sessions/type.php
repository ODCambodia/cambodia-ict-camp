<?php
add_action( 'add_meta_boxes', 'create_sessions_type_meta_box' );
add_action( 'save_post', 'save_sessions_type_data' );

function create_sessions_type_meta_box()
{
	add_meta_box( 'sessions_type', 'Type', 'add_sessions_type_callback', 'sessions', 'side' );
}

function add_sessions_type_callback( $post )
{
	wp_nonce_field( 'save_sessions_type_data', 'sessions_type_meta_box_nonce' );

	$value = get_post_meta( $post->ID, '_sessions_type_value_key', true );

	echo '<span class="help-block"><b><i>Session Type</i></b> e.g. Workshop, Lecture</span>';
	echo '<input type="text" id="sessions_type_field" name="sessions_type_field" value="'. esc_attr( $value ) .'" size="35" />';
}

function save_sessions_type_data( $post_id )
{
	if( ! isset( $_POST['sessions_type_meta_box_nonce'] ) ) {
		return;
	}

	if( ! wp_verify_nonce( $_POST['sessions_type_meta_box_nonce'], 'save_sessions_type_data' ) ) {
		return;
	}

	if( ! current_user_can( 'edit_post', $post_id ) ) {
		return;
	}

	if( ! isset( $_POST['sessions_type_field'] ) ) {
		return;
	}

	$speakers_linked_in_link = sanitize_text_field( $_POST['sessions_type_field'] );

	update_post_meta( $post_id, '_sessions_type_value_key', $speakers_linked_in_link );
}