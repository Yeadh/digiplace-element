<?php
namespace Elementor;
 
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
// contact item
class martua_Widget_Contact extends Widget_Base {
 
   public function get_name() {
      return 'contact_info';
   }
 
   public function get_title() {
      return esc_html__( 'Contact Info', 'martua' );
   }
 
   public function get_icon() { 
        return 'eicon-facebook-comments';
   }
 
   public function get_categories() {
      return [ 'martua-elements' ];
   }
   protected function _register_controls() {
      $this->start_controls_section(
         'contact_section',
         [
            'label' => esc_html__( 'Contact Info', 'martua' ),
            'type' => Controls_Manager::SECTION,
         ]
      );


      $this->add_control(
         'sub-title',
         [
            'label' => __( 'Sub Title', 'martua' ),
            'type' => \Elementor\Controls_Manager::TEXT,
            'default' => __('INFORMATION','martua'),
         ]
      );

      $this->add_control(
         'title',
         [
            'label' => __( 'Title', 'martua' ),
            'type' => \Elementor\Controls_Manager::TEXT,
            'default' => __('Office Information','martua'),
         ]
      );

      $contact = new \Elementor\Repeater();

      $contact->add_control(
         'contact',
         [
            'label' => __( 'Title', 'martua' ),
            'type' => \Elementor\Controls_Manager::TEXTAREA,
            'default' => __( 'Office Locations', 'martua' )
         ]
      );

      $contact->add_control(
         'info',
         [
            'label' => __( 'Info', 'martua' ),
            'type' => \Elementor\Controls_Manager::TEXTAREA,
            'default' => __( 'W8 Steet Capital 7TH Lan Roas New York Brooklyn, New York', 'martua' )
         ]
      );

      $this->add_control(
         'contact_list',
         [
            'label' => __( 'Feature List', 'martua' ),
            'type' => \Elementor\Controls_Manager::REPEATER,
            'fields' => $contact->get_controls(),
            'default' => [
               [
                  'contact' => __( 'Office Locations', 'martua' ),
                  'info' => __( 'W8 Steet Capital 7TH Lan Roas New York Brooklyn, New York', 'martua' ),
               ],
               [
                  'contact' => __( 'Contact Number', 'martua' ),
                  'info' => __( '(+02) 124 326 4587 (+02) 124 326 4588', 'martua' ),
               ],
               [
                  'contact' => __( 'Mail Support', 'martua' ),
                  'info' => __( 'infocompany@mail.com info@exemple.com', 'martua' ),
               ]
            ],
            'title_field' => '{{{ contact }}}',
         ]
      );
      
      $this->end_controls_section();
   }
   protected function render( $instance = [] ) {
 
      // get our input from the widget settings.
       
      $settings = $this->get_settings_for_display();
      
      //Inline Editing
      $this->add_inline_editing_attributes( 'title', 'basic' );
      $this->add_inline_editing_attributes( 'sub-title', 'basic' );
      ?>

      <div class="contact-wrap">
         <div class="section-title s-section-title white-title contact-title mb-25">
            <span><?php echo $settings['sub-title'] ?></span>
            <h2><?php echo esc_html($settings['title']); ?></h2>
         </div>
         <div class="contact-info-list">
            <ul>
            <?php foreach( $settings['contact_list'] as $index => $contact ) { ?>
               <li>
                  <h5><?php echo $contact['contact'] ?></h5>
                  <span><?php echo $contact['info'] ?></span>
               </li>
            <?php } ?>
            </ul>
         </div>
      </div>

      <?php
   }
}

Plugin::instance()->widgets_manager->register_widget_type( new martua_Widget_Contact );