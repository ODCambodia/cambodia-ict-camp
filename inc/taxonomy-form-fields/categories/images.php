<?php
add_action( 'category_add_form_fields', 'add_category_image_create_form_field' );
add_action( 'create_category', 'save_category_image_form_field_data' );

add_action( 'category_edit_form_fields', 'add_category_image_edit_form_field' );
add_action( 'edited_category', 'save_category_image_form_field_data' );

function add_category_image_create_form_field( $theme )
{
    wp_nonce_field( 'save_category_image_form_field_data', 'category_image_form_field_nonce' );
?>
    <div class="form-field">
        <label for="category_image_edit_form_field"><?php _e( 'Theme Image', 'ict_camp' ); ?></label>
        <input type="text" name="category_image_edit_form_field" id="category_image_edit_form_field" class="meta-image regular-text" value="<?php echo $theme_image; ?>" readonly>
        <input type="button" class="button-primary" value="Browse" id="image-upload">
        <br/>
        <span class="description"><?php _e( 'Select a image for the theme.', 'ict_camp' ); ?></span>
    </div>
<?php
}

function add_category_image_edit_form_field( $theme )
{
    wp_nonce_field( 'save_category_image_form_field_data', 'category_image_form_field_nonce' );

    $theme_id = $theme->term_id;
    $theme_image = get_term_meta( $theme_id, '_category_image_value_key', true );
    ?>

    <tr class="form-field">
        <th><label for="category_image_edit_form_field"><?php _e( 'Theme Image', 'ict_camp' ); ?></label></th>
        <td>
            <input type="text" name="category_image_edit_form_field" id="category_image_edit_form_field" class="meta-image regular-text" value="<?php echo $theme_image; ?>" style="width: 83%" readonly>
            <input type="button" class="button-primary" value="Browse" id="image-upload">
            <br/>
            <img class="image-preview" src="<?php echo $theme_image; ?>" style="max-width: 250px;">
            <p class="description"><?php _e( 'Select a color for the theme.', 'ict_camp' ); ?></p>
        </td>
    </tr>
<?php
}

function save_category_image_form_field_data( $theme_id )
{
    if( ! isset( $_POST['category_image_form_field_nonce'] ) ) {
        return;
    }

    if( ! wp_verify_nonce( $_POST['category_image_form_field_nonce'], 'save_category_image_form_field_data' ) ) {
        return;
    }

    if( ! current_user_can( 'manage_categories', $theme_id ) ) {
        return;
    }

    if( ! isset( $_POST['category_image_edit_form_field'] ) ) {
        return;
    }

    $theme_image = $_POST['category_image_edit_form_field'];
    var_dump($theme_image);

    update_term_meta( $theme_id, '_category_image_value_key', $theme_image );
}
?>
