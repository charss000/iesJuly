<?php
namespace EpElements\Modules\ImageHover\Widgets;

use elementor\Widget_Base;
use elementor\Controls_Manager;
use elementor\Scheme_Typography;
use elementor\Group_Control_Image_Size;
use elementor\Group_Control_Border;
use elementor\Group_Control_Typography;
use elementor\Group_Control_Background;
use elementor\Group_Control_Box_Shadow;
use elementor\Icons_Manager;
use elementor\Utils;

use EpElements\TX_Load;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class ImageHover extends Widget_Base {

	public function get_name() {
		return 'ep-image-hover';
	}

	public function get_title() {
		return esc_html__( 'EP Image Hover', 'education-pro-core' );
	}

	public function get_icon() {
		return 'eicon-image-rollover';
	}

	public function get_categories() {
		return [ 'ep-elements' ];
	}

	public function get_keywords() {
		return [ 'image', 'hover' ];
	}
	protected function register_controls() {
		$this->start_controls_section(
			'ih_settings',
			[
				'label' => esc_html__( 'Settings', 'education-pro-core' ),
			]
		);
		$this->add_control(
			'ih_image',
			[
				'label' => esc_html__( 'Image', 'education-pro-core' ),
				'type' => Controls_Manager::MEDIA,
				'default' => [
					'url' => Utils::get_placeholder_image_src(),
				],
			]
		);
		$this->add_responsive_control(
            'ih_img_size',
            [
                'label'   => esc_html__( 'Image Size', 'education-pro-core' ),
                'type'    => Controls_Manager::SLIDER,
                'default' => [
                    'size' => 360,
                    'unit' => 'px',
                ],
                'range' => [
                    'px' => [
                        'max'  => 1200,
                        'min'  => 0,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .tx-ih-wrap, {{WRAPPER}} .tx-ih-wrap img'   => 'width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
		$this->add_control(
			'ih_effect',
			[
				'label' => esc_html__( 'Effects', 'education-pro-core' ),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'effect-1'  => esc_html__( 'Effect 1', 'education-pro-core' ),
					// 'effect-2'  => esc_html__( 'Effect 2', 'education-pro-core' ),
					'effect-3'  => esc_html__( 'Effect 2', 'education-pro-core' ),
					'effect-4'  => esc_html__( 'Effect 3', 'education-pro-core' ),
					'effect-5'  => esc_html__( 'Effect 4', 'education-pro-core' ),
					// 'effect-6'  => esc_html__( 'Effect 6', 'education-pro-core' ),
					// 'effect-7'  => esc_html__( 'Effect 7', 'education-pro-core' ),
					// 'effect-8'  => esc_html__( 'Effect 8', 'education-pro-core' ),
					// 'effect-9'  => esc_html__( 'Effect 9', 'education-pro-core' ),
					'effect-10' => esc_html__( 'Effect 5', 'education-pro-core' ),
					// 'effect-11' => esc_html__( 'Effect 11', 'education-pro-core' ),
					// 'effect-12' => esc_html__( 'Effect 12', 'education-pro-core' ),
				],
				'default' => 'effect-1',
			]
		);
		$this->add_control(
			'ih_title',
			[
				'label'   => esc_html__( 'Title', 'education-pro-core' ),
				'type'    => Controls_Manager::TEXT,
				'dynamic'     => [ 'active' => true ],
				'default'     => esc_html__( 'This is the title', 'education-pro-core' ),
				'label_block' => true,
			]
		);
		$this->add_control(
			'ih_link',
			[
				'label'        => esc_html__( 'Title Link', 'education-pro-core' ),
				'type'         => Controls_Manager::SWITCHER,
			]
		);
		$this->add_control(
			'ih_link_url',
			[
				'label'       => esc_html__( 'Title Link URL', 'education-pro-core' ),
				'type'        => Controls_Manager::URL,
				'dynamic'     => [ 'active' => true ],
				'placeholder' => 'http://your-link.com',
				'condition'   => [
				 'ih_link' => 'yes'
				]
			]
		);
		$this->add_control(
			'ih_desc',
			[
				'label'   => esc_html__( 'Description', 'education-pro-core' ),
				'type'    => Controls_Manager::WYSIWYG,
				'dynamic'     => [ 'active' => true ],
				'default'     => esc_html__( 'Suspendisse potenti Phasellus euismod libero in neque molestie et mentum libero maximus. Etiam in enim vestibulum suscipit sem quis.', 'education-pro-core' ),
				'placeholder' => esc_html__( 'Enter your description', 'education-pro-core' ),
			]
		);
		$this->end_controls_section();

		$this->start_controls_section(
            'ih_styles',
            [
                'label'                 => esc_html__( 'Style', 'education-pro-core' ),
                'tab'                   => Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'ih_background',
				'label' => esc_html__( 'Background', 'education-pro-core' ),
				'selector' => '{{WRAPPER}} .tx-ih-wrap.effect-1:before, {{WRAPPER}} .tx-ih-wrap.effect-2:before, {{WRAPPER}} .tx-ih-wrap.effect-3:hover:before, {{WRAPPER}} .tx-ih-wrap.effect-4:hover, {{WRAPPER}} .tx-ih-wrap.effect-5:before, {{WRAPPER}} .tx-ih-wrap.effect-5:after, {{WRAPPER}} .tx-ih-wrap.effect-5 .tx-ih-content:before, {{WRAPPER}} .tx-ih-wrap.effect-5 .tx-ih-content:after, {{WRAPPER}} .tx-ih-wrap.effect-6:before, {{WRAPPER}} .tx-ih-wrap.effect-7:before, {{WRAPPER}} .tx-ih-wrap.effect-8:before, {{WRAPPER}} .tx-ih-wrap.effect-8, {{WRAPPER}} .tx-ih-wrap.effect-9 .tx-ih-content, {{WRAPPER}} .tx-ih-wrap.effect-10:before, {{WRAPPER}} .tx-ih-wrap.effect-10:after, {{WRAPPER}} .tx-ih-wrap.effect-10 .tx-ih-content:before, {{WRAPPER}} .tx-ih-wrap.effect-10 .tx-ih-content:after, {{WRAPPER}} .tx-ih-wrap.effect-11:before, {{WRAPPER}} .tx-ih-wrap.effect-11:after, {{WRAPPER}} .tx-ih-wrap.effect-12 .tx-ih-content',
			]
		);
        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'        => 'ih_img_border',
                'selector'    =>    '{{WRAPPER}} .tx-ih-wrap'
            ]
        );
        $this->add_responsive_control(
            'ih_img_border_radius',
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
                    '{{WRAPPER}} .tx-ih-wrap'   => 'border-radius: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
		$this->add_control(
            'ih_title_color',
            [
                'label'     => esc_html__( 'Title Color', 'education-pro-core' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tx-ih-title' => 'color: {{VALUE}};',
                ],
                'separator' => 'before'
            ]
        );
        $this->add_control(
            'ih_title_hov_color',
            [
                'label'     => esc_html__( 'Title Hover Color', 'education-pro-core' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tx-ih-title:hover' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'      => 'ih_title_typo',
                'selector'  => '{{WRAPPER}} .tx-ih-title',
            ]
        );
        $this->add_responsive_control(
            'ih_title_padding',
            [
                'label'         => esc_html__( 'Title Padding', 'education-pro-core' ),
                'type'          => Controls_Manager::DIMENSIONS,
                'size_units'    => [ 'px', 'em', '%' ],
                'selectors'     => [
                    '{{WRAPPER}} .tx-ih-title' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_control(
            'ih_desc_color',
            [
                'label'     => esc_html__( 'Description Color', 'education-pro-core' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tx-ih-desc' => 'color: {{VALUE}};',
                ],
                'separator' => 'before'
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'      => 'ih_desc_typo',
                'selector'  => '{{WRAPPER}} .tx-ih-desc',
            ]
        );
        $this->add_responsive_control(
            'ih_desc_padding',
            [
                'label'         => esc_html__( 'Description Padding', 'education-pro-core' ),
                'type'          => Controls_Manager::DIMENSIONS,
                'size_units'    => [ 'px', 'em', '%' ],
                'selectors'     => [
                    '{{WRAPPER}} .tx-ih-desc' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->end_controls_section();
	}

	protected function render() {
		$settings = $this->get_settings();
		$target = $settings['ih_link_url']['is_external'] ? '_blank' : '_self';

		?>	
		<div class="tx-ih-wrap <?php echo esc_attr( $settings['ih_effect'] ); ?>">
			
			<img src="<?php echo esc_attr($settings['ih_image']['url']); ?>" alt="<?php echo esc_attr( $settings['ih_title'] ); ?>">
			
            <div class="tx-ih-content">
            	<div class="tx-ih-inner-content">
	            <div class="tx-ih-title-wrap">
		            <?php if($settings['ih_link'] == 'yes') : ?>
		            <a class="tx-ih-title-link" href="<?php echo esc_url($settings['ih_link_url']['url']); ?>" target="<?php echo esc_attr($target); ?>">
					<h4 class="tx-ih-title"><?php echo esc_html( $settings['ih_title'] ); ?></h4>
					</a>
					<?php else : ?>
					<h4 class="tx-ih-title"><?php echo esc_html( $settings['ih_title'] ); ?></h4>
					<?php endif; ?>
				</div><!-- tx-ih-title-wrap -->

				<div class="tx-ih-desc">
					<?php echo wp_sprintf( $settings['ih_desc'] ); ?>
				</div>
				</div><!-- tx-ih-inner-content -->
			</div><!-- tx-ih-content-wrap -->
			
		</div><!-- tx-ih-wrap -->
		
		
		
		

		
<?php }

}
