<?php
get_header();

global $event_star_customizer_all_values;
?>

<div class="wrapper inner-main-title">
    <div class="container">
        <header class="entry-header init-animate">
            <h1 class="page-title"><?php _e( post_type_archive_title( '', false ), 'ict_camp' ); ?></h1>

            <?php
            var_dump($event_star_customizer_all_values['event-star-show-breadcrumb'] ); die();
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
            $args = [
                'post_type' => 'speakers',
                'orderby'   => 'post_name',
                'order'     => 'ASC',
            ];

            $speakers = new WP_Query( $args );

            if ( $speakers->have_posts() ) {
            ?>
                <div class="section padding-top-1-em">
                    <div class="setcion-body margin-top-3-em">
                        <?php
                        $counter = 1;
                        $wrap_count = 6;
                        while ( $speakers->have_posts() ) {
                            $speakers->the_post();

                            if ($counter%$wrap_count == 1 ) {
                                echo '<div class="row flex-box-row">';
                            }

                            get_template_part( 'inc/template-parts/speakers/content', 'list' );

                            if( ($counter%$wrap_count == 0) || ($counter == $speakers->post_count) ) {
                                echo '</div>';
                            }

                            $counter++;
                        }
                        ?>
                    </div>
                </div>
            <?php
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
