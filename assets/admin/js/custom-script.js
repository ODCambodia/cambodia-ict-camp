jQuery( document ).ready( function( $ ){

  let mediaUploader;

  $( '#image-upload' ).click( function( e ) {
    e.preventDefault();
    // If the uploader object has already been created, reopen the dialog
      if ( mediaUploader ) {
        mediaUploader.open();
      return;
    }
    // Extend the wp.media object
    mediaUploader = wp.media.frames.file_frame = wp.media({
      title: 'Choose Image',
      button: {
        text: 'Choose Image'
      },
      multiple: false
    });

    // When a file is selected, grab the URL and set it as the text field's value
    mediaUploader.on( 'select', function() {
      let attachment = mediaUploader.state().get( 'selection' ).first().toJSON();
      $( '#category_image_edit_form_field' ).val( attachment.url );
    });
    // Open the uploader dialog
    mediaUploader.open();
  });

});
