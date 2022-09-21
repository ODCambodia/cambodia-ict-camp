<?php
global $event_star_customizer_all_values;

$content_from = $event_star_customizer_all_values['event-star-blog-archive-content-from'];
$no_blog_image = '';
?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <div class="content-wrapper">
        <?php
        $thumbnail = $event_star_customizer_all_values['event-star-blog-archive-img-size'];
        if( has_post_thumbnail() && 'disable' != $thumbnail):
            ?>
            <!--post thumbnal options-->
            <div class="image-wrap">
                <div class="post-thumb">
                    <a href="<?php the_permalink(); ?>">
                        <?php the_post_thumbnail( $thumbnail ); ?>
                    </a>
                </div><!-- .post-thumb-->
            </div>
            <?php
        else:
            $no_blog_image = 'no-image';
        endif;
        ?>
        <div class="entry-content <?php echo $no_blog_image?>">
            <?php
            if ( 'post' === get_post_type() ) : ?>
                <header class="entry-header <?php echo $no_blog_image; ?>">
                    <div class="entry-meta">
                        <?php
                        // event_star_cats_lists()
                        ?>
                    </div><!-- .entry-meta -->
                </header><!-- .entry-header -->
            <?php
            endif; ?>
            <div class="entry-header-title">
                <?php the_title( sprintf( '<h2 class="entry-title"><a class="txtcolor-dgreen" href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' ); ?>
            </div>
            <footer class="entry-footer">
                <?php
                $tags = '';
                $sources = '';

                if ( ! is_tag() ) {
                    $tags = 'tags';
                }

                if ( get_post_type() === 'news') {
                    $sources = 'sources';
                }

                echo_ictcamp_post_meta( get_post(), ['date', $tags, $sources] );
                ?>
            </footer><!-- .entry-footer -->
            <?php
            if ( 'content' == $content_from ) :
                the_content( sprintf(
                /* translators: %s: Name of current post. */
                    wp_kses( __( 'Continue reading %s <span class="meta-nav">&rarr;</span>', 'event-star' ), array( 'span' => array( 'class' => array() ) ) ),
                    the_title( '<span class="screen-reader-text">"', '"</span>', false )
                ) );
                wp_link_pages( array(
                    'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'event-star' ),
                    'after'  => '</div>',
                ) );
            else :
                the_excerpt();
            endif;
            ?>
        </div><!-- .entry-content -->
    </div>
</article><!-- #post-## -->
