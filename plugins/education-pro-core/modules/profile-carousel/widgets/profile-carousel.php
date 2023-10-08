<?php
namespace EpElements\Modules\ProfileCarousel\Widgets;

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
use EpElements\TX_Helper;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class ProfileCarousel extends Widget_Base {

    public function get_name() {
        return 'ep-profile-carousel';
    }

    public function get_title() {
        return esc_html__( 'EP Profile Carousel', 'education-pro-core' );
    }

    public function get_icon() {
        return 'eicon-carousel';
    }

    public function get_categories() {
        return [ 'ep-elements' ];
    }

	protected function register_controls() {
       
		$this->start_controls_section(
            'settings',
            [
                'label' => esc_html__( 'Content', 'education-pro-core' )
            ]
        );
        
        $repeater = new Repeater();
        $repeater->add_control(
            'user_name', 
            [
                'label' => esc_html__('Name', 'education-pro-core'),
                'default' => 'John Doe',
                'type' => Controls_Manager::TEXT,
            ]
        );
        $repeater->add_control(
            'link_url', 
            [
                'label' => esc_html__('Link URL', 'education-pro-core'),
                'type'        => Controls_Manager::URL,
                'dynamic'     => [ 'active' => true ],
                'placeholder' => 'http://your-link.com',
            ]
        );
        $repeater->add_control(
            'position', 
            [
                'label' => esc_html__('Position', 'education-pro-core'),
                'type' => Controls_Manager::TEXT,
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
            'profile_details', 
            [
                'label' => esc_html__('Details', 'education-pro-core'),
                'type' => Controls_Manager::WYSIWYG,
                'default' => esc_html__( 'Lorem ipsum dolor sit amet consectetur adipiscing elit sed do eiusmod tempor incididunt.', 'education-pro-core' ),
            ]
        );
        $repeater->add_control(
            'social_profile', 
            [
                'label' => esc_html__('Social Profile', 'avas'),
                'type' => Controls_Manager::HEADING,
            ]
        );
        $repeater->add_control(
            'email', 
            [
                'label' => esc_html__('Email', 'avas'),
                'type' => Controls_Manager::TEXT,
            ]
        );
        $repeater->add_control(
            'facebook', 
            [
                'label' => esc_html__('Facebook', 'avas'),
                'type' => Controls_Manager::TEXT,
            ]
        );
        $repeater->add_control(
            'twitter', 
            [
                'label' => esc_html__('Twitter', 'avas'),
                'type' => Controls_Manager::TEXT,
            ]
        );
        $repeater->add_control(
            'linkedin', 
            [
                'label' => esc_html__('LinkedIn', 'avas'),
                'type' => Controls_Manager::TEXT,
            ]
        );
        $repeater->add_control(
            'instagram', 
            [
                'label' => esc_html__('Instagram', 'avas'),
                'type' => Controls_Manager::TEXT,
            ]
        );
        $repeater->add_control(
            'behance', 
            [
                'label' => esc_html__('Behance', 'avas'),
                'type' => Controls_Manager::TEXT,
            ]
        );
        $repeater->add_control(
            'dribbble', 
            [
                'label' => esc_html__('Dribbble', 'avas'),
                'type' => Controls_Manager::TEXT,
            ]
        );
        $repeater->add_control(
            'pinterest', 
            [
                'label' => esc_html__('Pinterest', 'avas'),
                'type' => Controls_Manager::TEXT,
            ]
        );
        $repeater->add_control(
            'youtube', 
            [
                'label' => esc_html__('Youtube', 'avas'),
                'type' => Controls_Manager::TEXT,
            ]
        );
        
        $this->add_control(
            'profiles',
            [
                'type' => Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default' => [

                    [
                        'user_name' => esc_html__('John Doe', 'education-pro-core'),
                        'position' => esc_html__('Web Developer', 'education-pro-core'),
                        'profile_details' => esc_html__('Lorem ipsum dolor sit amet consectetur adipiscing elit sed do eiusmod tempor incididunt.', 'education-pro-core'),
                    ],
                    [
                        'user_name' => esc_html__('Sharon Brinson', 'education-pro-core'),
                        'position' => esc_html__('Graphics Designer', 'education-pro-core'),
                        'profile_details' => esc_html__('Ut enim ad minim veniam quis nostrud exercitation ullamco laboris nisi ut aliquip.', 'education-pro-core'),
                    ],
                    [
                        'user_name' => esc_html__('Felix Mercer', 'education-pro-core'),
                        'position' => esc_html__('Marketing Expert', 'education-pro-core'),
                        'profile_details' => esc_html__('Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore.', 'education-pro-core'),
                    ],
                    [
                        'user_name' => esc_html__('Carla Houston', 'education-pro-core'),
                        'position' => esc_html__('Finance Manager', 'education-pro-core'),
                        'profile_details' => esc_html__('Cras hendrerit suscipit ligula id ultrices. Maecenas dolor libero fringilla.', 'education-pro-core'),
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
                    'size' => 250,
                ],
                'selectors' => [
                    '{{WRAPPER}} .tx-profile-wrap .owl-carousel .tx-profile-image img' => 'width: {{SIZE}}{{UNIT}};',
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
                    '{{WRAPPER}} .tx-profile-image img' => 'border-radius: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'alignment',
            [
                'label' => esc_html__( 'Alignment', 'education-pro-core' ),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'left' => [
                        'title' => esc_html__( 'Left', 'education-pro-core' ),
                        'icon' => 'fa fa-align-left',
                    ],
                    'center' => [
                        'title' => esc_html__( 'Center', 'education-pro-core' ),
                        'icon' => 'fa fa-align-center',
                    ],
                    'right' => [
                        'title' => esc_html__( 'Right', 'education-pro-core' ),
                        'icon' => 'fa fa-align-right',
                    ],
                ],
                'toggle' => false,
                'selectors'         => [
                    '{{WRAPPER}} .tx-profile-content-wrap'   => 'text-align: {{VALUE}};',
                ],
                

            ]
        );

        $this->end_controls_section();
         $this->start_controls_section(
            'carousel_settings',
            [
                'label' => esc_html__('Settings', 'education-pro-core'),
            ]
        );
         $this->add_control(
            'display_mobile',
            [
                'label' => esc_html__( 'Profile Per Row on Mobile', 'education-pro-core' ),
                'type' => Controls_Manager::NUMBER,
                'default' => 1
            ]
        );
        $this->add_control(
            'display_tablet',
            [
                'label' => esc_html__( 'Profile Per Row on Tablet', 'education-pro-core' ),
                'type' => Controls_Manager::NUMBER,
                'default' => 2
            ]
        );
        $this->add_control(
            'display_laptop',
            [
                'label' => esc_html__( 'Profile Per Row on Laptop', 'education-pro-core' ),
                'type' => Controls_Manager::NUMBER,
                'default' => 3
            ]
        );
        $this->add_control(
            'display_desktop',
            [
                'label' => esc_html__( 'Profile Per Row on Desktop', 'education-pro-core' ),
                'type' => Controls_Manager::NUMBER,
                'default' => 4
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
                'default' => 'no',
                'toggle' => false,
                'separator' => 'before',
            ]
        );
        $this->add_control(
            'smart_speed',
            [
                'label' => esc_html__('Slide Speed', 'education-pro-core'),
                'type' => Controls_Manager::NUMBER,
                'default' => 800,
                'step' => 50,
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
                'default' => 2500,
                'step' => 500,
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
                'default' => 'yes',
                'toggle' => false,
                 'condition' => [
                    'autoplay' => 'yes'
                ]
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
                'selector' => '{{WRAPPER}} .tx-profile-content-wrap',
            ]
        );
        
        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'cont_border',
                'label' => esc_html__( 'Border', 'education-pro-core' ),
                'selector' => '{{WRAPPER}} .tx-profile-content-wrap',
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
                    '{{WRAPPER}} .tx-profile-content-wrap' => 'border-radius: {{SIZE}}{{UNIT}};',
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
                    '{{WRAPPER}} .tx-profile-content-wrap' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
                    '{{WRAPPER}} .tx-profile-content-wrap' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name'     => 'content_box_shadow',
                'selector' => '{{WRAPPER}} .tx-profile-content-wrap'
            ]
        );
        $this->add_control(
            'cont_bg_color',
            [
                'label'     => esc_html__( 'Content Background Color', 'education-pro-core' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tx-profile-content' => 'background-color: {{VALUE}};',
                ],
                
                'separator' => 'before',
            ]
        );
        $this->add_responsive_control(
            'cont_pad',
            [
                'label' => esc_html__( 'Content Padding', 'education-pro-core' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .tx-profile-content' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'cont_only_border',
                'label' => esc_html__( 'Content Border', 'education-pro-core' ),
                'selector' => '{{WRAPPER}} .tx-profile-content',
            ]
        );
        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name'     => 'content_only_box_shadow',
                'selector' => '{{WRAPPER}} .tx-profile-content'
            ]
        );
        $this->add_control(
            'name_color',
            [
                'label'     => esc_html__( 'Name Color', 'education-pro-core' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tx-profile-name' => 'color: {{VALUE}};',
                ],
                
                'separator' => 'before',
            ]
        );
        $this->add_control(
            'name_hov_color',
            [
                'label'     => esc_html__( 'Name Hover Color', 'education-pro-core' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tx-profile-name:hover' => 'color: {{VALUE}};',
                ],
                
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
              [
                   'name'    => 'name_typography',
                   'selector'  => '{{WRAPPER}} .tx-profile-name',
                   
              ]
        );
        $this->add_control(
            'position_color',
            [
                'label'     => esc_html__( 'Position Color', 'education-pro-core' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tx-profile-position' => 'color: {{VALUE}};',
                ],
                
                'separator' => 'before',
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
              [
                   'name'    => 'position_typography',
                   'selector'  => '{{WRAPPER}} .tx-profile-position',
                   
              ]
        );
        $this->add_control(
            'profile_details_color',
            [
                'label'     => esc_html__( 'Profile Details Color', 'education-pro-core' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tx-profile-details' => 'color: {{VALUE}};',
                ],
                
                'separator' => 'before',
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
              [
                   'name'    => 'profile_details_typography',
                   'selector'  => '{{WRAPPER}} .tx-profile-details',
                   
              ]
        );
        $this->add_control(
            'sp_color',
            [
                'label'     => esc_html__( 'Social Profile Color', 'education-pro-core' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tx-social-profile a i' => 'color: {{VALUE}};',
                ],
                
                'separator' => 'before',
            ]
        );
        $this->add_control(
            'sp_hov_color',
            [
                'label'     => esc_html__( 'Social Profile Hover Color', 'education-pro-core' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tx-social-profile a:hover i' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
              [
                   'name'    => 'sp_typography',
                   'selector'  => '{{WRAPPER}} .tx-social-profile a i',
                   
              ]
        );
        $this->add_responsive_control(
            'sp_padding',
            [
                'label' => esc_html__( 'Social Profile Icon Padding', 'education-pro-core' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .tx-social-profile a' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
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
      
        $settings = $this->get_settings();
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

        <div class="tx-profile-wrap">

            <div <?php echo $this->get_render_attribute_string( 'tx-carousel' ); ?> >

               <?php foreach ( $settings['profiles'] as $profile ) : ?>
                        <div class="tx-profile-content-wrap">
                            <?php if(!empty($profile['user_image']['url'])) : ?>
                            <div class="tx-profile-image"><img src="<?php echo esc_attr($profile['user_image']['url']);?>" alt="<?php echo esc_attr( $profile['user_name'] ); ?>">
                            </div><!-- tx-profile-image -->
                            <?php endif; ?>

                            <div class="tx-profile-content">
                                <?php if ( $profile['link_url']['is_external'] &&  !empty($profile['link_url']['url']) ) : ?>
                                <a href="<?php echo $profile['link_url']['url']; ?>" target="_blank"><h4 class="tx-profile-name"><?php echo esc_html( $profile['user_name'] ); ?></h4></a>
                                <?php elseif (!empty($profile['link_url']['url'])) : ?>
                                   <a href="<?php echo $profile['link_url']['url']; ?>"><h4 class="tx-profile-name"><?php echo esc_html( $profile['user_name'] ); ?></h4></a>
                                
                                <?php else : ?>
                                <h4 class="tx-profile-name"><?php echo esc_html( $profile['user_name'] ); ?></h4>    
                                <?php endif; ?>
                                <div class="tx-profile-position"><?php echo esc_html( $profile['position'] ); ?></div>
                                <div class="tx-profile-details"><?php echo sprintf( $profile['profile_details'] ); ?></div>
                                <?php TX_Helper::social_profile($profile); ?> 
                            </div><!-- tx-profile-content -->
                        </div><!-- tx-profile-content-wrap -->
               <?php endforeach; ?>

            </div><!-- tx-carousel -->
            
        </div><!-- tx-profile-wrap -->

<?php

    } // function render()


} // class Portfolio