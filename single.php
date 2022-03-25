<?php

/**
 * The template for displaying all single posts.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package Acme Themes
 * @subpackage Event Star
 */

get_header();

global $event_star_customizer_all_values;
?>
<div class="wrapper inner-main-title">
    <div id="particles-js"></div>
    <div class="container">
        <header class="entry-header init-animate">
            <?php
            $single_header_title = $event_star_customizer_all_values['event-star-single-header-title'];

            if (!empty($single_header_title)) {
                echo '<h1 class="entry-title">' . esc_html($single_header_title) . '</h1>';
            }

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
            while (have_posts()) : the_post();
                get_template_part('inc/template-parts/content', 'single-post'); ?>
                <div class="clearfix"></div>
            <?php
                the_post_navigation();
                // If comments are open or we have at least one comment, load up the comment template.
                if (comments_open() || get_comments_number()) :
                    comments_template();
                endif;
            endwhile; // End of the loop.
            ?>
        </main><!-- #main -->
    </div><!-- #primary -->
    <?php
    get_sidebar('left');
    get_sidebar();
    ?>
</div><!-- #content -->

<?php get_footer();
