<?php
namespace EpElements\Modules\Testimonial\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Image_Size;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Background;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Icons_Manager;
use Elementor\Repeater;
use Elementor\Utils;

use EpElements\TX_Load;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Testimonial extends Widget_Base {

    public function get_name() {
        return 'ep-testimonial';
    }

    public function get_title() {
        return esc_html__( 'EP Testimonial', 'education-pro-core' );
    }

    public function get_icon() {
        return 'eicon-testimonial-carousel';
    }

    public function get_categories() {
        return [ 'ep-elements' ];
    }
	protected function register_controls() {
       
		$this->start_controls_section(
            'settings',
            [
                'label' => esc_html__( 'Content Settings', 'education-pro-core' )
            ]
        );
        
        $repeater = new Repeater();
        
        $repeater->add_control(
            'user_name', 
            [
                'label' => esc_html__( 'Name', 'education-pro-core' ),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__( 'John Doe' , 'education-pro-core' ),
                'label_block' => true,
            ]
        );
        $repeater->add_control(
            'company_name',
            [
                'label' => esc_html__( 'Company Name', 'education-pro-core' ),
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
            ]
        );
        $repeater->add_control(
            'user_image',
            [
               'label' => esc_html__('Image', 'education-pro-core'),
                'type' => Controls_Manager::MEDIA,
                    'default' => [
                        'url' => Utils::get_placeholder_image_src(),
                    ],
                'label_block' => true,
            ]
        );
        $repeater->add_control(
           'testimonial_details',
           [
                'label' => esc_html__('Testimonials', 'education-pro-core'),
                'type' => Controls_Manager::WYSIWYG,
                'default' => esc_html__( 'Lorem ipsum dolor sit amet consectetur adipiscing elit sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.', 'education-pro-core' ),
            ]
        );
        $repeater->add_control(
            'rating',
            [
                'label' => esc_html__( 'Rating', 'education-pro-core' ),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'show' => [
                        'title' => esc_html__( 'Yes', 'education-pro-core' ),
                        'icon' => 'fa fa-check',
                        ],
                    'hide' => [
                        'title' => esc_html__( 'No', 'education-pro-core' ),
                        'icon' => 'fa fa-ban',
                        ]
                ],
                'default' => 'show',
                'separator' => 'before',
            ]
        );
        $repeater->add_control(
            'stars',
            [
                'label'       => esc_html__( 'Stars', 'education-pro-core' ),
                'type' => Controls_Manager::SELECT,
                'default' => 's_5',
                'options' => [
                    's_1'  => esc_html__( '1 Star', 'education-pro-core' ),
                    's_2' => esc_html__( '2 Stars', 'education-pro-core' ),
                    's_3' => esc_html__( '3 Stars', 'education-pro-core' ),
                    's_4' => esc_html__( '4 Stars', 'education-pro-core' ),
                    's_5'   => esc_html__( '5 Stars', 'education-pro-core' ),
                    ],
                'condition' => [
                    'rating' => 'show',
                ],
            ]
        );

        $this->add_control(
            'testimonials',
            [
                'type' => Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default' => [

                    [
                        'user_name' => esc_html__('John Doe', 'education-pro-core'),
                        'company_name' => esc_html__('Theme X', 'education-pro-core'),
                        'testimonial_details' => esc_html__('Lorem ipsum dolor sit amet consectetur adipiscing elit sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.', 'education-pro-core'),
                    ],
                    [
                        'user_name' => esc_html__('Sharon Brinson', 'education-pro-core'),
                        'company_name' => esc_html__('Envato', 'education-pro-core'),
                        'testimonial_details' => esc_html__('Ut enim ad minim veniam quis nostrud exercitation ullamco laboris nisi ut aliquip exea commodo consequat.', 'education-pro-core'),
                    ],
                    [
                        'user_name' => esc_html__('Felix Mercer', 'education-pro-core'),
                        'company_name' => esc_html__('Themeforest', 'education-pro-core'),
                        'testimonial_details' => esc_html__('Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.', 'education-pro-core'),
                    ],
                ],

                
                'title_field' => '{{{user_name}}}',
            ]
        );
        $this->add_control(
            'img_width',
            [
                'label' => esc_html__( 'Image Size', 'education-pro-core' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%' ],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 1000,
                    ],
                    '%' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'default' => [
                    'unit' => 'px',
                    'size' => 100,
                ],
                'selectors' => [
                    '{{WRAPPER}} .tx-testimonial-wrap .owl-carousel .tx-testimonial-image img' => 'width: {{SIZE}}{{UNIT}};',
                ],
                'separator' => 'before'
            ]
        );
        $this->add_control(
            'img_border_radius',
            [
                'label' => esc_html__( 'Image Border Radius', 'education-pro-core' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%' ],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                    '%' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'default' => [
                    'unit' => '%',
                    'size' => 0,
                ],
                'selectors' => [
                    '{{WRAPPER}} .tx-testimonial-image img' => 'border-radius: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->add_control(
            'quote',
            [
                'label' => esc_html__( 'Quote', 'education-pro-core' ),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'show' => [
                        'title' => esc_html__( 'Show', 'education-pro-core' ),
                        'icon' => 'fa fa-check',
                    ],
                    'hide' => [
                        'title' => esc_html__( 'Hide', 'education-pro-core' ),
                        'icon' => 'fa fa-ban',
                    ]
                ],
                'default' => 'show',
                'toggle' => false,
                'separator' => 'before',
            ]
        );

        $this->end_controls_section();
         $this->start_controls_section(
            'carousel_settings',
            [
                'label' => esc_html__('Carousel Settings', 'education-pro-core'),
            ]
        );
         $this->add_control(
            'display_mobile',
            [
                'label' => esc_html__( 'Posts Per Row on Mobile', 'education-pro-core' ),
                'type' => Controls_Manager::NUMBER,
                'default' => 1
            ]
        );
        $this->add_control(
            'display_tablet',
            [
                'label' => esc_html__( 'Posts Per Row on Tablet', 'education-pro-core' ),
                'type' => Controls_Manager::NUMBER,
                'default' => 2
            ]
        );
        $this->add_control(
            'display_laptop',
            [
                'label' => esc_html__( 'Posts Per Row on Laptop', 'education-pro-core' ),
                'type' => Controls_Manager::NUMBER,
                'default' => 2
            ]
        );
        $this->add_control(
            'display_desktop',
            [
                'label' => esc_html__( 'Posts Per Row on Desktop', 'education-pro-core' ),
                'type' => Controls_Manager::NUMBER,
                'default' => 2
            ]
        );
        $this->add_control(
            'gutter',
            [
                'label' => esc_html__( 'Gutter', 'education-pro-core' ),
                'type' => Controls_Manager::NUMBER,
                'default' => 30
            ]
        );
        
        $this->add_control(
            'autoplay',
            [
                'label' => esc_html__( 'Autoplay', 'education-pro-core' ),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'yes' => [
                        'title' => esc_html__( 'Yes', 'education-pro-core' ),
                        'icon' => 'fa fa-check',
                    ],
                    'no' => [
                        'title' => esc_html__( 'No', 'education-pro-core' ),
                        'icon' => 'fa fa-ban',
                    ]
                ],
                'default' => 'yes',
                'toggle' => false,
                'separator' => 'before',
            ]
        );
        $this->add_control(
            'smart_speed',
            [
                'label' => esc_html__('Slide Speed', 'education-pro-core'),
                'type' => Controls_Manager::NUMBER,
                'default' => 600,
                'step'    => 50,
                'condition' => [
                    'autoplay' => 'yes'
                ]
            ]
        );
        $this->add_control(
            'autoplay_timeout',
            [
                'label' => esc_html__('Slide Delay', 'education-pro-core'),
                'type' => Controls_Manager::NUMBER,
                'default' => 2000,
                'step'    => 500,
                'condition' => [
                    'autoplay' => 'yes'
                ]
            ]
        );
        $this->add_control(
            'pause_on_hover',
            [
                'label' => esc_html__( 'Autoplay pause on hover', 'education-pro-core' ),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'yes' => [
                        'title' => esc_html__( 'Yes', 'education-pro-core' ),
                        'icon' => 'fa fa-check',
                    ],
                    'no' => [
                        'title' => esc_html__( 'No', 'education-pro-core' ),
                        'icon' => 'fa fa-ban',
                    ]
                ],
                'default' => 'no',
                'toggle' => false,
            ]
        );
        $this->add_control(
            'loop',
            [
                'label' => esc_html__( 'Loop', 'education-pro-core' ),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'yes' => [
                        'title' => esc_html__( 'Yes', 'education-pro-core' ),
                        'icon' => 'fa fa-check',
                    ],
                    'no' => [
                        'title' => esc_html__( 'No', 'education-pro-core' ),
                        'icon' => 'fa fa-ban',
                    ]
                ],
                'default' => 'yes',
                'toggle' => false,
            ]
        );
        
        $this->add_control(
            'navigation',
            [
                'label' => esc_html__( 'Navigation', 'education-pro-core' ),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'yes' => [
                        'title' => esc_html__( 'Yes', 'education-pro-core' ),
                        'icon' => 'fa fa-check',
                    ],
                    'no' => [
                        'title' => esc_html__( 'No', 'education-pro-core' ),
                        'icon' => 'fa fa-ban',
                    ]
                ],
                'default' => 'no',
                'toggle' => false,
                'separator' => 'before',
            ]
        );
        $this->add_responsive_control(
            'nav_position',
            [
                'label' => esc_html__( 'Navigation Position', 'education-pro-core' ),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'tx-nav-top' => [
                        'title' => esc_html__( 'Top', 'education-pro-core' ),
                        'icon' => 'eicon-v-align-top',
                    ],
                    'tx-nav-middle' => [
                        'title' => esc_html__( 'Middle', 'education-pro-core' ),
                        'icon' => 'eicon-v-align-middle',
                    ],
                    'tx-nav-bottom' => [
                        'title' => esc_html__( 'Bottom', 'education-pro-core' ),
                        'icon' => 'eicon-v-align-bottom',
                    ],
                ],
                'toggle' => false,
                'default' => 'tx-nav-bottom',
                'condition' => [
                    'navigation' => 'yes'
                ],
            ]
        );
        $this->add_responsive_control(
            'nav_alignment',
            [
                'label' => esc_html__( 'Navigation Alignment', 'education-pro-core' ),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'tx-nav-left' => [
                        'title' => esc_html__( 'Left', 'education-pro-core' ),
                        'icon' => 'fa fa-align-left',
                    ],
                    'tx-nav-center' => [
                        'title' => esc_html__( 'Center', 'education-pro-core' ),
                        'icon' => 'fa fa-align-center',
                    ],
                    'tx-nav-right' => [
                        'title' => esc_html__( 'Right', 'education-pro-core' ),
                        'icon' => 'fa fa-align-right',
                    ],
                ],
                'toggle' => false,
                'default' => 'tx-nav-center',
                'condition' => [
                    'nav_position!' => 'tx-nav-middle',
                    'navigation' => 'yes'
                ],
            ]
        );
        $this->add_control(
            'dots',
            [
                'label' => esc_html__( 'Dots', 'education-pro-core' ),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'block' => [
                        'title' => esc_html__( 'Yes', 'education-pro-core' ),
                        'icon' => 'fa fa-check',
                    ],
                    'none' => [
                        'title' => esc_html__( 'No', 'education-pro-core' ),
                        'icon' => 'fa fa-ban',
                    ]
                ],
                'default' => 'none',
                'toggle' => false,
                'selectors'         => [
                    '{{WRAPPER}} .tx-carousel.owl-carousel .owl-dots'   => 'display: {{VALUE}};',
                ],
               
            ]
        );
        $this->end_controls_section();

        // Style section started
        $this->start_controls_section(
            'styles',
            [
              'label'   => esc_html__( 'Styles', 'education-pro-core' ),
              'tab'     => Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'background',
                'label' => esc_html__( 'Background', 'education-pro-core' ),
                'types' => [ 'classic', 'gradient' ],
                'selector' => '{{WRAPPER}} .tx-testimonial',
            ]
        );
        
        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'cont_border',
                'label' => esc_html__( 'Border', 'education-pro-core' ),
                'selector' => '{{WRAPPER}} .tx-testimonial',
            ]
        );
        $this->add_control(
            'cont_border_radius',
            [
                'label' => esc_html__( 'Border Radius', 'education-pro-core' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%' ],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                    '%' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'default' => [
                    'unit' => '%',
                    'size' => 0,
                ],
                'selectors' => [
                    '{{WRAPPER}} .tx-testimonial' => 'border-radius: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'content_padding',
            [
                'label' => esc_html__( 'Padding', 'education-pro-core' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .tx-testimonial' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'content_margin',
            [
                'label' => esc_html__( 'Margin', 'education-pro-core' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .tx-testimonial' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name'     => 'content_box_shadow',
                'selector' => '{{WRAPPER}} .tx-testimonial'
            ]
        );
        $this->add_control(
            'quote_color',
            [
                'label'     => esc_html__( 'Quote Color', 'education-pro-core' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tx-testimonial-quote' => 'color: {{VALUE}};',
                ],
                'condition' => [
                      'quote' => 'show',
                    ],
                'separator' => 'before',
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
              [
                   'name'    => 'quote_typography',
                   'selector'  => '{{WRAPPER}} .tx-testimonial-quote',
                   'condition' => [
                      'quote' => 'show',
                    ],
              ]
        );
        $this->add_control(
            'testi_details_color',
            [
                'label'     => esc_html__( 'Testimonials Details Color', 'education-pro-core' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tx-testimonial-details' => 'color: {{VALUE}};',
                ],
                
                'separator' => 'before',
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
              [
                   'name'    => 'testi_details_typography',
                   'selector'  => '{{WRAPPER}} .tx-testimonial-details',
                   
              ]
        );
        $this->add_control(
            'name_color',
            [
                'label'     => esc_html__( 'Name Color', 'education-pro-core' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tx-testimonial-name' => 'color: {{VALUE}};',
                ],
                
                'separator' => 'before',
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
              [
                   'name'    => 'name_typography',
                   'selector'  => '{{WRAPPER}} .tx-testimonial-name',
                   
              ]
        );
        $this->add_control(
            'com_name_color',
            [
                'label'     => esc_html__( 'Company Name Color', 'education-pro-core' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tx-testimonial-company' => 'color: {{VALUE}};',
                ],
                
                'separator' => 'before',
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
              [
                   'name'    => 'com_name_typography',
                   'selector'  => '{{WRAPPER}} .tx-testimonial-company',
                   
              ]
        );
        
        $this->add_control(
            'navigation_color',
            [
                'label'     => esc_html__( 'Navigation Color', 'education-pro-core' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tx-carousel.owl-carousel .owl-nav button.owl-prev i, {{WRAPPER}} .tx-carousel.owl-carousel .owl-nav button.owl-next i' => 'color: {{VALUE}};',
                ],
                'condition' => [
                    'navigation' => 'yes',
                ],
                'separator' => 'before',
            ]
        );
        $this->add_control(
            'navigation_hover_color',
            [
                'label'     => esc_html__( 'Navigation Hover Color', 'education-pro-core' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tx-carousel.owl-carousel .owl-nav button.owl-prev:hover i, {{WRAPPER}} .tx-carousel.owl-carousel .owl-nav button.owl-next:hover i' => 'color: {{VALUE}};',
                ],
                'condition' => [
                    'navigation' => 'yes',
                ],
            ]
        );
      
        $this->add_control(
            'navigation_hover_bg_color',
            [
                'label'     => esc_html__( 'Navigation Background Color', 'education-pro-core' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tx-carousel.owl-carousel .owl-nav button.owl-prev, {{WRAPPER}} .tx-carousel.owl-carousel .owl-nav button.owl-next' => 'background-color: {{VALUE}};',
                ],
                'condition' => [
                    'navigation' => 'yes',
                ],
            ]
        );
        $this->add_control(
            'navigation_hover_bg_hover_color',
            [
                'label'     => esc_html__( 'Navigation Background Hover Color', 'education-pro-core' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tx-carousel.owl-carousel .owl-nav button.owl-prev:hover, {{WRAPPER}} .tx-carousel.owl-carousel .owl-nav button.owl-next:hover' => 'background-color: {{VALUE}};',
                ],
                'condition' => [
                    'navigation' => 'yes',
                ],
            ]
        );
        
        $this->add_control(
            'dots_bg_color',
            [
                'label'     => esc_html__( 'Dots Color', 'education-pro-core' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tx-carousel.owl-carousel button.owl-dot span' => 'background-color: {{VALUE}};',
                ],
                'separator' => 'before',
                'condition' => [
                    'dots' => 'block',
                ],
            ]
        );
        $this->add_control(
            'dots_active_bg_color',
            [
                'label'     => esc_html__( 'Dots Active Color', 'education-pro-core' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tx-carousel.owl-carousel button.owl-dot.active span' => 'background-color: {{VALUE}};',
                ],
                'condition' => [
                    'dots' => 'block',
                ],
            ]
        );
        $this->add_control(
            'dots_size',
            [
                'label' => esc_html__( 'Dots Size', 'education-pro-core' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px' ],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                   
                ],
                'default' => [
                    'size' => 12,
                ],
                'condition' => [
                    'dots' => 'block',
                ],
                'selectors' => [
                    '{{WRAPPER}} .tx-carousel.owl-carousel button.owl-dot span' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}}',
                ],
            ]
        );
     

        $this->end_controls_section();
    }
    
    protected function render() {
      
        $settings = $this->get_settings_for_display();

            $this->add_render_attribute( 
                [
                    'tx-testimonial-wrap' => [
                        'class' => [
                            'tx-testimonial-wrap',
                            $settings['nav_position'],
                            $settings['nav_alignment'],
                        ] 
                    ]
                ]
            );
            $this->add_render_attribute( 'tx-carousel', 'class', 'tx-carousel owl-carousel owl-theme' );
            $this->add_render_attribute(
                [
                    'tx-carousel' => [
                        'data-settings' => [
                            wp_json_encode(array_filter([
                               'navigation' => ('yes' === $settings['navigation']),
                               'autoplay' => ('yes' === $settings['autoplay']),
                               'autoplay_timeout' => absint($settings['autoplay_timeout']),
                               'smart_speed' => absint($settings['smart_speed']),
                               'pause_on_hover' => ('yes' === $settings['pause_on_hover']),
                               'loop' => ('yes' === $settings['loop']),
                               'display_mobile' => $settings['display_mobile'],
                               'display_tablet' => $settings['display_tablet'],
                               'display_laptop' => $settings['display_laptop'],
                               'display_desktop' => $settings['display_desktop'],
                               'gutter' => $settings['gutter'],
                            ]))
                        ]
                    ]
                ]
            );        

        ?>

        <div <?php echo $this->get_render_attribute_string( 'tx-testimonial-wrap' ); ?> >

            <div <?php echo $this->get_render_attribute_string( 'tx-carousel' ); ?> >

                
               <?php foreach ( $settings['testimonials'] as $testimonial ) : ?>
                   
                    <div class="tx-testimonial <?php echo esc_attr( $testimonial['stars'] ); ?>">
                        <?php if($settings['quote'] == 'show') : ?>
                        <div class="tx-testimonial-quote"><i class="fas fa-quote-left"></i></div>
                        <?php endif; ?>

                        <div class="tx-testimonial-details"><?php echo sprintf( $testimonial['testimonial_details'] ); ?></div>
                        <?php if ( $testimonial['rating'] == 'show' ) : ?>
                        <ul class="tx-testimonial-star">
                            <li><i class="fas fa-star" aria-hidden="true"></i></li>
                            <li><i class="fas fa-star" aria-hidden="true"></i></li>
                            <li><i class="fas fa-star" aria-hidden="true"></i></li>
                            <li><i class="fas fa-star" aria-hidden="true"></i></li>
                            <li><i class="fas fa-star" aria-hidden="true"></i></li>
                        </ul>
                        <?php endif;?>
                        <h5 class="tx-testimonial-name"><?php echo esc_html( $testimonial['user_name'] ); ?></h5>
                        <div class="tx-testimonial-company"><?php echo esc_html( $testimonial['company_name'] ); ?></div>
                        <?php if(!empty($testimonial['user_image']['url'])) : ?>
                        <div class="tx-testimonial-image"><img src="<?php echo esc_attr($testimonial['user_image']['url']);?>" alt="<?php echo esc_attr( $testimonial['user_name'] ); ?>"></div>  
                        <?php endif; ?>


                    </div><!-- tx-testimonial -->
               <?php endforeach; ?>

            </div><!-- testimonial-carousel -->
            
        </div><!-- tx-testimonial-wrap -->


<?php

    } // function render()

} // class Portfolio


