<section class="feature-event clearfix <?php echo esc_attr( $animation3 );?>"
         data-year="<?php echo esc_attr( $date_time['year'] );?>"
         data-month="<?php echo esc_attr( $date_time['month'] );?>"
         data-day="<?php echo esc_attr( $date_time['day'] );?>"
         data-hour="<?php echo esc_attr( $date_time['hour'] );?>"
         data-minutes="<?php echo esc_attr( $date_time['minutes'] );?>"
>
    <div class="feature-col col-xs-3">
        <span class="day countdown-time"></span>
        <?php
        if ( !empty( $event_star_days_text ) ) {
        ?>
            <span class="day-text countdown-label">
                <?php
                echo esc_html( $event_star_days_text );
                ?>
            </span>
        <?php
        }
        ?>
    </div>
    <div class="feature-col col-xs-3">
        <span class="hour countdown-time"></span>
        <?php
        if( !empty( $event_star_hours_text ) ){
        ?>
            <span class="hour-text countdown-label">
                <?php
                echo esc_html( $event_star_hours_text );
                ?>
            </span>
        <?php
        }
        ?>
    </div>
    <div class="feature-col col-xs-3">
        <span class="min countdown-time"></span>
        <?php
        if( !empty( $event_star_min_text ) ){
        ?>
            <span class="min-text countdown-label">
                <?php
                echo esc_html( $event_star_min_text );
                ?>
            </span>
        <?php
        }
        ?>
    </div>
    <div class="feature-col col-xs-3">
        <span class="sec countdown-time"></span>
        <?php
        if( !empty( $event_star_second_text ) ){
        ?>
            <span class="sec-text countdown-label">
                <?php
                echo esc_html( $event_star_second_text );
                ?>
            </span>
        <?php
        }
        ?>
    </div>
</section>