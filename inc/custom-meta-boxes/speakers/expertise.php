<?php
add_action( 'add_meta_boxes', 'create_speakers_expertise_meta_box' );
add_action( 'save_post', 'save_speakers_expertise_data' );

function create_speakers_expertise_meta_box()
{
    add_meta_box( 'speakers_expertise', __( 'Expertise' ), 'add_speakers_expertise_callback', 'speakers', 'advanced' );
}

function add_speakers_expertise_callback( $post )
{
    wp_nonce_field( 'save_speakers_expertise_data', 'speakers_expertise_meta_box_nonce' );

    $value = get_post_meta( $post->ID, '_speakers_expertise_value_key', true );

    echo '<input type="text" id="speakers_expertise_field" name="speakers_expertise_field" value="'. esc_attr( $value ) .'" size="35" />';
}

function save_speakers_expertise_data( $post_id )
{
    if( ! isset( $_POST['speakers_expertise_meta_box_nonce'] ) ) {
        return;
    }

    if( ! wp_verify_nonce( $_POST['speakers_expertise_meta_box_nonce'], 'save_speakers_expertise_data' ) ) {
        return;
    }

    if( ! current_user_can( 'edit_post', $post_id ) ) {
        return;
    }

    if( ! isset( $_POST['speakers_expertise_field'] ) ) {
        return;
    }

    $speakers_linked_in_link = sanitize_text_field( $_POST['speakers_expertise_field'] );

    update_post_meta( $post_id, '_speakers_expertise_value_key', $speakers_linked_in_link );
}
