<?php
namespace EpElements\Modules\Button\Widgets;

use elementor\Widget_Base;
use elementor\Controls_Manager;
use elementor\Group_Control_Border;
use elementor\Group_Control_Typography;
use elementor\Icons_Manager;
use elementor\Utils;

use EpElements\TX_Load;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Button extends Widget_Base {

	public function get_name() {
		return 'ep-button';
	}

	public function get_title() {
		return esc_html__( 'EP Button', 'education-pro-core' );
	}

	public function get_icon() {
		return 'eicon-button';
	}

	public function get_categories() {
		return [ 'ep-elements' ];
	}

	public function get_keywords() {
		return [ 'button' ];
	}
	
	protected function register_controls() {
		$this->start_controls_section(
			'btn_settings',
			[
				'label' => esc_html__( 'Settings', 'education-pro-core' ),
			]
		);
		$this->add_control(
			'btn_style',
			[
				'label' => esc_html__( 'Style', 'education-pro-core' ),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'style-1'  => esc_html__( 'Style 1', 'education-pro-core' ),
					'style-2'  => esc_html__( 'Style 2', 'education-pro-core' ),
					'style-3'  => esc_html__( 'Style 3', 'education-pro-core' ),
					'style-4'  => esc_html__( 'Style 4', 'education-pro-core' ),
					'style-5'  => esc_html__( 'Style 5', 'education-pro-core' ),
				],
				'default' => 'style-1',
				'return_value' => [
					'style-1',
					'style-2',
					'style-3',
					'style-4',
					'style-5',
				],

			]
		);
		$this->add_control(
            'btn_txt',
            [
                'label'             => esc_html__( 'Button Text', 'education-pro-core' ),
                'type'              => Controls_Manager::TEXT,
                'default'           => esc_html__( 'HOVER ME', 'education-pro-core' ),
            ]
        );
        $this->add_control(
            'btn_txt_2',
            [
                'label'             => esc_html__( 'Hover Text', 'education-pro-core' ),
                'type'              => Controls_Manager::TEXT,
                'default'           => esc_html__( 'CLICK ME', 'education-pro-core' ),
                'condition' 		=> [         	
                	'btn_style' => [
                		'style-3',
						'style-5',
                	]

                ]
            ]
        );
		$this->add_control(
			'btn_link_url',
			[
				'label'       => esc_html__( 'Link URL', 'education-pro-core' ),
				'type'        => Controls_Manager::URL,
				'dynamic'     => [ 'active' => true ],
				'placeholder' => 'http://your-link.com',
				'default'     => [
                    'url' => '#',
                ],
			]
		);
		$this->add_responsive_control(
            'btn_width',
            [
                'label'                 => esc_html__( 'Width', 'education-pro-core' ),
                'type'                  => Controls_Manager::SLIDER,
                'default'               => [
                    'size'  => 200,
                ],
                'range'                 => [
                    'px' => [
                        'min'   => 1,
                        'max'   => 1000,
                    ],
                ],
                'size_units'            => [ 'px', '%' ],
                'selectors'             => [
                    '{{WRAPPER}} .tx-btn-wrap.style-3 a' => 'width: {{SIZE}}{{UNIT}}',
                ],
                'conditions'   => [
					'terms' => [
						[
							'name'  => 'btn_style',
							'operator' => 'in',
							'value' => [
								'style-3',
							]
						],
					]
				]

            ]
        );
		$this->add_responsive_control(
            'btn_alignment',
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
					'{{WRAPPER}} .tx-btn-wrap'   => 'text-align: {{VALUE}};',
				],
				// 'conditions'   => [
				// 	'terms' => [
				// 		[
				// 			'name'  => 'btn_style',
				// 			'operator' => '!in',
				// 			'value' => [
				// 				'style-3',
				// 			]
				// 		],
				// 	]
				// ]

            ]
        );
		$this->end_controls_section();

		$this->start_controls_section(
            'btn_styles',
            [
                'label'                 => esc_html__( 'Style', 'education-pro-core' ),
                'tab'                   => Controls_Manager::TAB_STYLE,
            ]
        );
		$this->start_controls_tabs( 'btn_tabs' );

		$this->start_controls_tab(
			'btn_tab_normal',
			[
				'label' => esc_html__( 'Normal', 'education-pro-core' ),
			]
		);
		$this->add_control(
            'btn_color',
            [
                'label' => esc_html__('Color', 'education-pro-core'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tx-btn-wrap.style-1 a, {{WRAPPER}} .tx-btn-wrap.style-2 a, {{WRAPPER}} .tx-btn-wrap.style-3 a, {{WRAPPER}} .tx-btn-wrap.style-4 a, {{WRAPPER}} .tx-btn-wrap.style-5 a' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_control(
            'btn_bg_color',
            [
                'label' => esc_html__('Background Color', 'education-pro-core'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tx-btn-wrap.style-1 a, {{WRAPPER}} .tx-btn-wrap.style-2 a, {{WRAPPER}} .tx-btn-wrap.style-3 a, {{WRAPPER}} .tx-btn-wrap.style-4 a, {{WRAPPER}} .tx-btn-wrap.style-5 a' => 'background-color: {{VALUE}};',
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'      => 'btn_typo',
                'selector'  => '{{WRAPPER}} .tx-btn-wrap.style-1 a, {{WRAPPER}} .tx-btn-wrap.style-2 a, {{WRAPPER}} .tx-btn-wrap.style-3 a, {{WRAPPER}} .tx-btn-wrap.style-4 a, {{WRAPPER}} .tx-btn-wrap.style-5 a',
            ]
        );
        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'        => 'btn_border',
                'selector'    =>    '{{WRAPPER}} .tx-btn-wrap.style-1 a, {{WRAPPER}} .tx-btn-wrap.style-2 a, {{WRAPPER}} .tx-btn-wrap.style-4 a'
            ]
        );
        $this->add_responsive_control(
            'btn_border_radius',
            [
                'label'   => esc_html__( 'Border Radius', 'education-pro-core' ),
                'type'    => Controls_Manager::SLIDER,
                'default' => [
                    'size' => '',
                    'unit' => 'px',
                ],
                'range' => [
                    'px' => [
                        'max'  => 100,
                        'min'  => 0,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .tx-btn-wrap.style-2 a, {{WRAPPER}} .tx-btn-wrap.style-4 a'   => 'border-radius: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'btn_padding',
            [
                'label'         => esc_html__( 'Padding', 'education-pro-core' ),
                'type'          => Controls_Manager::DIMENSIONS,
                'size_units'    => [ 'px', 'em', '%' ],
                'selectors'     => [
                    '{{WRAPPER}} .tx-btn-wrap.style-1 a, {{WRAPPER}} .tx-btn-wrap.style-2 a, {{WRAPPER}} .tx-btn-wrap.style-4 a, {{WRAPPER}} .tx-btn-wrap.style-5 a' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

		$this->end_controls_tab();

        $this->start_controls_tab(
			'btn_tab_hover',
			[
				'label' => esc_html__( 'Hover', 'education-pro-core' ),
			]
		);
		$this->add_control(
            'btn_hov_color',
            [
                'label' => esc_html__('Color', 'education-pro-core'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tx-btn-wrap.style-1 a:hover, {{WRAPPER}} .tx-btn-wrap.style-2 a:hover, {{WRAPPER}} .tx-btn-wrap.style-3:hover a, {{WRAPPER}} .tx-btn-wrap.style-4 a:hover' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_control(
            'btn_bg_hov_color',
            [
                'label' => esc_html__('Background Color', 'education-pro-core'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tx-btn-wrap.style-1 a:hover, {{WRAPPER}} .tx-btn-wrap.style-2 a:after, {{WRAPPER}} .tx-btn-wrap.style-3:hover a, {{WRAPPER}} .tx-btn-wrap.style-3 a:before, {{WRAPPER}} .tx-btn-wrap.style-4 a:hover, {{WRAPPER}} .tx-btn-wrap.style-5 a:before' => 'background-color: {{VALUE}};',
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'        => 'btn_hov_border',
                'selector'    =>    '{{WRAPPER}} .tx-btn-wrap.style-1 a:hover .line-1, {{WRAPPER}} .tx-btn-wrap.style-1 a:hover .line-2, {{WRAPPER}} .tx-btn-wrap.style-1 a:hover .line-3, {{WRAPPER}} .tx-btn-wrap.style-1 a:hover .line-4, {{WRAPPER}} .tx-btn-wrap.style-2 a, {{WRAPPER}} .tx-btn-wrap.style-4 a'
            ]
        );

        $this->end_controls_tab();
        $this->end_controls_section();

	}

	protected function render() {
		$settings = $this->get_settings();
		$target = $settings['btn_link_url']['is_external'] ? '_blank' : '_self';

		if ( ! empty( $settings['btn_link_url']['url'] ) ) :
        	$this->add_render_attribute( 'btn-link', 'href', $settings['btn_link_url']['url'] );
        endif;

		?>

		<div class="tx-btn-wrap <?php echo esc_attr( $settings['btn_style'] ); ?>">
			
           <a data-hover="<?php echo esc_attr($settings['btn_txt_2']); ?>" <?php echo $this->get_render_attribute_string( 'btn-link' ); ?> target="<?php echo esc_attr($target); ?>" >

           	<?php echo esc_attr( $settings['btn_txt'] ); ?>

           	<span class="line-1"></span>
           	<span class="line-2"></span>
           	<span class="line-3"></span>
           	<span class="line-4"></span>
           </a>
          
			
		</div><!-- tx-btn-wrap -->
		
		
<?php } // render()

} // class
