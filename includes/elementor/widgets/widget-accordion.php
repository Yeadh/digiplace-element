<?php 
namespace Elementor;
 
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

// Accordion
class martua_Widget_Accordion extends Widget_Base {
 
   public function get_name() {
      return 'accordion';
   }
 
   public function get_title() {
      return esc_html__( 'Accordion', 'martua' );
   }
 
   public function get_icon() { 
        return 'eicon-accordion';
   }
 
   public function get_categories() {
      return [ 'martua-elements' ];
   }

   protected function _register_controls() {

      $this->start_controls_section(
         'accordion_section',
         [
            'label' => esc_html__( 'Accordion', 'martua' ),
            'type' => Controls_Manager::SECTION,
         ]
      );

      $this->add_control(
         'style',
         [
            'label' => __( 'Style', 'martua' ),
            'type' => \Elementor\Controls_Manager::SELECT,
            'default' => 'style1',
            'options' => [
               'style1' => __( 'Style 1', 'martua' ),
               'style2' => __( 'Style 2', 'martua' ),
            ],
         ]
      );


      $accordion = new \Elementor\Repeater();

      $accordion->add_control(
         'title', [
            'label' => __( 'Title', 'martua' ),
            'type' => \Elementor\Controls_Manager::TEXT
         ]
      );
      $accordion->add_control(
         'text', [
            'label' => __( 'Text', 'martua' ),
            'type' => \Elementor\Controls_Manager::TEXTAREA
         ]
      );

      $this->add_control(
         'accordion_list',
         [
            'label' => __( 'Accordion list', 'martua' ),
            'type' => \Elementor\Controls_Manager::REPEATER,
            'fields' => $accordion->get_controls(),
            'default' => [
               [
                  'title' => __( 'Lorem ipsum dummy text used here?', 'martua' ),
                  'text' => __( 'Lorem ipsum dolor sit amet, vix an natum labitur eleifd, mel am laoreet menandri. Ei justo complectitur duo. Ei mundi solet utos soletu possit quo. Sea cu justo laudem.', 'martua' )
               ],
               [
                  'title' => __( 'Why i should buy this Theme?', 'martua' ),
                  'text' => __( 'Lorem ipsum dolor sit amet, vix an natum labitur eleifd, mel am laoreet menandri. Ei justo complectitur duo. Ei mundi solet utos soletu possit quo. Sea cu justo laudem.', 'martua' )
               ],
               [
                  'title' => __( 'Can i change any elements easilly?', 'martua' ),
                  'text' => __( 'Lorem ipsum dolor sit amet, vix an natum labitur eleifd, mel am laoreet menandri. Ei justo complectitur duo. Ei mundi solet utos soletu possit quo. Sea cu justo laudem.', 'martua' )
               ]
            ],
            'title_field' => '{{{ title }}}',
         ]
      );

      $this->end_controls_section();

   }

   protected function render( $instance = [] ) {
 
      // get our input from the widget settings.

      $randID = wp_rand();

      $settings = $this->get_settings_for_display(); ?>
      
      <?php if ( $settings['style'] == 'style1' ){ ?>
      

      <div class="row">
        <div class="col-12">
          <div class="faq-wrapper-padding">
              <div class="faq-wrapper">
                  <div class="accordion" id="accordionExample<?php echo $randID ?>">
                    <?php if ( $settings['accordion_list'] ) {
                    foreach (  $settings['accordion_list'] as $key => $accordion ) { ?>

                      <div class="card">
                          <div class="card-header" id="heading<?php echo $key.$randID ?>">
                              <h5 class="mb-0">
                                  <a href="#" class="btn-link collapsed" data-toggle="collapse" data-target="#collapse<?php echo $key.$randID ?>"
                                      aria-expanded="false" aria-controls="collapse<?php echo $key.$randID ?>">
                                      <?php echo esc_html( $accordion['title'] ); ?>
                                  </a>
                              </h5>
                          </div>
                          <div id="collapse<?php echo $key.$randID ?>" class="collapse" aria-labelledby="heading<?php echo $key.$randID ?>" data-parent="#accordionExample<?php echo $randID ?>">
                              <div class="card-body">
                                  <p><?php echo esc_html( $accordion['text'] ); ?></p>
                              </div>
                          </div>
                      </div>

                      <?php } 
                    } ?>
                  </div>
              </div>
          </div>
        </div>
      </div>
      <!-- faq-area-end -->

      <?php } elseif( $settings['style'] == 'style2' ){ ?>

          <div class="faq-wrapper s-faq-wrapper">
              <div class="accordion" id="accordionExampleS">
                  
                <?php if ( $settings['accordion_list'] ) {
                  foreach (  $settings['accordion_list'] as $key => $accordion ) { ?>

                  <div class="card">
                      <div class="card-header" id="heading<?php echo $key.$randID ?>S">
                          <h5 class="mb-0">
                              <a href="#" class="btn-link collapsed" data-toggle="collapse" data-target="#collapse<?php echo $key.$randID ?>S"
                                  aria-expanded="false" aria-controls="collapse<?php echo $key.$randID ?>S">
                                  <?php echo esc_html( $accordion['title'] ); ?>
                              </a>
                          </h5>
                      </div>
                      <div id="collapse<?php echo $key.$randID ?>S" class="collapse" aria-labelledby="heading<?php echo $key.$randID ?>S"
                          data-parent="#accordionExampleS">
                          <div class="card-body">
                              <p><?php echo esc_html( $accordion['text'] ); ?></p>
                          </div>
                      </div>
                  </div>

                <?php } 
              } ?>

              </div>
          </div>
      
      <?php } ?>

      <?php
   }

}

Plugin::instance()->widgets_manager->register_widget_type( new martua_Widget_Accordion );