<?php 
namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
// Product
class martua_Widget_free extends Widget_Base {
 
   public function get_name() {
      return 'freeproduct';
   }
 
   public function get_title() {
      return esc_html__( 'free products', 'martua' );
   }
 
   public function get_icon() { 
        return 'eicon-posts-carousel';
   }
 
   public function get_categories() {
      return [ 'martua-elements' ];
   }
   protected function _register_controls() {

      $this->start_controls_section(
         'product_section',
         [
            'label' => esc_html__( 'Products', 'martua' ),
            'type' => Controls_Manager::SECTION,
         ]
      );
	   
	  $this->add_control(
         'ppp',
         [
            'label' => __( 'Post per page', 'martua' ),
            'type' => \Elementor\Controls_Manager::NUMBER,
            'default' => 3,
            'min' => 5,
            'max' => 100,
            'step' => 1
         ]
      );
	   
      $this->end_controls_section();
   }

   protected function render( $instance = [] ) {
 
      // get our input from the widget settings.
       
      $settings = $this->get_settings_for_display();

        $products = new \WP_Query( array( 
          'post_type' => 'product',
		  'product_cat' => 'free',	
		  'posts_per_page' => $settings['ppp'],
        ));
	   
        global $product;?>
		<div class="row">
		<?php
        while ( $products->have_posts() ) : $products->the_post(); ?>

		   <div class="col-lg-4 col-md-6">
				<div class="single-product-item mb-30">
					<div class="product-img">
						<a href="<?php the_permalink() ?>"><?php the_post_thumbnail('martua-405x506') ?></a>
					</div>
					<div class="product-overlay">
						<h5><a href="<?php the_permalink() ?>"><?php the_title() ?> - <?php echo esc_html( get_post_meta( get_the_ID(), 'martua_sub_title', 1 ) ) ?></a></h5>
						<span><?php echo get_woocommerce_currency_symbol().get_post_meta( get_the_ID(), '_regular_price', true ); ?></span>
					</div>
				</div>
			</div>
			
        <?php endwhile; wp_reset_postdata(); ?>
			
		</div>
      <?php
   }
 
}
Plugin::instance()->widgets_manager->register_widget_type( new martua_Widget_free );