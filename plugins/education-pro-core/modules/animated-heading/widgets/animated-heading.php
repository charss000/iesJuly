<?php
namespace EpElements\Modules\AnimatedHeading\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Background;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Text_Shadow;
use Elementor\Utils;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class AnimatedHeading extends Widget_Base {

    public function get_name() {
        return 'ep-animated-heading';
    }

    public function get_title() {
        return esc_html__( 'EP Animated Heading', 'education-pro-core' );
    }

    public function get_icon() {
        return 'eicon-animation-text';
    }

    public function get_categories() {
        return [ 'ep-elements' ];
    }

    public function get_script_depends() {
        return [ 'typed', 'morphext' ];
    }
    public function get_keywords() {
        return [ 'animated', 'heading', 'headline', 'vivid', 'title', 'text', 'animation', 'typing' ];
    }

	protected function register_controls() {
		$this->start_controls_section(
            'settings',
            [
                'label' => esc_html__( 'Content', 'education-pro-core' )
            ]
        );
        $this->add_control(
            'txt_style',
            [
                'label'   => esc_html__( 'Style', 'education-pro-core' ),
                'type'    => Controls_Manager::SELECT,
                'options' => [
                    'typed' => esc_html__( 'Typed', 'education-pro-core' ),
                    'animated'    => esc_html__( 'Animated', 'education-pro-core' ),
                ],
                'default' => 'typed',
            ]
        );
        $this->add_control(
            'type_speed',
            [
                'label'     => esc_html__( 'Type Speed', 'education-pro-core' ),
                'type'      => Controls_Manager::NUMBER,
                'default'   => 70,
                'condition' => [
                    'txt_style' => 'typed',
                ],
            ]
        );
        $this->add_control(
            'start_delay',
            [
                'label'     => esc_html__( 'Start Delay', 'education-pro-core' ),
                'type'      => Controls_Manager::NUMBER,
                'default'   => 500,
                'step'      => 100,
                'condition' => [
                    'txt_style' => 'typed',
                ],
            ]
        );

        $this->add_control(
            'back_speed',
            [
                'label'     => esc_html__( 'Back Speed', 'education-pro-core' ),
                'type'      => Controls_Manager::NUMBER,
                'default'   => 40,
                'condition' => [
                    'txt_style' => 'typed',
                ],
            ]
        );

        $this->add_control(
            'back_delay',
            [
                'label'     => esc_html__( 'Back Delay', 'education-pro-core' ),
                'type'      => Controls_Manager::NUMBER,
                'default'   => 500,
                'step'      => 50,
                'condition' => [
                    'txt_style' => 'typed',
                ],
            ]
        );
        $this->add_control(
            'txt_animation',
            [
                'label'   => esc_html__( 'Animation', 'education-pro-core' ),
                'type'    => Controls_Manager::SELECT,
                'options' => [
                    'none' => esc_html__( 'None', 'education-pro-core' ),
                    'fadeIn' => esc_html__( 'Fade In', 'education-pro-core' ),
                    'fadeInUp' => esc_html__( 'Fade In Up', 'education-pro-core' ),
                    'fadeInDown' => esc_html__( 'Fade In Down', 'education-pro-core' ),
                    'fadeInLeft' => esc_html__( 'Fade In Left', 'education-pro-core' ),
                    'fadeInRight' => esc_html__( 'Fade In Right', 'education-pro-core' ),
                    'zoomIn'    => esc_html__( 'Zoom In', 'education-pro-core' ),
                    'zoomInUp'    => esc_html__( 'Zoom In Up', 'education-pro-core' ),
                    'zoomInDown'    => esc_html__( 'Zoom In Down', 'education-pro-core' ),
                    'zoomInLeft'    => esc_html__( 'Zoom In Left', 'education-pro-core' ),
                    'zoomInRight'    => esc_html__( 'Zoom In Right', 'education-pro-core' ),
                    'bounceIn'    => esc_html__( 'Bounce In', 'education-pro-core' ),
                    'bounceInUp'    => esc_html__( 'Bounce In Up', 'education-pro-core' ),
                    'bounceInDown'    => esc_html__( 'Bounce In Down', 'education-pro-core' ),
                    'bounceInLeft'    => esc_html__( 'Bounce In Left', 'education-pro-core' ),
                    'bounceInRight'    => esc_html__( 'Bounce In Right', 'education-pro-core' ),
                    'slideIn'    => esc_html__( 'Slide In', 'education-pro-core' ),
                    'slideInUp'    => esc_html__( 'Slide In Up', 'education-pro-core' ),
                    'slideInDown'    => esc_html__( 'Slide In Down', 'education-pro-core' ),
                    'slideInLeft'    => esc_html__( 'Slide In Left', 'education-pro-core' ),
                    'slideInRight'    => esc_html__( 'Slide In Right', 'education-pro-core' ),
                    'rotateIn'    => esc_html__( 'Rotate In', 'education-pro-core' ),
                    'rotateInUpLeft'    => esc_html__( 'Rotate In Up Left', 'education-pro-core' ),
                    'rotateInUpRight'    => esc_html__( 'Rotate In Up Right', 'education-pro-core' ),
                    'rotateInDownLeft'    => esc_html__( 'Rotate In Down Left', 'education-pro-core' ),
                    'rotateInDownRight'    => esc_html__( 'Rotate In Down Right', 'education-pro-core' ),
                    'bounce'    => esc_html__( 'Bounce', 'education-pro-core' ),
                    'flash'    => esc_html__( 'Flash', 'education-pro-core' ),
                    'pulse'    => esc_html__( 'Pulse', 'education-pro-core' ),
                    'rubberBand'    => esc_html__( 'Rubber Band', 'education-pro-core' ),
                    'shake'    => esc_html__( 'Shake', 'education-pro-core' ),
                    'headShake'    => esc_html__( 'Head Shake', 'education-pro-core' ),
                    'swing'    => esc_html__( 'Swing', 'education-pro-core' ),
                    'tada'    => esc_html__( 'Tada', 'education-pro-core' ),
                    'wobble'    => esc_html__( 'Wobble', 'education-pro-core' ),
                    'jello'    => esc_html__( 'Jello', 'education-pro-core' ),
                    'lightSpeedIn'    => esc_html__( 'Light Speed In', 'education-pro-core' ),
                    'rollIn'    => esc_html__( 'Roll In', 'education-pro-core' ),
                ],
                'default' => 'fadeIn',
                'condition' => [
                    'txt_style' => 'animated',
                ]
            ]
        );
        $this->add_control(
            'speed',
            [
                'label'     => esc_html__( 'Delay', 'education-pro-core' ),
                'type'      => Controls_Manager::NUMBER,
                'default'   => 2500,
                'step'      => 100,
                'condition' => [
                   'txt_style' => 'animated',
                ],
            ]
        );
        $this->add_control(
            'before_txt',
            [
                'label' => esc_html__( 'Before Text', 'education-pro-core' ),
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'default' => esc_html__( 'This is', 'education-pro-core' ),
                'separator' => 'before'
            ]
        );
        
        $this->add_control(
            'animated_txt',
            [
                'label' => esc_html__( 'Animated Text', 'education-pro-core' ),
                'type' => Controls_Manager::TEXTAREA,
                'label_block' => true,
                'default' => esc_html__( 'Animated, Typing, Dynamic', 'education-pro-core' ),
            ]
        );
        $this->add_control(
            'after_txt',
            [
                'label' => esc_html__( 'After Text', 'education-pro-core' ),
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'default' => esc_html__( 'Heading', 'education-pro-core' ),
            ]
        );
        $this->add_control(
            'html_tag',
            [
                'label'     => esc_html__( 'HTML Tag', 'education-pro-core' ),
                'type'      => Controls_Manager::SELECT,
                'default'   => 'h2',
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
                'separator' => 'before'
            ]
        );
        
        $this->add_control(
            'link_url',
            [
                'label'       => esc_html__( 'Link URL', 'education-pro-core' ),
                'type'        => Controls_Manager::URL,
                'dynamic'     => [ 'active' => true ],
                'placeholder' => 'https://your-link.com',
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
                    '{{WRAPPER}} .tx-animated-heading'   => 'text-align: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_section();

		$this->start_controls_section(
			'tx_styles',
			[
				'label' 	=> esc_html__( 'Default Styles', 'education-pro-core' ),
				'tab' 		=> Controls_Manager::TAB_STYLE,
			]
		);
        $this->add_control(
            'ah_txt_color',
            [
                'label'     => esc_html__( 'Text Color', 'education-pro-core' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tx-animated-heading' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_control(
            'ah_txt_hov_color',
            [
                'label'     => esc_html__( 'Text Hover Color', 'education-pro-core' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tx-animated-heading:hover span' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_control(
            'ah_txt_bg_color',
            [
                'label'     => esc_html__( 'Text Background Color', 'education-pro-core' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tx-animated-heading' => 'background-color: {{VALUE}};',
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'      => 'ah_txt_typo',
                'selector'  => '{{WRAPPER}} .tx-animated-heading',
            ]
        );
        $this->add_group_control(
            Group_Control_Text_Shadow::get_type(),
            [
                'name'     => 'ah_txt_shadow',
                'selector' => '{{WRAPPER}} .tx-animated-heading'
            ]
        );
        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'        => 'ah_border',
                'selector'    =>    '{{WRAPPER}} .tx-animated-heading'
            ]
        );
        $this->add_responsive_control(
            'ah_padding',
            [
                'label'         => esc_html__( 'Padding', 'education-pro-core' ),
                'type'          => Controls_Manager::DIMENSIONS,
                'size_units'    => [ 'px', 'em', '%' ],
                'selectors'     => [
                    '{{WRAPPER}} .tx-animated-heading' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'ah_margin',
            [
                'label'         => esc_html__( 'Margin', 'education-pro-core' ),
                'type'          => Controls_Manager::DIMENSIONS,
                'size_units'    => [ 'px', 'em', '%' ],
                'selectors'     => [
                    '{{WRAPPER}} .tx-animated-heading' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->end_controls_section();

        $this->start_controls_section(
            'tx_before_style',
            [
                'label'     => esc_html__( 'Before Text', 'education-pro-core' ),
                'tab'       => Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_control(
            'ah_before_txt_color',
            [
                'label'     => esc_html__( 'Before Text Color', 'education-pro-core' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tx-animated-heading-before-text' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_control(
            'ah_before_txt_bg_color',
            [
                'label'     => esc_html__( 'Before Text Background Color', 'education-pro-core' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tx-animated-heading-before-text' => 'background-color: {{VALUE}};',
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'      => 'ah_before_txt_typo',
                'selector'  => '{{WRAPPER}} .tx-animated-heading-before-text',
            ]
        );
        $this->add_group_control(
            Group_Control_Text_Shadow::get_type(),
            [
                'name'     => 'ah_before_txt_shadow',
                'selector' => '{{WRAPPER}} .tx-animated-heading-before-text'
            ]
        );
        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'        => 'ah_before_txt_border',
                'selector'    =>    '{{WRAPPER}} .tx-animated-heading-before-text'
            ]
        );
        $this->add_responsive_control(
            'ah_before_txt_padding',
            [
                'label'         => esc_html__( 'Padding', 'education-pro-core' ),
                'type'          => Controls_Manager::DIMENSIONS,
                'size_units'    => [ 'px', 'em', '%' ],
                'selectors'     => [
                    '{{WRAPPER}} .tx-animated-heading-before-text' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'ah_before_txt_margin',
            [
                'label'         => esc_html__( 'Margin', 'education-pro-core' ),
                'type'          => Controls_Manager::DIMENSIONS,
                'size_units'    => [ 'px', 'em', '%' ],
                'selectors'     => [
                    '{{WRAPPER}} .tx-animated-heading-before-text' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->end_controls_section();

        $this->start_controls_section(
            'tx_animated_style',
            [
                'label'     => esc_html__( 'Animated Text', 'education-pro-core' ),
                'tab'       => Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_control(
            'ah_animated_txt_color',
            [
                'label'     => esc_html__( 'Animated Text Color', 'education-pro-core' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tx-animated-txt' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_control(
            'ah_animated_txt_bg_color',
            [
                'label'     => esc_html__( 'Animated Text Background Color', 'education-pro-core' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tx-animated-txt' => 'background-color: {{VALUE}};',
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'      => 'ah_animated_txt_typo',
                'selector'  => '{{WRAPPER}} .tx-animated-txt',
            ]
        );
        $this->add_group_control(
            Group_Control_Text_Shadow::get_type(),
            [
                'name'     => 'ah_animated_txt_shadow',
                'selector' => '{{WRAPPER}} .tx-animated-txt'
            ]
        );
        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'        => 'ah_animated_txt_border',
                'selector'    =>    '{{WRAPPER}} .tx-animated-txt'
            ]
        );
        $this->add_responsive_control(
            'ah_animated_txt_padding',
            [
                'label'         => esc_html__( 'Padding', 'education-pro-core' ),
                'type'          => Controls_Manager::DIMENSIONS,
                'size_units'    => [ 'px', 'em', '%' ],
                'selectors'     => [
                    '{{WRAPPER}} .tx-animated-txt' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'ah_animated_txt_margin',
            [
                'label'         => esc_html__( 'Margin', 'education-pro-core' ),
                'type'          => Controls_Manager::DIMENSIONS,
                'size_units'    => [ 'px', 'em', '%' ],
                'selectors'     => [
                    '{{WRAPPER}} .tx-animated-txt' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->end_controls_section();

        $this->start_controls_section(
            'tx_after_style',
            [
                'label'     => esc_html__( 'After Text', 'education-pro-core' ),
                'tab'       => Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_control(
            'ah_after_txt_color',
            [
                'label'     => esc_html__( 'After Text Color', 'education-pro-core' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tx-animated-heading-after-text' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_control(
            'ah_after_txt_bg_color',
            [
                'label'     => esc_html__( 'After Text Background Color', 'education-pro-core' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tx-animated-heading-after-text' => 'background-color: {{VALUE}};',
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'      => 'ah_after_txt_typo',
                'selector'  => '{{WRAPPER}} .tx-animated-heading-after-text',
            ]
        );
        $this->add_group_control(
            Group_Control_Text_Shadow::get_type(),
            [
                'name'     => 'ah_after_txt_shadow',
                'selector' => '{{WRAPPER}} .tx-animated-heading-after-text'
            ]
        );
        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'        => 'ah_after_txt_border',
                'selector'    =>    '{{WRAPPER}} .tx-animated-txt'
            ]
        );
        $this->add_responsive_control(
            'ah_after_txt_padding',
            [
                'label'         => esc_html__( 'Padding', 'education-pro-core' ),
                'type'          => Controls_Manager::DIMENSIONS,
                'size_units'    => [ 'px', 'em', '%' ],
                'selectors'     => [
                    '{{WRAPPER}} .tx-animated-heading-after-text' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'ah_after_txt_margin',
            [
                'label'         => esc_html__( 'Margin', 'education-pro-core' ),
                'type'          => Controls_Manager::DIMENSIONS,
                'size_units'    => [ 'px', 'em', '%' ],
                'selectors'     => [
                    '{{WRAPPER}} .tx-animated-heading-after-text' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->end_controls_section();

	}

	protected function render() {

		$settings = $this->get_settings();
        $target = $settings['link_url']['is_external'] ? '_blank' : '_self';
        $id = $this->get_id();
        $animated_txt = explode(",", esc_html($settings['animated_txt']) );

        $this->add_render_attribute( 'animated-txt', 'id', 'tx-ah-' . $id );
        $this->add_render_attribute( 'animated-txt', 'class', 'tx-animated-txt' );

        if($settings['txt_style'] == 'typed') :
            $this->add_render_attribute(
                [
                    'animated-heading' => [
                        'data-settings' => [
                            wp_json_encode(array_filter([
                                'styles'     => $settings['txt_style'],
                                'strings'    => $animated_txt,
                                'typeSpeed'  => $settings['type_speed'],
                                'startDelay' => $settings['start_delay'],
                                'backSpeed'  => $settings['back_speed'],
                                'backDelay'  => $settings['back_delay'],
                                'loop'       => true,
                                'loopCount'  => 'infinity',
                            ]))
                        ]
                    ]
                ]
            );
        elseif($settings['txt_style'] == 'animated') :
            $this->add_render_attribute(
                [
                    'animated-heading' => [
                        'data-settings' => [
                            wp_json_encode(array_filter([
                                'styles'    => $settings['txt_style'],
                                'animation' => $settings['txt_animation'],
                                'speed'     => $settings['speed'],
                            ]))
                        ]
                    ]
                ]
            );
        endif;
        ?>



    <div class="tx-animated-heading-wrap" <?php echo $this->get_render_attribute_string( 'animated-heading' ); ?> >

        <?php if( !empty($settings['link_url']['url']) ) : ?>

            <a class="tx-ah-title-link" href="<?php echo esc_url($settings['link_url']['url']); ?>" target="<?php echo esc_attr($target); ?>">
            <<?php echo esc_attr($settings['html_tag']); ?> class="tx-animated-heading">
                <span class="tx-animated-heading-before-text"><?php echo esc_html( $settings['before_txt']); ?></span>
                <?php if($settings['txt_style'] == 'animated') : ?>
                <span <?php echo $this->get_render_attribute_string( 'animated-txt' ); ?>><?php echo esc_html($settings['animated_txt']); ?></span>
                <?php elseif($settings['txt_style'] == 'typed') : ?>
                <span <?php echo $this->get_render_attribute_string( 'animated-txt' ); ?>></span>
                <?php endif; ?>
                <span class="tx-animated-heading-after-text"><?php echo esc_html( $settings['after_txt'] ); ?></span>
            </<?php echo esc_attr($settings['html_tag']); ?>>
            </a>

            <?php else: ?>

            <<?php echo esc_attr($settings['html_tag']); ?> class="tx-animated-heading">
                <span class="tx-animated-heading-before-text"><?php echo esc_html( $settings['before_txt']); ?></span>
                <?php if($settings['txt_style'] == 'animated') : ?>
                <span <?php echo $this->get_render_attribute_string( 'animated-txt' ); ?>><?php echo esc_html($settings['animated_txt']); ?></span>
                <?php elseif($settings['txt_style'] == 'typed') : ?>
                <span <?php echo $this->get_render_attribute_string( 'animated-txt' ); ?>></span>
                <?php endif; ?>
                <span class="tx-animated-heading-after-text"><?php echo esc_html( $settings['after_txt'] ); ?></span>
            </<?php echo esc_attr($settings['html_tag']); ?>>

        <?php endif; ?>

    </div>



<?php
	} //render()
} // class
