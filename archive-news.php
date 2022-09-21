<?php
get_header();

global $event_star_customizer_all_values;
?>
<div class="wrapper inner-main-title">
    <div id="particles-js"></div>
    <div class="container">
        <header class="entry-header init-animate">
            <?php $title = post_type_archive_title('', false); ?>

            <h1 class="page-title"><?php _e($title, 'ict_camp'); ?></h1>

            <?php
            if (1 == $event_star_customizer_all_values['event-star-show-breadcrumb']) {
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
            if (have_posts()) :
                $wrap_count = 3;
                $counter = 1;

                /* Start the Loop */
                while (have_posts()) : the_post();

                    if ($counter % $wrap_count == 1) {
                        echo '<div class="row">';
                    }

                    $attributes = [
                        'custom_link'           => true,
                        'no_link_get_permalink' => false,
                        'post'                  => get_post(),
                        'show_excerpt'          => true,
                        'show_meta'             => true,
                        'show_thumbnail'        => true
                    ];

                    get_ictcamp_template('content-grid-3-cols', $attributes, true);

                    if ($counter % $wrap_count == 0) {
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
                do_action('event_star_action_posts_navigation');
            else :
                get_template_part('template-parts/content', 'none');

            endif; ?>

        </main><!-- #main -->
    </div><!-- #primary -->
    <?php
    get_sidebar('left');
    get_sidebar();
    ?>
</div><!-- #content -->

<?php get_footer();
