<?php

/**
 * The template for displaying 404 pages (not found).
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package Cambodia ICT Camp Theme
 */

get_header();

global $event_star_customizer_all_values;
?>
<div class="wrapper inner-main-title">
    <div id="particles-js"></div>
    <div class="container">
        <header class="entry-header init-animate">
            <h1 class="page-title"><?php esc_html_e('Page Not Found', 'ict_camp'); ?></h1>
            <?php
            if (1 == $event_star_customizer_all_values['event-star-show-breadcrumb']) {
                event_star_breadcrumbs();
            }
            ?>
        </header>
    </div>
</div>
<div id="content" class="site-content container">
    <div id="primary" class="content-area">
        <main id="main" class="site-main" role="main">
            <section class="error-404 not-found">
                <div class="page-content">
                    <p><?php esc_html_e('Sorry the page your are looking for does not exist.', 'ict_camp'); ?></p>
                    <?php //get_search_form(); 
                    ?>
                    <a role="button" class="btn btn-primary" href="/"><?php _e('Return Home', 'ict_camp'); ?></a>
                </div><!-- .page-content -->
            </section><!-- .error-404 -->
        </main><!-- #main -->
    </div><!-- #primary -->
</div><!-- #content -->
<?php get_footer();
