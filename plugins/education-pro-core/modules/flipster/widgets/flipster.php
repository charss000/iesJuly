<?php
namespace EpElements\Modules\Flipster\Widgets;

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

class Flipster extends Widget_Base {

    public function get_name() {
        return 'ep-flipster';
    }

    public function get_title() {
        return esc_html__( 'EP Flipster', 'education-pro-core' );
    }
    public function get_keywords() {
        return [ 'flip', 'carousel', 'flipster', 'flip box', 'flip carousel', 'gallery' ];
    }
    public function get_icon() {
        return 'eicon-carousel';
    }
    public function get_script_depends() {
        return [ 'flipster' ];
    }
    public function get_categories() {
        return [ 'ep-elements' ];
    }
	protected function register_controls() {
		$this->start_controls_section(
            'sec_content',
            [
                'label' => esc_html__( 'Content', 'education-pro-core' )
            ]
        );

        $this->add_control(
            'tx_flipster_items',
            [
                'type' => Controls_Manager::REPEATER,
                'seperator' => 'before',
                'default' => [
                    [ 'tx_flipster_item' => TX_PLUGIN_URL . '/assets/img/flipster.png' ],
                    [ 'tx_flipster_item' => TX_PLUGIN_URL . '/assets/img/flipster.png' ],
                    [ 'tx_flipster_item' => TX_PLUGIN_URL . '/assets/img/flipster.png' ],
                    [ 'tx_flipster_item' => TX_PLUGIN_URL . '/assets/img/flipster.png' ],
                    [ 'tx_flipster_item' => TX_PLUGIN_URL . '/assets/img/flipster.png' ],
                    [ 'tx_flipster_item' => TX_PLUGIN_URL . '/assets/img/flipster.png' ],
                    [ 'tx_flipster_item' => TX_PLUGIN_URL . '/assets/img/flipster.png' ],
                    [ 'tx_flipster_item' => TX_PLUGIN_URL . '/assets/img/flipster.png' ],
                ],
                'fields' => [
                    [
                        'name' => 'tx_flipster_item',
                        'label' => esc_html__( 'Slide', 'education-pro-core' ),
                        'type' => Controls_Manager::MEDIA,
                        'default' => [
                            'url' => TX_PLUGIN_URL . '/assets/img/flipster.png',
                        ],
                    ],
                    [
                        'name' => 'tx_flipster_item_text',
                        'label' => esc_html__( 'Caption', 'education-pro-core' ),
                        'type' => Controls_Manager::TEXT,
                        'label_block' => true,
                        'default' => '',
                    ],
                ],
                'title_field' => '{{tx_flipster_item_text}}',
            ]
        );
        $this->end_controls_section();

        $this->start_controls_section(
            'sec_settings',
            [
                'label' => esc_html__( 'Settings', 'education-pro-core' )
            ]
        );
        $this->add_control(
          'tx_fs_carousel_type',
            [
            'label'         => esc_html__( 'Carousel Type', 'education-pro-core' ),
                'type'          => Controls_Manager::SELECT,
                'default'       => 'carousel',
                'label_block'   => false,
                'options'       => [
                    'coverflow' => esc_html__( 'Cover-Flow', 'education-pro-core' ),
                    'carousel'  => esc_html__( 'Carousel', 'education-pro-core' ),
                    'flat'      => esc_html__( 'Flat', 'education-pro-core' ),
                    'wheel'     => esc_html__( 'Wheel', 'education-pro-core' ),
                ],
            ]
        );
        $this->add_control(
            'tx_fs_item_spacing',
            [
                'label' => esc_html__( 'Item Spacing', 'education-pro-core' ),
                'type' => Controls_Manager::SLIDER,
                'default' => [
                    'size' => -0.6
                ],
                'range' => [
                    'px' => [
                        'min' => -1,
                        'max' => 1,
                        'step' => 0.1
                    ],
                ],
            ]
        );
        $this->add_control(
            'tx_fs_loop',
            [
                'label' => esc_html__( 'Loop', 'education-pro-core' ),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'true' => [
                        'title' => esc_html__( 'Enable', 'education-pro-core' ),
                        'icon' => 'fa fa-check',
                    ],
                    'false' => [
                        'title' => esc_html__( 'Disable', 'education-pro-core' ),
                        'icon' => 'fa fa-ban',
                    ]
                ],
                'default' => 'false',
                'toggle' => false,
            ]
        );
        $this->add_control(
            'tx_fs_nav',
            [
                'label' => esc_html__( 'Navigation', 'education-pro-core' ),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'true' => [
                        'title' => esc_html__( 'Enable', 'education-pro-core' ),
                        'icon' => 'fa fa-check',
                    ],
                    'false' => [
                        'title' => esc_html__( 'Disable', 'education-pro-core' ),
                        'icon' => 'fa fa-ban',
                    ]
                ],
                'default' => 'true',
                'toggle' => false,
            ]
        );
        $this->end_controls_section();

        /**
         * -------------------------------------------
         * Style
         * -------------------------------------------
         */
        $this->start_controls_section(
            'sec_styles',
            [
                'label' => esc_html__( 'Styles', 'education-pro-core' ),
                'tab' => Controls_Manager::TAB_STYLE
            ]
        );
        $this->add_control(
            'tx_fs_txt_color',
            [
                'label' => esc_html__( 'Color', 'education-pro-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tx-fs-text' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
             'name' => 'tx_fs_txt_typo',
                'selector' => '{{WRAPPER}} .tx-fs-text',
            ]
        );
        $this->add_responsive_control(
            'caption_alignment',
            [
                'label' => esc_html__( 'Alignment', 'education-pro-core' ),
                'type' => Controls_Manager::CHOOSE,
                'default' => 'center',
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
            ]
        );

	}

	protected function render() {
		$settings = $this->get_settings();
        ?>

        <div class="tx-flipster-wrap" >
            <div id="<?php echo $this->get_id(); ?>">
                <ul class="flip-items">
                <?php foreach( $settings['tx_flipster_items'] as $slides ) : ?>
                    <li>
                       <img src="<?php echo $slides['tx_flipster_item']['url'] ?>">
                       <div class="tx-fs-text tx-fs-text-align-<?php echo esc_attr($settings['caption_alignment']); ?>"><?php echo esc_html( $slides['tx_flipster_item_text'] ); ?></div>
                    </li>
                <?php endforeach; ?>
                </ul>
            </div>
        </div><!-- tx-flipster-wrap -->

        <script>
        jQuery( document ).ready( function($) {
            var carousel = $("#<?php echo $this->get_id(); ?>").flipster({
                    style: '<?php echo esc_attr($settings['tx_fs_carousel_type']); ?>',
                    spacing: '<?php echo esc_attr($settings['tx_fs_item_spacing']['size']); ?>',
                    loop: <?php echo esc_attr($settings['tx_fs_loop']); ?>,
                    buttons: <?php echo esc_attr($settings['tx_fs_nav']); ?>,
            })
         });
        </script>

<?php	} // render()
} // class 
