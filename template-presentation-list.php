<?php 
/**
 * Template Name: Presentation List Template
 */

get_header();

global $event_star_customizer_all_values;

$event_star_hide_front_page_header = $event_star_customizer_all_values['event-star-hide-front-page-header'];

if(
    ( is_front_page() && 1 != $event_star_hide_front_page_header )
    || !is_front_page()
) {
    ?>
    <div class="wrapper inner-main-title">
        <div id="particles-js"></div>
        <div class="container">
            <header class="entry-header init-animate">
                <?php
                the_title( '<h1 class="entry-title">', '</h1>' );

                if( 1 == $event_star_customizer_all_values['event-star-show-breadcrumb'] ) {
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
    <div id="primary" class="content-area col-sm-8">
        <main id="main" class="site-main" role="main">
            <?php
            $args = [
                'taxonomy' => 'category',
                'orderby'  => 'slug',
                'order'    => 'ASC',
            ];

            $presentation_terms = get_terms( $args );
            $count_post_in_posttype = 0;

            if ( ! empty( $presentation_terms ) && ! is_wp_error( $presentation_terms ) ) {
                $page_camp_year = get_the_terms( $post->ID, 'camp_year' );
                $camp_year = $page_camp_year[0]->name;

                foreach ( $presentation_terms as $presentation_term ) {
                    wp_reset_query();

                    $args = [
                        'post_type'         => 'presentations',
                        'posts_per_page'    => -1,
                        'orderby'           => 'post_name',
                        'order'             => 'ASC',
                        'camp_year'         => $camp_year,
                        'tax_query'         => [
                            [
                                'taxonomy'  => 'category',
                                'field'     => 'slug',
                                'terms'     => $presentation_term->slug,
                            ]
                        ]
                    ];

                    $presentation_group = new WP_Query( $args );

                    if ( $presentation_group->have_posts() ) {
                    ?>
                        <div class="section" id="<?php echo $presentation_term->slug; ?>">
                            <div class="section-title-left">
                                <h2><?php _e( $presentation_term->name ); ?></h2>
                            </div>

                            <div class="setcion-body">
                                <?php if ( isset( $presentation_term->description ) ) :?>
                                    <p class="width-80-percent">
                                        <?php _e( $presentation_term->description ); ?>
                                    </p>
                                <?php
                                endif;

                                $counter = 1;
                                $wrap_count = 6;

                                while ( $presentation_group->have_posts() ) {
                                    $presentation_group->the_post();

                                    if ( $counter%$wrap_count == 1 ) {
                                        echo '<div class="no-margin">';
                                    }

                                    $count_post_in_posttype++;
                                    $order_number = "P" . $count_post_in_posttype . ". ";
                                    $source_link = get_post_meta( $post->ID, '_custom_link_value_key', true );
                                    
                                    get_ictcamp_template(
                                        'content-list-1-col',
                                        array(
                                            'post'                         => get_post(),
                                            'show_meta'                    => false,
                                            'show_order_number'            => $order_number,
                                            'show_excerpt'                 => false,
                                            'custom_link'                  => $source_link,
                                            'no_custom_link_get_permalink' => false
                                        ),
                                        true
                                    );
                                    //get_template_part( 'inc/template-parts/content', 'list-1-col' );

                                    if( ( $counter%$wrap_count == 0 ) || ( $counter == $presentation_group->post_count ) ) {
                                        echo '</div>';
                                    }

                                    $counter++;
                                }
                                ?>
                            </div>
                        </div>
                    <?php
                    }
                }
            } else {
                get_template_part( 'template-parts/content', 'none' );
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