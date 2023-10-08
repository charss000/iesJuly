<?php
namespace EpElements\Modules\IconBox\Widgets;

use elementor\Widget_Base;
use elementor\Controls_Manager;
use elementor\Group_Control_Image_Size;
use elementor\Group_Control_Border;
use elementor\Group_Control_Typography;
use elementor\Group_Control_Background;
use elementor\Group_Control_Box_Shadow;
use elementor\Icons_Manager;
use elementor\Utils;

use EpElements\TX_Load;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class IconBox extends Widget_Base {

	public function get_name() {
		return 'ep-icon-box';
	}

	public function get_title() {
		return esc_html__( 'EP Icon Box', 'education-pro-core' );
	}

	public function get_icon() {
		return 'eicon-icon-box';
	}

	public function get_categories() {
		return [ 'ep-elements' ];
	}

	public function get_keywords() {
		return [ 'icon', 'box' ];
	}

	protected function register_controls() {
		$this->start_controls_section(
			'ib_settings',
			[
				'label' => esc_html__( 'Settings', 'education-pro-core' ),
			]
		);
		$this->add_responsive_control(
			'ib_select',
			[
				'label' => esc_html__( 'Select Icon or Image', 'education-pro-core' ),
				'type' => Controls_Manager::CHOOSE,
				'options' => [
					'icon' => [
						'title' => esc_html__( 'Icon', 'education-pro-core' ),
						'icon' => 'fa fa-snowflake-o',
					],
					'image' => [
						'title' => esc_html__( 'Image', 'education-pro-core' ),
						'icon' => 'fa fa-picture-o',
					]
				],
				'default' => 'icon',
			]
		);
		$this->add_control(
			'ib_icon',
			[
				'label' => esc_html__( 'Icon', 'education-pro-core' ),
				'type' => Controls_Manager::ICONS,
				'fa4compatibility' => 'icon',
				'default' => [
					'value' => 'fas fa-snowflake',
					'library' => 'fa-solid',
				],
				'condition' => [
					'ib_select' => 'icon'
				]
			]
		);
		$this->add_control(
			'ib_image',
			[
				'label' => esc_html__( 'Image', 'education-pro-core' ),
				'type' => Controls_Manager::MEDIA,
				'default' => [
					'url' => Utils::get_placeholder_image_src(),
				],
				'condition' => [
					'ib_select' => 'image'
				]
			]
		);
		$this->add_control(
			'ib_style',
			[
				'label' => esc_html__( 'Layout', 'education-pro-core' ),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'style-1' => esc_html__( 'Style 1', 'education-pro-core' ),
					'style-2' => esc_html__( 'Style 2', 'education-pro-core' ),
					'style-3' => esc_html__( 'Style 3', 'education-pro-core' ),
				],
				'default' => 'style-1',
			]
		);
		$this->add_control(
			'ib_position',
			[
				'label' => esc_html__( 'Position', 'education-pro-core' ),
				'type' => Controls_Manager::CHOOSE,
				'default' => 'center',
				'options' => [
					'left' => [
						'title' => esc_html__( 'Left', 'education-pro-core' ),
						'icon' => 'eicon-h-align-left',
					],
					'center' => [
						'title' => esc_html__( 'Center', 'education-pro-core' ),
						'icon' => 'eicon-v-align-middle',
					],
					'right' => [
						'title' => esc_html__( 'Right', 'education-pro-core' ),
						'icon' => 'eicon-h-align-right',
					],
				],
				'toggle' => false,
			]
		);
		$this->add_control(
			'ib_icon_space_vertical_left',
			[
				'label' => esc_html__( 'Icon Spacing Vertical', 'education-pro-core' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'max' => 300,
					],
				],
				'condition' => [
					'ib_position' => 'left',
					'ib_style' => 'style-2',
				],
				'selectors' => [
					'{{WRAPPER}} .tx-icon-box-wrap.style-2.left .tx-icon-box-icon' => 'margin-top: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_control(
			'ib_icon_space_horizontal_left',
			[
				'label' => esc_html__( 'Icon Spacing Horizontal', 'education-pro-core' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'max' => 300,
					],
				],
				'condition' => [
					'ib_position' => 'left',
					'ib_style' => 'style-2'
				],
				'selectors' => [
					'{{WRAPPER}} .tx-icon-box-wrap.style-2.left .tx-icon-box-icon' => 'margin-right: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_control(
			'ib_icon_space_vertical_right',
			[
				'label' => esc_html__( 'Icon Spacing Vertical', 'education-pro-core' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'max' => 300,
					],
				],
				'condition' => [
					'ib_position' => 'right',
					'ib_style' => 'style-2'
				],
				'selectors' => [
					'{{WRAPPER}} .tx-icon-box-wrap.style-2.right .tx-icon-box-icon' => 'margin-top: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_control(
			'ib_icon_space_horizontal_right',
			[
				'label' => esc_html__( 'Icon Spacing Horizontal', 'education-pro-core' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'max' => 300,
					],
				],
				'default' => [
					'size' => 20,
				],
				'condition' => [
					'ib_position' => 'right',
					'ib_style' => 'style-2'
				],
				'selectors' => [
					'{{WRAPPER}} .tx-icon-box-wrap.style-2.right .tx-icon-box-icon' => 'margin-left: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_control(
			'ib_title',
			[
				'label'   => esc_html__( 'Title', 'education-pro-core' ),
				'type'    => Controls_Manager::TEXT,
				'dynamic' => [
					'active' => true,
				],
				'default'     => esc_html__( 'This is the title', 'education-pro-core' ),
				'label_block' => true,
			]
		);
		$this->add_control(
            'ib_html_tag',
            [
                'label'     => esc_html__( 'HTML Tag', 'education-pro-core' ),
                'type'      => Controls_Manager::SELECT,
                'default'   => 'h4',
                'options'   => [
                        'h1'    => 'H1',
                        'h2'    => 'H2',
                        'h3'    => 'H3',
                        'h4'    => 'H4',
                        'h5'    => 'H5',
                        'h6'    => 'H6',
                        'div'   => 'div',
                        'span'  => 'Span',
                        'p'     => 'P'
                    ],
            ]
        );
		$this->add_control(
			'ib_link',
			[
				'label'        => esc_html__( 'Title Link', 'education-pro-core' ),
				'type'         => Controls_Manager::SWITCHER,
			]
		);

		$this->add_control(
			'ib_link_url',
			[
				'label'       => esc_html__( 'Title Link URL', 'education-pro-core' ),
				'type'        => Controls_Manager::URL,
				'dynamic'     => [ 'active' => true ],
				'placeholder' => 'http://your-link.com',
				'condition'   => [
				 'ib_link' => 'yes'
				]
			]
		);

		$this->add_control(
			'ib_desc',
			[
				'label'   => esc_html__( 'Description', 'education-pro-core' ),
				'type'    => Controls_Manager::WYSIWYG,
				'dynamic' => [
					'active' => true,
				],
				'default'     => esc_html__( 'Suspendisse potenti Phasellus euismod libero in neque molestie et mentum libero maximus. Etiam in enim vestibulum suscipit sem quis molestie nibh.', 'education-pro-core' ),
				'placeholder' => esc_html__( 'Enter your description', 'education-pro-core' ),
			]
		);
		$this->add_control(
			'ib_btn',
			[
				'label'        => esc_html__( 'Button', 'education-pro-core' ),
				'type'         => Controls_Manager::SWITCHER,
			]
		);
		$this->add_control(
			'ib_btn_text',
			[
				'label'       => esc_html__( 'Button Text', 'education-pro-core' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => esc_html__( 'Read More', 'education-pro-core' ),
				'placeholder' => esc_html__( 'Enter Text', 'education-pro-core' ),
				'condition' => [
				'ib_btn' => 'yes'
				]
			]

		);

		$this->add_control(
			'ib_btn_link',
			[
				'label'     => esc_html__( 'Button Link', 'education-pro-core' ),
				'type'      => Controls_Manager::URL,
				'dynamic'   => [
					'active' => true,
				],
				'placeholder' => esc_html__( 'https://your-link.com', 'education-pro-core' ),
				'default'     => [
					'url' => '#',
				],
				'condition' => [
				'ib_btn' => 'yes'
				]
			]
		);
		$this->add_control(
			'ib_btn_icon',
			[
				'label' => esc_html__( 'Button Icon', 'education-pro-core' ),
				'type' => Controls_Manager::ICON,
				'label_block' => true,
				'condition' => [
				'ib_btn' => 'yes'
				]
			]
		);

		$this->add_control(
			'ib_btn_icon_position',
			[
				'label' => esc_html__( 'Button Icon Position', 'education-pro-core' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'before',
				'options' => [
					'before' => esc_html__( 'Before', 'education-pro-core' ),
					'after' => esc_html__( 'After', 'education-pro-core' ),
				],
				'condition' => [
					'ib_btn' => 'yes'
				],
			]
		);

		$this->add_control(
			'ib_btn_icon_indent',
			[
				'label' => esc_html__( 'Icon Spacing', 'education-pro-core' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'max' => 100,
					],
				],
				'condition' => [
					'ib_btn' => 'yes'
				],
				'selectors' => [
					'{{WRAPPER}} .tx-ib-btn-icon-before' => 'margin-right: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .tx-ib-btn-icon-after' => 'margin-left: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->end_controls_section();
		$this->start_controls_section(
            'ib_styles',
            [
                'label'                 => esc_html__( 'Style', 'education-pro-core' ),
                'tab'                   => Controls_Manager::TAB_STYLE,
            ]
        );
        $this->start_controls_tabs( 'icon_colors' );

		$this->start_controls_tab(
			'ib_normal',
			[
				'label' => esc_html__( 'Normal', 'education-pro-core' ),
			]
		);
        $this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name'      => 'ib_bg',
				'selector'  => '{{WRAPPER}} .tx-icon-box-wrap',
			]
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'        => 'ib_bg_border',
				'selector'    => 	'{{WRAPPER}} .tx-icon-box-wrap'
			]
		);
		$this->add_responsive_control(
			'ib_bg_border_radius',
			[
				'label'      => esc_html__( 'Background Border Radius', 'education-pro-core' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors'  => [
					'{{WRAPPER}} .tx-icon-box-wrap' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name'     => 'ib_bg_shadow',
				'selector' => '{{WRAPPER}} .tx-icon-box-wrap'
			]
		);
		$this->add_control(
			'ib_bg_rotate',
			[
				'label'   => esc_html__( 'Rotate', 'education-pro-core' ),
				'type'    => Controls_Manager::SLIDER,
				'default' => [
					'size' => 0,
					'unit' => 'deg',
				],
				'range' => [
					'deg' => [
						'max'  => 360,
						'min'  => -360,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .tx-icon-box-wrap'   => 'transform: rotate({{SIZE}}{{UNIT}});',
				],
			]
		);
		$this->add_responsive_control(
            'ib_padding',
            [
                'label' => esc_html__( 'Padding', 'education-pro-core' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .tx-icon-box-wrap' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_control(
            'ib_icon_color',
            [
                'label' => esc_html__('Icon Color', 'education-pro-core'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tx-icon-box-icon i' => 'color: {{VALUE}};',
                ],
                'separator' => 'before'
            ]
        );
        $this->add_control(
            'ib_icon_bg_color',
            [
                'label' => esc_html__('Icon Background Color', 'education-pro-core'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tx-icon-box-icon i' => 'background-color: {{VALUE}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'ib_icon_size',
            [
                'label' => esc_html__('Icon Size', 'education-pro-core'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%', 'em' ],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 999,
                    ],
                
                ],
                'selectors' => [
                    '{{WRAPPER}} .tx-icon-box-icon img' => 'width: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .tx-icon-box-icon i' => 'font-size: {{SIZE}}{{UNIT}};',
                ],
                
            ]
        );
        $this->add_control(
			'ib_icon_rotate',
			[
				'label'   => esc_html__( 'Icon Rotate', 'education-pro-core' ),
				'type'    => Controls_Manager::SLIDER,
				'default' => [
					'size' => 0,
					'unit' => 'deg',
				],
				'range' => [
					'deg' => [
						'max'  => 360,
						'min'  => -360,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .tx-icon-box-icon img'   => 'transform: rotate({{SIZE}}{{UNIT}});',
					'{{WRAPPER}} .tx-icon-box-icon i' => 'transform: rotate({{SIZE}}{{UNIT}});',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'        => 'ib_icon_border',
				'selector'    => 	'{{WRAPPER}} .tx-icon-box-icon img, {{WRAPPER}} .tx-icon-box-icon i'
			]
		);
		$this->add_responsive_control(
			'ib_icon_border_radius',
			[
				'label'      => esc_html__( 'Icon Border Radius', 'education-pro-core' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors'  => [
					'{{WRAPPER}} .tx-icon-box-icon img, {{WRAPPER}} .tx-icon-box-icon i' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
            'ib_icon_margin_bottom',
            [
                'label' => esc_html__('Icon Margin Bottom', 'education-pro-core'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%', 'em' ],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 150,
                    ],
                
                ],
                'selectors' => [
                    '{{WRAPPER}} .tx-icon-box-icon img, {{WRAPPER}} .tx-icon-box-icon i' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                ],
                
            ]
        );
		$this->add_responsive_control(
            'ib_icon_padding',
            [
                'label' => esc_html__( 'Padding', 'education-pro-core' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .tx-icon-box-icon img, {{WRAPPER}} .tx-icon-box-icon i' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_control(
            'ib_title_color',
            [
                'label' => esc_html__('Title Color', 'education-pro-core'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tx-icon-box-title' => 'color: {{VALUE}};',
                ],
                'separator' => 'before',
            ]
        );
        $this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'      => 'ib_title_typography',
				'selector'  => '{{WRAPPER}} .tx-icon-box-title',
			]
		);
        $this->add_control(
            'ib_desc_color',
            [
                'label' => esc_html__('Description Color', 'education-pro-core'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tx-icon-box-desc' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'      => 'ib_desc_typography',
				'selector'  => '{{WRAPPER}} .tx-icon-box-desc',
			]
		);
		$this->add_control(
            'ib_btn_color',
            [
                'label' => esc_html__('Button Color', 'education-pro-core'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tx-icon-box-btn' => 'color: {{VALUE}};',
                ],
                'separator' => 'before',
            ]
        );
        $this->add_control(
            'ib_btn_bg_color',
            [
                'label' => esc_html__('Button Background Color', 'education-pro-core'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tx-icon-box-btn' => 'background-color: {{VALUE}};',
                ],
            ]
        );
        $this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'      => 'ib_btn_typography',
				'selector'  => '{{WRAPPER}} .tx-icon-box-btn',
			]
		);
        $this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'        => 'ib_btn_border',
				'placeholder' => '1px',
				'default'     => '1px',
				'selector'    => 	'{{WRAPPER}} .tx-icon-box-btn'
			]
		);
		$this->add_responsive_control(
			'ib_btn_border_radius',
			[
				'label'      => esc_html__( 'Button Border Radius', 'education-pro-core' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors'  => [
					'{{WRAPPER}} .tx-icon-box-btn' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
        $this->add_responsive_control(
            'ib_btn_padding',
            [
                'label' => esc_html__( 'Button Padding', 'education-pro-core' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .tx-icon-box-btn' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'ib_btn_margin',
            [
                'label' => esc_html__( 'Button Space', 'education-pro-core' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .tx-icon-box-btn-wrap' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );


        $this->end_controls_tab();

        $this->start_controls_tab(
			'ib_hover',
			[
				'label' => esc_html__( 'Hover', 'education-pro-core' ),
			]
		);
        $this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name'      => 'ib_bg_hov',
				'selector'  => '{{WRAPPER}} .tx-icon-box-wrap:hover',
			]
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'        => 'ib_bg_border_hov',
				'selector'    => 	'{{WRAPPER}} .tx-icon-box-wrap:hover'
			]
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name'     => 'ib_bg_hov_shadow',
				'selector' => '{{WRAPPER}} .tx-icon-box-wrap:hover'
			]
		);
		$this->add_control(
			'ib_bg_rotate_hov',
			[
				'label'   => esc_html__( 'Hover Rotate', 'education-pro-core' ),
				'type'    => Controls_Manager::SLIDER,
				'default' => [
					'size' => 0,
					'unit' => 'deg',
				],
				'range' => [
					'deg' => [
						'max'  => 360,
						'min'  => -360,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .tx-icon-box-wrap:hover'   => 'transform: rotate({{SIZE}}{{UNIT}});',
				],
			]
		);
		$this->add_control(
            'ib_icon_hov_color',
            [
                'label' => esc_html__('Icon Hover Color', 'education-pro-core'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tx-icon-box-icon:hover i' => 'color: {{VALUE}};',
                ],
                'separator' => 'before'
            ]
        );
        $this->add_control(
            'ib_icon_bg_hov_color',
            [
                'label' => esc_html__('Icon Background Hover Color', 'education-pro-core'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tx-icon-box-icon:hover i' => 'background-color: {{VALUE}};',
                ],
            ]
        );
        $this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'        => 'ib_icon_border_hov',
				'selector'    => 	'{{WRAPPER}} .tx-icon-box-icon:hover img, {{WRAPPER}} .tx-icon-box-icon:hover i'
			]
		);
		$this->add_control(
			'ib_icon_rotate_hov',
			[
				'label'   => esc_html__( 'Icon Rotate Hover', 'education-pro-core' ),
				'type'    => Controls_Manager::SLIDER,
				'default' => [
					'size' => 0,
					'unit' => 'deg',
				],
				'range' => [
					'deg' => [
						'max'  => 360,
						'min'  => -360,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .tx-icon-box-wrap:hover .tx-icon-box-icon img, {{WRAPPER}} .tx-icon-box-wrap:hover .tx-icon-box-icon i'   => 'transform: rotate({{SIZE}}{{UNIT}});',
				],
			]
		);
        $this->add_control(
            'ib_title_hov_color',
            [
                'label' => esc_html__('Title Hover Color', 'education-pro-core'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tx-icon-box-title:hover' => 'color: {{VALUE}};',
                ],
                'separator' => 'before',
            ]
        );
        $this->add_control(
            'ib_btn_hov_color',
            [
                'label' => esc_html__('Button Hover Color', 'education-pro-core'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tx-icon-box-btn:hover' => 'color: {{VALUE}};',
                ],
                'separator' => 'before',
            ]
        );
        $this->add_control(
            'ib_btn_bg_hov_color',
            [
                'label' => esc_html__('Button Background Hover Color', 'education-pro-core'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tx-icon-box-btn:hover' => 'background-color: {{VALUE}};',
                ],
            ]
        );
        $this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'        => 'ib_btn_hov_border',
				'placeholder' => '1px',
				'default'     => '1px',
				'selector'    => 	'{{WRAPPER}} .tx-icon-box-btn:hover'
			]
		);



		$this->end_controls_tab();



        $this->end_controls_section();
	}

	protected function render() {
		$settings = $this->get_settings();
		$target = $settings['ib_link_url']['is_external'] ? '_blank' : '_self';
		$target_btn = $settings['ib_btn_link']['is_external'] ? '_blank' : '_self';

		?>	
		<div class="tx-icon-box-wrap <?php echo esc_attr($settings['ib_style'] . ' ' . $settings['ib_position']); ?>">

			<div class="tx-icon-box-icon">
				<?php 
					if ($settings['ib_select'] == 'icon') { 
						Icons_Manager::render_icon( $settings['ib_icon'], [ 'aria-hidden' => 'true' ] );
					}
					if ($settings['ib_select'] == 'image') { ?>
						<img src="<?php echo esc_attr($settings['ib_image']['url']); ?>">
					<?php }
				?>

				<?php if($settings['ib_style'] == 'style-3') : ?>
				<?php if($settings['ib_link'] == 'yes') : ?>
				<a href="<?php echo esc_url($settings['ib_link_url']['url']); ?>" target="<?php echo esc_attr($target); ?>">
				<<?php echo esc_attr($settings['ib_html_tag']); ?> class="tx-icon-box-title">
				<?php echo esc_html($settings['ib_title']); ?>
				</<?php echo esc_attr($settings['ib_html_tag']); ?>>
				</a>
				<?php else : ?>
				<<?php echo esc_attr($settings['ib_html_tag']); ?> class="tx-icon-box-title">
				<?php echo esc_html($settings['ib_title']); ?>
				</<?php echo esc_attr($settings['ib_html_tag']); ?>>
				<?php endif; ?>
				<?php endif; ?>

			</div><!-- tx-icon-box-icon -->

			<div class="tx-icon-box-content-wrap">

				<?php if($settings['ib_style'] == 'style-1' || $settings['ib_style'] == 'style-2') : ?>
				<?php if($settings['ib_link'] == 'yes') : ?>
				<a href="<?php echo esc_url($settings['ib_link_url']['url']); ?>" target="<?php echo esc_attr($target); ?>">
				<<?php echo esc_attr($settings['ib_html_tag']); ?> class="tx-icon-box-title">
				<?php echo esc_html($settings['ib_title']); ?>
				</<?php echo esc_attr($settings['ib_html_tag']); ?>>
				</a>
				<?php else : ?>
				<<?php echo esc_attr($settings['ib_html_tag']); ?> class="tx-icon-box-title">
				<?php echo esc_html($settings['ib_title']); ?>
				</<?php echo esc_attr($settings['ib_html_tag']); ?>>
				<?php endif; ?>
				<?php endif; ?>

				<div class="tx-icon-box-desc"><?php echo wp_sprintf($settings['ib_desc']); ?></div>
				<?php if($settings['ib_btn'] == 'yes') : ?>
				<div class="tx-icon-box-btn-wrap">
					<a class="tx-icon-box-btn" href="<?php echo esc_url($settings['ib_btn_link']['url']); ?>" target="<?php echo esc_attr($target_btn); ?>">
						<?php 
						if( $settings['ib_btn_icon'] !='' && $settings['ib_btn_icon_position'] =='before'  ) : ?>
							<i class="<?php echo esc_attr($settings['ib_btn_icon']); ?> tx-ib-btn-icon-before" aria-hidden="true"></i>
						<?php endif;
							echo esc_html($settings['ib_btn_text']);
						if( $settings['ib_btn_icon'] !='' && $settings['ib_btn_icon_position'] =='after'  ) : ?>
							<i class="<?php echo esc_attr($settings['ib_btn_icon']); ?> tx-ib-btn-icon-after" aria-hidden="true"></i>
						<?php endif;
						?>
					</a>
				</div><!-- tx-icon-box-btn-wrap -->
				<?php endif; ?>
			</div><!-- tx-icon-box-content-wrap -->

		</div><!-- tx-icon-box-wrap -->

<?php }

}
