<?php
namespace EpElements\Modules\Countdown\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Background;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Text_Shadow;
use Elementor\Icons_Manager;
use Elementor\Utils;

use EpElements\TX_Load;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Countdown extends Widget_Base {

    public function get_name() {
        return 'ep-countdown';
    }

    public function get_title() {
        return esc_html__( 'EP Countdown', 'education-pro-core' );
    }

    public function get_icon() {
        return 'eicon-countdown';
    }

    public function get_categories() {
        return [ 'ep-elements' ];
    }

    public function get_script_depends() {
        return [ 'countdown' ];
    }
    public function get_keywords() {
        return [ 'countdown', 'timer' ];
    }

	protected function register_controls() {

        
        $this->start_controls_section(
            'tx_cd_settings',
            [
                'label' => esc_html__( 'Settings', 'education-pro-core' )
            ]
        );
        
        $this->add_control(
            'tx_cd_due_date_time',
            [
                'label' => esc_html__( 'Set Date and Time', 'education-pro-core' ),
                'type' => Controls_Manager::DATE_TIME,
                'default' => date("Y-m-d", strtotime("+ 2 day")),
            ]
        );
        $this->add_control(
            'tx_cd_label_style',
            [
                'label' => esc_html__( 'Label', 'education-pro-core' ),
                'type' => Controls_Manager::SELECT,
                'default' => 'tx-cd-label-block',
                'options' => [
                    'tx-cd-label-block' => esc_html__( 'Block', 'education-pro-core' ),
                    'tx-cd-label-inline' => esc_html__( 'Inline', 'education-pro-core' ),
                ],
            ]
        );
        $this->add_responsive_control(
            'tx_cd_label_spacing',
            [
                'label' => esc_html__( 'Label Spacing', 'education-pro-core' ),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .tx-cd-label' => 'padding-left:{{SIZE}}px;',
                ],
                'condition' => [
                    'tx_cd_label_style' => 'tx-cd-label-inline',
                ],
            ]
        );
        $this->add_control(
            'tx_cd_separator',
            [
                'label' => esc_html__( 'Separator', 'education-pro-core' ),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    '-separator' => [
                        'title' => esc_html__( 'Show', 'education-pro-core' ),
                        'icon' => 'fa fa-check',
                    ],
                    '-none' => [
                        'title' => esc_html__( 'Hide', 'education-pro-core' ),
                        'icon' => 'fa fa-ban',
                    ]
                ],
                'default' => '-none',
                'toggle' => false,
                'prefix_class' => 'tx-cd'
            ]
        );
        $this->add_control(
            'tx_cd_days',
            [
                'label' => esc_html__( 'Days', 'education-pro-core' ),
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
                'separator' => 'before',
                'toggle' => false
            ]
        );
        $this->add_control(
            'tx_cd_days_label',
            [
                'label' => esc_html__( 'Label', 'education-pro-core' ),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__( 'Days', 'education-pro-core' ),
                'condition' => [
                    'tx_cd_days' => 'show',
                ],
            ]
        );
        $this->add_control(
            'tx_cd_hours',
            [
                'label' => esc_html__( 'Hours', 'education-pro-core' ),
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
                'separator' => 'before',
                'toggle' => false
            ]
        );
        $this->add_control(
            'tx_cd_hours_label',
            [
                'label' => esc_html__( 'Label', 'education-pro-core' ),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__( 'Hours', 'education-pro-core' ),
                'condition' => [
                    'tx_cd_hours' => 'show',
                ],
            ]
        );       
        $this->add_control(
            'tx_cd_mins',
            [
                'label' => esc_html__( 'Minutes', 'education-pro-core' ),
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
                'separator' => 'before',
                'toggle' => false
            ]
        );
        $this->add_control(
            'tx_cd_mins_label',
            [
                'label' => esc_html__( 'Label', 'education-pro-core' ),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__( 'Minutes', 'education-pro-core' ),
                'condition' => [
                    'tx_cd_mins' => 'show',
                ],
            ]
        );
        $this->add_control(
            'tx_cd_secs',
            [
                'label' => esc_html__( 'Seconds', 'education-pro-core' ),
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
                'separator' => 'before',
                'toggle' => false
            ]
        );
        $this->add_control(
            'tx_cd_secs_label',
            [
                'label' => esc_html__( 'Label', 'education-pro-core' ),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__( 'Seconds', 'education-pro-core' ),
                'condition' => [
                    'tx_cd_secs' => 'show',
                ],
            ]
        );           
        $this->end_controls_section();
        
        $this->start_controls_section(
            'tx_cd_styles',
            [
                'label' => esc_html__( 'Styles', 'education-pro-core' ),
                'tab' => Controls_Manager::TAB_STYLE
            ]
        );
        $this->add_control(
            'tx_cd_background',
            [
                'label' => esc_html__( 'Background Color', 'education-pro-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tx-cd-content > div' => 'background-color: {{VALUE}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'tx_cd_spacing',
            [
                'label' => esc_html__( 'Spacing', 'education-pro-core' ),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .tx-cd-content > div' => 'margin-right:{{SIZE}}px; margin-left:{{SIZE}}px;',
                    '{{WRAPPER}} .tx-countdown-container' => 'margin-right: -{{SIZE}}px; margin-left: -{{SIZE}}px;',
                ],
            ]
        );        
        $this->add_responsive_control(
            'tx_cd_padding',
            [
                'label' => esc_html__( 'Padding', 'education-pro-core' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} .tx-cd-content > div' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'tx_cd_border',
                'label' => esc_html__( 'Border', 'education-pro-core' ),
                'selector' => '{{WRAPPER}} .tx-cd-content > div',
            ]
        );
        $this->add_control(
            'tx_cd_border_radius',
            [
                'label' => esc_html__( 'Border Radius', 'education-pro-core' ),
                'type' => Controls_Manager::DIMENSIONS,
                'selectors' => [
                    '{{WRAPPER}} .tx-cd-content > div' => 'border-radius: {{TOP}}px {{RIGHT}}px {{BOTTOM}}px {{LEFT}}px;',
                ],
            ]
        );
        $this->add_control(
            'tx_cd_digits_color',
            [
                'label' => esc_html__( 'Digits Color', 'education-pro-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tx-cd-digits' => 'color: {{VALUE}};',
                ],
                'separator' => 'before'
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
             'name' => 'tx_cd_digit_typography',
                'selector' => '{{WRAPPER}} .tx-cd-digits',
            ]
        );
        $this->add_control(
            'tx_cd_label_color',
            [
                'label' => esc_html__( 'Label Color', 'education-pro-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tx-cd-label' => 'color: {{VALUE}};',
                ],
                'separator' => 'before'
            ]
        );
        
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
             'name' => 'tx_cd_label_typography',
                'selector' => '{{WRAPPER}} .tx-cd-label',
            ]
        );
        $this->end_controls_section();       
        $this->start_controls_section(
            'tx_cd_block_styles',
            [
                'label' => esc_html__( 'Block Styles', 'education-pro-core' ),
                'tab' => Controls_Manager::TAB_STYLE
            ]
        );
        $this->add_control(
            'tx_cd_days_bg_color',
            [
                'label' => esc_html__( 'Days Background Color', 'education-pro-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tx-cd-content > div.tx-cd-days' => 'background-color: {{VALUE}};',
                ],
            ]
        );
        $this->add_control(
            'tx_cd_days_digit_color',
            [
                'label' => esc_html__( 'Days Digit Color', 'education-pro-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tx-cd-days .tx-cd-digits' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_control(
            'tx_cd_days_label_color',
            [
                'label' => esc_html__( 'Days Label Color', 'education-pro-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tx-cd-days .tx-cd-label' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_control(
            'tx_cd_days_border_color',
            [
                'label' => esc_html__( 'Border Color', 'education-pro-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tx-cd-content > div.tx-cd-days' => 'border-color: {{VALUE}};',
                ],
            ]
        );
        $this->add_control(
            'tx_cd_hours_bg_color',
            [
                'label' => esc_html__( 'Hours Background Color', 'education-pro-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tx-cd-content > div.tx-cd-hours' => 'background-color: {{VALUE}};',
                ],
                'separator' => 'before'
            ]
        );
        $this->add_control(
            'tx_cd_hours_hours_digit_color',
            [
                'label' => esc_html__( 'Hours Digit Color', 'education-pro-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tx-cd-hours .tx-cd-digits' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_control(
            'tx_cd_hours_label_color',
            [
                'label' => esc_html__( 'Hours Label Color', 'education-pro-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tx-cd-hours .tx-cd-label' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_control(
            'tx_cd_hours_border_color',
            [
                'label' => esc_html__( 'Border Color', 'education-pro-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tx-cd-content > div.tx-cd-hours' => 'border-color: {{VALUE}};',
                ],
            ]
        );
        $this->add_control(
            'tx_cd_minutes_bg_color',
            [
                'label' => esc_html__( 'Minutes Background Color', 'education-pro-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tx-cd-content > div.tx-cd-minutes' => 'background-color: {{VALUE}};',
                ],
                'separator' => 'before'
            ]
        );
        $this->add_control(
            'tx_cd_minutes_digit_color',
            [
                'label' => esc_html__( 'Minutes Digit Color', 'education-pro-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tx-cd-minutes .tx-cd-digits' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_control(
            'tx_cd_minutes_label_color',
            [
                'label' => esc_html__( 'Minutes Label Color', 'education-pro-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tx-cd-minutes .tx-cd-label' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_control(
            'tx_cd_minutes_border_color',
            [
                'label' => esc_html__( 'Minutes Border Color', 'education-pro-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tx-cd-content > div.tx-cd-minutes' => 'border-color: {{VALUE}};',
                ],
            ]
        );
        $this->add_control(
            'tx_cd_seconds_bg_color',
            [
                'label' => esc_html__( 'Seconds Background Color', 'education-pro-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tx-cd-content > div.tx-cd-seconds' => 'background-color: {{VALUE}};',
                ],
                'separator' => 'before'
            ]
        );
        $this->add_control(
            'tx_cd_seconds_digit_color',
            [
                'label' => esc_html__( 'Seconds Digit Color', 'education-pro-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tx-cd-seconds .tx-cd-digits' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_control(
            'tx_cd_seconds_label_color',
            [
                'label' => esc_html__( 'Seconds Label Color', 'education-pro-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tx-cd-seconds .tx-cd-label' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_control(
            'tx_cd_seconds_border_color',
            [
                'label' => esc_html__( 'Seconds Border Color', 'education-pro-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tx-cd-content > div.tx-cd-seconds' => 'border-color: {{VALUE}};',
                ],
            ]
        );
        $this->end_controls_section();
    }

	protected function render( ) {
        $settings = $this->get_settings();
        $get_due_date =  esc_attr($settings['tx_cd_due_date_time']);
        $due_date = date("M d Y G:i:s", strtotime($get_due_date));
        $id = $this->get_id();
        $this->add_render_attribute( 'tx-cd-container', 'class', 'tx-countdown-container ' . $settings['tx_cd_label_style'] );
        $this->add_render_attribute( 'tx-cd-content', 'id', 'tx-cd-' . $id );
        $this->add_render_attribute( 'tx-cd-content', 'class', 'tx-countdown-content' );
        $this->add_render_attribute( 'tx-cd-content', 'data-date', $due_date );
        $this->add_render_attribute( 'tx-cd-digits', 'class', 'tx-cd-digits' );
        $this->add_render_attribute( 'tx-cd-label', 'class', 'tx-cd-label' );
        
    ?>

    <div class="tx-countdown-wrapper">
        <div <?php echo $this->get_render_attribute_string( 'tx-cd-container' ); ?> >
            <ul <?php echo $this->get_render_attribute_string( 'tx-cd-content' ); ?>>
                <?php if ( $settings['tx_cd_days'] == 'show' ) : ?>
                    <li class="tx-cd-content">
                        <div class="tx-cd-days">
                            <span data-days <?php echo $this->get_render_attribute_string( 'tx-cd-digits' ); ?>><?php echo esc_html__( '00', 'avas-core' ); ?></span>
                            <?php if ( ! empty($settings['tx_cd_days_label']) ) : ?>
                                <span class="tx-cd-label"><?php echo esc_attr($settings['tx_cd_days_label'] ); ?></span>
                            <?php endif; ?>
                        </div><!-- tx-cd-days -->
                    </li><!-- tx-cd-content -->
                <?php endif; ?>
                <?php if ( $settings['tx_cd_hours'] == 'show' ) : ?>
                    <li class="tx-cd-content">
                        <div class="tx-cd-hours">
                            <span data-hours <?php echo $this->get_render_attribute_string( 'tx-cd-digits' ); ?>><?php echo esc_html__( '00', 'avas-core' ); ?></span>
                            <?php if ( ! empty( $settings['tx_cd_hours_label'] ) ) : ?>
                                <span <?php echo $this->get_render_attribute_string( 'tx-cd-label' ); ?>><?php echo esc_attr($settings['tx_cd_hours_label'] ); ?></span>
                            <?php endif; ?>
                        </div><!-- tx-cd-hours -->
                    </li><!-- tx-cd-content -->
                <?php endif; ?>
                <?php if ( $settings['tx_cd_mins'] == 'show' ) : ?>
                    <li class="tx-cd-content">
                        <div class="tx-cd-minutes">
                            <span data-minutes <?php echo $this->get_render_attribute_string( 'tx-cd-digits' ); ?>><?php echo esc_html__( '00', 'avas-core' ); ?></span>
                            <?php if ( ! empty( $settings['tx_cd_mins_label'] ) ) : ?>
                                <span <?php echo $this->get_render_attribute_string( 'tx-cd-label' ); ?>><?php echo esc_attr($settings['tx_cd_mins_label'] ); ?></span>
                            <?php endif; ?>
                        </div><!-- tx-cd-minutes -->
                    </li><!-- tx-cd-content -->
                <?php endif; ?>
                <?php if ( $settings['tx_cd_secs'] == 'show' ) : ?>
                    <li class="tx-cd-content">
                        <div class="tx-cd-seconds">
                            <span data-seconds <?php echo $this->get_render_attribute_string( 'tx-cd-digits' ); ?>><?php echo esc_html__( '00', 'avas-core' ); ?></span>
                            <?php if ( ! empty( $settings['tx_cd_secs_label'] ) ) : ?>
                                <span <?php echo $this->get_render_attribute_string( 'tx-cd-label' ); ?>><?php echo esc_attr($settings['tx_cd_secs_label'] ); ?></span>
                            <?php endif; ?>
                        </div><!-- tx-cd-seconds -->
                    </li><!-- tx-cd-content -->
                <?php endif; ?>
            </ul><!-- tx-countdown-content -->
            <div class="clearfix"></div>
        </div><!-- tx-countdown-container -->
    </div><!-- tx-countdown-wrapper -->
    
    <?php   
    }
} // class
