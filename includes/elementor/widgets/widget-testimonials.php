<?php 
namespace Elementor;
 
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

// Title
class martua_Widget_Testimonials extends Widget_Base {
 
   public function get_name() {
      return 'testimonials';
   }
 
   public function get_title() {
      return esc_html__( 'Testimonials', 'martua' );
   }
 
   public function get_icon() { 
        return 'eicon-testimonial';
   }

   public function get_categories() {
      return [ 'martua-elements' ];
   }

   protected function _register_controls() {

      $this->start_controls_section(
         'testimonial_section',
         [
            'label' => esc_html__( 'Testimonials', 'martua' ),
            'type' => Controls_Manager::SECTION,
         ]
      );

      $repeater = new \Elementor\Repeater();

      $repeater->add_control(
         'image',
         [
            'label' => __( 'Choose Photo', 'martua' ),
            'type' => \Elementor\Controls_Manager::MEDIA,
            'default' => [
               'url' => \Elementor\Utils::get_placeholder_image_src()
            ]
         ]
      );
      
      $repeater->add_control(
         'name',
         [
            'label' => __( 'Name', 'martua' ),
            'type' => \Elementor\Controls_Manager::TEXT,
            'default' => __( 'Emaley Mcculloch', 'martua' ),
            
         ]
      );

      $repeater->add_control(
         'designation',
         [
            'label' => __( 'Designation', 'martua' ),
            'type' => \Elementor\Controls_Manager::TEXT,
            'default' => __( 'Founder ceo', 'martua' ),
         ]
      );

      $repeater->add_control(
         'testimonial',
         [
            'label' => __( 'Testimonial', 'martua' ),
            'type' => \Elementor\Controls_Manager::TEXTAREA,
            'default' => __( 'In promotion and of advertising testimonial show consiss of a person\'s written orsoken statement extollig the virtue', 'martua' ),
         ]
      );

      $repeater->add_control(
        'rating',
        [
          'label' => __( 'Rating', 'martua' ),
          'type' => \Elementor\Controls_Manager::SELECT,
          'default' => 1,
          'options' => [
            1 => __( 'Star 1', 'martua' ),
            2 => __( 'Star 2', 'martua' ),
            3 => __( 'Star 3', 'martua' ),
            4 => __( 'Star 4', 'martua' ),
            5 => __( 'Star 5', 'martua' ),
            'none' => __( 'None', 'martua' ),
          ]
        ]
      );

      $this->add_control(
         'testimonial_list',
         [
            'label' => __( 'Testimonial List', 'martua' ),
            'type' => \Elementor\Controls_Manager::REPEATER,
            'fields' => $repeater->get_controls(),
            'title_field' => '{{name}}',

         ]
      );
      
      $this->end_controls_section();

   }

   protected function render( $instance = [] ) {
 
      // get our input from the widget settings.
       
      $settings = $this->get_settings_for_display(); ?>

        <div class="row testimonial-active">
          <?php foreach (  $settings['testimonial_list'] as $testimonial_single ): ?>
          <div class="col-xl-6">
              <div class="single-testimonial">
                  <div class="testi-avatar text-center">
                      <div class="t-avatar-img">
                          <img src="<?php echo esc_url($testimonial_single['image']['url']) ?>" alt="img">
                      </div>
                      <div class="testi-quote">
                          <i class="fas fa-quote-right"></i>
                      </div>
                  </div>
                  <div class="testi-content">
                      <div class="testi-rating mb-10">
                          <?php for ($i = 1; $i <= $testimonial_single['rating']; $i++) {
                            echo '<i class="fas fa-star"></i>';
                          } ?>
                      </div>
                      <div class="t-avatar-info mb-20">
                          <h4><?php echo esc_html($testimonial_single['name']); ?></h4>
                          <span><?php echo esc_html($testimonial_single['designation']); ?></span>
                      </div>
                      <p><?php echo esc_html($testimonial_single['testimonial']); ?></p>
                  </div>
              </div>
          </div>
          <?php endforeach; ?>
        </div>

   <?php } 
 
}

Plugin::instance()->widgets_manager->register_widget_type( new martua_Widget_Testimonials );