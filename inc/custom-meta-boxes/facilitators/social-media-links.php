<?php
add_action( 'add_meta_boxes', 'create_facilitators_social_media_links_meta_box' );
add_action( 'save_post', 'save_facilitators_social_media_links_data' );

function create_facilitators_social_media_links_meta_box()
{
	add_meta_box( 'facilitators_social_media_links', __( 'Social Media Links' ), 'add_facilitators_social_media_links_callback', 'facilitators', 'side' );
}

function add_facilitators_social_media_links_callback( $post )
{
	wp_nonce_field( 'save_facilitators_social_media_links_data', 'facilitators_social_media_links_meta_box_nonce' );

	$value = get_post_meta( $post->ID, '_facilitators_social_media_links_value_key', true );

	echo '<lable for="facilitators_linkedin_link_field">LinkedIn Link: </lable>';
	echo '<input type="text" id="facilitators_linkedin_link_field" name="facilitators_linkedin_link_field" value="'. esc_attr( $value ) .'" size="35" />';
}

function save_facilitators_social_media_links_data( $post_id )
{
	if( ! isset( $_POST['facilitators_social_media_links_meta_box_nonce'] ) ) {
		return;
	}

	if( ! wp_verify_nonce( $_POST['facilitators_social_media_links_meta_box_nonce'], 'save_facilitators_social_media_links_data' ) ) {
		return;
	}

	if( ! current_user_can( 'edit_post', $post_id ) ) {
		return;
	}

	if( ! isset( $_POST['facilitators_linkedin_link_field'] ) ) {
		return;
	}

	$facilitators_linked_in_link = esc_url_raw( $_POST['facilitators_linkedin_link_field']);

	update_post_meta( $post_id, '_facilitators_social_media_links_value_key', $facilitators_linked_in_link );
}