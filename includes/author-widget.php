<?php
/**
 * Add Recent Post Widget.
 * @package digiplace
 */
if( !class_exists('digiplace_Author') ){
	class digiplace_Author extends WP_Widget{
		/**
		 * Register widget with WordPress.
		 */
		function __construct(){

			$widget_options = array(
				'description'					=> esc_html__('digiplace author here', 'digiplace'), 
				'customize_selective_refresh' 	=> true,
			);

			parent:: __construct('digiplace_Author', esc_html__( 'Author : digiplace', 'digiplace'), $widget_options );

		}
		
		/**
		 * Front-end display of widget.
		 *
		 * @see WP_Widget::widget()
		 *
		 * @param array $args     Widget arguments.
		 * @param array $instance Saved values from database.
		 */
		public function widget($args, $instance){

			if ( ! isset( $args['widget_id'] ) ) {

			$args['widget_id'] = $this->id;

		}
		
		$title = ( ! empty( $instance['title'] ) ) ? $instance['title'] : esc_html__( 'About Author','digiplace' );
		$profile_image = ( ! empty( $instance['profile_image'] ) ) ? $instance['profile_image'] : '';
		$designation = ( ! empty( $instance['designation'] ) ) ? $instance['designation'] : esc_html__( 'Markplus CEO','digiplace' );
		$short_description = ( ! empty( $instance['short_description'] ) ) ? $instance['short_description'] : esc_html__( 'A design is plan or specification for the construction','digiplace' );
		$facebook = ( ! empty( $instance['facebook'] ) ) ? $instance['facebook'] : '#';
		$twitter = ( ! empty( $instance['twitter'] ) ) ? $instance['twitter'] : '#';
		$pinterest = ( ! empty( $instance['pinterest'] ) ) ? $instance['pinterest'] : '#';
		$linkedin = ( ! empty( $instance['linkedin'] ) ) ? $instance['linkedin'] : '#';
		
		$title = apply_filters( 'widget_title', $title, $instance, $this->id_base );


			echo $args['before_widget'];
			if ( $title ): 
		    echo $args['before_title'];  
			echo esc_attr( $title );  
		 	echo $args['after_title']; 
			endif;  ?>
			
            <?php if ($profile_image): ?>
		    	<div class="sidebar-about-thumb mb-20 text-center">
		            <img src="<?php echo esc_url( $profile_image ) ?>" alt="<?php echo esc_attr( $title ); ?>">
		            <span><?php echo esc_attr( $designation ); ?></span>
		        </div>
		    <?php endif ?>
            <div class="sidebar-about-content text-center">
                <p><?php echo esc_html( $short_description ) ?></p>
                <div class="sidebar-about-social">
                    <ul>
			            <li><a href="<?php echo esc_url( $facebook ) ?>"><i class="fab fa-facebook-f"></i></a></li>
			            <li><a href="<?php echo esc_url( $twitter ) ?>"><i class="fab fa-twitter"></i></a></li>
			            <li><a href="<?php echo esc_url( $pinterest ) ?>"><i class="fab fa-pinterest-p"></i></a></li>
			            <li><a href="<?php echo esc_url( $linkedin ) ?>"><i class="fab fa-linkedin-in"></i></a></li>
			        </ul>
                </div>
            </div>
            
			<?php echo $args['after_widget']; ?>
			
			<?php wp_reset_postdata();
		}
		/**
		 * Sanitize widget form values as they are saved.
		 *
		 * @see WP_Widget::update()
		 *
		 * @param array $new_instance Values just sent to be saved.
		 * @param array $old_instance Previously saved values from database.
		 *
		 * @return array Updated safe values to be saved.
		 */
		public function update( $new_instance, $old_instance ) {
			$instance = $old_instance;
			$instance['title'] = sanitize_text_field( $new_instance['title'] );
			$instance['profile_image'] = sanitize_text_field( $new_instance['profile_image'] );
			$instance['designation'] = sanitize_text_field( $new_instance['designation'] );
			$instance['short_description'] = sanitize_text_field( $new_instance['short_description'] );
			$instance['facebook'] = sanitize_text_field( $new_instance['facebook'] );
			$instance['twitter'] = sanitize_text_field( $new_instance['twitter'] );
			$instance['pinterest'] = sanitize_text_field( $new_instance['pinterest'] );
			$instance['linkedin'] = sanitize_text_field( $new_instance['linkedin'] );
			return $instance;
		}

	 	/**
		 * Back-end widget form.
		 *
		 * @see WP_Widget::form()
		 *
		 * @param array $instance Previously saved values from database.
		 */

		public function form( $instance ) {
		$title     = isset( $instance['title'] ) ? esc_attr( $instance['title'] ) : '';
		$profile_image     = isset( $instance['profile_image'] ) ? esc_attr( $instance['profile_image'] ) : '';
		$short_description     = isset( $instance['short_description'] ) ? esc_attr( $instance['short_description'] ) : '';
		$designation = isset( $instance['designation'] ) ? esc_attr( $instance['designation'] ) : '';
		$facebook     = isset( $instance['facebook'] ) ? esc_attr( $instance['facebook'] ) : '';
		$twitter     = isset( $instance['twitter'] ) ? esc_attr( $instance['twitter'] ) : '';
		$pinterest     = isset( $instance['pinterest'] ) ? esc_attr( $instance['pinterest'] ) : '';
		$linkedin     = isset( $instance['linkedin'] ) ? esc_attr( $instance['linkedin'] ) : ''; 
		?>

		<p>
			<label for="<?php echo esc_attr($this->get_field_id( 'title' )); ?>"><?php echo esc_html__( 'Title:','digiplace' ); ?></label>
			<input class="widefat" id="<?php echo esc_attr($this->get_field_id( 'title' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'title' )); ?>" type="text" value="<?php echo esc_attr($title); ?>" />
		</p>
		<p>
	        <label for="<?php echo esc_attr($this->get_field_id( 'profile_image' )); ?>"><?php echo esc_html__( 'Profile image:','digiplace' ); ?></label>
	        <img class="<?php echo esc_attr($this->get_field_id( 'profile_image' )); ?>_img" src="<?php echo esc_url($profile_image); ?>" style="margin:0;padding:0;max-width:100%;display:block"/>
	        <input type="text" class="widefat <?php echo esc_attr($this->get_field_id( 'profile_image' )); ?>_url" name="<?php echo esc_attr($this->get_field_name( 'profile_image' )); ?>" value="<?php echo esc_attr($profile_image); ?>" style="margin-top:5px;" />
	        <input type="button" id="<?php echo esc_attr($this->get_field_id( 'profile_image' )); ?>" class="button button-primary js_custom_upload_media" value="Upload Image" style="margin-top:5px;" />
	    </p>
	    <p>
			<label for="<?php echo esc_attr($this->get_field_id( 'designation' )); ?>"><?php echo esc_html__( 'Designation:','digiplace' ); ?></label>
			<input class="widefat" id="<?php echo esc_attr($this->get_field_id( 'designation' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'designation' )); ?>" type="text" value="<?php echo esc_attr($designation); ?>" />
		</p>
		<p>
			<label for="<?php echo esc_attr($this->get_field_id( 'short_description' )); ?>"><?php echo esc_html__( 'Short description:','digiplace' ); ?></label>
			<textarea class="widefat" rows="5" cols="30" id="<?php echo esc_attr($this->get_field_id( 'short_description' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'short_description' )); ?>"><?php echo stripslashes( $short_description ); ?></textarea>
		</p>
		<p>
			<label for="<?php echo esc_attr($this->get_field_id( 'facebook' )); ?>"><?php echo esc_html__( 'Facebook:','digiplace' ); ?></label>
			<input class="widefat" id="<?php echo esc_attr($this->get_field_id( 'facebook' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'facebook' )); ?>" type="text" value="<?php echo esc_attr($facebook); ?>" />
		</p>
		<p>
			<label for="<?php echo esc_attr($this->get_field_id( 'twitter' )); ?>"><?php echo esc_html__( 'Twitter:','digiplace' ); ?></label>
			<input class="widefat" id="<?php echo esc_attr($this->get_field_id( 'twitter' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'twitter' )); ?>" type="text" value="<?php echo esc_attr($twitter); ?>" />
		</p>
		<p>
			<label for="<?php echo esc_attr($this->get_field_id( 'pinterest' )); ?>"><?php echo esc_html__( 'Pinterest:','digiplace' ); ?></label>
			<input class="widefat" id="<?php echo esc_attr($this->get_field_id( 'pinterest' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'pinterest' )); ?>" type="text" value="<?php echo esc_attr($pinterest); ?>" />
		</p>
		<p>
			<label for="<?php echo esc_attr($this->get_field_id( 'linkedin' )); ?>"><?php echo esc_html__( 'Linkedin:','digiplace' ); ?></label>
			<input class="widefat" id="<?php echo esc_attr($this->get_field_id( 'linkedin' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'linkedin' )); ?>" type="text" value="<?php echo esc_attr($linkedin); ?>" />
		</p>

	<?php
		}
	}
}



// register Contact  Widget widget
function digiplace_Author(){
	register_widget('digiplace_Author');
}
add_action('widgets_init','digiplace_Author');