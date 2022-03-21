<?php
if ( ! function_exists( 'camp_ict_posts_navigation' ) ) :
    function camp_ict_posts_navigation() {
        the_posts_pagination( array(
                'mid_size'  => 3,
                'prev_text' => __( 'Previous', 'camp_ict' ),
                'next_text' => __( 'Next', 'camp_ict' )
            )
        );
    }
endif;

add_action( 'camp_ict_action_posts_navigation', 'camp_ict_posts_navigation' );