<?php
get_header();

global $event_star_customizer_all_values;

$event_star_hide_front_page_header = $event_star_customizer_all_values['event-star-hide-front-page-header'];

if( ( is_front_page() && 1 != $event_star_hide_front_page_header ) || !is_front_page() ) {
?>
    <div class="wrapper inner-main-title">
        <div class="container">
            <header class="entry-header init-animate">
                <?php
                the_title( '<h1 class="entry-title">', '</h1>' );
                if( 1 == $event_star_customizer_all_values['event-star-show-breadcrumb'] ){
                    event_star_breadcrumbs();
                }
                ?>
            </header><!-- .entry-header -->
        </div>
    </div>
<?php
}
?>

<div id="content" class="site-content container clearfix">
    <div id="primary" class="content-area">
        <main id="main" class="site-main" role="main">
            <?php
            // while ( have_posts() ) : the_post();
            //     get_template_part( 'template-parts/content', 'page' );
            //     // If comments are open or we have at least one comment, load up the comment template.
            //     if ( comments_open() || get_comments_number() ) :
            //         comments_template();
            //     endif;
            // endwhile; // End of the loop.

            $args = [
                'hide_empty' => 0,
                'orderby'    => 'name',
                'parent'     => 0,
                'exclude'    => 1
            ];

            $themes = get_categories( $args );

            foreach( $themes as $theme ) {
                $theme_color = get_term_meta( $theme->term_id, '_category_color_value_key', true );
            ?>
                <div class="col-xs-12" id="<?php echo $theme->slug; ?>">
                    <h2 style="color: <?php echo esc_attr( $theme_color ); ?>">
                        <?php _e( $theme->name ); ?>
                    </h2>
                    <p><?php _e( $theme->description ); ?></p>
                </div>
            <?php
            }
            ?>
        </main><!-- #main -->
    </div><!-- #primary -->

    <?php
    get_sidebar( 'left' );
    get_sidebar();
    ?>
</div><!-- #content -->

<?php get_footer();
