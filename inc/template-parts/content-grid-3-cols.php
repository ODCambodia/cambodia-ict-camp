<?php
global $event_star_customizer_all_values;

$content_from          = $event_star_customizer_all_values['event-star-blog-archive-content-from'];
$custom_link           = isset( $params['custom_link'] ) ? $params['custom_link'] : null;
$extra_classes         = isset( $params['extra_classes'] ) ? $params['extra_classes'] : null;
$max_num_tags          = isset( $params['max_num_tags'] ) ? $params['max_num_tags'] : null;
$no_link_get_permalink = isset( $params['no_custom_link_get_permalink'] ) ? $params['no_custom_link_get_permalink'] : false;
$order                 = isset( $params['order'] ) ? $params['order'] : 'publish_date';
$post                  = isset( $params['post'] ) ? $params['post'] : null;
$show_tags             = isset( $params['show_tags'] ) ? $params['$show_tags'] : null;
$show_meta             = isset( $params['show_meta'] ) ? $params['show_meta'] : true;
$show_order_number     = isset( $params['show_order_number'] ) ? $params['show_order_number'] : '';
$show_excerpt          = isset( $params['show_excerpt'] ) ? $params['show_excerpt'] : false;
$show_thumbnail        = isset( $params['show_thumbnail'] ) ? $params['show_thumbnail'] : false;
$thumbnail_size        = isset( $params['thumbnail_size'] ) ? $params['thumbnail_size'] : 'full';

$no_blog_image         = '';
?>

<div class="col-sm-4">
    <article id="post-<?php the_ID(); ?>" <?php post_class( 'no-border-bottom' ) ?>>
        <div class="content-wrapper">
            <?php
            if ( $show_thumbnail ) :
                if ( has_post_thumbnail() && 'disable' != $thumbnail_size ) :
                    $feature_image_url = get_the_post_thumbnail_url( $post->ID, $thumbnail_size );
                    ?>

                    <div class="image-wrap">
                        <div class="post-thumb">
                            <a href="<?php the_permalink(); ?>">
                                <div class="blog-feature-image" style="background-image: url( '<?php echo $feature_image_url; ?>' );"></div>
                            </a>
                        </div>
                    </div>
                <?php
                else :
                    $no_blog_image = 'no-image';
                endif;
            else :
                $no_blog_image = 'no-image';
            endif;
            ?>

            <div class="entry-content <?php echo $no_blog_image; ?>">
                <div class="entry-header-title">
                    <?php 
                    if ( $no_link_get_permalink ) {
                        $link = $custom_link ? $custom_link : get_permalink();
                        the_title( sprintf( '<h4 class="entry-title"><a class="txtcolor-dgreen" href="%s" rel="bookmark">', esc_url( $link ) ), '</a></h4>' );
                    } else {
                        if ( $custom_link ) {
                            the_title( sprintf( '<h4 class="entry-title"><a class="txtcolor-dgreen" href="%s" rel="bookmark">', esc_url( $custom_link ) ), '</a></h4>' );
                        } else {
                            the_title( sprintf( '<h4 class="entry-title">', esc_url( $custom_link ) ), '</h4>' );
                        }
                    }
                    ?>
                </div>
                
                <?php
                if ( $show_meta ) {
                ?>
                    <div class="posts-meta-div">
                        <?php echo_ictcamp_post_meta( get_post(), array( 'date', 'tags', 'sources' ) ); ?>
                    </div>
                <?php
                }

                if ( $show_excerpt ) {
                    the_excerpt();
                } else {
                    if ( 'content' == $content_from ) {
                        the_content( sprintf(
                        /* translators: %s: Name of current post. */
                            wp_kses( __( 'Continue reading %s <span class="meta-nav">&rarr;</span>', 'ict_camp' ), array( 'span' => array( 'class' => array() ) ) ),
                            the_title( '<span class="screen-reader-text">"', '"</span>', false )
                        ) );

                        wp_link_pages( array(
                            'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'ict_camp' ),
                            'after'  => '</div>',
                        ) );
                    } else {
                        the_content();
                    }
                }
                ?>
            </div><!-- .entry-content -->
        </div>
    </article>
</div>