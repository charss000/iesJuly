<?php
namespace EpElements\Modules\Features\Widgets;

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

class Features extends Widget_Base {

    public function get_name() {
        return 'ep-features';
    }

    public function get_title() {
        return esc_html__( 'EP Features', 'education-pro-core' );
    }

    public function get_icon() {
        return 'fa fa-th-large';
    }

    public function get_categories() {
        return [ 'ep-elements' ];
    }
	protected function register_controls() {
		$this->start_controls_section(
            'ft_settings',
            [
                'label' => esc_html__( 'Settings', 'education-pro-core' )
            ]
        );

        $this->add_control(
          'ft_source',
            [
            'label'         => esc_html__( 'Source', 'education-pro-core' ),
                'type'          => Controls_Manager::SELECT,
                'default'       => 'custom',
                'label_block'   => false,
                'options'       => [
                    'custom'    => esc_html__( 'Custom', 'education-pro-core' ),
                    'dynamic'   => esc_html__( 'Dynamic', 'education-pro-core' ),
                ],
            ]
        );
        $this->add_control(
            'post_type',
            [
                'label' => esc_html__( 'Post Type', 'education-pro-core' ),
                'type' => Controls_Manager::SELECT,
                'options' => TX_Helper::get_all_post_types(),
                'default' => 'post',
                'condition' => [
                    'ft_source' => 'dynamic'
                ]

            ]
        );
        $this->add_group_control(
            Group_Control_Image_Size::get_type(),
            [
                'name' => 'image',
                'default' => 'tx-m-thumb',
                'condition' => [
                    'ft_source' => 'dynamic'
                ]

            ]
        );
        $this->add_control(
            'tax_query',
            [
                'label' => esc_html__( 'Categories', 'education-pro-core' ),
                'type' => Controls_Manager::SELECT2,
                'label_block' => true,
                'multiple' => true,
                'options' => TX_Helper::get_all_categories(),
               'condition' => [
                    'ft_source' => 'dynamic'
                ]
            ]
        );
        $this->add_control(
            'number_of_posts',
            [
                'label' => esc_html__( 'Number of Posts', 'education-pro-core' ),
                'type' => Controls_Manager::NUMBER,
                'default' => '4',
                'condition' => [
                    'ft_source' => 'dynamic'
                ]
            ]
        );
        $this->add_control(
            'offset',
            [
                'label' => esc_html__( 'Offset', 'education-pro-core' ),
                'type' => Controls_Manager::NUMBER,
                'condition' => [
                    'ft_source' => 'dynamic'
                ]
            ]
        );
        $this->add_control(
            'order',
            [
                'label' => esc_html__('Order', 'education-pro-core'),
                'type' => Controls_Manager::SELECT,
                'options' => array(
                    'ASC' => esc_html__('Ascending', 'education-pro-core'),
                    'DESC' => esc_html__('Descending', 'education-pro-core'),
                ),
                'default' => 'DESC',
                'condition' => [
                    'ft_source' => 'dynamic'
                ]
            ]
        );
        $this->add_control(
            'post_sortby',
            [
                'label'     => esc_html__( 'Post sort by', 'education-pro-core' ),
                'type'      => Controls_Manager::SELECT,
                'default'   => 'latestpost',
                'options'   => [
                        'latestpost'      => esc_html__( 'Latest posts', 'education-pro-core' ),
                        'popularposts'    => esc_html__( 'Popular posts', 'education-pro-core' ),
                        'mostdiscussed'    => esc_html__( 'Most discussed', 'education-pro-core' ),
                    ],
                    'condition' => [
                    'ft_source' => 'dynamic'
                ],
            ]
        );
        $this->add_control(
            'orderby',
            [
                'label' => esc_html__('Order By', 'education-pro-core'),
                'type' => Controls_Manager::SELECT,
                'options' => array(
                    'none' => esc_html__('No order', 'education-pro-core'),
                    'ID' => esc_html__('Post ID', 'education-pro-core'),
                    'author' => esc_html__('Author', 'education-pro-core'),
                    'title' => esc_html__('Title', 'education-pro-core'),
                    'date' => esc_html__('Published date', 'education-pro-core'),
                    'modified' => esc_html__('Modified date', 'education-pro-core'),
                    'parent' => esc_html__('By parent', 'education-pro-core'),
                    'rand' => esc_html__('Random order', 'education-pro-core'),
                    'comment_count' => esc_html__('Comment count', 'education-pro-core'),
                    'menu_order' => esc_html__('Menu order', 'education-pro-core'),
                    'post__in' => esc_html__('By include order', 'education-pro-core'),
                ),
                'default' => 'date',
                'condition' => [
                    'ft_source' => 'dynamic',
                    'post_sortby' => ['latestpost'],
                ]
            ]
        );

        $this->add_control(
            'features',
            [
                'type' => Controls_Manager::REPEATER,
                'condition' => [
                    'ft_source' => 'custom'
                ],
                'default' => [
                    [
                        'ft_title' => 'Ut enim ad minim veniam',
                        'ft_subtitle' => 'Lioula ulsrices',
                        'ft_desc' => 'Lorem ipsum dolor sit amet consectetur adipiscing elit sed do eiusmod tempor incididunt ut labore et dolore magna aliquat enim ad minim veniam quis.',
                    ],
                    [
                        'ft_title' => 'Felis eros vehicula leo ato',
                        'ft_subtitle' => 'Ltrices semper',
                        'ft_desc' => 'Nostrud exercitation ullamco laboris nisi ut aliquip siamonea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse.',
                    ],
                    [
                        'ft_title' => 'Nullam tinci dunt adip',
                        'ft_subtitle' => 'Pellentesque laoreet',
                        'ft_desc' => 'Cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim.',
                    ],
                    [
                        'ft_title' => 'Tristique sapien accum',
                        'ft_subtitle' => 'Ligula ultrices',
                        'ft_desc' => 'Suspendisse potenti Phasellus euismod libero in neque molestie et elementum libero maximus. Etiam in enim vestibulum suscipit sem quis molestie nibh.',
                    ],
                ],
                'fields' => [


                    [
                        'name' => 'ft_title',
                        'label' => esc_html__('Title', 'education-pro-core'),
                        'type' => Controls_Manager::TEXT,
                        'label_block' => true,
                        'default' => esc_html__('Tristique sapien accum','education-pro-core'),
                    ],
                    [
                        'name' => 'ft_title_link',
                        'label' => esc_html__('Title Link URL', 'education-pro-core'),
                        'type'        => Controls_Manager::URL,
                        'dynamic'     => [ 'active' => true ],
                        'placeholder' => 'http://your-site.com',
                        
                    ],
                    [
                        'name' => 'ft_subtitle',
                        'label' => esc_html__('Subtitle', 'education-pro-core'),
                        'type' => Controls_Manager::TEXT,
                        'label_block' => true,
                        'default' => esc_html__('Ligula ultrices','education-pro-core'),
                    ],

                    [
                        'name' => 'ft_image',
                        'library' => 'image',
                        'label' => esc_html__('Image.', 'education-pro-core'),
                        'type' => Controls_Manager::MEDIA,
                        'default' => [
                            'url' => Utils::get_placeholder_image_src(),
                        ],
                        'label_block' => true,
                    ],

                    [
                        'name' => 'ft_desc',
                        'type' => Controls_Manager::WYSIWYG,
                        "label" => esc_html__("Text", 'education-pro-core'),
                        "default" => esc_html__("Lorem ipsum dolor sit amet consectetur adipiscing elit sed do eiusmod tempor incididunt ut labore et dolore magna aliquat enim ad minim veniam quis.", 'education-pro-core'),
                        'show_label' => true,
                    ],


                ],
                'title_field' => '{{{ft_title}}}',
            ]
        );
        $this->end_controls_section();

        $this->start_controls_section(
            'ft_style',
            [
                'label' => esc_html__('Styles', 'education-pro-core'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_control(
            'ft_tiled',
            [
                'label' => esc_html__( 'Tiled', 'education-pro-core' ),
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
                'default' => 'no'
            ]
        );
        $this->add_control(
            'ft_spacing',
            [
                'label' => esc_html__('Space', 'education-pro-core'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'range' => [
                    'px' => [
                        'max' => 500,
                    ],
                ],
                'condition' => [
                    'ft_tiled' => 'no'
                ],
                'selectors' => [
                    '{{WRAPPER}} .tx-ft-container:not(.tx-ft-tiled) .tx-ft-wrapper' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                ],

            ]
        );
        $this->add_control(
            'ft_title_color',
            [
                'label' => esc_html__('Title Color', 'education-pro-core'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tx-ft-title' => 'color: {{VALUE}};',
                ],
                'separator' => 'before'
            ]
        );
        $this->add_control(
            'ft_title_hov_color',
            [
                'label' => esc_html__('Title Hover Color', 'education-pro-core'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tx-ft-title:hover' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'ft_title_typography',
                'selector' => '{{WRAPPER}} .tx-ft-title',
            ]
        );
        $this->add_control(
            'ft_subtitle_color',
            [
                'label' => esc_html__('Sub Title', 'education-pro-core'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tx-ft-subtitle' => 'color: {{VALUE}};',
                ],
                'separator' => 'before',
                'condition' => [
                    'ft_source' => 'custom'
                ]
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'ft_subtitle_typography',
                'selector' => '{{WRAPPER}} .tx-ft-subtitle',
                'condition' => [
                    'ft_source' => 'custom'
                ]
            ]
        );
        $this->add_control(
            'ft_date_color',
            [
                'label' => esc_html__('Date Color', 'education-pro-core'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .post-time' => 'color: {{VALUE}};',
                ],
                'separator' => 'before',
                'condition' => [
                    'ft_source' => 'dynamic'
                ]
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'ft_date_typography',
                'selector' => '{{WRAPPER}} .post-time',
                'condition' => [
                    'ft_source' => 'dynamic'
                ]
            ]
        );
        $this->add_control(
            'ft_desc_color',
            [
                'label' => esc_html__('Description Color', 'education-pro-core'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tx-ft-desc' => 'color: {{VALUE}};',
                ],
                'separator' => 'before'
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'ft_desc_typography',
                'selector' => '{{WRAPPER}} .tx-ft-desc',
            ]
        );

        $this->end_controls_section();

	}

	protected function render() {
		$settings = $this->get_settings();
        $ft_tiled = ($settings['ft_tiled'] == 'yes') ? 'tx-ft-tiled' : ''; 
        $paged = ( get_query_var('paged') ) ? get_query_var('paged') : 1;
        $showposts = '';
        $query_args = TX_Helper::setup_query_args($settings, $showposts);
        $post_query = new \WP_Query( $query_args );
        ?>

        <?php if( $settings['ft_source'] == 'dynamic' ) : ?>
        <div class="tx-ft-container <?php echo esc_attr($ft_tiled) ?>">
            <?php
            if ($post_query->have_posts()) : 
                while ($post_query->have_posts()) : $post_query->the_post();
            ?>

            <div class="tx-ft-wrapper">
                <div class="tx-ft-image-content">
                    <?php if (has_post_thumbnail()) : ?>
                        <div class="zoom-thumb featured-thumb">
                        <a href="<?php echo esc_url( get_permalink() ); ?>" rel="bookmark" title="<?php echo esc_attr( get_the_title() ); ?>">
                            <img src="<?php echo wp_get_attachment_image_url(get_post_thumbnail_id(), $settings['image_size'])?>" alt="<?php echo esc_attr( get_the_title() ); ?>">
                        </a>
                        </div><!-- zoom-thumb featured-thumb -->
                    <?php endif; ?>
                </div><!-- tx-ft-image-content -->

                <div class="tx-ft-text-content">
                    <div class="tx-ft-subtitle"><?php echo tx_date(); ?></div>
                    <h3 class="tx-ft-title"><a href="<?php echo esc_url( get_permalink() ); ?>"><?php echo the_title(); ?></a></h3>
                    <div class="tx-ft-desc"><?php echo the_excerpt();?></div>
                </div><!-- tx-ft-text-content -->
            </div><!-- tx-ft-wrapper -->
        <?php endwhile;
             wp_reset_postdata();
            endif;
        ?>
        </div><!-- tx-ft-container -->
        <?php endif; ?>

        <?php if( $settings['ft_source'] == 'custom'  ) : ?>
        <div class="tx-ft-container <?php echo esc_attr($ft_tiled) ?>">
            <?php foreach ($settings['features'] as $feature): 
                $target = $feature['ft_title_link']['is_external'] ? '_blank' : '_self';
            ?>

                <div class="tx-ft-wrapper">
                    <div class="tx-ft-image-content">
                        <?php if (!empty($feature['ft_image'])) : ?>
                              <img src="<?php echo esc_attr($feature['ft_image']['url']); ?>" alt="<?php echo esc_html($feature['ft_title']); ?>">
                        <?php endif; ?>
                    </div><!-- tx-ft-image-content -->
                    <div class="tx-ft-text-content">
                        <div class="tx-ft-subtitle"><?php echo esc_html($feature['ft_subtitle']) ?></div>
                        <?php if(!empty($feature['ft_title_link']['url'])) : ?>
                        <a href="<?php echo esc_url( $feature['ft_title_link']['url'] ); ?>" target="<?php echo esc_attr($target); ?>">
                        <h3 class="tx-ft-title"><?php echo esc_html($feature['ft_title']); ?></h3>
                        </a>
                        <?php else: ?>
                        <h3 class="tx-ft-title"><?php echo esc_html($feature['ft_title']); ?></h3>
                        <?php endif; ?>
                        <div class="tx-ft-desc"><?php echo $this->parse_text_editor($feature['ft_desc']); ?></div>
                    </div><!-- tx-ft-text-content -->
                </div><!-- tx-ft-wrapper -->

            <?php endforeach; ?>
        </div><!-- tx-ft-container -->
        <?php endif; ?>


<?php	} // render()
} // class 
