<?php
add_action( 'add_meta_boxes', 'create_facilitators_expertise_meta_box' );
add_action( 'save_post', 'save_facilitators_expertise_data' );

function create_facilitators_expertise_meta_box()
{
	add_meta_box( 'facilitators_expertise', __( 'Expertise' ), 'add_facilitators_expertise_callback', 'facilitators', 'side' );
}

function add_facilitators_expertise_callback( $post )
{
	wp_nonce_field( 'save_facilitators_expertise_data', 'facilitators_expertise_meta_box_nonce' );

	$value = get_post_meta( $post->ID, '_facilitators_expertise_value_key', true );

	echo '<input type="text" id="facilitators_expertise_field" name="facilitators_expertise_field" value="'. esc_attr( $value ) .'" size="35" />';
}

function save_facilitators_expertise_data( $post_id )
{
	if( ! isset( $_POST['facilitators_expertise_meta_box_nonce'] ) ) {
		return;
	}

	if( ! wp_verify_nonce( $_POST['facilitators_expertise_meta_box_nonce'], 'save_facilitators_expertise_data' ) ) {
		return;
	}

	if( ! current_user_can( 'edit_post', $post_id ) ) {
		return;
	}

	if( ! isset( $_POST['facilitators_expertise_field'] ) ) {
		return;
	}

	$facilitators_linked_in_link = sanitize_text_field( $_POST['facilitators_expertise_field'] );

	update_post_meta( $post_id, '_facilitators_expertise_value_key', $facilitators_linked_in_link );
}