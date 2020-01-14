<?php 
namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
// Product
class martua_Widget_Product extends Widget_Base {
 
   public function get_name() {
      return 'product';
   }
 
   public function get_title() {
      return esc_html__( 'Products', 'martua' );
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
            'default' => 8,
            'min' => 5,
            'max' => 100,
            'step' => 1
         ]
      );


      $this->add_control(
         'order',
         [
            'label' => __( 'Order', 'martua' ),
            'type' => \Elementor\Controls_Manager::SELECT,
            'default' => 'DESC',
            'options' => [
               'ASC'  => __( 'Ascending', 'martua' ),
               'DESC' => __( 'Descending', 'martua' )
            ],
         ]
      );
      
      $this->end_controls_section();
   }

   protected function render( $instance = [] ) {
 
      // get our input from the widget settings.
       
      $settings = $this->get_settings_for_display(); ?>

      <div class="row justify-content-center">
        <div class="text-center">
          <div class="product-menu mb-60">
            <button class="active" data-filter="*">All Items</button>
            <?php  $product_menu_terms = get_terms( array(
               'taxonomy' => 'product_cat',
               'hide_empty' => false,  
            ) ); 

            foreach ( $product_menu_terms as $portfolio_menu_term ) { ?>
              <button class="" data-filter=".<?php echo esc_attr( $portfolio_menu_term->slug ) ?>"><?php echo esc_html( $portfolio_menu_term->name ) ?></button>
            <?php } ?>
          </div>
        </div>
      </div>
      <div class="row product-active justify-content-center">
        <?php
        $products = new \WP_Query( array( 
          'post_type' => 'product',
          'posts_per_page' => $settings['ppp'],
          'ignore_sticky_posts' => true,
          'order' => $settings['order'],
        ));
         /* Start the Loop */
        while ( $products->have_posts() ) : $products->the_post();
        $product_terms = get_the_terms( get_the_ID() , 'product_cat' ); 
        
        global $product;?>


        <div class="col-lg-4 col-md-6 grid-item <?php foreach ($product_terms as $portfolio_term) { echo esc_attr( $portfolio_term->slug ); } ?>">
            <div class="single-product-item t-single-product-item mb-30">
                <div class="product-img">
                    <a href="<?php the_permalink() ?>"><?php the_post_thumbnail('martua-403x300') ?></a>
                </div>
                <div class="t-product-overlay">
                    <h5><a href="<?php the_permalink() ?>"><?php the_title() ?></a></h5>
                    <span><?php echo esc_html( get_post_meta( get_the_ID(), 'martua_sub_title', 1 ) ) ?></span>
                    <p> <?php echo $product->get_total_sales(); ?> Sales</p>
                    <div class="t-product-meta">
                        <?php woocommerce_template_loop_rating(); ?>
                        <h6><?php echo get_woocommerce_currency_symbol().get_post_meta( get_the_ID(), '_regular_price', true ); ?></h6>
                    </div>
                </div>
            </div>
        </div>


        <?php endwhile; wp_reset_postdata(); ?>
      </div>

      <?php
   }
 
}
Plugin::instance()->widgets_manager->register_widget_type( new martua_Widget_Product );