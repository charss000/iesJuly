<?php
namespace EpElements\Modules\NewsTicker\Widgets;

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

class NewsTicker extends Widget_Base {

    public function get_name() {
        return 'ep-news-ticker';
    }

    public function get_title() {
        return esc_html__( 'EP News Ticker', 'education-pro-core' );
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
                'label' => esc_html__( 'Settings', 'education-pro-core' )
            ]
        );
        $this->add_control(
            'nt_label',
            [
                'label'             => esc_html__( 'Label', 'education-pro-core' ),
                'type'              => Controls_Manager::TEXT,
                'default'           => esc_html__( 'TRENDING', 'education-pro-core' ),
            ]
        );
        $this->add_control(
            'categories',
            [
                'label'       => esc_html__( 'Categories', 'education-pro-core' ),
                'type'        => Controls_Manager::SELECT2,
                'options'     => TX_Helper::get_post_type_categories('category'),
                'default'     => [],
                'label_block' => true,
                'multiple'    => true,
            ]
        );
        $this->add_control(
            'formats',
            [
                'label'       => esc_html__( 'Post Format', 'education-pro-core' ),
                'type'        => Controls_Manager::SELECT2,
                'options'     => [
                    'post-format-gallery' => esc_html__( 'Gallery', 'education-pro-core' ),
                    'post-format-video' => esc_html__( 'Video', 'education-pro-core' ),
                ],
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
            'offset',
            [
                'label' => esc_html__( 'Offset', 'education-pro-core' ),
                'type' => Controls_Manager::NUMBER,
               
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
                    'parent' => esc_html__('By parent', 'education-pro-core'),
                    'rand' => esc_html__('Random order', 'education-pro-core'),
                    'menu_order' => esc_html__('Menu order', 'education-pro-core'),
                ),
                'default' => 'date',
                'condition' => [
                    'post_sortby' => ['latestpost'],
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
                'default' => 1
            ]
        );
        $this->add_control(
            'display_laptop',
            [
                'label' => esc_html__( 'Posts Per Row on Laptop', 'education-pro-core' ),
                'type' => Controls_Manager::NUMBER,
                'default' => 1
            ]
        );
        $this->add_control(
            'display_desktop',
            [
                'label' => esc_html__( 'Posts Per Row on Desktop', 'education-pro-core' ),
                'type' => Controls_Manager::NUMBER,
                'default' => 1
            ]
        );
        $this->add_control(
            'gutter',
            [
                'label' => esc_html__( 'Gutter', 'education-pro-core' ),
                'type' => Controls_Manager::NUMBER,
                'default' => 0
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
                'label' => esc_html__('Slide Change Speed(ms)', 'education-pro-core'),
                'type' => Controls_Manager::NUMBER,
                'default' => 900,
                'step' => 50,
            ]
        );
        $this->add_control(
            'autoplay_timeout',
            [
                'label' => esc_html__('Slide Change Delay(ms)', 'education-pro-core'),
                'type' => Controls_Manager::NUMBER,
                'default' => 2500,
                'step' => 500,
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
            'nt_label_color',
            [
                'label'     => esc_html__( 'Label Color', 'education-pro-core' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tx-news-ticker-label' => 'color: {{VALUE}};',
                ],
               
            ]
        );
        $this->add_control(
            'nt_label_bg_color',
            [
                'label'     => esc_html__( 'Label Background Color', 'education-pro-core' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tx-news-ticker-label' => 'background-color: {{VALUE}};',
                ],
               
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
              [
                   'name'    => 'nt_label_typography',
                   'selector'  => '{{WRAPPER}} .tx-news-ticker-label',
                   
              ]
        );
        $this->add_responsive_control(
            'nt_label_padding',
            [
                'label'         => esc_html__( 'Padding', 'education-pro-core' ),
                'type'          => Controls_Manager::DIMENSIONS,
                'size_units'    => [ 'px', 'em', '%' ],
                'selectors'     => [
                    '{{WRAPPER}} .tx-news-ticker-label' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'nt_label_margin',
            [
                'label'         => esc_html__( 'Margin', 'education-pro-core' ),
                'type'          => Controls_Manager::DIMENSIONS,
                'size_units'    => [ 'px', 'em', '%' ],
                'selectors'     => [
                    '{{WRAPPER}} .tx-news-ticker-label' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_control(
            'title_color',
            [
                'label'     => esc_html__( 'Title Color', 'education-pro-core' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tx-post-list-title a' => 'color: {{VALUE}};',
                ],
                'separator' => 'before'
            ]
        );
        $this->add_control(
            'title_color_hover',
            [
                'label'     => esc_html__( 'Title Hover Color', 'education-pro-core' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tx-post-list-title a:hover' => 'color: {{VALUE}};',
                ],
               
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
              [
                   'name'    => 'title_typography',
                   'selector'  => '{{WRAPPER}} .tx-post-list-title a',
                   
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
        $this->add_group_control(
            Group_Control_Typography::get_type(),
              [
                   'name'    => 'nav_typography',
                   'selector'  => '{{WRAPPER}} .tx-news-ticker-container .owl-carousel .owl-nav button.owl-prev, {{WRAPPER}} .tx-news-ticker-container .owl-carousel .owl-nav button.owl-next',
                   
              ]
        );

        $this->end_controls_section();
    }
    
    protected function render() {
      
        $settings = $this->get_settings_for_display();
        $categories = $settings['categories'];

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

        if( !empty($settings['categories']) ) {

            $query_args = array(
                'post_type' => 'post',
                'orderby' => $settings['orderby'],
                'order' => $settings['order'],
                'ignore_sticky_posts' => 1,
                'post_status' => 'publish',
                'showposts' => $settings['number_of_posts'],
                'offset' => $settings['offset'],
                'tax_query' => array(
                'relation' => 'AND',
                    array(
                        'taxonomy' => 'category',
                        'field'    => 'slug',
                        'terms'    => $settings['categories'],
                    ),
                )
            );

        } elseif( !empty($settings['formats']) ) {

            $query_args = array(
                'post_type' => 'post',
                'orderby' => $settings['orderby'],
                'order' => $settings['order'],
                'ignore_sticky_posts' => 1,
                'post_status' => 'publish',
                'showposts' => $settings['number_of_posts'],
                'offset' => $settings['offset'],
                'tax_query' => array(
                    array(
                        'taxonomy' => 'post_format',
                        'field'    => 'slug',
                        'terms' => $settings['formats'],
                        'operator' => 'IN'
                    ),
                )
                
            );

        } else {

            $query_args = array(
                'post_type' => 'post',
                'orderby' => $settings['orderby'],
                'order' => $settings['order'],
                'ignore_sticky_posts' => 1,
                'post_status' => 'publish',
                'showposts' => $settings['number_of_posts'],
                'offset' => $settings['offset'],
            );
            
            
        }

        if ( $settings['post_sortby'] == 'popularposts' ) {
            $query_args = [
                'post_type' => 'post',
                'order' => $settings['order'],
                'ignore_sticky_posts' => 1,
                'post_status' => 'publish',
                 'showposts' => $settings['number_of_posts'],
                'offset' => $settings['offset'],
                'meta_key' => 'post_views_count',
                'orderby' => 'meta_value_num',
            ];
        } elseif ( $settings['post_sortby'] == 'mostdiscussed' ) {
            $query_args = [
                'post_type' => 'post',
                'orderby' => 'comment_count',
                'order' => $settings['order'],
                'ignore_sticky_posts' => 1,
                'post_status' => 'publish',
                 'showposts' => $settings['number_of_posts'],
                'offset' => $settings['offset'],
            ];
        } else {
            $query_args = [
                'post_type' => 'post',
                'orderby' => $settings['orderby'],
                'order' => $settings['order'],
                'ignore_sticky_posts' => 1,
                'post_status' => 'publish',
                'showposts' => $settings['number_of_posts'],
                'offset' => $settings['offset'],
            ];
        }

        global $post;

        $post_query = new \WP_Query( $query_args );
        
        ?>

        <div class="tx-news-ticker-container">
            <?php
            if ($post_query->have_posts()) : ?>
                <?php if(!empty($settings['nt_label'])) : ?>
                <div class="tx-news-ticker-label">
                    <?php echo esc_html( $settings['nt_label'] ); ?>
                </div><!-- tx-news-ticker-label -->
                <?php endif; ?>
                <div <?php echo $this->get_render_attribute_string( 'tx-carousel' ); ?> >
                    <?php while ($post_query->have_posts()) : $post_query->the_post(); ?>
                            <div class="tx-post-list-title"><a href="<?php the_permalink() ?>"><?php the_title(); ?></a></div>
                    <?php endwhile;
                    wp_reset_postdata(); ?>
                </div><!-- tx-carousel -->
            <?php
            else:
                get_template_part('template-parts/content/content', 'none');
            endif;
            ?>
            <div class="clearfix"></div>
        </div><!-- tx-news-ticker-container -->


<?php

    } // function render()

} // class Portfolio