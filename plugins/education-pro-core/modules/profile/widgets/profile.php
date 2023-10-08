<?php
namespace EpElements\Modules\Profile\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Image_Size;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Background;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Icons_Manager;
use Elementor\Utils;

use EpElements\TX_Load;
use EpElements\TX_Helper;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Profile extends Widget_Base {

    public function get_name() {
        return 'ep-profile';
    }

    public function get_title() {
        return esc_html__( 'EP Profile', 'education-pro-core' );
    }

    public function get_icon() {
        return 'eicon-user-circle-o';
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
        
        $this->add_control(
            'profiles',
            [
                'type' => Controls_Manager::REPEATER,
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

                'fields' => [
                    [
                        'name' => 'user_name',
                        'label' => esc_html__('Name', 'education-pro-core'),
                        'default' => 'John Doe',
                        'type' => Controls_Manager::TEXT,
                    ],

                    [
                        'name' => 'link_url',
                        'label' => esc_html__('Link URL', 'education-pro-core'),
                        'type'        => Controls_Manager::URL,
                        'dynamic'     => [ 'active' => true ],
                        'placeholder' => 'http://your-link.com',
                        
                    ],
       
                    [
                        'name' => 'position',
                        'label' => esc_html__('Position', 'education-pro-core'),
                        'type' => Controls_Manager::TEXT,
                    ],
                    [
                        'name' => 'user_image',
                        'label' => esc_html__('Image', 'education-pro-core'),
                        'type' => Controls_Manager::MEDIA,
                        'default' => [
                            'url' => Utils::get_placeholder_image_src(),
                        ],
                        'label_block' => true,
                    ],

                    [
                        'name' => 'profile_details',
                        'label' => esc_html__('Details', 'education-pro-core'),
                        'type' => Controls_Manager::WYSIWYG,
                        'default' => esc_html__( 'Lorem ipsum dolor sit amet consectetur adipiscing elit sed do eiusmod tempor incididunt.', 'education-pro-core' ),
                    ],
                    [
                        'name' => 'social_profile',
                        'label' => esc_html__('Social Profile', 'education-pro-core'),
                        'type' => Controls_Manager::HEADING,
                    ],
                    [
                        'type' => Controls_Manager::TEXT,
                        'name' => 'email',
                        'label' => esc_html__('Email', 'education-pro-core'),
                    ],
                    [
                        'type' => Controls_Manager::TEXT,
                        'name' => 'facebook',
                        'label' => esc_html__('Facebook', 'education-pro-core'),
                    ],
                    [
                        'type' => Controls_Manager::TEXT,
                        'name' => 'twitter',
                        'label' => esc_html__('Twitter', 'education-pro-core'),
                    ],
                    [
                        'type' => Controls_Manager::TEXT,
                        'name' => 'linkedin',
                        'label' => esc_html__('LinkedIn', 'education-pro-core'),
                    ],
                    [
                        'type' => Controls_Manager::TEXT,
                        'name' => 'instagram',
                        'label' => esc_html__('Instagram', 'education-pro-core'),
                    ],
                    [
                        'type' => Controls_Manager::TEXT,
                        'name' => 'behance',
                        'label' => esc_html__('Behance', 'education-pro-core'),
                    ],
                    [
                        'type' => Controls_Manager::TEXT,
                        'name' => 'dribbble',
                        'label' => esc_html__('Dribbble', 'education-pro-core'),
                    ],
                    [
                        'type' => Controls_Manager::TEXT,
                        'name' => 'pinterest',
                        'label' => esc_html__('Pinterest', 'education-pro-core'),
                    ],
                    [
                        'type' => Controls_Manager::TEXT,
                        'name' => 'youtube',
                        'label' => esc_html__('Youtube', 'education-pro-core'),
                    ],

                ],
                
                'title_field' => '{{user_name}}',
            ]
        );
        $this->add_responsive_control(
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
                    '{{WRAPPER}} .tx-profile-image img' => 'width: {{SIZE}}{{UNIT}};',
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
        $this->add_control(
            'columns',
            [
                'label' => esc_html__( 'Columns', 'education-pro-core' ),
                'type' => Controls_Manager::SELECT,
                'default' => '3',
                'options' => [
                    '12' => esc_html__( 'One Column', 'education-pro-core' ),
                    '6' => esc_html__( 'Two Columns',   'education-pro-core' ),
                    '4' => esc_html__( 'Three Columns', 'education-pro-core' ),
                    '3' => esc_html__( 'Four Columns',  'education-pro-core' ),
                    '2' => esc_html__( 'Six Columns',   'education-pro-core' ),                   
                    
                ],
            ]
        );
        $this->add_control(
            'columns_tablet',
            [
                'label' => esc_html__( 'Columns for Tablet', 'education-pro-core' ),
                'type' => Controls_Manager::SELECT,
                'default' => '6',
                'options' => [
                    '12' => esc_html__( 'One Column', 'education-pro-core' ),
                    '6' => esc_html__( 'Two Columns',   'education-pro-core' ),
                    '4' => esc_html__( 'Three Columns', 'education-pro-core' ),
                    '3' => esc_html__( 'Four Columns',  'education-pro-core' ),
                    '2' => esc_html__( 'Six Columns',   'education-pro-core' ),                   
                    
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
                    '{{WRAPPER}} .tx-profile-container'   => 'text-align: {{VALUE}};',
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
                'selector' => '{{WRAPPER}} .tx-profile-container',
            ]
        );
        
        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'cont_border',
                'label' => esc_html__( 'Border', 'education-pro-core' ),
                'selector' => '{{WRAPPER}} .tx-profile-container',
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
                    '{{WRAPPER}} .tx-profile-container' => 'border-radius: {{SIZE}}{{UNIT}};',
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
                    '{{WRAPPER}} .tx-profile-container' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
                    '{{WRAPPER}} .tx-profile-container' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name'     => 'content_box_shadow',
                'selector' => '{{WRAPPER}} .tx-profile-container'
            ]
        );
        $this->add_control(
            'content_bg_color',
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
                    '{{WRAPPER}} .tx-social-profile a:hover' => 'border-color: {{VALUE}};',
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
        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'sp_border',
                'label' => esc_html__( 'Border', 'education-pro-core' ),
                'selector' => '{{WRAPPER}} .tx-social-profile a',
            ]
        );
        $this->add_control(
            'sp_border_radius',
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
                    '{{WRAPPER}} .tx-social-profile a' => 'border-radius: {{SIZE}}{{UNIT}};',
                ],
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
        $this->add_responsive_control(
            'sp_margin',
            [
                'label' => esc_html__( 'Social Profile Icon Margin', 'education-pro-core' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .tx-social-profile a' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->end_controls_section();
    }
    
    protected function render() {
        $settings = $this->get_settings();
        ?>

        <div class="row">
               <?php foreach ( $settings['profiles'] as $profile ) : ?>
                    <div class="col-lg-<?php echo esc_attr($settings['columns']); ?> col-sm-<?php echo esc_attr( $settings['columns_tablet'] ); ?>">
                        <div class="tx-profile-container">
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
                        </div><!-- tx-profile-container -->
                    </div><!-- col-md -->
               <?php endforeach; ?>    
        </div><!-- row -->

<?php

    } // function render()

} // class Portfolio

