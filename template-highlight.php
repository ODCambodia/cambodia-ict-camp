<?php

/**
 * Template Name: Highlight Template
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
            </header>
        </div>
    </div>
<?php
}
?>

<div id="content" class="site-content container clearfix">
    <div class="primary" class="content-area">
        <main id="main" class="site-main" role="main">
            <?php
            $args = [
                'hide_empty' => 1,
                'orderby'    => 'name',
                'parent'     => 0,
                'exclude'    => 1
            ];

            $themes = get_categories($args);

            if (!empty($themes) && !is_wp_error($themes)) {

                foreach ($themes as $theme) {
            ?>
                    <div id="<?php echo $theme->slug; ?>">
                        <div class="section-title">
                            <h2 class="text-center"><?php _e($theme->name); ?></h2>
                        </div>
                        <div class="setcion-body margin-top-3-em">
                            <?php
                            if ($theme->description != '') {
                            ?>
                                <p class="text-center padding-bottom-1-em"><?php _e($theme->description) ?></p>
                            <?php
                            }
                            ?>

                            <?php
                            $args = [
                                'post_type' => 'presentations',
                                'category_name' => $theme->slug
                            ];

                            $slide_presentations = new WP_Query($args);

                            if ($slide_presentations->have_posts()) {
                                $counter = 1;
                                $wrap_count = 4;

                                echo '<div class="row flex-box-row">';

                                while ($slide_presentations->have_posts()) {
                                    $slide_presentations->the_post();

                                    $attributes = [
                                        'title' => get_the_title(),
                                        'class' => 'aligncenter margin-bottom-10-px'
                                    ];

                                    $profile = get_the_post_thumbnail($post->ID, [600, 600], $attributes);
                                    $responsive_profile = preg_replace('/(width|height)="\d*"\s/', '', $profile);
                            ?>
                                    <div class="col-xs-12 col-sm-4 col-md-4">
                                        <?php echo $responsive_profile; ?>
                                        <div class="text-center margin-bottom-10-px">
                                            <h3 class="inline">
                                                <p><a href=""><i class="fa fa-download"></i></a></p>
                                                <?php the_content(); ?>
                                            </h3>
                                            <em><?php _e(get_the_excerpt()); ?></em>
                                        </div>
                                    </div>
                            <?php
                                }
                                echo '</div>';
                            }
                            ?>
                        </div>
                    </div>
            <?php
                }
            } else {
                get_template_part('template-parts/content', 'none');
            }
            ?>
        </main>
    </div>
</div>

<?php
get_footer();
