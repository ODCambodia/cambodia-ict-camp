<?php
function event_star_excerpt_read_more( $more ) {
    $output = $more;

    global $event_star_customizer_all_values;

    $more_text = esc_html( $event_star_customizer_all_values['event-star-blog-archive-more-text'] );

    if ( ! empty( $more_text ) ) {
        $output = '...<a href="'. esc_url( get_permalink() ) . '" class="more-link btn btn-primary">' . esc_html( $more_text ) . '</a>';
        $output = apply_filters( 'event_star_filter_read_more_link' , $output );
    }

    return $output;
}