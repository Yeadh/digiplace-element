<?php 
namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
// service item
class digiplace_Widget_Service extends Widget_Base {
 
   public function get_name() {
      return 'service item';
   }
 
   public function get_title() {
      return esc_html__( 'Service Item', 'digiplace' );
   }
 
   public function get_icon() { 
        return 'eicon-facebook-comments';
   }
 
   public function get_categories() {
      return [ 'digiplace-elements' ];
   }

   protected function _register_controls() {
    
      $this->start_controls_section(
         'service_section',
         [
            'label' => esc_html__( 'Service Item', 'digiplace' ),
            'type' => Controls_Manager::SECTION,
         ]
      );

      $this->add_control(
         'style',
         [
            'label' => __( 'Service Style', 'digiplace' ),
            'type' => \Elementor\Controls_Manager::SELECT,
            'default' => 'style1',
            'options' => [
               'style1'  => __( 'Style 1', 'digiplace' ),
               'style2' => __( 'Style 2', 'digiplace' ),
            ],
         ]
      );

      $this->add_control(
         'icon',
         [
            'label' => __( 'Icon', 'digiplace' ),
            'type' => \Elementor\Controls_Manager::MEDIA,
            'default' => [
               'url' => \Elementor\Utils::get_placeholder_image_src(),
            ],
         ]     
      );

      $this->add_control(
         'title',
         [
            'label' => __( 'Title', 'digiplace' ),
            'type' => \Elementor\Controls_Manager::TEXT,
            'default' => __('Awesome Design','digiplace'),
         ]
      );

      $this->add_control(
         'text',
         [
            'label' => __( 'Text', 'digiplace' ),
            'type' => \Elementor\Controls_Manager::TEXTAREA,
            'default' => __('Lorem ipsum dummy text are used here so replace your app data, ipsum dummy text are used here so','digiplace'),
         ]
      );

      $this->add_control(
         'button',
         [
            'label' => __( 'Title', 'digiplace' ),
            'type' => \Elementor\Controls_Manager::TEXT,
            'default' => __('Learn More','digiplace'),
            'condition' => ['style' => 'style1']
         ]
      );

      $this->add_control(
         'url',
         [
            'label' => __( 'Title', 'digiplace' ),
            'type' => \Elementor\Controls_Manager::TEXT,
            'default' => '#',
            'condition' => ['style' => 'style1']
         ]
      );

      $this->end_controls_section();
   }
   protected function render( $instance = [] ) {
 
      // get our input from the widget settings.
       
      $settings = $this->get_settings_for_display();?>

      <div class="single-services mb-30">
          <div class="services-icon mb-30">
              <?php echo wp_get_attachment_image( $settings['icon']['id'],'full'); ?>
          </div>
          <div class="services-content">
              <h4><?php echo esc_html($settings['title']); ?></h4>
              <p><?php echo esc_html($settings['text']); ?></p>
          </div>
      </div>

      

      <?php
   }
 
}
Plugin::instance()->widgets_manager->register_widget_type( new digiplace_Widget_Service );