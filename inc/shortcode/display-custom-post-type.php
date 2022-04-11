<?php
// Create shortcode name
// [display_cpt post_type="post" show_thumbnail= true show_meta=true thumbnail_size="250, 200" show_post_title=true title_headtag="h6" item_per_row="1" open_new_tab=false show_content=false show_excerpt=true display="inline/list" flex_box_row=true row_container=true custom_link=true no_link_get_permalink=true camp_year="" max_post="5" camp_year="2018"]
add_shortcode('display_cpt', 'display_custom_post_type');

/**
 * Shortcode for displaying list of custom posts in Gridview or Listview
 * 
 * @param  $atts [List of short code attribute]
 * @return [string]
 */
function display_custom_post_type($atts)
{
    ob_start();

    $pairs = [
        'post_type'             => 'post',
        'show_thumbnail'        => 'true',
        'thumbnail_width'       => '550',
        'thumbnail_height'      => '500',
        'show_post_title'       => 'true',
        'show_meta'             => 'true',
        'title_headtag'         => 'h6',
        'item_per_row'          => '1',
        'open_new_tab'          => 'true',
        'show_excerpt'          => 'true',
        'show_content'          => 'false',
        'display'               => 'list',   // inline/list
        'row_container'         => 'true',   // if display=inline
        'flex_box_row'          => 'true',   // if display=inline
        'custom_link'           => 'true',
        'no_link_get_permalink' => 'true',
        'max_post'              => '5',
        'container_class'       => 'container',
        'camp_year'             => ''
    ];

    $shortcode_atts = shortcode_atts($pairs, $atts);

    $post_types = sanitize_text_field($shortcode_atts['post_type']);

    $post_types = explode(',', $post_types);

    $args = array(
        'post_type'      => $post_types,
        'posts_per_page' => sanitize_text_field($shortcode_atts['max_post']),
        'orderby'        => 'name',
        'order'          => 'DESC',
        'post_status'    => 'publish'
    );

    $camp_year = sanitize_text_field($shortcode_atts['camp_year']) ? sanitize_text_field($shortcode_atts['camp_year']) : date('Y');

    $args['tax_query'] = array(
        array(
            'taxonomy' => 'camp_year',
            'field'    => 'slug',
            'terms'    => $camp_year
        )
    );

    $post_list = '';
    $custom_posts = new WP_Query($args);

    if ($custom_posts->have_posts()) {
        $flex_box_row = (!strcmp(sanitize_text_field($shortcode_atts['flex_box_row']), 'true')) ? 'flex-box-row align-items-center' : '';
        $open_new_tab = (!strcmp(sanitize_text_field($shortcode_atts['open_new_tab']), 'true')) ? ' target="_blank"' : '';

        if (!strcmp(sanitize_text_field($shortcode_atts['display']), 'list')) :
            $post_list .= '<ul>';
        else :
            $post_list .= (!strcmp(sanitize_text_field($shortcode_atts['row_container']), 'true')) ? '<div class="row ' . $flex_box_row . '">' : '';
        endif;

        while ($custom_posts->have_posts()) {
            $custom_posts->the_post();

            $attributes = array(
                'title' => __(get_the_title()),
                'class' => 'img-responsive'
            );

            $thumbnail = get_the_post_thumbnail(get_the_ID(), array((int) sanitize_text_field($shortcode_atts['thumbnail_width']), (int) sanitize_text_field($shortcode_atts['thumbnail_height'])), $attributes);

            $responsive_thumbnail = preg_replace('/(width|height)="\d*"\s/', '', $thumbnail);

            $item_per_row = (int) sanitize_text_field($shortcode_atts['item_per_row']);
            $col_number = 12 / $item_per_row;

            $post_list .= (!strcmp(sanitize_text_field($shortcode_atts['display']), 'list')) ? '<li>' : '<div class="col-xs-12 col-sm-' . $col_number . '">';
            $custom_link = get_post_meta(get_the_ID(), '_custom_link_value_key', true);

            if (!strcmp(sanitize_text_field($shortcode_atts['show_thumbnail']), 'true')) :
                if (!strcmp(sanitize_text_field($shortcode_atts['no_link_get_permalink']), 'true')) :
                    $link = (!strcmp(sanitize_text_field($shortcode_atts['custom_link']), 'true')) ? $custom_link : get_permalink();
                    $post_list .= '<a href="' . $link . '"' . $open_new_tab . '" >';
                    $post_list .=  $responsive_thumbnail;
                    $post_list .= '</a>';
                else :
                    $post_list .=  $responsive_thumbnail;
                endif;
            endif;

            if (!strcmp(sanitize_text_field($shortcode_atts['show_post_title']), 'true')) :
                $post_list .= '<' . sanitize_text_field($shortcode_atts['title_headtag']) . ' class="text-center margin-top-1-em">';

                if (!strcmp(sanitize_text_field($shortcode_atts['no_link_get_permalink']), 'true')) :
                    $link = (!strcmp(sanitize_text_field($shortcode_atts['custom_link']), 'true')) ? $custom_link : get_permalink();
                    $post_list .= '<a href="' . $link . '"' . $open_new_tab . '">' . get_the_title() . '</a>';
                else :
                    $post_list .= get_the_title();
                endif;

                $post_list .= '</' . sanitize_text_field($shortcode_atts['title_headtag']) . '>';
            endif;

            // Show Tags
            if (!strcmp(sanitize_text_field($shortcode_atts['show_meta']), 'true')) :
                $post_list .= '<div class="posts-meta-div">';
                $post_list .= echo_ictcamp_post_meta(get_post(), array('date', 'tags'), '', false);
                $post_list .= '</div>';
            endif;

            // Show Excerpt
            if (!strcmp(sanitize_text_field($shortcode_atts['show_excerpt']), 'true')) : //$show_tags
                $post_list .= '<p>' . get_the_excerpt() . '</p>';
            endif;

            // Show content
            if (!strcmp(sanitize_text_field($shortcode_atts['show_content']), 'true')) :
                $post_list .= '<p>' . get_the_content() . '</p>';
            endif;

            $post_list .= (!strcmp(sanitize_text_field($shortcode_atts['display']), 'list')) ? '</li>' : '</div>';
        }

        if (!strcmp(sanitize_text_field($shortcode_atts['display']), 'list')) {
            $post_list .= '</ul>';
        } else {
            $post_list .= (!strcmp(sanitize_text_field($shortcode_atts['row_container']), 'true')) ? '</div>' : '';
        }
    }
    wp_reset_postdata();

    return $post_list;
}

// Hooks your functions into the correct filters
function display_posttype_add_mce_button()
{
    // Check user permissions
    if (!current_user_can('edit_posts') &&  !current_user_can('edit_pages')) {
        return;
    }

    // Check if WYSIWYG is enabled
    if ('true' == get_user_option('rich_editing')) {
        add_filter('mce_external_plugins', 'display_posttype_add_tinymce_plugin');
        add_filter('mce_buttons', 'display_posttype_register_mce_button');
    }
}
add_action('admin_head', 'display_posttype_add_mce_button');

// Register new button in the editor
function display_posttype_register_mce_button($buttons)
{
    array_push($buttons, 'display_posttype_mce_button');

    return $buttons;
}

// Declare a script for the new button
// the script will insert the shortcode on the click event
function display_posttype_add_tinymce_plugin($plugin_array)
{
    $plugin_array['display_posttype_mce_button'] = get_stylesheet_directory_uri() . '/inc/shortcode/display-posttype-mce-button.js';

    return $plugin_array;
}
