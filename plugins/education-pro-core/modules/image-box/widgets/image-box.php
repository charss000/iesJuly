<?php
namespace EpElements\Modules\ImageBox\Widgets;

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

class ImageBox extends Widget_Base {

	public function get_name() {
		return 'ep-image-box';
	}

	public function get_title() {
		return esc_html__( 'EP Image Box', 'education-pro-core' );
	}

	public function get_icon() {
		return 'eicon-image-box';
	}

	public function get_categories() {
		return [ 'ep-elements' ];
	}

	public function get_keywords() {
		return [ 'image', 'box' ];
	}

	protected function register_controls() {
		$this->start_controls_section(
			'ib_settings',
			[
				'label' => esc_html__( 'Image', 'education-pro-core' ),
			]
		);
		$this->add_control(
			'ib_image',
			[
				'type' => Controls_Manager::MEDIA,
				'default' => [
					'url' => Utils::get_placeholder_image_src(),
				],
			]
		);
		$this->add_control(
			'ib_hover_txt',
			[
				'label'   => esc_html__( 'Overlay Text', 'education-pro-core' ),
				'type'    => Controls_Manager::TEXT,
				'dynamic'     => [ 'active' => true ],
				'default'     => esc_html__( 'View More', 'education-pro-core' ),
				'label_block' => true,
			]
		);
		$this->add_control(
			'ib_hov_txt_link',
			[
				'label'        => esc_html__( 'Overlay Text Link', 'education-pro-core' ),
				'type'         => Controls_Manager::SWITCHER,
			]
		);
		$this->add_control(
			'ib_hov_txt_link_url',
			[
				'label'       => esc_html__( 'Overlay Text Link URL', 'education-pro-core' ),
				'type'        => Controls_Manager::URL,
				'dynamic'     => [ 'active' => true ],
				'placeholder' => 'http://your-link.com',
				'condition'   => [
				 'ib_hov_txt_link' => 'yes'
				]
			]
		);
		$this->end_controls_section();

		$this->start_controls_section(
            'ib_content_setting',
            [
                'label'                 => esc_html__( 'Content', 'education-pro-core' ),
            ]
        );
		$this->add_control(
			'ib_title',
			[
				'label'   => esc_html__( 'Title', 'education-pro-core' ),
				'type'    => Controls_Manager::TEXT,
				'dynamic'     => [ 'active' => true ],
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
			'ib_title_link',
			[
				'label'        => esc_html__( 'Title Link', 'education-pro-core' ),
				'type'         => Controls_Manager::SWITCHER,
			]
		);
		$this->add_control(
			'ib_title_link_url',
			[
				'label'       => esc_html__( 'Title Link URL', 'education-pro-core' ),
				'type'        => Controls_Manager::URL,
				'dynamic'     => [ 'active' => true ],
				'placeholder' => 'http://your-link.com',
				'condition'   => [
				 'ib_title_link' => 'yes'
				]
			]
		);
		$this->add_control(
			'ib_desc',
			[
				'label'   => esc_html__( 'Description', 'education-pro-core' ),
				'type'    => Controls_Manager::WYSIWYG,
				'dynamic'     => [ 'active' => true ],
				'default'     => esc_html__( 'Suspendisse potenti Phasellus euismod libero in neque molestie et mentum libero maximus. Etiam in enim vestibulum suscipit sem quis.', 'education-pro-core' ),
				'separator' => 'before'
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
                'default' => 'center',
                'toggle' => false,
                'selectors'         => [
                    '{{WRAPPER}} .tx-ib-content'   => 'text-align: {{VALUE}};',
                ],
                'separator' => 'before'
            ]
        );
        $this->end_controls_section();

		$this->start_controls_section(
            'ib_button_settings',
            [
                'label'                 => esc_html__( 'Button', 'education-pro-core' ),
            ]
        );
        $this->add_control(
            'ib_button_display',
            [
                'label' => esc_html__( 'Button Display', 'education-pro-core' ),
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

            ]
        );
		$this->add_control(
			'ib_btn_txt',
			[
				'label' => esc_html__( 'Button Text', 'education-pro-core' ),
				'type' => Controls_Manager::TEXT,
				'default' => esc_html__( 'View Details', 'education-pro-core' ),
				'condition' => [
					'ib_button_display' => 'yes'
				]
			]
		);
		$this->add_control(
			'ib_btn_link_url',
			[
				'label'       => esc_html__( 'Button Link URL', 'education-pro-core' ),
				'type'        => Controls_Manager::URL,
				'dynamic'     => [ 'active' => true ],
				'placeholder' => 'http://your-link.com',
				'condition' => [
					'ib_button_display' => 'yes'
				]
			]
		);
		$this->add_control(
			'ib_btn_icon',
			[
				'label' => esc_html__( 'Button Icon', 'education-pro-core' ),
				'type' => Controls_Manager::ICON,
				'condition' => [
					'ib_button_display' => 'yes'
				]
			]
		);
		$this->add_control(
			'ib_btn_icon_align',
			[
				'label' => esc_html__( 'Icon Position', 'education-pro-core' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'left',
				'options' => [
					'left' => esc_html__( 'Before', 'education-pro-core' ),
					'right' => esc_html__( 'After', 'education-pro-core' ),
				],
				'condition' => [
					'ib_button_display' => 'yes'
				]
				
			]
		);
		$this->add_control(
			'ib_btn_icon_spacing',
			[
				'label' => esc_html__( 'Icon Spacing', 'education-pro-core' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .tx-ib-btn-icon-right' => 'margin-left: {{SIZE}}px;',
					'{{WRAPPER}} .tx-ib-btn-icon-left' => 'margin-right: {{SIZE}}px;',
				],
				'condition' => [
					'ib_button_display' => 'yes'
				]
			]
		);
		$this->end_controls_section();

		$this->start_controls_section(
            'ib_styles',
            [
                'label'                 => esc_html__( 'Image', 'education-pro-core' ),
                'tab'                   => Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_control(
			'ib_img_overlay_color',
			[
				'label' => esc_html__( 'Image Overlay Color', 'education-pro-core' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .tx-ib-img-overlay' => 'background-color: {{VALUE}};',
				],
			]
		);
        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'        => 'ib_border',
                'selector'    =>    '{{WRAPPER}} .tx-ib-image img'
            ]
        );
        $this->add_responsive_control(
            'ib_border_radius',
            [
                'label'   => esc_html__( 'Border Radius', 'education-pro-core' ),
                'type'    => Controls_Manager::SLIDER,
                'default' => [
                    'size' => 0,
                    'unit' => '%',
                ],
                'range' => [
                    '%' => [
                        'max'  => 100,
                        'min'  => 0,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .tx-ib-image img'   => 'border-radius: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        
		$this->add_control(
            'ib_overlay_txt_color',
            [
                'label'     => esc_html__( 'Overlay Text Color', 'education-pro-core' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tx-ib-img-hov-txt' => 'color: {{VALUE}};',
                ],
                'separator' => 'before'
            ]
        );
        $this->add_control(
            'ib_overlay_txt_hov_color',
            [
                'label'     => esc_html__( 'Overlay Text Hover Color', 'education-pro-core' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tx-ib-img-hov-txt:hover' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_group_control(
			Group_Control_Typography::get_type(),
			[
             'name' => 'ib_overlay_txt_typography',
				'selector' => '{{WRAPPER}} .tx-ib-img-hov-txt',
			]
		);
		$this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'        => 'ib_overlay_txt_border',
                'selector'    =>    '{{WRAPPER}} .tx-ib-img-hov-txt'
            ]
        );
        $this->add_responsive_control(
            'ib_overlay_txt_border_radius',
            [
                'label'   => esc_html__( 'Overlay Text Border Radius', 'education-pro-core' ),
                'type'    => Controls_Manager::SLIDER,
                'default' => [
                    'size' => 0,
                    'unit' => '%',
                ],
                'range' => [
                    '%' => [
                        'max'  => 100,
                        'min'  => 0,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .tx-ib-img-hov-txt'   => 'border-radius: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'ib_overlay_txt_padding',
            [
                'label'         => esc_html__( 'Overlay Text Padding', 'education-pro-core' ),
                'type'          => Controls_Manager::DIMENSIONS,
                'size_units'    => [ 'px', 'em', '%' ],
                'selectors'     => [
                    '{{WRAPPER}} .tx-ib-img-hov-txt' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
		$this->end_controls_section();

		$this->start_controls_section(
			'ib_content_style',
			[
				'label' => esc_html__( 'Content', 'education-pro-core' ),
				'tab' => Controls_Manager::TAB_STYLE
			]
		);
		$this->add_responsive_control(
            'ib_content_padding',
            [
                'label'         => esc_html__( 'Content Padding', 'education-pro-core' ),
                'type'          => Controls_Manager::DIMENSIONS,
                'size_units'    => [ 'px', 'em', '%' ],
                'selectors'     => [
                    '{{WRAPPER}} .tx-ib-content' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'        => 'ib_content_border',
                'selector'    =>    '{{WRAPPER}} .tx-ib-content'
            ]
        );
        $this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'ib_content_box_shadow',
				'selector' => '{{WRAPPER}} .tx-ib-content',
				'separator' => '',
			]
		);
        $this->add_control(
            'ib_content_bg_color',
            [
                'label'     => esc_html__( 'Content Background Color', 'education-pro-core' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tx-ib-content' => 'background-color: {{VALUE}};',
                ],
            ]
        );
        $this->add_control(
            'ib_title_color',
            [
                'label'     => esc_html__( 'Title Color', 'education-pro-core' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tx-ib-title' => 'color: {{VALUE}};',
                ],
                'separator' => 'before'
            ]
        );
        $this->add_control(
            'ib_title_hov_color',
            [
                'label'     => esc_html__( 'Title Hover Color', 'education-pro-core' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tx-ib-title:hover' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_group_control(
			Group_Control_Typography::get_type(),
			[
             'name' => 'ib_title_typography',
				'selector' => '{{WRAPPER}} .tx-ib-title',
			]
		);
        
        
        $this->add_control(
            'ib_desc_color',
            [
                'label'     => esc_html__( 'Description Color', 'education-pro-core' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tx-ib-desc' => 'color: {{VALUE}};',
                ],
                'separator' => 'before'
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'      => 'ib_desc_typo',
                'selector'  => '{{WRAPPER}} .tx-ib-desc',
            ]
        );
        $this->end_controls_section();
        
        $this->start_controls_section(
        	'ib_button_style',
        	[
        	'label' => esc_html__( 'Button', 'education-pro-core' ),
			'tab' => Controls_Manager::TAB_STYLE,
			'condition' => [
					'ib_button_display' => 'yes'
				]
			]
        );
        $this->start_controls_tabs(
        	'ib_button_tabs' 
        );
		$this->start_controls_tab(
			'ib_btn_tab_normal', 
				[ 
					'label' => esc_html__( 'Normal', 'education-pro-core' ),
				
			 	] 
		);
		$this->add_control(
			'ib_btn_color',
			[
				'label' => esc_html__( 'Button Color', 'education-pro-core' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .tx-ib-btn-link' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'ib_btn_bg_color',
			[
				'label' => esc_html__( 'Button Background Color', 'education-pro-core' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .tx-ib-btn-link' => 'background-color: {{VALUE}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
             'name' => 'ib_btn_typography',
				'selector' => '{{WRAPPER}} .tx-ib-btn-link',
			]
		);
		$this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'        => 'ib_btn_border',
                'selector'    =>    '{{WRAPPER}} .tx-ib-btn-link'
            ]
        );
        $this->add_control(
			'ib_btn_border_radius',
			[
				'label' => esc_html__( 'Button Border Radius', 'education-pro-core' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .tx-ib-btn-link' => 'border-radius: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
            'ib_btn_padding',
            [
                'label'         => esc_html__( 'Button Padding', 'education-pro-core' ),
                'type'          => Controls_Manager::DIMENSIONS,
                'size_units'    => [ 'px', 'em', '%' ],
                'selectors'     => [
                    '{{WRAPPER}} .tx-ib-btn-link' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'ib_btn_margin',
            [
                'label'         => esc_html__( 'Button Margin', 'education-pro-core' ),
                'type'          => Controls_Manager::DIMENSIONS,
                'size_units'    => [ 'px', 'em', '%' ],
                'selectors'     => [
                    '{{WRAPPER}} .tx-ib-button' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
		$this->end_controls_tab();

		$this->start_controls_tab(
			'ib_btn_tab_hover', 
				[ 
					'label' => esc_html__( 'Hover', 'education-pro-core' ),
				
			 	] 
		);
		$this->add_control(
			'ib_btn_hov_color',
			[
				'label' => esc_html__( 'Button Hover Color', 'education-pro-core' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .tx-ib-btn-link:hover' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'ib_btn_bg_hov_color',
			[
				'label' => esc_html__( 'Button Background Hover Color', 'education-pro-core' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .tx-ib-btn-link:hover' => 'background-color: {{VALUE}};',
				],
			]
		);
		$this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'        => 'ib_btn_hov_border',
                'selector'    =>    '{{WRAPPER}} .tx-ib-btn-link:hover'
            ]
        );
		$this->end_controls_tab();

		$this->end_controls_section();
	}

	protected function render() {
		$settings = $this->get_settings();
		$target = $settings['ib_title_link_url']['is_external'] ? '_blank' : '_self';
		$target_btn = $settings['ib_btn_link_url']['is_external'] ? '_blank' : '_self';
		$target_hov_txt = $settings['ib_hov_txt_link_url']['is_external'] ? '_blank' : '_self';
		?>

		<div class="tx-image-box-wrap">

			<div class="tx-ib-image">
				<div class="tx-ib-img-overlay"></div>
				<img src="<?php echo esc_attr($settings['ib_image']['url']); ?>" alt="<?php echo esc_attr( $settings['ib_title'] ); ?>">
				<?php if($settings['ib_hov_txt_link'] == 'yes') : ?>
				<a href="<?php echo esc_url($settings['ib_hov_txt_link_url']['url']); ?>" target="<?php echo esc_attr($target_hov_txt); ?>"><span class="tx-ib-img-hov-txt"><?php echo esc_html( $settings['ib_hover_txt'] ); ?></span></a>
				<?php else : ?>
				<span class="tx-ib-img-hov-txt"><?php echo esc_html( $settings['ib_hover_txt'] ); ?></span>
				<?php endif; ?>
			</div><!-- tx-ib-image -->

            <div class="tx-ib-content">
		        <?php if($settings['ib_title_link'] == 'yes') : ?>
		        <a class="tx-ib-title-link" href="<?php echo esc_url($settings['ib_title_link_url']['url']); ?>" target="<?php echo esc_attr($target); ?>">
				<<?php echo esc_attr($settings['ib_html_tag']); ?>><?php echo esc_html( $settings['ib_title'] ); ?></<?php echo esc_attr($settings['ib_html_tag']); ?>>
				</a>
				<?php else : ?>
				<<?php echo esc_attr($settings['ib_html_tag']); ?> class="tx-ib-title"><?php echo esc_html( $settings['ib_title'] ); ?></<?php echo esc_attr($settings['ib_html_tag']); ?>>
				<?php endif; ?>

				<div class="tx-ib-desc">
				<?php echo wp_sprintf( $settings['ib_desc'] ); ?>
				</div><!-- tx-ib-desc -->

				<?php if($settings['ib_button_display'] == 'yes') : ?>
				<div class="tx-ib-button">
					<a class="tx-ib-btn-link" href="<?php echo esc_url($settings['ib_btn_link_url']['url']); ?>" target="<?php echo esc_attr($target_btn); ?>">

						<?php 
						if( $settings['ib_btn_icon'] !='' && $settings['ib_btn_icon_align'] =='left'  ) : ?>
							<i class="<?php echo esc_attr($settings['ib_btn_icon']); ?> tx-ib-btn-icon-left" aria-hidden="true"></i>
						<?php endif; ?>

						<?php echo esc_html($settings['ib_btn_txt']); ?>
						
						<?php 
						if( $settings['ib_btn_icon'] !='' && $settings['ib_btn_icon_align'] =='right'  ) : ?>
							<i class="<?php echo esc_attr($settings['ib_btn_icon']); ?> tx-ib-btn-icon-right" aria-hidden="true"></i>
						<?php endif; ?>
					</a>
				</div><!-- tx-ib-button -->
				<?php endif; ?>
			</div><!-- tx-ih-content-wrap -->

		</div><!-- tx-image-box-wrap -->
		

		
<?php } //render()

} // class
