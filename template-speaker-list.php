<?php

/**
 * Template Name: Speaker List
 */

get_header();

global $event_star_customizer_all_values;

$event_star_hide_front_page_header = $event_star_customizer_all_values['event-star-hide-front-page-header'];

if (
    (is_front_page() && 1 != $event_star_hide_front_page_header)
    || !is_front_page()
) {
?>
    <div class="wrapper inner-main-title">
        <div id="particles-js"></div>
        <div class="container">
            <header class="entry-header init-animate">
                <?php
                the_title('<h1 class="entry-title">', '</h1>');

                if (1 == $event_star_customizer_all_values['event-star-show-breadcrumb']) {
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
            $page_camp_year = get_the_terms($post->ID, 'camp_year');
            $camp_year = $page_camp_year[0]->name;

            $args = [
                'post_type'         => 'speakers',
                'posts_per_page'    => -1,
                'orderby'           => 'post_name',
                'order'             => 'ASC',
                'camp_year'         => '2018'
            ];

            $speakers = new WP_Query($args);

            if ($speakers->have_posts()) {
            ?>
                <div class="section padding-top-1-em">
                    <div class="setcion-body margin-top-3-em">
                        <?php
                        $counter = 1;
                        $wrap_count = 6;

                        while ($speakers->have_posts()) {
                            $speakers->the_post();

                            if ($counter % $wrap_count == 1) {
                                echo '<div class="row flex-box-row">';
                            }

                            get_template_part('inc/template-parts/speakers/content', 'list');

                            if (($counter % $wrap_count == 0) || ($counter == $speakers->post_count)) {
                                echo '</div>';
                            }

                            $counter++;
                        }
                        ?>
                    </div>
                </div>
            <?php
            } else {
                get_template_part('template-parts/content', 'none');
            }
            ?>
        </main><!-- #main -->
    </div><!-- #primary -->
    <?php
    get_sidebar('left');
    get_sidebar();
    ?>
</div><!-- #content -->

<?php get_footer();
