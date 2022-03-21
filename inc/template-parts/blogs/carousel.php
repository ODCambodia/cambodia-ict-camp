<?php
$number_of_post_with_image = isset( $params['number_of_post_with_image'] ) ? $params['number_of_post_with_image'] : null;
?>

<div id="carousel-example-generic" class="carousel slide hidden-xs" data-ride="carousel">
    <!-- Indicators -->
    <?php if ( 1 < $number_of_post_with_image ) : ?>
        <ol class="carousel-indicators">
            <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>

            <?php
            if ( 4 < $number_of_post_with_image ) {
                $number_of_carousel_indicator = 4;
            } else {
                $number_of_carousel_indicator = $number_of_post_with_image;
            }

            for ( $i = 1; $i < $number_of_carousel_indicator; $i++ ) {
                echo '<li data-target="#carousel-example-generic" data-slide-to="' . $i .'"></li>';
            }
            ?>
        </ol>
    <?php endif; ?>
    <!-- End Indicators -->

    <!-- Wrapper for slides -->
    <div class="carousel-inner" role="listbox">
        <div class="item active">
            <?php 
            if ( has_post_thumbnail() ) {
            ?>
                <div class="recent-feature-image" style="background-image: url( '<?php echo $recent_feature_image_url; ?>' );"></div>
            <?php
            }
            ?>
        </div>

        <?php
        $args = [
            'offset'         => 1,
            'orderby'        => 'post_date',
            'order'          => 'DESC',
            'post_status'    => 'publish',
            'meta_query'     => [
                [
                    'key'     => '_thumbnail_id',
                    'value'   => '',
                    'compare' => '!='
                ]
            ],
            'posts_per_page' => 3
        ];

        $recent_posts_with_img = new WP_Query( $args );

        while ( $recent_posts_with_img->have_posts() ) {
            $recent_posts_with_img->the_post();

            if ( has_post_thumbnail() ) {
                $recent_feature_image_url = get_the_post_thumbnail_url( get_the_ID(), $thumbnail_size );
                ?>
                <div class="item">
                    <div class="recent-feature-image" style="background-image: url( '<?php echo $recent_feature_image_url; ?>' );"></div>
                </div>
            <?php
            }
        }

        wp_reset_query();
        ?>
    </div>
    <!-- End Wrapper for slides -->

    <!-- Controls -->
    <?php if ( 1 < $number_of_post_with_image ) : ?>
        <a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
            <i class="fa fa-chevron-left" style="top: 50%" aria-hidden="true"></i>
            <span class="sr-only">Previous</span>
        </a>

        <a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
            <i class="fa fa-chevron-right" aria-hidden="true"></i>
            <span class="sr-only">Next</span>
        </a>
    <?php endif; ?>
    <!-- End Controls -->
</div>