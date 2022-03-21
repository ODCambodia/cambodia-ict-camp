<?php
add_action( 'add_meta_boxes', 'create_speakers_organization_meta_box' );
add_action( 'save_post', 'save_speakers_organization_data' );

function create_speakers_organization_meta_box()
{
    add_meta_box( 'speakers_organization', __( 'Organization' ), 'add_speakers_organization_callback', 'speakers', 'advanced' );
}

function add_speakers_organization_callback( $post )
{
    wp_nonce_field( 'save_speakers_organization_data', 'speakers_organization_meta_box_nonce' );

    $value = get_post_meta( $post->ID, '_speakers_organization_value_key', true );

    echo '<input type="text" id="speakers_organization_field" name="speakers_organization_field" value="'. esc_attr( $value ) .'" size="35" />';
}

function save_speakers_organization_data( $post_id )
{
    if( ! isset( $_POST['speakers_organization_meta_box_nonce'] ) ) {
        return;
    }

    if( ! wp_verify_nonce( $_POST['speakers_organization_meta_box_nonce'], 'save_speakers_organization_data' ) ) {
        return;
    }

    if( ! current_user_can( 'edit_post', $post_id ) ) {
        return;
    }

    if( ! isset( $_POST['speakers_organization_field'] ) ) {
        return;
    }

    $speakers_linked_in_link = sanitize_text_field( $_POST['speakers_organization_field'] );

    update_post_meta( $post_id, '_speakers_organization_value_key', $speakers_linked_in_link );
}
