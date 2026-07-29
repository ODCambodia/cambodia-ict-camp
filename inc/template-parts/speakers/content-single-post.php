<?php
global $event_star_customizer_all_values;

$attributes = [
    'title' => get_the_title(),
    'class' => 'aligncenter img-circle margin-bottom-10-px',
];

$content_from = $event_star_customizer_all_values['event-star-blog-archive-content-from'];

$profile = get_the_post_thumbnail( $post->ID, [200, 200], $attributes );
$responsive_profile = preg_replace( '/(width|height)="\d*"\s/', '', $profile );
$speaker_linked_in_link = get_post_meta( $post->ID, '_speakers_social_media_links_value_key', true );
$speaker_expertise = get_post_meta( $post->ID, '_speakers_expertise_value_key', true );
$speaker_organization = get_post_meta( $post->ID, '_speakers_organization_value_key', true );
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <div class="content-wrapper">

        <div class="entry-content" style="text-align: center">
            <?php if ( 'post' === get_post_type() ) : ?>
                <header class="entry-header">
                    <div class="entry-meta">
                        <?php
                        // event_star_cats_lists()
                        ?>
                    </div>
                </header>
            <?php endif; ?>
            
            <div class="row" style="width: 20vw; margin: auto;">
                <?php echo $responsive_profile; ?>
            </div>

            <div class="entry-header-title">
                <?php the_title( sprintf( '<h2 class="entry-title" style="margin-right: 0;">' ), '</h2>' ); ?>
                <p><?php _e( $speaker_expertise ); ?></p>
                <p><?php _e( $speaker_organization ); ?></p>
            </div>
            
            <?php
            if ( 'content' == $content_from ) :
                the_content( sprintf(
                    /* translators: %s: Name of current post. */
                    wp_kses( __( 'Continue reading %s <span class="meta-nav">&rarr;</span>', 'ict_camp' ), array( 'span' => array( 'class' => array() ) ) ),
                    the_title( '<span class="screen-reader-text">"', '"</span>', false )
                ) );
                wp_link_pages( array(
                    'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'ict_camp' ),
                    'after'  => '</div>',
                ) );
            else :
                the_content();
            endif;
            ?>
        </div><!-- .entry-content -->

        <div class="clearfix"></div>
    </div>
</article><!-- #post-## -->