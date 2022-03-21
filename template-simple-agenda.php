<?php
/**
 * Template Name: Simple Agenda Template
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
    <div id="primary" class="content-area">
        <main id="main" class="site-main" role="main">
            <?php
            if( have_posts() ) {
                while( have_posts() ) {
                    the_post();

                    the_content();
                }
            }

            $taxonomy = 'camp_year';
            $args = [
                'taxonomy'   => $taxonomy,
                'parent'     => 0,
                'hide_empty' => false
            ];
            $years = get_terms( $args );

            foreach ( $years as $year ) {
                if ( $year->name == date('Y') ) {
                    $days = get_terms( $taxonomy, [ 'child_of' => $year->term_id ] );
                    ?>

                    <ul class="nav nav-tabs nav-justified no-margin" role="tab-list">
                        <?php
                        $counter = 0;
                        $class_active = 'active';

                        foreach ( $days as $day ) {
                            if ( $day->count > 0 ) {
                                if( $counter != 0 ) {
                                    $class_active = '';
                                } else {
                                    $day_active_in = $day->slug;
                                }
                                ?>

                                <li class="<?php echo $class_active; ?>" role="presentation">
                                    <a href="<?php echo get_site_url() . '#' . $day->slug; ?>" aria-controls="<?php echo $day->slug; ?>" role="tab" data-toggle="tab">
                                        <?php _e( $day->name ); ?>
                                    </a>
                                </li>
                                <?php
                                $counter++;
                            }
                        }
                        ?>
                    </ul>
                <?php
                }
            }
            ?>

            <div class="tab-content">
                <?php
                $args = [
                    'post_type'    => 'sessions',
                    'tax_query'    => [
                            'taxonomy' => $taxonomy,
                            'field'    => 'term_id',
                            'terms'    => $day->term_id
                        ]
                    ];

                $sessions = new WP_Query( $args );

                while( $sessions->have_posts() ) {
                    $sessions->the_post();

                    $terms = wp_get_post_terms( $post->ID, $taxonomy );

                    foreach( $terms as $term ) {
                        if( $term->parent != 0 ) {

                            if( strcmp($term->slug, $day_active_in) == 0 ) {
                                $class_active_in = 'active in';
                            } else {
                                $class_active_in = '';
                            }
                            ?>
                            <div role="tabpanel" class="tab-pane fade <?php echo $class_active_in; ?>" id="<?php echo $term->slug; ?>">
                                <h3><?php _e( $term->name ); ?></h3>
                                <?php echo $post->post_content; ?>
                            </div>
                        <?php
                        }
                    }
                }
                ?>
            </div>
        </main>
    </div>
</div>

<?php get_footer();