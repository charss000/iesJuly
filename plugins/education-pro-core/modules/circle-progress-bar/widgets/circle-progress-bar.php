<?php
namespace EpElements\Modules\CircleProgressBar\Widgets;

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

class CircleProgressBar extends Widget_Base {

    public function get_name() {
        return 'ep-circle-progress-bar';
    }

    public function get_title() {
        return esc_html__( 'EP Circle Progress Bar', 'education-pro-core' );
    }

    public function get_icon() {
        return 'eicon-counter-circle';
    }

    public function get_categories() {
        return [ 'ep-elements' ];
    }

    public function get_script_depends() {
        return [ 'asPieProgress' ];
    }
    public function get_keywords() {
        return [ 'circle', 'progress', 'bar', 'asPieProgress' ];
    }

	protected function register_controls() {
		$this->start_controls_section(
            'settings',
            [
                'label' => esc_html__( 'Settings', 'education-pro-core' )
            ]
        );
        $this->add_control(
            'percentage',
            [
                'label' => esc_html__( 'Percentage', 'education-pro-core' ),
                'type' => Controls_Manager::NUMBER,
                'min' => 0,
                'max' => 100,
                'step' => 1,
                'default' => 75,
            ]
        );
        $this->add_control(
            'bar_size',
            [
                'label'   => esc_html__( 'Bar Size', 'education-pro-core' ),
                'type'    => Controls_Manager::NUMBER,
                'default' => 15,
            ]
        );
        $this->add_control(
            'speed',
            [
                'label'   => esc_html__( 'Delay', 'education-pro-core' ),
                'type'    => Controls_Manager::NUMBER,
                'default' => 3,
            ]
        );
        $this->add_control(
            'before_txt',
            [
                'label' => esc_html__( 'Before Text', 'education-pro-core' ),
                'type' => Controls_Manager::TEXT,
            ]
        );
        $this->add_control(
            'percentage_txt',
            [
                'label' => esc_html__( 'Percentage Text', 'education-pro-core' ),
                'type' => Controls_Manager::TEXT,
            ]
        );
        $this->add_control(
            'after_txt',
            [
                'label' => esc_html__( 'After Text', 'education-pro-core' ),
                'type' => Controls_Manager::TEXT,
            ]
        );
        $this->add_control(
            'line_cap',
            [
                'label'     => esc_html__( 'Line Cap', 'education-pro-core' ),
                'type'      => Controls_Manager::SELECT,
                'default'   => 'round',
                'options'   => [
                    'round' => esc_html__( 'Rounded', 'education-pro-core' ),
                    'square'  => esc_html__( 'Square', 'education-pro-core' ),
                    'butt'    => esc_html__( 'Butt', 'education-pro-core' ),
                ],
            ]
        );
        $this->end_controls_section();

		$this->start_controls_section(
			'styles',
			[
				'label' 	=> esc_html__( 'Style', 'education-pro-core' ),
				'tab' 		=> Controls_Manager::TAB_STYLE,
			]
		);
        
        $this->add_control(
            'bar_color',
            [
                'label'     => esc_html__( 'Color', 'education-pro-core' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tx-circle-progress-bar .pie_progress__svg svg path' => 'stroke: {{VALUE}};',
                ],
            ]
        );
        $this->add_control(
            'bar_bg_color',
            [
                'label'     => esc_html__( 'Background Color', 'education-pro-core' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tx-circle-progress-bar .pie_progress__svg svg ellipse' => 'stroke: {{VALUE}};',
                ],
                
            ]
        );
        $this->add_control(
            'before_color',
            [
                'label'     => esc_html__( 'Before Text Color', 'education-pro-core' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tx-cpb-before-txt' => 'color: {{VALUE}};',
                ],
                'separator' => 'before'
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'      => 'before_typography',
                'selector'  => '{{WRAPPER}} .tx-cpb-before-txt',
            ]
        );
        $this->add_responsive_control(
            'before_position',
            [
                'label' => esc_html__('Position', 'education-pro-core'),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    '%' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                
                ],
                'default' => [
                    'unit' => '%',
                    'size' => 40
                ],
                'selectors' => [
                    '{{WRAPPER}} .tx-cpb-before-txt' => 'top: {{SIZE}}{{UNIT}};',
                ],
                
            ]
        );
        $this->add_control(
            'percentage_color',
            [
                'label'     => esc_html__( 'Percentage Text Color', 'education-pro-core' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tx-cpb-percentage-txt, {{WRAPPER}} .pie_progress__number' => 'color: {{VALUE}};',
                ],
                'separator' => 'before'
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'      => 'percentage_typography',
                'selector'  => '{{WRAPPER}} .tx-cpb-percentage-txt, {{WRAPPER}} .pie_progress__number',
            ]
        );
        $this->add_responsive_control(
            'percentage_position',
            [
                'label' => esc_html__('Position', 'education-pro-core'),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    '%' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                
                ],
                'default' => [
                    'unit' => '%',
                    'size' => 50
                ],
                'selectors' => [
                    '{{WRAPPER}} .tx-cpb-percentage-txt, {{WRAPPER}} .pie_progress__number' => 'top: {{SIZE}}{{UNIT}};',
                ],
                
            ]
        );
        $this->add_control(
            'after_color',
            [
                'label'     => esc_html__( 'After Text Color', 'education-pro-core' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tx-cpb-after-txt' => 'color: {{VALUE}};',
                ],
                'separator' => 'before'
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'      => 'after_typography',
                'selector'  => '{{WRAPPER}} .tx-cpb-after-txt',
            ]
        );
        $this->add_responsive_control(
            'after_position',
            [
                'label' => esc_html__('Position', 'education-pro-core'),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    '%' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                
                ],
                'default' => [
                    'unit' => '%',
                    'size' => 60
                ],
                'selectors' => [
                    '{{WRAPPER}} .tx-cpb-after-txt' => 'top: {{SIZE}}{{UNIT}};',
                ],
                
            ]
        );
        $this->end_controls_section();

	}

	protected function render() {
        $id       = $this->get_id();
        $settings = $this->get_settings_for_display();

       $this->add_render_attribute(
            [
                'cpb' => [
                    'id'          => esc_attr( $id ),
                    'class'       => [
                        'tx-circle-progress-bar',
                        'tx-linecap-'.$settings['line_cap'],
                    ],
                    'role'          => 'progressbar',
                    'data-goal'     => $settings['percentage'],
                    'aria-valuemin' => '0',
                    'data-speed'    => $settings['speed']*10,
                    'data-barsize'  => intval($settings['bar_size']),
                    'aria-valuemax' => '100'
                ]
            ]
        );

        ?>

        
        <div <?php echo ( $this->get_render_attribute_string( 'cpb' ) ); ?>>
            <span class="tx-cpb-before-txt"><?php echo esc_html( $settings['before_txt'] ); ?></span>
            <?php 
            if(!empty($settings['percentage_txt'])) : ?>
            <span class="tx-cpb-percentage-txt"><?php echo esc_html( $settings['percentage_txt'] ); ?></span>
            <?php else: ?>
                <span class="pie_progress__number"></span>
            <?php endif; ?>
            
            <span class="tx-cpb-after-txt"><?php echo esc_html( $settings['after_txt'] ); ?></span>
        </div>




<?php
	} //render()
} // class
