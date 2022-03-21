<?php
add_action( 'add_meta_boxes', 'create_facilitators_organization_meta_box' );
add_action( 'save_post', 'save_facilitators_organization_data' );

function create_facilitators_organization_meta_box()
{
	add_meta_box( 'facilitators_organization', __( 'Organization' ), 'add_facilitators_organization_callback', 'facilitators', 'side' );
}

function add_facilitators_organization_callback( $post )
{
	wp_nonce_field( 'save_facilitators_organization_data', 'facilitators_organization_meta_box_nonce' );

	$value = get_post_meta( $post->ID, '_facilitators_organization_value_key', true );

	echo '<input type="text" id="facilitators_organization_field" name="facilitators_organization_field" value="'. esc_attr( $value ) .'" size="35" />';
}

function save_facilitators_organization_data( $post_id )
{
	if( ! isset( $_POST['facilitators_organization_meta_box_nonce'] ) ) {
		return;
	}

	if( ! wp_verify_nonce( $_POST['facilitators_organization_meta_box_nonce'], 'save_facilitators_organization_data' ) ) {
		return;
	}

	if( ! current_user_can( 'edit_post', $post_id ) ) {
		return;
	}

	if( ! isset( $_POST['facilitators_organization_field'] ) ) {
		return;
	}

	$facilitators_linked_in_link = sanitize_text_field( $_POST['facilitators_organization_field'] );

	update_post_meta( $post_id, '_facilitators_organization_value_key', $facilitators_linked_in_link );
}