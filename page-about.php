<?php
get_header();

global $event_star_customizer_all_values;
$event_star_hide_front_page_header = $event_star_customizer_all_values['event-star-hide-front-page-header'];

if(
	( is_front_page() && 1 != $event_star_hide_front_page_header )
	|| !is_front_page()
) {
	?>
	<div class="wrapper inner-main-title">
		<div class="container">
			<header class="entry-header init-animate">
				<?php
                the_title( '<h1 class="entry-title">', '</h1>' );
                if( 1 == $event_star_customizer_all_values['event-star-show-breadcrumb'] ){
					event_star_breadcrumbs();
				}
				?>
			</header><!-- .entry-header -->
		</div>
	</div>
	<?php
}
?>
<div id="content" class="site-content container clearfix">
	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">
            <?php
            while ( have_posts() ) : the_post();

                get_template_part( 'inc/template-parts/content', 'page' );

            endwhile; // End of the loop.
            ?>

			<!-- Organizer Section -->
			<?php
			/*
			$organizers = new WP_Query( ['post_type' => 'organizers'] );

			if( $organizers->have_posts() ) {
				$counter = 0;
				$wrap_count = 4;
			?>
				<div class="section padding-top-1-em" id="organizers">
					<div class="section-title">
						<h2 class="text-center"><?php _e( 'Organizers', 'ict_camp' ); ?></h2>
					</div>

					<div class="setcion-body margin-top-3-em">
						<?php
						while ( $organizers->have_posts() ) {
							$organizers->the_post();

							if( $counter%$wrap_count == 0 ) {
								echo '<div class=" flex-box-row">';
							}
							?>

							<div class="col-xs-12 col-sm-12 col-md-3">
								<?php
								$attributes = [
									'title' => __( get_the_title() ),
									'class' => 'img-responsive',
								];

								$logo = get_the_post_thumbnail( $post->ID, 'large', $attributes );
								$responsive_logo = preg_replace( '/(width|height)="\d*"\s/', "", $logo );
								?>
								<a href="<?php echo get_the_excerpt(); ?>" target="_blank">
									<?php echo $responsive_logo  ?>
								</a>
							</div><!-- col-xs-12 col-sm-12 col-md-3 -->

							<?php
							if( $counter%$wrap_count == 3 ) {
								echo '</div>';
							}

							$counter++;
						}
						?>
					</div>
				</div>
			<?php
			}
			?>
			<!-- END Organizer Section -->

			<!-- Partner Section -->
			<?php
			$partners = new WP_Query( ['post_type' => 'partners'] );

			if( $partners->have_posts() ) {
				$counter = 0;
				$wrap_count = 4;
			?>
				<div class="section padding-top-1-em" id="partners">
					<div class="section-title text-center">
						<h2><?php  _e( 'Partners', 'ict_camp' ); ?></h2>
					</div>

					<div class="setcion-body margin-top-3-em">
						<?php
						while ( $partners->have_posts() ) {
							$partners->the_post();

							if( $counter%$wrap_count == 0 ) {
								echo '<div class="row flex-box-row">';
							}
							?>

							<div class="col-xs-12 col-sm-12 col-md-3">
								<?php
								$attributes = [
									'title' => __( get_the_title() ),
									'class' => 'img-responsive',
								];

								$logo = get_the_post_thumbnail( $post->ID, 'large', $attributes );
								$responsive_logo = preg_replace( '/(width|height)="\d*"\s/', "", $logo );
								?>
								<a href="<?php echo get_the_excerpt(); ?>" target="_blank">
									<?php echo $responsive_logo  ?>
								</a>
							</div><!-- col-xs-12 col-sm-12 col-md-3 -->

							<?php
							if( $counter%$wrap_count == 3 ) {
								echo '</div>';
							}

							$counter++;
						}
						?>
					</div>
				</div>
			<?php
			}
			?>
			<!-- END Partner Section -->

			<!-- Supporter Section -->
			<?php
			$donors = new WP_Query( ['post_type' => 'donors'] );

			if( $donors->have_posts() ) {
				$counter = 0;
				$wrap_count = 4;
			?>
				<div class="section padding-top-1-em" id="donors">
					<div class="section-title">
						<h2 class="text-center"><?php _e( 'Donors', 'ict_camp' ); ?></h2>
					</div>

					<div class="setcion-body margin-top-3-em">
						<?php
						while ( $donors->have_posts() ) {
							$donors->the_post();

							if( $counter%$wrap_count == 0 ) {
								echo '<div class="row flex-box-row">';
							}
							?>

							<div class="col-xs-12 col-sm-12 col-md-3">
								<?php
								$attributes = [
									'title' => __( get_the_title() ),
									'class' => 'img-responsive',
								];

								$logo = get_the_post_thumbnail( $post->ID, 'large', $attributes );
								$responsive_logo = preg_replace( '/(width|height)="\d*"\s/', "", $logo );
								?>
								<a href="<?php echo get_the_excerpt(); ?>" target="_blank">
									<?php echo $responsive_logo  ?>
								</a>
							</div><!-- col-xs-12 col-sm-12 col-md-3 -->

							<?php
							if( $counter%$wrap_count == 3 ) {
								echo '</div>';
							}

							$counter++;
						}
						?>
					</div>
				</div>
			<?php
            }

						*/
            ?><!-- END Suppporter Section -->
        </main><!-- #main -->
    </div><!-- #primary -->

    <?php
    get_sidebar( 'left' );
    get_sidebar();
    ?>
</div><!-- #content -->

<?php get_footer();
