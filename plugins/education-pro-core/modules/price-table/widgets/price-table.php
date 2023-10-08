<?php
namespace EpElements\Modules\PriceTable\Widgets;

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

class PriceTable extends Widget_Base {

    public function get_name() {
        return 'ep-price-table';
    }

    public function get_title() {
        return esc_html__( 'EP Price Table', 'education-pro-core' );
    }

    public function get_icon() {
        return 'eicon-price-table';
    }

    public function get_categories() {
        return [ 'ep-elements' ];
    }

	protected function register_controls() {
		$this->start_controls_section(
            'settings',
            [
                'label' => esc_html__( 'Settings', 'education-pro-core' )
            ]
        );
        $this->add_control(
            'ribbon',
            [
                'label' => esc_html__( 'Ribbon', 'education-pro-core' ),
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

            ]
        );
        $this->add_control(
            'ribbon_txt',
            [
                'label' => esc_html__( 'Ribbon Text', 'education-pro-core' ),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__( 'POPULAR', 'education-pro-core' ),
                'condition' => [
                    'ribbon' => 'yes'
                ]
            ]
        );
        $this->add_control(
            'icon_switch',
            [
                'label' => esc_html__( 'Icon', 'education-pro-core' ),
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
            'pt_icon',
            [
                'type' => Controls_Manager::ICONS,
                'default' => [
                    'value' => 'fas fa-home',
                    'library' => 'fa-solid',
                ],
                'condition' => [
                    'icon_switch' => 'yes'
                ]
            ]
        );
        $this->add_control(
            'main_heading',
            [
                'label' => esc_html__( 'Main Heading', 'education-pro-core' ),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__( 'Heading', 'education-pro-core' ),
                'separator' => 'before',
            ]
        );
        $this->add_control(
            'sub_heading',
            [
                'label' => esc_html__( 'Sub Heading', 'education-pro-core' ),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__( 'Sub Heading', 'education-pro-core' ),
            ]
        );
        $this->add_control(
            'price',
            [
                'label' => esc_html__( 'Price', 'education-pro-core' ),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__( '24.99', 'education-pro-core' ),
                'separator' => 'before',
            ]
        );
        $this->add_control(
            'period',
            [
                'label' => esc_html__( 'Period', 'education-pro-core' ),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__( 'Per month', 'education-pro-core' ),
            ]
        );
        $this->add_control(
            'features',
            [
                'type' => Controls_Manager::REPEATER,
                'label' => 'Features',
                'separator' => 'before',
                'default' => [
                    [ 'feature_item' => '100GB Bandwidth' ],
                    [ 'feature_item' => '10GB SSD Storage' ],
                    [ 'feature_item' => '1GB RAM' ],
                    [ 'feature_item' => '1 Domain' ],
                    [ 'feature_item' => 'Automatic Backup' ],
                    [ 'feature_item' => 'Emergency Support' ]
                ],
                'fields' => [
                    [
                        'name' => 'feature_item',
                        'default' => 'Features',
                        'label' => esc_html__( 'Details', 'education-pro-core' ),
                        'type' => Controls_Manager::TEXT,
                        'label_block' => true,
                    ],
                    [
                        'name' => 'feature_icon',
                        'label' => esc_html__( 'Icon', 'education-pro-core' ),
                        'type' => Controls_Manager::ICON,
                        'label_block' => false,
                        'default' => 'fa fa-check',
                    ],
                    [
                        'name' => 'feature_item_status',
                        'label' => esc_html__( 'Active', 'education-pro-core' ),
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
      
                    
                ],
               'title_field' => '{{feature_item}}',
            ]
        );
        $this->add_control(
            'btn_txt',
            [
                'label' => esc_html__( 'Button Text', 'education-pro-core' ),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__( 'ORDER NOW', 'education-pro-core' ),
                'separator' => 'before',
            ]
        );
        $this->add_control(
            'btn_link',
            [
                'label'       => esc_html__( 'Button Link', 'education-pro-core' ),
                'type'        => Controls_Manager::URL,
                'dynamic'     => [ 'active' => true ],
                'placeholder' => 'http://your-link.com',
                'default' => [
                    'url' => '#'
                ]
            ]
        );
        $this->end_controls_section();

		$this->start_controls_section(
			'styles',
			[
				'label' 	=> esc_html__( 'Styles', 'education-pro-core' ),
				'tab' 		=> Controls_Manager::TAB_STYLE,
			]
		);
        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name'      => 'pt_bg',
                'selector'  => '{{WRAPPER}} .tx-price-table-wrap',
            ]
        );
        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'        => 'pt_border',
                'selector'    =>    '{{WRAPPER}} .tx-price-table-wrap'
            ]
        );
        $this->add_responsive_control(
            'pt_border_radius',
            [
                'label'      => esc_html__( 'Border Radius', 'education-pro-core' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'selectors'  => [
                    '{{WRAPPER}} .tx-price-table-wrap' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name'     => 'pt_shadow',
                'selector' => '{{WRAPPER}} .tx-price-table-wrap'
            ]
        );
        $this->add_responsive_control(
            'pt_padding',
            [
                'label' => esc_html__( 'Padding', 'education-pro-core' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .tx-price-table-wrap' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_control(
            'pt_ribbon_color',
            [
                'label' => esc_html__('Ribbon Color', 'education-pro-core'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tx-price-table-ribbon-txt' => 'color: {{VALUE}};',
                ],
                'separator' => 'before',
                'condition' => ['ribbon' => 'yes']
            ]
        );
        $this->add_control(
            'pt_ribbon_bg_color',
            [
                'label' => esc_html__('Ribbon Background Color', 'education-pro-core'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tx-price-table-ribbon-txt' => 'background-color: {{VALUE}};',
                ],
                'condition' => ['ribbon' => 'yes']
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'      => 'pt_ribbon_typography',
                'selector'  => '{{WRAPPER}} .tx-price-table-ribbon-txt',
                'condition' => ['ribbon' => 'yes']
            ]
        );
        $this->add_control(
            'pt_icon_color',
            [
                'label' => esc_html__('Icon Color', 'education-pro-core'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tx-pt-icon i' => 'color: {{VALUE}};',
                ],
                'separator' => 'before',
                'condition' => ['icon_switch' => 'yes']
            ]
        );
        $this->add_control(
            'pt_icon_bg_color',
            [
                'label' => esc_html__('Icon Background Color', 'education-pro-core'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tx-pt-icon i' => 'background-color: {{VALUE}};',
                ],
                'condition' => ['icon_switch' => 'yes']
            ]
        );
        $this->add_responsive_control(
            'pt_icon_size',
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
                'default' => [
                    'size' => 32
                ],
                'selectors' => [
                    '{{WRAPPER}} .tx-pt-icon i' => 'font-size: {{SIZE}}{{UNIT}};',
                ],
                'condition' => ['icon_switch' => 'yes']
                
            ]
        );
        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'        => 'pt_icon_border',
                'selector'    =>    '{{WRAPPER}} .tx-pt-icon i',
                'condition' => ['icon_switch' => 'yes']
            ]
        );
        $this->add_responsive_control(
            'pt_icon_border_radius',
            [
                'label'      => esc_html__( 'Icon Border Radius', 'education-pro-core' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'selectors'  => [
                    '{{WRAPPER}} .tx-pt-icon i' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'condition' => ['icon_switch' => 'yes']
            ]
        );
        $this->add_responsive_control(
            'pt_icon_padding',
            [
                'label' => esc_html__( 'Icon Padding', 'education-pro-core' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .tx-pt-icon i' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'condition' => ['icon_switch' => 'yes']
            ]
        );
        $this->add_responsive_control(
            'pt_icon_margin',
            [
                'label' => esc_html__( 'Icon Margin', 'education-pro-core' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .tx-pt-icon' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'condition' => ['icon_switch' => 'yes']
            ]
        );
        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name'      => 'pt_heading_bg',
                'selector'  => '{{WRAPPER}} .tx-price-table-head',
                'label' => esc_html__( 'Icon Margin', 'education-pro-core' ),
                'separator' => 'before'
            ]
        );
        $this->add_control(
            'pt_heading_color',
            [
                'label'     => esc_html__( 'Heading Color', 'education-pro-core' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tx-pt-heading' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'      => 'pt_heading_typography',
                'selector'  => '{{WRAPPER}} .tx-pt-heading',
            ]
        );
        $this->add_responsive_control(
            'pt_heading_padding',
            [
                'label' => esc_html__( 'Heading Padding', 'education-pro-core' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .tx-pt-heading' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_control(
            'pt_heading_sub_color',
            [
                'label'     => esc_html__( 'Sub Heading Color', 'education-pro-core' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tx-pt-sub-heading' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'      => 'pt_sub_heading_typography',
                'selector'  => '{{WRAPPER}} .tx-pt-sub-heading',
            ]
        );
        $this->add_control(
            'pt_price_bg',
            [
                'label'     => esc_html__( 'Price Background Color', 'education-pro-core' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tx-price-table-price' => 'background-color: {{VALUE}};',
                ],
                'separator' => 'before'
            ]
        );
        $this->add_responsive_control(
            'pt_price_padding',
            [
                'label' => esc_html__( 'Price Padding', 'education-pro-core' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .tx-price-table-price' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_control(
            'pt_price_color',
            [
                'label'     => esc_html__( 'Price Color', 'education-pro-core' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tx-pt-price' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'      => 'pt_price_typo',
                'selector'  => '{{WRAPPER}} .tx-pt-price',
            ]
        );
        $this->add_control(
            'pt_period_color',
            [
                'label'     => esc_html__( 'Period Color', 'education-pro-core' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tx-pt-period' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'      => 'pt_period_typo',
                'selector'  => '{{WRAPPER}} .tx-pt-period',
            ]
        );
        $this->add_control(
            'pt_feature_details_color',
            [
                'label'     => esc_html__( 'Features Item Color', 'education-pro-core' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tx-pt-feature-details' => 'color: {{VALUE}};',
                ],
                'separator' => 'before'
            ]
        );
        $this->add_control(
            'pt_feature_details_border_color',
            [
                'label'     => esc_html__( 'Features Item Border Color', 'education-pro-core' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tx-pt-feature-details' => 'border-color: {{VALUE}};',
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'      => 'pt_feature_details_typo',
                'selector'  => '{{WRAPPER}} .tx-pt-feature-details',
            ]
        );
        $this->end_controls_section();
        
        $this->start_controls_section(
            'btn_styles',
            [
                'label'                 => esc_html__( 'Button', 'education-pro-core' ),
                'tab'                   => Controls_Manager::TAB_STYLE,
            ]
        );
        $this->start_controls_tabs( 'btn_styl_tabs' );
        $this->start_controls_tab(
            'btn_normal',
            [
                'label' => esc_html__( 'Normal', 'education-pro-core' ),
            ]
        );
        $this->add_control(
            'pt_btn_color',
            [
                'label'     => esc_html__( 'Button Color', 'education-pro-core' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tx-price-table-button a' => 'color: {{VALUE}};',
                ],
                'separator' => 'before'
            ]
        );
        $this->add_control(
            'pt_btn_bg_color',
            [
                'label'     => esc_html__( 'Button Background Color', 'education-pro-core' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tx-price-table-button a' => 'background-color: {{VALUE}};',
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'      => 'pt_btn_typography',
                'selector'  => '{{WRAPPER}} .tx-price-table-button a',
            ]
        );
        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'        => 'pt_btn_border',
                'selector'    =>    '{{WRAPPER}} .tx-price-table-button a'
            ]
        );
        $this->add_responsive_control(
            'pt_btn_border_radius',
            [
                'label'      => esc_html__( 'Button Border Radius', 'education-pro-core' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'selectors'  => [
                    '{{WRAPPER}} .tx-price-table-button a' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'pt_btn_padding',
            [
                'label' => esc_html__( 'Button Padding', 'education-pro-core' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .tx-price-table-button a' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'pt_btn_margin',
            [
                'label' => esc_html__( 'Button Margin', 'education-pro-core' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .tx-price-table-button' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->end_controls_tab();

        $this->start_controls_tab(
            'btn_hover',
            [
                'label' => esc_html__( 'Hover', 'education-pro-core' ),
            ]
        );
        $this->add_control(
            'pt_btn_hov_color',
            [
                'label'     => esc_html__( 'Button Hover Color', 'education-pro-core' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tx-price-table-button a:hover' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_control(
            'pt_btn_bg_hov_color',
            [
                'label'     => esc_html__( 'Button Background Hover Color', 'education-pro-core' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tx-price-table-button a:hover' => 'background-color: {{VALUE}};',
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'        => 'pt_btn_hov_border',
                'selector'    =>    '{{WRAPPER}} .tx-price-table-button a:hover'
            ]
        );
        $this->end_controls_tab();
        $this->end_controls_section();
	}

	protected function render() {
		$settings = $this->get_settings();
        $target = $settings['btn_link']['is_external'] ? '_blank' : '_self';
        if ( ! empty( $settings['btn_link']['url'] ) ) :
            $this->add_render_attribute( 'btn-link', 'href', $settings['btn_link']['url'] );
        endif;
        ?>
        <div class="tx-price-table-wrap">
            
            <div class="tx-price-table-head">
                <?php if( $settings['icon_switch'] == 'yes') : ?>
                <div class="tx-pt-icon">    
                <?php Icons_Manager::render_icon( $settings['pt_icon'], [ 'aria-hidden' => 'true' ] ); ?>
                </div>
                <?php endif; ?>

                <h4 class="tx-pt-heading"><?php echo esc_html($settings['main_heading']); ?></h4>
                <div class="tx-pt-sub-heading"><?php echo esc_html($settings['sub_heading']); ?></div>
                <?php if($settings['ribbon'] == 'yes') : ?>
                <div class="tx-price-table-ribbon">
                    <div class="tx-price-table-ribbon-txt">
                    <?php echo esc_html( $settings['ribbon_txt'] ); ?>
                    </div>
                </div>
            <?php endif; ?>
            </div><!-- tx-price-table-head -->

            <div class="tx-price-table-price">
                <div class="tx-pt-price"><?php echo esc_html($settings['price']); ?></div>
                <div class="tx-pt-period"><?php echo esc_html($settings['period']); ?></div>
            </div><!-- tx-price-table-price -->

            <div class="tx-price-table-features">
                <?php foreach ($settings['features'] as $item) : ?>

                    <?php 
                        if($item['feature_item_status'] == 'yes') : 
                            $status = ''; 
                        else : 
                            $status = 'tx-not-active';
                        endif;
                    ?>
                    <div class="tx-pt-feature-details <?php echo esc_attr( $status ); ?>">
                        <i class="<?php echo esc_attr($item['feature_icon']); ?>"></i> <?php echo esc_html($item['feature_item']); ?>
                    </div><!-- tx-pt-feature-details -->
                <?php endforeach; ?>
            </div><!-- tx-price-table-features -->

            <div class="tx-price-table-button">
                <a <?php echo $this->get_render_attribute_string( 'btn-link' ); ?> target="<?php echo esc_attr($target); ?>"><?php echo esc_html( $settings['btn_txt'] ); ?></a>
            </div><!-- tx-price-table-button -->
       
        </div><!-- tx-price-table-wrap -->


<?php
	}//render()
} //class
