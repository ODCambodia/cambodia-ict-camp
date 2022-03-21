<?php
/**
 * Widget Name: CICT Themes Widget
 * Description: This is the widget get for displaying all themes of the camp.
 * Version: 1.0.0
 */

class Camp_Themes_Widget extends WP_Widget
{
	// Constructor
	public function __construct()
	{
		parent::__construct(
			'camp_themes',
			esc_html__( 'CICT Theme Widget', 'ict_camp' ),
			[
				'description' => esc_html__( 'Display a list of all themes of the camp', 'ict_camp' ),
			]
		);
	}

	// Output Front-end
	public function widget( $args, $instance )
	{
		$title = apply_filters( 'widget_title', $instance['title'] );

		echo $args['before_widget'];

		$attr = [
			'hide_empty' => 0,
			'orderby'	 => 'name',
			'parent'	 => 0,
			'exclude'    => 1 
		];

		$themes = get_categories( $attr );
		?>
        <section class="cict-widgets">
            <div class="container">

                <?php
                if( ! empty( $title ) ) {
                    echo $args['before_title'] . $title . $args['after_title'];
                }
                ?>

                <div class="flex-box-row align-items-center">
                    <?php
                    foreach( $themes as $theme ) {
                        $theme_image = get_term_meta( $theme->term_id, '_category_image_value_key', true );
                        ?>

                        <div class="aling-center col-xs-12 col-sm-12 col-md-3">
                            <a href="<?php echo get_site_url() . '/themes#' . $theme->slug; ?>">
                            <div class="theme-box" style="background-image: url( <?php echo $theme_image; ?>);">
                                <h5 class="text-center">
                                        <?php _e( $theme->name ); ?>
                                    </h5>
                                </div>
                            </a>
                        </div>

                    <?php
                    }
                    ?>
                </div>
            </div>
        </section>
    <?php
        echo $args['after_widget'];
        echo '<div class="clearfix"></div>';
    }

    // Form Field on Widget Screen
    public function form( $instance )
    {
        if( isset( $instance['title'] ) ) {
            $title = $instance['title'];
        } else {
			$title = __( 'New Title', 'ict_camp' );
		}
		?>

		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title: ' ) ?></label>
			<input type="text" class="widefat" 
				id="<?php echo $this->get_field_id( 'title' ); ?>" 
				name="<?php echo $this->get_field_name( 'title' ) ?>" 
				value="<?php echo esc_attr( $title ) ?>"
			>
		</p>
	<?php
	}

	// Save Data
	public function update( $new_instance, $old_instance )
	{
		$instance = [];

		if( ! empty( $new_instance['title'] ) ) {
			$instance['title'] = strip_tags( $new_instance['title'] );
		} else {
			$instance['title'] = '';
		}

		return $instance;
	}
}