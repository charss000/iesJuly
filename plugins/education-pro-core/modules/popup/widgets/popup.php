<?php
namespace EpElements\Modules\Popup\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Image_Size;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Background;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Text_Shadow;
use Elementor\Icons_Manager;
use Elementor\Utils;

use EpElements\TX_Load;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Popup extends Widget_Base {

    public function get_name() {
        return 'ep-popup';
    }

    public function get_title() {
        return esc_html__( 'EP Popup', 'education-pro-core' );
    }

    public function get_icon() {
        return 'eicon-lightbox';
    }

    public function get_categories() {
        return [ 'ep-elements' ];
    }

    public function get_keywords() {
        return [ 'popup', 'modal', 'lightbox', 'window' ];
    }
    public function get_script_depends() {
        return [ 'lity' ];
    }
    protected function register_controls() {
        $this->start_controls_section(
            'sec_settings',
            [
                'label' => esc_html__( 'Settings', 'education-pro-core' ),
            ]
        );
        $this->add_control(
            'popup_type',
            [
                'label' => esc_html__( 'Popup Type', 'education-pro-core' ),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'type_image'  => esc_html__( 'Image', 'education-pro-core' ),
                    'type_content'  => esc_html__( 'Content', 'education-pro-core' ),
                    'type_url'  => esc_html__( 'External URL', 'education-pro-core' ),
                ],
                'default' => 'type_image',
            ]
        );
        $this->add_control(
            'popup_type_image',
            [
                'label' => esc_html__( 'Choose Image', 'education-pro-core' ),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ],
                'condition' => [
                    'popup_type' => 'type_image',
                ],
            ]
        );
        $this->add_control(
          'popup_type_content',
          [
             'label'   => esc_html__( 'Add Content', 'education-pro-core' ),
             'type'    => Controls_Manager::WYSIWYG,
             'default' => esc_html__( 'Lorem ipsum dolor sit amet consectetur adipiscing elit sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.', 'education-pro-core' ),
             'condition' => [
                'popup_type' => 'type_content',
             ],
          ]
        );
        $this->add_control(
            'popup_type_url',
            [
                'label' => esc_html__( 'Add website, video, map etc url', 'education-pro-core' ),
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'default' => 'https://theme-x.org/',
                'condition' => [
                    'popup_type' => 'type_url',
                ],
            ]
        );
        $this->add_control(
            'popup_btn_txt',
            [
                'label' => esc_html__( 'Button Text', 'education-pro-core' ),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__( 'CLICK TO OPEN', 'education-pro-core' ),
                'separator' => 'before',
            ]
        );
        $this->add_control(
            'popup_btn_icon',
            [
                'label' => esc_html__( 'Button Icon', 'education-pro-core' ),
                'type' => Controls_Manager::ICONS,
            ]
        );
        $this->add_control(
            'popup_btn_icon_position',
            [
                'label' => esc_html__( 'Icon Position', 'education-pro-core' ),
                'type' => Controls_Manager::SELECT,
                'default' => 'before',
                'options' => [
                    'before' => esc_html__( 'Before', 'education-pro-core' ),
                    'after' => esc_html__( 'After', 'education-pro-core' ),
                ],
            ]
        );
        $this->add_control(
            'popup_btn_icon_indent',
            [
                'label' => esc_html__( 'Icon Spacing', 'education-pro-core' ),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'max' => 50,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .tx-popup-btn-icon-before' => 'margin-right: {{SIZE}}px;',
                    '{{WRAPPER}} .tx-popup-btn-icon-after' => 'margin-left: {{SIZE}}px;',
                ],
            ]
        );
        
        $this->add_control(
            'popup_btn_border_radius',
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
                    '{{WRAPPER}} .tx-popup-button' => 'border-radius: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'popup_btn_alignment',
            [
                'label' => esc_html__( 'Button Alignment', 'education-pro-core' ),
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
                'selectors' => [
                    '{{WRAPPER}} .tx-popup-wrap' => 'text-align: {{VALUE}}',
                ],
                'toggle' => false
            ]
        );
        $this->add_responsive_control(
            'popup_btn_padding',
            [
                'label' => esc_html__( 'Button Padding', 'education-pro-core' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px' ],
                'selectors' => [
                    '{{WRAPPER}} .tx-popup-button' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->end_controls_section();

        // $this->start_controls_section(
        //     'sec_styles',
        //     [
        //         'label'                 => esc_html__( 'Style', 'education-pro-core' ),
        //         'tab'                   => Controls_Manager::TAB_STYLE,
        //     ]
        // );
        // $this->add_control(
        //     'popup_container_bg_color',
        //     [
        //         'label' => esc_html__( 'Container Background Color', 'education-pro-core' ),
        //         'type' => Controls_Manager::COLOR,
        //         'selectors' => [
        //             '{{WRAPPER}} .lity-container' => 'background-color: {{VALUE}};',
        //         ],
        //     ]
        // );
        // $this->add_responsive_control(
        //     'popup_container_padding',
        //     [
        //         'label' => esc_html__( 'Container Padding', 'education-pro-core' ),
        //         'type' => Controls_Manager::DIMENSIONS,
        //         'size_units' => [ 'px' ],
        //         'selectors' => [
        //             '{{WRAPPER}} .lity-container' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
        //         ],
        //     ]
        // );
        // $this->end_controls_section();

        $this->start_controls_section(
            'popup_btn_styles',
            [
                'label' => esc_html__( 'Button', 'education-pro-core' ),
                'tab' => Controls_Manager::TAB_STYLE
            ]
        );
        $this->start_controls_tabs( 'popup_btn_tabs' );

        $this->start_controls_tab( 
            'popup_btn_tab_normal', 
            [ 
                'label' => esc_html__( 'Normal', 'education-pro-core' ), 
            ] 
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
             'name' => 'popup_btn_typography',
                'selector' => '{{WRAPPER}} .tx-popup-button',
            ]
        );
        $this->add_control(
            'popup_btn_text_color',
            [
                'label' => esc_html__( 'Text Color', 'education-pro-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tx-popup-button' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_control(
            'popup_btn_bg_color',
            [
                'label' => esc_html__( 'Background Color', 'education-pro-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tx-popup-button' => 'background-color: {{VALUE}};',
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'popup_btn_border',
                'selector' => '{{WRAPPER}} .tx-popup-button',
            ]
        );
        $this->end_controls_tab();

        $this->start_controls_tab( 'popup_btn_tab_hover', 
            [ 
                'label' => esc_html__( 'Hover', 'education-pro-core' ), 
            ] 
        );
        $this->add_control(
            'popup_btn_text_hov_color',
            [
                'label' => esc_html__( 'Text Hover Color', 'education-pro-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tx-popup-button:hover' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_control(
            'popup_btn_bg_hov_color',
            [
                'label' => esc_html__( 'Background Hover Color', 'education-pro-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tx-popup-button:hover' => 'background-color: {{VALUE}};',
                ],
            ]
        );
        $this->add_control(
            'popup_btn_border_hov_color',
            [
                'label' => esc_html__( 'Border Hover Color', 'education-pro-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tx-popup-button:hover' => 'border-color: {{VALUE}};',
                ],
            ]
        );
        $this->end_controls_tab();
        $this->end_controls_section();

    }

    protected function render() {
        $settings = $this->get_settings();
        $id = $this->get_id();

        $this->add_render_attribute( 'popup-content', 'id', 'tx-popup-content-' . $id );
        $this->add_render_attribute( 'popup-content', 'class', 'lity-hide' );
        ?>

        <div class="tx-popup-wrap">
            <?php if($settings['popup_type'] == 'type_image') : ?>
                <a href="<?php echo esc_attr($settings['popup_type_image']['url']); ?>" id="<?php echo esc_attr('tx-popup-image-'.$id); ?>" class="tx-popup-button" data-lity>
                    <?php if( $settings['popup_btn_icon'] !='' && $settings['popup_btn_icon_position'] =='before'  ) : ?>
                            <span class="tx-popup-btn-icon-before"><?php Icons_Manager::render_icon( $settings['popup_btn_icon'], [ 'aria-hidden' => 'true' ] ); ?></span>
                    <?php endif; ?>
                    <?php echo esc_html($settings['popup_btn_txt']); ?>
                    <?php if( $settings['popup_btn_icon'] !='' && $settings['popup_btn_icon_position'] =='after'  ) : ?>
                            <span class="tx-popup-btn-icon-after"><?php Icons_Manager::render_icon( $settings['popup_btn_icon'], [ 'aria-hidden' => 'true' ] ); ?></span>
                    <?php endif; ?>
                </a>
            <?php endif; ?>
            <?php if($settings['popup_type'] == 'type_content') : ?>
                <a href="#tx-popup-content-<?php echo esc_attr($id); ?>" class="tx-popup-button" data-lity>
                    <?php if( $settings['popup_btn_icon'] !='' && $settings['popup_btn_icon_position'] =='before'  ) : ?>
                            <span class="tx-popup-btn-icon-before"><?php Icons_Manager::render_icon( $settings['popup_btn_icon'], [ 'aria-hidden' => 'true' ] ); ?></span>
                    <?php endif; ?>
                    <?php echo esc_html($settings['popup_btn_txt']); ?>
                    <?php if( $settings['popup_btn_icon'] !='' && $settings['popup_btn_icon_position'] =='after'  ) : ?>
                            <span class="tx-popup-btn-icon-after"><?php Icons_Manager::render_icon( $settings['popup_btn_icon'], [ 'aria-hidden' => 'true' ] ); ?></span>
                    <?php endif; ?>
                </a>
            <?php endif; ?>
            <?php if($settings['popup_type'] == 'type_url') : ?>
                <a href="<?php echo esc_attr($settings['popup_type_url']); ?>" id="<?php echo esc_attr('tx-popup-url-'.$id); ?>" class="tx-popup-button" data-lity>
                    <?php if( $settings['popup_btn_icon'] !='' && $settings['popup_btn_icon_position'] =='before'  ) : ?>
                            <span class="tx-popup-btn-icon-before"><?php Icons_Manager::render_icon( $settings['popup_btn_icon'], [ 'aria-hidden' => 'true' ] ); ?></span>
                    <?php endif; ?>
                    <?php echo esc_html($settings['popup_btn_txt']); ?>
                    <?php if( $settings['popup_btn_icon'] !='' && $settings['popup_btn_icon_position'] =='after'  ) : ?>
                            <span class="tx-popup-btn-icon-after"><?php Icons_Manager::render_icon( $settings['popup_btn_icon'], [ 'aria-hidden' => 'true' ] ); ?></span>
                    <?php endif; ?>
                </a>
            <?php endif; ?>
            <div <?php echo $this->get_render_attribute_string( 'popup-content' ); ?>>
                <?php echo wp_sprintf( $settings['popup_type_content'] ); ?>
            </div>
        </div><!-- tx-popup-wrap -->
        
        
        
<?php } // render()

} // class
