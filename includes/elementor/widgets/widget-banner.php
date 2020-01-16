<?php 
namespace Elementor;
 
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

// Banner Parallax
class digiplace_Widget_Banner2 extends Widget_Base {
 
   public function get_name() {
      return 'banner2';
   }
 
   public function get_title() {
      return esc_html__( 'Banner 2', 'digiplace' );
   }
 
   public function get_icon() { 
        return 'eicon-slider-video';
   }
 
   public function get_categories() {
      return [ 'digiplace-elements' ];
   }

   protected function _register_controls() {

      $this->start_controls_section(
         'banner_section',
         [
            'label' => esc_html__( 'Banner', 'digiplace' ),
            'type' => Controls_Manager::SECTION,
         ]
      );

      $this->add_control(
      'banner_image',
        [
          'label' => __( 'Banner image', 'digiplace' ),
          'type' => \Elementor\Controls_Manager::MEDIA,
          'default' => [
            'url' => get_template_directory_uri().'/images/slider_bg02.jpg',
          ],
        ]
      );

      $this->add_control(
         'title',
         [
            'label' => __( 'Title', 'digiplace' ),
            'type' => \Elementor\Controls_Manager::TEXT,
            'default' => __('Let\'s Start. Digital Marketplace for Themes & Plugins','digiplace')
         ]
      );

      $this->add_control(
         'description',
         [
            'label' => __( 'Description', 'digiplace' ),
            'type' => \Elementor\Controls_Manager::TEXTAREA,
            'default' => __('New Products on the Marketplace.Your dream site download!','digiplace')
         ]
      );

      $this->end_controls_section();

   }

   protected function render( $instance = [] ) {
    // get our input from the widget settings.
    $settings = $this->get_settings_for_display(); ?>

      <section class="slider-area s-slider-bg" style="background-image: url(<?php echo esc_url($settings['banner_image']['url']) ?>)">
          <div class="container">
              <div class="row justify-content-center">
                  <div class="col-xl-10">
                      <div class="slider-content s-slider-content text-center mb-45">
                          <h2><?php echo $settings['title'] ?></h2>
                          <p><?php echo esc_html( $settings['description'] ) ?></p>
                      </div>
                  </div>
              </div>
              <div class="row justify-content-center">
                  <div class="col-xl-8 col-lg-10">
                      <div class="s-slider-search-form">
                        <form role="search" method="get" class="woocommerce-product-search" action="<?php echo esc_url( home_url( '/' ) ); ?>">
                        <label class="screen-reader-text" for="woocommerce-product-search-field-<?php echo isset( $index ) ? absint( $index ) : 0; ?>"><?php esc_html_e( 'Search for:', 'woocommerce' ); ?></label>
                        <input type="search" id="woocommerce-product-search-field-<?php echo isset( $index ) ? absint( $index ) : 0; ?>" class="search-field" placeholder="<?php echo esc_attr__( 'Search what your need...', 'woocommerce' ); ?>" value="<?php echo get_search_query(); ?>" name="s" />
                        <button type="submit" ><i class="fas fa-search"></i></button>
                        <input type="hidden" name="post_type" value="product" />
                      </form>
                      </div>
                  </div>
              </div>
          </div>
      </section>
    <?php }
}

Plugin::instance()->widgets_manager->register_widget_type( new digiplace_Widget_Banner2 );