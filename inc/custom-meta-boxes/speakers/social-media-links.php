<?php
add_action( 'add_meta_boxes', 'create_speakers_social_media_links_meta_box' );
add_action( 'save_post', 'save_speakers_social_media_links_data' );

function create_speakers_social_media_links_meta_box()
{
    add_meta_box( 'speakers_social_media_links', __( 'Social Media Links' ), 'add_speakers_social_media_links_callback', 'speakers', 'advanced' );
}

function add_speakers_social_media_links_callback( $post )
{
    wp_nonce_field( 'save_speakers_social_media_links_data', 'speakers_social_media_links_meta_box_nonce' );

    $value = get_post_meta( $post->ID, '_speakers_social_media_links_value_key', true );

    echo '<lable for="speakers_linkedin_link_field">LinkedIn Link: </lable>';
    echo '<input type="text" id="speakers_linkedin_link_field" name="speakers_linkedin_link_field" value="'. esc_attr( $value ) .'" size="35" />';
}

function save_speakers_social_media_links_data( $post_id )
{
    if( ! isset( $_POST['speakers_social_media_links_meta_box_nonce'] ) ) {
        return;
    }

    if( ! wp_verify_nonce( $_POST['speakers_social_media_links_meta_box_nonce'], 'save_speakers_social_media_links_data' ) ) {
        return;
    }

    if( ! current_user_can( 'edit_post', $post_id ) ) {
        return;
    }

    if( ! isset( $_POST['speakers_linkedin_link_field'] ) ) {
        return;
    }

    $speakers_linked_in_link = esc_url_raw( $_POST['speakers_linkedin_link_field'] );

    update_post_meta( $post_id, '_speakers_social_media_links_value_key', $speakers_linked_in_link );
}
