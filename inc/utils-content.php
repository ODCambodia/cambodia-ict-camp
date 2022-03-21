<?php
/****** Post Meta *******
 * Prints HTML with meta information for the categories, tags and comments.
 */
function echo_ictcamp_post_meta( $the_post, $show_elements = array( 'date', 'categories', 'tags', 'sources' ), $order = "metadata_created", $echo = true, $max_num_cats = null, $max_num_tags = null)
{
    global $post;
    $post = $the_post;
    $post_meta = '';
    $post_meta .= '<div class="post-meta">';
    $post_meta .= '<ul>';

    // Show date and time
    if ( in_array( 'date', $show_elements ) ) :
        $post_meta .= '<li class="date">';

        if ( $order == 'metadata_modified' ) :
            $post_meta .= '<i class="fa fa-pencil"></i> ';
            if ( ictcamp_localize_manager()->get_current_language() == 'km' ) {
                $post_meta .= ictcamp_localize_manager()->khmer_date( get_the_modified_time( 'j.m.Y' ) );
            } else {
                $post_meta .= get_the_modified_time( 'j F Y' );
            }
        else :
            $post_meta .= '<i class="fa fa-calendar-check-o"></i> ';
            if ( ictcamp_localize_manager()->get_current_language() == 'km' ) {
                $post_meta .= ictcamp_localize_manager()->khmer_date( get_the_time( 'j.m.Y' ) );
            } else {
                $post_meta .= get_the_date( 'j F Y' );
            }
        endif;

        $post_meta .='</li>';
    endif;

    // Show sources
    if ( in_array( 'sources', $show_elements ) ) :
        if ( taxonomy_exists( 'news_source' ) && isset( $post ) ) {
            $terms_news_source = get_the_terms( $post->ID, 'news_source' );

            if ( $terms_news_source && ! is_wp_error( $terms_news_source ) ) {
                if ( $terms_news_source ) {
                    $news_sources = '';

                    foreach ( $terms_news_source as $term ) {
                        $term_link = get_term_link( $term, 'news_source' );

                        if (is_wp_error($term_link)) {
                            continue;
                        }

                        //We successfully got a link. Print it out.
                        $news_sources .= '<a href="' . $term_link . '">' . $term->name . '</a>, ';
                        if ( isset($news_sources ) ):
                            $post_meta .= '<li class="news-source">';
                            $post_meta .= '<i class="fa fa-chain"></i> ';
                            $post_meta .= substr( $news_sources, 0, -2 );
                            $post_meta .= '</li> ';
                        endif;
                    }
                }
            }
        }
    endif;

    // Show categories
    if ( in_array( 'categories',$show_elements ) && ! empty( get_the_category() ) ) :
        $category_list = wp_get_post_categories( $post->ID,array( 'fields' => 'all_with_object_id' ) );
        
        if ( isset( $max_num_cats ) && $max_num_cats > 0 ) :
            $category_list = array_splice( $category_list, 0, $max_num_cats );
        endif;

        if ( ! empty( $category_list ) ):
            $post_meta .= '<li class="categories">';
            $post_meta .= '<i class="fa fa-folder-o"></i> ';

            foreach ( $category_list as $category ) :
                $post_meta .= '<a href="' . get_category_link( $category->term_id ) . '?queried_post_type=' . get_post_type() . '">' . $category->name . '</a>';

                if ( $category != end( $category_list ) ):
                    $post_meta .= " / ";
                endif;
            endforeach;

            $post_meta .= '</li>';
        endif;
    endif;

    // Show tags
    if ( in_array( 'tags', $show_elements ) ) :
        $tag_list = get_the_tags( $post->ID );

        if ( is_array( $tag_list ) && isset( $max_num_tags ) && $max_num_tags > 0 ) :
            $tag_list = array_splice( $tag_list,0,$max_num_tags );
        endif;
        
        if ( ! empty( $tag_list ) ) :
            $post_meta .= '<li class="tags">';
            $post_meta .= '<i class="fa fa-tags"></i> ';

            foreach( $tag_list as $tag ) :
                $post_meta .= '<a href="' . get_tag_link( $tag->term_id ) . '?queried_post_type=' . get_post_type() . '">' . $tag->name . '</a>';
                if ( $tag != end( $tag_list ) ):
                    $post_meta .= " / ";
                endif;
            endforeach;

            $post_meta .= '</li>';
        endif;
    endif;

    // Show comment section
    if ( in_array( 'comment', $show_elements ) ):
        if ( ! is_single() && ! post_password_required() && ( comments_open() || get_comments_number() ) ) :
            $post_meta .= '<span class="comments-link"><i class="fa fa-comment-o"></i> ';
           	comments_popup_link( esc_html__( 'Leave a comment', 'ict_camp' ), esc_html__( '1 Comment', 'ict_camp' ), esc_html__( '% Comments', 'ict_camp' ) );
            $post_meta .= '</span>';
        endif;
    endif;

    $post_meta .= '</ul>';
    $post_meta .= '</div>';

    if ( $echo ):
        echo $post_meta;
    else :
        return $post_meta;
    endif;
}

/**
 * Load a component into a template while supplying data.
 *
 * @param   string    $slug       The slug name for the generic template.
 * @param   array     $params     An associated array of data that will be extracted into the templates scope
 * @param   bool      $output     Whether to output component or return as string.
 * 
 * @return  string
 */
function get_ictcamp_template( $slug, array $params = array(), $output = true ) {
    if ( ! $output ) {
        ob_start();
    }

    if ( ! $template_file = locate_template( "inc/template-parts/{$slug}.php", false, false ) ) {
        trigger_error( sprintf( __( 'Error locating %s for inclusion', 'sage' ), $slug ), E_USER_ERROR);
    }

    extract( $params, EXTR_SKIP );

    require( $template_file );

    if ( ! $output ) {
        return ob_get_clean();
    }
}
