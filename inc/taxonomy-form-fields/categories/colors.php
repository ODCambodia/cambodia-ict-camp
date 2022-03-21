<?php
add_action( 'category_add_form_fields', 'add_category_color_create_form_field' );
add_action( 'create_category', 'save_category_color_form_field_data' );

add_action( 'category_edit_form_fields', 'add_category_color_edit_form_field' );
add_action( 'edited_category', 'save_category_color_form_field_data' );

function add_category_color_create_form_field( $theme )
{
	wp_nonce_field( 'save_category_color_form_field_data', 'category_color_form_field_nonce' );
?>
	<div class="form-field">
		<label for="category_color_edit_form_field"><?php _e( 'Theme Color', 'ict_camp' ); ?></label> 
			 
		<input type="color" name="category_color_edit_form_field" id="category_color_edit_form_field" value="">
		<br/>
		<span class="description"><?php _e( 'Select a color for the theme.', 'ict_camp' ); ?></span>
	</div>
<?php
}

function add_category_color_edit_form_field( $theme )
{
	wp_nonce_field( 'save_category_color_form_field_data', 'category_color_form_field_nonce' );

	$theme_id = $theme->term_id;
	$theme_color = get_term_meta( $theme_id, '_category_color_value_key', true );
	?>

	<tr class="form-field">
		<th><label for="category_color_edit_form_field"><?php _e( 'Theme Color', 'ict_camp' ); ?></label></th>	 
		<td>	 
			<input type="color" name="category_color_edit_form_field" id="category_color_edit_form_field" value="<?php echo esc_attr( $theme_color ); ?>">
			<br/>
			<p class="description"><?php _e( 'Select a color for the theme.', 'ict_camp' ); ?></p>
		</td>
	</tr>
<?php	
}

function save_category_color_form_field_data( $theme_id )
{
	if( ! isset( $_POST['category_color_form_field_nonce'] ) ) {
		return;
	}

	if( ! wp_verify_nonce( $_POST['category_color_form_field_nonce'], 'save_category_color_form_field_data' ) ) {
		return;
	}

	if( ! current_user_can( 'manage_categories', $theme_id ) ) {
		return;
	}

	if( ! isset( $_POST['category_color_edit_form_field'] ) ) {
		return;
	}

	$theme_color = $_POST['category_color_edit_form_field'];

	update_term_meta( $theme_id, '_category_color_value_key', $theme_color );
}