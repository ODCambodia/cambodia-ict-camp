(function() {
       tinymce.PluginManager.add('display_posttype_mce_button', function( editor, url ) {
           editor.addButton('display_posttype_mce_button', {
                   text: 'Get Post Shortcode',
                   icon: false,
                   onclick: function() {
                     // change the shortcode as per your requirement
                      editor.insertContent('[display_cpt post_type="post" show_thumbnail=true show_meta=true thumbnail_size="250, 200" show_post_title=true title_headtag="h6" open_new_tab=false show_content=false show_excerpt=true display="inline/list" row_container=true flex_box_row=true custom_link=true no_link_get_permalink=true camp_year="" max_post="5"] <!-- row_container and flex_box_row will work if display=inline-->');
                  }
             });

             QTags.addButton( 'shortcode_cpt', 'Get Post Shortcode', '[display_cpt post_type="post" show_thumbnail=true show_meta=true thumbnail_size="250, 200" show_post_title=true title_headtag="h6" open_new_tab=false show_content=false show_excerpt=true display="inline/list" row_container=true flex_box_row=true custom_link=true no_link_get_permalink=true camp_year="" max_post="5"]<!-- row_container and flex_box_row will work if display=inline-->', '', '', 'Add shortcode to display posts', '', '' );
       });
})();
