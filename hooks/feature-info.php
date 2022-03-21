<?php
add_action( 'event_star_action_feature_info', 'event_star_feature_info', 20 );

if ( !function_exists('event_star_feature_info') ) :

	function event_star_feature_info() {

		global $event_star_customizer_all_values;

		$event_star_feature_info_number = $event_star_customizer_all_values['event-star-feature-info-number'];
		echo '<div class="info-icon-box-wrapper"><div class="container primary-bg">';

		$column = $number = $event_star_feature_info_number;

		$event_star_basic_info_data = [];
		$event_star_first_info_icon = $event_star_customizer_all_values['event-star-first-info-icon'] ;
		$event_star_first_info_title = $event_star_customizer_all_values['event-star-first-info-title'];
		$event_star_first_info_desc = $event_star_customizer_all_values['event-star-first-info-desc'];

		$event_star_basic_info_data[] = [
			'icon'  => $event_star_first_info_icon,
			'title' => $event_star_first_info_title,
			'desc'  => $event_star_first_info_desc
		];

		$event_star_second_info_icon = $event_star_customizer_all_values['event-star-second-info-icon'] ;
		$event_star_second_info_title = $event_star_customizer_all_values['event-star-second-info-title'];
		$event_star_second_info_desc = $event_star_customizer_all_values['event-star-second-info-desc'];

		$event_star_basic_info_data[] = [
			'icon'  => $event_star_second_info_icon,
			'title' => $event_star_second_info_title,
			'desc'  => $event_star_second_info_desc
		];

		$event_star_third_info_icon = $event_star_customizer_all_values['event-star-third-info-icon'] ;
		$event_star_third_info_title = $event_star_customizer_all_values['event-star-third-info-title'];
		$event_star_third_info_desc = $event_star_customizer_all_values['event-star-third-info-desc'];

		$event_star_basic_info_data[] = [
			'icon'  => $event_star_third_info_icon,
			'title' => $event_star_third_info_title,
			'desc'  => $event_star_third_info_desc
		];

		$event_star_forth_info_icon = $event_star_customizer_all_values['event-star-forth-info-icon'] ;
		$event_star_forth_info_title = $event_star_customizer_all_values['event-star-forth-info-title'];
		$event_star_forth_info_desc = $event_star_customizer_all_values['event-star-forth-info-desc'];

		$event_star_basic_info_data[] = [
			'icon'  => $event_star_forth_info_icon,
			'title' => $event_star_forth_info_title,
			'desc'  => $event_star_forth_info_desc
		];

		$event_date = esc_attr( $event_star_basic_info_data[0]['desc'] );
		$event_date = date( 'd/m/Y-G:i', strtotime( $event_date ) );

		if( ! empty( $event_date ) ) {

			switch( $column ) {
				case 1:
					$col = 'col-md-6';
					break;

				case 2:
					$col = 'col-md-4';
					break;

				case 3:
					$col = 'col-md-3';
					break;
				case 4:
					$col = 'col-md-3';
					break;
			}

		} else {
			switch( $column ) {
				case 1:
					$col = 'col-md-12';
					break;

				case 2:
					$col = 'col-md-6';
					break;

				case 3:
					$col = 'col-md-4';
					break;
				case 4:
					$col = 'col-md-3';
					break;
			}
		}

		$col .= " init-animate zoomIn";

		$i=0;
		echo "<div class='row'>";

		foreach( $event_star_basic_info_data as $base_basic_info_data) {

			if( $i >= $number ){
				break;
			}
			?>

            <div class="info-icon-box <?php echo esc_attr( $col );?>">
				<?php
				if( ! empty( $base_basic_info_data['icon'] ) ) {
					?>
                    <div class="info-icon">
                        <i class="fa <?php echo esc_attr( $base_basic_info_data['icon'] ); ?>"></i>
                    </div>
					<?php
				}
				if( ! empty( $base_basic_info_data['title'] ) || ! empty( $base_basic_info_data['desc'] ) ){
					?>
                    <div class="info-icon-details">
						<?php
						if( ! empty( $base_basic_info_data['title'] ) ){
							echo '<h6 class="icon-title">' . esc_html( $base_basic_info_data['title'] ) . '</h6>';
						}
						if( ! empty( $base_basic_info_data['desc'] ) ){
							echo '<span class="icon-desc">' . wp_kses_post( $base_basic_info_data['desc'] ) . '</span>';
						}
						?>
                    </div>
					<?php
				}
				?>
            </div>
			<?php
			$i++;
		}
		?>
			<div class="info-icon-box <?php echo $col; ?>">

				<?php
                if( ! empty( $event_date ) ) {
                	$animation1 = 'init-animate zoomIn';

                    $date_time = event_star_date_time_array( $event_date );

                    if( ! empty( $date_time ) && is_array( $date_time ) ) {

                        global $event_star_customizer_all_values;

                        $event_star_days_text = $event_star_customizer_all_values['event-star-days-text'];
                        $event_star_hours_text = $event_star_customizer_all_values['event-star-hours-text'];
                        $event_star_min_text = $event_star_customizer_all_values['event-star-min-text'];
                        $event_star_second_text = $event_star_customizer_all_values['event-star-second-text'];
												/*
												?>
                        <section class="feature-event clearfix"
                                 data-year="<?php echo esc_attr( $date_time['year'] );?>"
                                 data-month="<?php echo esc_attr( $date_time['month'] );?>"
                                 data-day="<?php echo esc_attr( $date_time['day'] );?>"
                                 data-hour="<?php echo esc_attr( $date_time['hour']);?>"
                                 data-minutes="<?php echo esc_attr( $date_time['minutes'] );?>"
                        >
                        	<div class="feature-col col-xs-3 <?php echo $animation1;?>">
                                <h6 class="day countdown-time-small"></h6>
                                <p class="day-text countdown-label-small">
                                    <?php _e( esc_html( $event_star_days_text ) );?>
                                </p>
                            </div>
                            <div class="feature-col col-xs-3 <?php echo $animation1;?>">
                                <h6 class="hour countdown-time-small"></h6>
                                <p class="hour-text countdown-label-small">
                                    <?php _e( esc_html( $event_star_hours_text ) );?>
                                </p>
                            </div>
                            <div class="feature-col col-xs-3 <?php echo $animation1;?>">
                                <h6 class="min countdown-time-small"></h6>
                                <p class="min-text countdown-label-small">
                                    <?php _e( esc_html( $event_star_min_text ) );?>
                                </p>
                            </div>
                            <div class="feature-col col-xs-3 <?php echo $animation1;?>">
                                <h6 class="sec countdown-time-small"></h6>
                                <p class="sec-text countdown-label-small">
                                    <?php _e( 'Secs' );?>
                                </p>
                            </div>
                        </section>
                        <?php
												*/
                    }
                }
                ?>
			</div>
		<?php
		echo "</div>";/*row*/
		echo "</div></div>";/*container/infowrapper*/
	}
endif;
