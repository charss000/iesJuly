<?php
namespace EpElements\Modules\ClassesCarousel\Widgets;

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

class ClassesCarousel extends Widget_Base {

    public function get_name() {
        return 'ep-classes-carousel';
    }

    public function get_title() {
        return esc_html__( 'EP Classes Carousel', 'education-pro-core' );
    }

    public function get_icon() {
        return 'eicon-posts-carousel';
    }

    public function get_categories() {
        return [ 'ep-elements' ];
    }

	protected function register_controls() {
       
		$this->start_controls_section(
            'settings',
            [
                'label' => esc_html__( 'Content Settings', 'education-pro-core' )
            ]
        );
        
        $this->add_control(
            'tx_categories',
            [
                'label'       => esc_html__( 'Categories', 'education-pro-core' ),
                'type'        => Controls_Manager::SELECT2,
                'options'     => TX_Helper::get_post_type_categories('classes-category'),
                'default'     => [],
                'label_block' => true,
                'multiple'    => true,
            ]
        );
        
        $this->add_control(
            'number_of_posts',
            [
                'label' => esc_html__( 'Number of Posts', 'education-pro-core' ),
                'type' => Controls_Manager::NUMBER,
                'default' => 8
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
                    'rand' => esc_html__('Random order', 'education-pro-core'),
                    'menu_order' => esc_html__('Menu order', 'education-pro-core'),
                ),
                'default' => 'date',
            ]
        );
        $this->add_control(
            'offset',
            [
                'label' => esc_html__( 'Offset', 'education-pro-core' ),
                'type' => Controls_Manager::NUMBER,
               
            ]
        );
        $this->add_group_control(
            Group_Control_Image_Size::get_type(),
            [
                'name' => 'image',
                'exclude' => [ 'custom' ],
                'default' => 'tx-serv-thumb',
            ]
        );
        $this->add_control(
            'display',
            [
                'label'     => esc_html__( 'Style', 'education-pro-core' ),
                'type'      => Controls_Manager::SELECT,
                'default'   => 'grid',
                'options'   => [
                        'grid'    => esc_html__('Grid','education-pro-core'),
                        'overlay'    => esc_html__('Overlay','education-pro-core'),
                    ],
            ]
        );
        $this->add_control(
            'image_display',
            [
                'label' => esc_html__( 'Image', 'education-pro-core' ),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'show' => [
                        'title' => esc_html__( 'Yes', 'education-pro-core' ),
                        'icon' => 'fa fa-check',
                    ],
                    'hide' => [
                        'title' => esc_html__( 'No', 'education-pro-core' ),
                        'icon' => 'fa fa-ban',
                    ]
                ],
                'default' => 'show',
               'separator' => 'before',
            ]
        );
        $this->add_control(
            'title',
            [
                'label' => esc_html__( 'Title', 'education-pro-core' ),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'show' => [
                        'title' => esc_html__( 'Yes', 'education-pro-core' ),
                        'icon' => 'fa fa-check',
                    ],
                    'hide' => [
                        'title' => esc_html__( 'No', 'education-pro-core' ),
                        'icon' => 'fa fa-ban',
                    ]
                ],
                'default' => 'show',
                
            ]
        );
        $this->add_control(
            'title_lenth',
            [
                'label' => esc_html__( 'Title Lenth', 'education-pro-core' ),
                'type' => Controls_Manager::NUMBER,
                'default' => '30',
                'condition' => [
                    'title' => 'show',
                ]

            ]
        );
        $this->add_control(
            'category_display',
            [
                'label' => esc_html__( 'Category', 'education-pro-core' ),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'show' => [
                        'title' => esc_html__( 'Yes', 'education-pro-core' ),
                        'icon' => 'fa fa-check',
                    ],
                    'hide' => [
                        'title' => esc_html__( 'No', 'education-pro-core' ),
                        'icon' => 'fa fa-ban',
                    ]
                ],
                'default' => 'show',
            ]
        );
        $this->add_control(
            'bio',
            [
                'label' => esc_html__( 'Description', 'education-pro-core' ),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'show' => [
                        'title' => esc_html__( 'Yes', 'education-pro-core' ),
                        'icon' => 'fa fa-check',
                    ],
                    'hide' => [
                        'title' => esc_html__( 'No', 'education-pro-core' ),
                        'icon' => 'fa fa-ban',
                    ]
                ],
                'default' => 'show'
            ]
        );
        $this->add_control(
            'excerpt_words',
            [
                'label' => esc_html__( 'Desc Words Limit', 'education-pro-core' ),
                'type' => Controls_Manager::NUMBER,
                'default' => '20',
                'condition' => [
                    'bio' => 'show',
                ],
            ]
        );
        $this->add_control(
            'icon',
            [
                'label' => esc_html__( 'Overlay Icon', 'education-pro-core' ),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'block' => [
                        'title' => esc_html__( 'Yes', 'education-pro-core' ),
                        'icon' => 'fa fa-check',
                    ],
                    'none' => [
                        'title' => esc_html__( 'No', 'education-pro-core' ),
                        'icon' => 'fa fa-ban',
                    ]
                ],
                'default' => 'block',
                'condition' => [
                    'display' => 'grid'
                ],
                'selectors' => [
                    '{{WRAPPER}} .tx-services-featured a:after'   => 'display: {{VALUE}};',
                ],
            ]
        );
        $this->add_control(
            'arrow',
            [
                'label' => esc_html__( 'Overlay Arrow', 'education-pro-core' ),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'show' => [
                        'title' => esc_html__( 'Yes', 'education-pro-core' ),
                        'icon' => 'fa fa-check',
                    ],
                    'hide' => [
                        'title' => esc_html__( 'No', 'education-pro-core' ),
                        'icon' => 'fa fa-ban',
                    ]
                ],
                'default' => 'show',
                'condition' => [
                    'display' => 'overlay'
                ],
            ]
        );

        $this->end_controls_section();
         $this->start_controls_section(
            'carousel_settings',
            [
                'label' => esc_html__('Carousel Settings', 'education-pro-core'),
            ]
        );
         $this->add_control(
            'display_mobile',
            [
                'label' => esc_html__( 'Posts Per Row on Mobile', 'education-pro-core' ),
                'type' => Controls_Manager::NUMBER,
                'default' => 1
            ]
        );
        $this->add_control(
            'display_tablet',
            [
                'label' => esc_html__( 'Posts Per Row on Tablet', 'education-pro-core' ),
                'type' => Controls_Manager::NUMBER,
                'default' => 2
            ]
        );
        $this->add_control(
            'display_laptop',
            [
                'label' => esc_html__( 'Posts Per Row on Laptop', 'education-pro-core' ),
                'type' => Controls_Manager::NUMBER,
                'default' => 3
            ]
        );
        $this->add_control(
            'display_desktop',
            [
                'label' => esc_html__( 'Posts Per Row on Desktop', 'education-pro-core' ),
                'type' => Controls_Manager::NUMBER,
                'default' => 3
            ]
        );
        $this->add_control(
            'gutter',
            [
                'label' => esc_html__( 'Gutter', 'education-pro-core' ),
                'type' => Controls_Manager::NUMBER,
                'default' => 20
            ]
        );
        
        $this->add_control(
            'autoplay',
            [
                'label' => esc_html__( 'Autoplay', 'education-pro-core' ),
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
                'toggle' => false,
                'separator' => 'before',
            ]
        );
        $this->add_control(
            'smart_speed',
            [
                'label' => esc_html__('Slide Change Speed', 'education-pro-core'),
                'type' => Controls_Manager::NUMBER,
                'default' => 600,
                'condition' => [
                    'autoplay' => 'yes'
                ]
            ]
        );
        $this->add_control(
            'autoplay_timeout',
            [
                'label' => esc_html__('Slide Change Delay', 'education-pro-core'),
                'type' => Controls_Manager::NUMBER,
                'default' => 2000,
                'condition' => [
                    'autoplay' => 'yes'
                ]
            ]
        );
        $this->add_control(
            'pause_on_hover',
            [
                'label' => esc_html__( 'Autoplay pause on hover', 'education-pro-core' ),
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
                'toggle' => false,
                'condition' => [
                    'autoplay' => 'yes'
                ]
            ]
        );
        $this->add_control(
            'loop',
            [
                'label' => esc_html__( 'Loop', 'education-pro-core' ),
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
                'toggle' => false,
            ]
        );
        $this->add_control(
            'navigation',
            [
                'label' => esc_html__( 'Navigation', 'education-pro-core' ),
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
                'toggle' => false,
               
            ]
        );
        $this->add_control(
            'dots',
            [
                'label' => esc_html__( 'Dots', 'education-pro-core' ),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'block' => [
                        'title' => esc_html__( 'Yes', 'education-pro-core' ),
                        'icon' => 'fa fa-check',
                    ],
                    'none' => [
                        'title' => esc_html__( 'No', 'education-pro-core' ),
                        'icon' => 'fa fa-ban',
                    ]
                ],
                'default' => 'none',
                'toggle' => false,
                'selectors'         => [
                    '{{WRAPPER}} .tx-carousel.owl-carousel .owl-dots'   => 'display: {{VALUE}};',
                ],
               
            ]
        );
        $this->end_controls_section();

        // Style section started
        $this->start_controls_section(
            'styles',
            [
              'label'   => esc_html__( 'Styles', 'education-pro-core' ),
              'tab'     => Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_control(
            'overlay_bg_color',
            [
                'label' => esc_html__('Overlay Background Color', 'education-pro-core'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tx-services-featured a:before' => 'background-color: {{VALUE}};',
                ],
            ]
        );
        $this->add_control(
            'overlay_icon_color',
            [
                'label' => esc_html__('Overlay Icon Color', 'education-pro-core'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tx-services-featured a:after, {{WRAPPER}} .tx-services-overlay-item i' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_control(
            'title_color',
            [
                'label'     => esc_html__( 'Title Color', 'education-pro-core' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tx-services-title' => 'color: {{VALUE}};',
                ],
                'condition' => [
                    'title' => 'show',
                ],
                'separator' => 'before',
            ]
        );
        $this->add_control(
            'title_color_hover',
            [
                'label'     => esc_html__( 'Title Hover Color', 'education-pro-core' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tx-services-title a:hover, {{WRAPPER}} .tx-services-overlay-item .tx-services-title:hover' => 'color: {{VALUE}};',
                ],
                'condition' => [
                    'title' => 'show',
                ],
            ]
        );
        
        $this->add_control(
            'title_bg_color',
            [
                'label'     => esc_html__( 'Title Background Color', 'education-pro-core' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tx-services-title-holder' => 'background-color: {{VALUE}};',
                ],
                'condition' => [
                    'title' => 'show',
                    'display' => 'overlay',
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
              [
                   'name'    => 'title_typography',
                   'selector'  => '{{WRAPPER}} .tx-services-title',
                   'condition' => [
                      'title' => 'show',
                    ],
              ]
        );
        $this->add_control(
            'desc_color',
            [
                'label'     => esc_html__( 'Excerpt Color', 'education-pro-core' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tx-services-overlay-item .tx-services-excp, {{WRAPPER}} .tx-services-excp' => 'color: {{VALUE}};',
                ],
                'separator' => 'before'
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
              [
                   'name'    => 'desc_typography',
                   'selector'  => '{{WRAPPER}} .tx-services-overlay-item .tx-services-excp, {{WRAPPER}} .tx-services-excp',
              ]
        );
        $this->add_control(
            'cate_color',
            [
                'label'     => esc_html__( 'Category Color', 'education-pro-core' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tx-serv-cat' => 'color: {{VALUE}}; border-color: {{VALUE}};',
                ],
                
                'separator' => 'before',
            ]
        );
        $this->add_control(
            'cate_hov_color',
            [
                'label'     => esc_html__( 'Category Hover Color', 'education-pro-core' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tx-serv-cat:hover' => 'color: {{VALUE}}; border-color: {{VALUE}};',
                ],
                
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
              [
                   'name'    => 'cat_typography',
                   'selector'  => '{{WRAPPER}} .tx-serv-cat',
              ]
        );      
        $this->add_control(
            'navigation_color',
            [
                'label'     => esc_html__( 'Navigation Color', 'education-pro-core' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tx-carousel.owl-carousel .owl-nav button.owl-prev i, {{WRAPPER}} .tx-carousel.owl-carousel .owl-nav button.owl-next i' => 'color: {{VALUE}};',
                ],
                'condition' => [
                    'navigation' => 'yes',
                ],
                'separator' => 'before',
            ]
        );
        $this->add_control(
            'navigation_hover_color',
            [
                'label'     => esc_html__( 'Navigation Hover Color', 'education-pro-core' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tx-carousel.owl-carousel .owl-nav button.owl-prev:hover i, {{WRAPPER}} .tx-carousel.owl-carousel .owl-nav button.owl-next:hover i' => 'color: {{VALUE}};',
                ],
                'condition' => [
                    'navigation' => 'yes',
                ],
            ]
        );
      
        $this->add_control(
            'navigation_hover_bg_color',
            [
                'label'     => esc_html__( 'Navigation Background Color', 'education-pro-core' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tx-carousel.owl-carousel .owl-nav button.owl-prev, {{WRAPPER}} .tx-carousel.owl-carousel .owl-nav button.owl-next' => 'background-color: {{VALUE}};',
                ],
                'condition' => [
                    'navigation' => 'yes',
                ],
            ]
        );
        $this->add_control(
            'navigation_hover_bg_hover_color',
            [
                'label'     => esc_html__( 'Navigation Background Hover Color', 'education-pro-core' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tx-carousel.owl-carousel .owl-nav button.owl-prev:hover, {{WRAPPER}} .tx-carousel.owl-carousel .owl-nav button.owl-next:hover' => 'background-color: {{VALUE}};',
                ],
                'condition' => [
                    'navigation' => 'yes',
                ],
            ]
        );
        
        $this->add_control(
            'dots_bg_color',
            [
                'label'     => esc_html__( 'Dots Color', 'education-pro-core' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tx-carousel.owl-carousel button.owl-dot span' => 'background-color: {{VALUE}};',
                ],
                'separator' => 'before',
                'condition' => [
                    'dots' => 'block',
                ],
            ]
        );
        $this->add_control(
            'dots_active_bg_color',
            [
                'label'     => esc_html__( 'Dots Active Color', 'education-pro-core' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tx-carousel.owl-carousel button.owl-dot.active span' => 'background-color: {{VALUE}};',
                ],
                'condition' => [
                    'dots' => 'block',
                ],
            ]
        );
        $this->add_control(
            'dots_size',
            [
                'label' => esc_html__( 'Dots Size', 'education-pro-core' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px' ],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                   
                ],
                'default' => [
                    'size' => 12,
                ],
                'condition' => [
                    'dots' => 'block',
                ],
                'selectors' => [
                    '{{WRAPPER}} .tx-carousel.owl-carousel button.owl-dot span' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}}',
                ],
            ]
        );

        $this->end_controls_section();
    }
    
    protected function render() {
      
        $settings = $this->get_settings_for_display();
        $tx_categories = $settings['tx_categories'];

            $this->add_render_attribute( 'tx-carousel', 'class', 'tx-carousel owl-carousel owl-theme' );
            $this->add_render_attribute(
                [
                    'tx-carousel' => [
                        'data-settings' => [
                            wp_json_encode(array_filter([
                               'navigation' => ('yes' === $settings['navigation']),
                               'autoplay' => ('yes' === $settings['autoplay']),
                               'autoplay_timeout' => absint($settings['autoplay_timeout']),
                               'smart_speed' => absint($settings['smart_speed']),
                               'pause_on_hover' => ('yes' === $settings['pause_on_hover']),
                               'loop' => ('yes' === $settings['loop']),
                               'display_mobile' => $settings['display_mobile'],
                               'display_tablet' => $settings['display_tablet'],
                               'display_laptop' => $settings['display_laptop'],
                               'display_desktop' => $settings['display_desktop'],
                               'gutter' => $settings['gutter'],
                            ]))
                        ]
                    ]
                ]
            );

       
        if( !empty($tx_categories) ) {

            $query_args = array(
                'post_type' => 'class',
                'orderby' => $settings['orderby'],
                'order' => $settings['order'],
                'ignore_sticky_posts' => 1,
                'post_status' => 'publish',
                'showposts' => $settings['number_of_posts'],
                'offset' => $settings['offset'],
                'tax_query' => array(
                'relation' => 'AND',
                    array(
                        'taxonomy' => 'classes-category',
                        'field'    => 'slug',
                        'terms'    => $tx_categories,
                    ),
                )
            );

        } else {

            $query_args = array(
                'post_type' => 'class',
                'orderby' => $settings['orderby'],
                'order' => $settings['order'],
                'ignore_sticky_posts' => 1,
                'post_status' => 'publish',
                'showposts' => $settings['number_of_posts'],
                'offset' => $settings['offset'],
            );
        }
        global $post;

        $post_query = new \WP_Query( $query_args );

        ?>

        <div class="tx-carousel-wrapper">

            <?php
          
            if ($post_query->have_posts()) : 

            ?>

            <div <?php echo $this->get_render_attribute_string( 'tx-carousel' ); ?> >
                <?php while ($post_query->have_posts()) : $post_query->the_post();
                        global $post;
                        $terms = get_the_terms( $post->ID, 'classes-category' );
                        if ( $terms && ! is_wp_error( $terms ) ) :
                          $taxonomy = array();
                          foreach ( $terms as $term ) :
                            $taxonomy[] = $term->name;
                          endforeach;
                          $cat_name = join( " ", $taxonomy);
                          $cat_link = get_term_link( $term );
                        else:
                        $cat_name = '';
                        endif;
                ?>
                        <?php if($settings['display'] == 'grid') : ?>
                            <div class="tx-services-item">
                            <?php if (has_post_thumbnail() && $settings['image_display'] == 'show') : ?>
                                <div class="tx-services-featured">
                                    <a href="<?php the_permalink(); ?>" rel="bookmark">
                                        <?php the_post_thumbnail($settings['image_size']); ?>
                                    </a>
                                </div>
                            <?php endif; ?>
                                <div class="tx-services-content">
                                    <?php if($settings['title'] == 'show') : ?>
                                    <h3 class="tx-services-title"><a href="<?php the_permalink() ?>" rel="bookmark" ><?php echo TX_Helper::title_lenth($settings['title_lenth']); ?></a></h3>
                                    <?php endif; ?>
                                    <?php if($settings['bio'] == 'show') : ?>
                                    <div class="tx-services-excp"><?php echo TX_Helper::excerpt_limit($settings['excerpt_words']); ?></div>
                                    <?php endif; ?> 
                                    <?php if(!empty($cat_name) && $settings['category_display'] == 'show') : ?>
                                        <a class="tx-serv-cat" href="<?php echo esc_url( $cat_link ); ?>"><?php echo esc_attr($cat_name); ?></a>
                                    <?php endif; ?>
                                </div><!-- /.tx-services-content -->
                            </div><!-- /.tx-services-item -->
                        <?php endif; ?>

                        <?php if($settings['display'] == 'overlay') : ?>
                            <?php $featured_img_url = get_the_post_thumbnail_url(get_the_ID(), $settings['image_size']); ?>

                            <div class="tx-services-overlay-item" <?php if (has_post_thumbnail()) : echo 'style="background-image:url('.$featured_img_url.')"'; endif;?>>
                                <div class="tx-services-content">
                                    <?php if($settings['title'] == 'show') : ?>
                                    <div class="tx-services-title-holder">
                                        <h3 class="tx-services-title"><a href="<?php the_permalink() ?>" rel="bookmark" ><?php echo TX_Helper::title_lenth($settings['title_lenth']); ?></a></h3>
                                    </div>
                                    <?php endif; ?>
                                    <?php if(!empty($cat_name) && $settings['category_display'] == 'show') : ?>
                                        <a class="tx-serv-cat" href="<?php echo esc_url( $cat_link ); ?>"><?php echo esc_attr($cat_name); ?></a>
                                    <?php endif; ?>
                                    <?php if($settings['bio'] == 'show') : ?>
                                    <div class="tx-services-excp"><?php echo TX_Helper::excerpt_limit($settings['excerpt_words']); ?></div>
                                    <?php endif; ?>
                                    <?php if($settings['arrow'] == 'show') : ?>  
                                    <a href="<?php the_permalink(); ?>"><i class="la la-long-arrow-right"></i></a>
                                    <?php endif; ?> 
                                </div><!-- /.tx-services-content -->
                            </div><!-- /.tx-services-item -->
                        <?php endif; ?>  
                <?php endwhile;
                wp_reset_postdata(); ?>
            </div><!-- tx-carousel -->
            
           
         
            <?php
            else:
                get_template_part('template-parts/content/content', 'none');
            endif;
            ?>
            <div class="clearfix"></div>
        </div><!-- tx-carousel-wrapper -->


<?php

    } // render()

} // class 