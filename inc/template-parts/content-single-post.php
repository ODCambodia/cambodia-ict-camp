<?php
global $event_star_customizer_all_values;

$content_from = $event_star_customizer_all_values['event-star-blog-archive-content-from'];

$no_blog_image = '';
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <div class="content-wrapper">

        <div class="entry-content <?php echo $no_blog_image; ?>">
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
                <?php echo_ictcamp_post_meta( get_post(), ['date', 'tags'] ); ?>
            </footer><!-- .entry-footer -->
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