<?php
get_header();

global $event_star_customizer_all_values;
?>
<div class="wrapper inner-main-title">
    <div class="container">
        <header class="entry-header init-animate">
            <?php
            if ( is_tag() ) {
                $title = single_tag_title( '', false );
            } elseif ( is_category() ) {
                $title = single_cat_title( '', false );
            } elseif ( is_author() ) {
                $title = '<span class="vcard">' . get_the_author() . '</span>';
            } elseif ( is_tax() ) {
                $title = single_term_title( '', false );
            } elseif ( is_post_type_archive() ) {
                $title = post_type_archive_title( '', false );
            }
            ?>

            <h1 class="page-title"><?php _e( $title ); ?></h1>

            <?php

            the_archive_description( '<div class="taxonomy-description">', '</div>' );

            if( 1 == $event_star_customizer_all_values['event-star-show-breadcrumb'] ){
                event_star_breadcrumbs();
            }
            ?>
        </header><!-- .entry-header -->
    </div>
</div>
<div id="content" class="site-content container clearfix">
    <div id="primary" class="content-area">
        <main id="main" class="site-main" role="main">
            <?php
            if ( have_posts() ) :
                $wrap_count = 3;
                $counter = 1;

                /* Start the Loop */
                while ( have_posts() ) : the_post();

                    if ( $counter%$wrap_count == 1 ) {
                        echo '<div class="row">';
                    }

                    $attributes = [
                        'no_custom_link_get_permalink' => true,
                        'post'                         => get_post(),
                        'show_excerpt'                 => true,
                        'show_meta'                    => true,
                        'show_thumbnail'               => true
                    ];

                    get_ictcamp_template( 'content-grid-3-cols', $attributes, true );

                    if ( $counter%$wrap_count == 0 ) {
                        echo '</div>';
                        echo '<div class="clearfix"></div>';
                    }

                    $counter++;
                endwhile;
                /**
                 * event_star_action_posts_navigation hook
                 * @since Event Star 1.0.0
                 *
                 * @hooked event_star_posts_navigation - 10
                 */
                do_action( 'event_star_action_posts_navigation' );
            else :
                get_template_part( 'template-parts/content', 'none' );

            endif; ?>

        </main><!-- #main -->
    </div><!-- #primary -->
    <?php
    get_sidebar( 'left' );
    get_sidebar();
    ?>
</div><!-- #content -->

<?php get_footer();
