<?php
namespace EpElements\Modules\Courses\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Scheme_Typography;
use Elementor\Scheme_Color;
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

class Courses extends Widget_Base {

    public function get_name() {
        return 'ep-courses';
    }

    public function get_title() {
        return esc_html__( 'EP Courses Grid', 'education-pro-core' );
    }

    public function get_icon() {
        return 'eicon-posts-grid';
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
        if ( class_exists( 'LearnPress' ) ) {
        $this->add_control(
            'categories',
            [
                'label'       => esc_html__( 'Categories', 'education-pro-core' ),
                'type'        => Controls_Manager::SELECT2,
                'options'     => TX_Helper::get_post_type_categories('course_category'),
                'default'     => [],
                'label_block' => true,
                'multiple'    => true,
            ]
        );
        $this->add_responsive_control(
            'columns',
            [
                'label' => esc_html__( 'Columns', 'avas-core' ),
                'label_block' => true,
                'type' => Controls_Manager::SELECT,             
                'desktop_default' => '25%',
                'mobile_default' => '100%',
                'options' => [
                    '100%' => esc_html__( '1 Column', 'avas-core' ),
                    '50%' => esc_html__( '2 Column', 'avas-core' ),
                    '33.333%' => esc_html__( '3 Columns', 'avas-core' ),
                    '25%' => esc_html__( '4 Columns', 'avas-core' ),
                    '20%' => esc_html__( '5 Columns', 'avas-core' ),
                    '16.67%' => esc_html__( '6 Columns', 'avas-core' ),
                ],
                'selectors' => [
                    '{{WRAPPER}} ul.learn-press-courses .course' => 'width: {{VALUE}};',
                ],
                'render_type' => 'template'
            ]
        );
        $this->add_control(
            'number_of_posts',
            [
                'label' => esc_html__( 'Number of Courses', 'education-pro-core' ),
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
                    'menu_order' => esc_html__('Menu order', 'education-pro-core'),
                ),
                'default' => 'date',
            ]
        );
        $this->add_responsive_control(
            'min_height',
            [
                'label'                 => esc_html__( 'Minimum Height', 'avas-core' ),
                'type'                  => Controls_Manager::SLIDER,
                'range'                 => [
                    'px' => [
                        'min'   => 1,
                        'max'   => 500,
                    ],
                ],
                'size_units'            => [ 'px', '%' ],
                'selectors'             => [
                    '{{WRAPPER}} .course-content' => 'min-height: {{SIZE}}{{UNIT}}',
                ],

            ]
        );
        $this->add_control(
            'price',
            [
                'label' => esc_html__( 'Price', 'education-pro-core' ),
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
        // $this->add_control(
        //     'display_category',
        //     [
        //         'label' => esc_html__( 'Category', 'education-pro-core' ),
        //         'type' => Controls_Manager::CHOOSE,
        //         'options' => [
        //             'show' => [
        //                 'title' => esc_html__( 'Yes', 'education-pro-core' ),
        //                 'icon' => 'fa fa-check',
        //             ],
        //             'hide' => [
        //                 'title' => esc_html__( 'No', 'education-pro-core' ),
        //                 'icon' => 'fa fa-ban',
        //             ]
        //         ],
        //         'default' => 'show'
        //     ]
        // );
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
                'default' => 'show'
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
            'desc',
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
                'default' => '10',
                'condition' => [
                    'desc' => 'show',
                ],
            ]
        );
        $this->add_control(
            'author',
            [
                'label' => esc_html__( 'Author', 'education-pro-core' ),
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
            'rating',
            [
                'label' => esc_html__( 'Rating', 'education-pro-core' ),
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
            'views',
            [
                'label' => esc_html__( 'Views', 'education-pro-core' ),
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
            'endrolled',
            [
                'label' => esc_html__( 'Student Enrolled', 'education-pro-core' ),
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
            'pagination',
            [
                'label' => esc_html__( 'Pagination', 'education-pro-core' ),
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
                'default' => 'hide',
               
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
            'content_bg_color',
            [
                'label'     => esc_html__( 'Content Background Color', 'avas-core' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .course-content' => 'background-color: {{VALUE}};',
                ],
                'separator' => 'before',
            ]
        );
        $this->add_control(
            'fotoer_sep_hov_color',
            [
                'label'     => esc_html__( 'Footer Separator Hover Color', 'avas-core' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .type-lp_course:hover .edu-course-footer' => 'border-color: {{VALUE}};',
                ],

                
            ]
        );
        $this->add_control(
            'studen_enroll_color',
            [
                'label'     => esc_html__( 'Student Enrolled Color', 'avas-core' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .course-students::before' => 'color: {{VALUE}};',
                ],

                
            ]
        );
        $this->add_control(
            'title_color',
            [
                'label'     => esc_html__( 'Title Color', 'avas-core' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} ul.learn-press-courses .course .course-title' => 'color: {{VALUE}};',
                ],
                'separator' => 'before',
            ]
        );
        $this->add_control(
            'title_color_hover',
            [
                'label'     => esc_html__( 'Title Hover Color', 'avas-core' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .course-content .course-permalink:hover .course-title' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
              [
                   'name'    => 'title_typography',
                   'selector'  => '{{WRAPPER}} ul.learn-press-courses .course .course-title',
              ]
        );
        $this->add_control(
            'cat_color',
            [
                'label'     => esc_html__( 'Category Color', 'avas-core' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .course-content .course-categories a' => 'background-color: {{VALUE}};',
                ],

                'separator' => 'before',
            ]
        );
        $this->add_control(
            'cat_color_hover',
            [
                'label'     => esc_html__( 'Category Hover Color', 'avas-core' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .course-content .course-categories a:hover' => 'background-color: {{VALUE}};',
                ],

            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
              [
                   'name'    => 'cat_typography',
                   'selector'  => '{{WRAPPER}} .course-content .course-categories a',
              ]
        );
        $this->add_control(
            'price_sale_color',
            [
                'label'     => esc_html__( 'Sale Price Color', 'avas-core' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .lp-course-price' => 'color: {{VALUE}};',
                ],

                'separator' => 'before',
            ]
        );
        $this->add_control(
            'price_reg_color',
            [
                'label'     => esc_html__( 'Regular Price Color', 'avas-core' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .lp-course-price .origin-price' => 'color: {{VALUE}};',
                ],

                
            ]
        );
        $this->add_control(
            'price_bg_color',
            [
                'label'     => esc_html__( 'Price Background Color', 'avas-core' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .lp-course-price' => 'background-color: {{VALUE}};',
                ],

                
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
              [
                   'name'    => 'price_typography',
                   'selector'  => '{{WRAPPER}} .lp-course-price',
              ]
        );

        
        $this->add_control(
            'pagination_color',
            [
                'label'     => esc_html__( 'Pagination Color', 'education-pro-core' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tx-pagination-widgets a' => 'color: {{VALUE}};',
                ],
                'condition' => [
                    'pagination' => 'show',
                ],
                'separator' => 'before',
            ]
        );
        $this->add_control(
            'pagination_hover_color',
            [
                'label'     => esc_html__( 'Pagination Hover Color', 'education-pro-core' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tx-pagination-widgets ul li:hover a' => 'color: {{VALUE}};',
                ],
                'condition' => [
                    'pagination' => 'show',
                ],
            ]
        );
        $this->add_control(
            'pagination_current_color',
            [
                'label'     => esc_html__( 'Pagination Active Color', 'education-pro-core' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tx-pagination-widgets ul li .current' => 'color: {{VALUE}};',
                ],
                'condition' => [
                    'pagination' => 'show',
                ],
            ]
        );
        $this->add_control(
            'pagination_border_color',
            [
                'label'     => esc_html__( 'Pagination Border Color', 'education-pro-core' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tx-pagination-widgets ul li' => 'border-color: {{VALUE}};',
                ],
                'condition' => [
                    'pagination' => 'show',
                ],
            ]
        );
          
        $this->add_control(
            'pagination_hover_border_color',
            [
                'label'     => esc_html__( 'Pagination Hover Border Color', 'education-pro-core' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tx-pagination-widgets ul li:hover' => 'border-color: {{VALUE}};',
                ],
                'condition' => [
                    'pagination' => 'show',
                ],
            ]
        );
        $this->add_control(
            'pagination_bg_color',
            [
                'label'     => esc_html__( 'Pagination Background Color', 'education-pro-core' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tx-pagination-widgets ul li' => 'background-color: {{VALUE}};',
                ],
                'condition' => [
                    'pagination' => 'show',
                ],
            ]
        );
        $this->add_control(
            'pagination_hover_bg_color',
            [
                'label'     => esc_html__( 'Pagination Hover Background Color', 'education-pro-core' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tx-pagination-widgets ul li:hover' => 'background-color: {{VALUE}};',
                ],
                'condition' => [
                    'pagination' => 'show',
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
              [
                   'name'    => 'pagination_typography',
                   'selector'  => '{{WRAPPER}} .tx-pagination-widgets ul li',
                   'condition' => [
                      'pagination' => 'show',
                    ],
              ]
        );
        $this->add_responsive_control(
            'pagination_align',
            [
                'label' => esc_html__( 'Pagination Align', 'education-pro-core' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%' ],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 2000,
                        'step' => 1,
                    ],
                    '%' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .tx-pagination-widgets' => 'left: {{SIZE}}{{UNIT}};',
                ],
                'condition' => [
                      'pagination' => 'show',
                    ],
            ]
        );
        $this->add_responsive_control(
            'pagination_padding',
            [
                'label' => esc_html__( 'Pagination Padding', 'education-pro-core' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} .tx-pagination-widgets' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ],
                'condition' => [
                    'pagination' => 'show',
                ],
            ]
        );
        $this->add_responsive_control(
            'pagination_spacing',
            [
                'label' => esc_html__( 'Spacing', 'education-pro-core' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} .tx-pagination-widgets ul li' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ],
                'condition' => [
                    'pagination' => 'show',
                ],
            ]
        );
        $this->end_controls_section();
    }
    }

    protected function render() {
        $settings = $this->get_settings();
        $columns = $settings['columns'];
        $pagination = $settings['pagination'];
        $categories = $settings['categories'];
        $number_of_posts = $settings['number_of_posts'];
        if ( get_query_var('paged') ) :
            $paged = get_query_var('paged');
        elseif ( get_query_var('page') ) :
            $paged = get_query_var('page');
        else :
            $paged = 1;
        endif;

        if( !empty($categories) ) {

            $query_args = array(
                'post_type' => 'lp_course',
                'orderby' => $settings['orderby'],
                'order' => $settings['order'],
                'ignore_sticky_posts' => 1,
                'post_status' => 'publish',
                'paged' => $paged,
                'offset' => $settings['offset'],
                'posts_per_page' => $number_of_posts,
                'tax_query' => array(
                'relation' => 'AND',
                    array(
                        'taxonomy' => 'course_category',
                        'field'    => 'slug',
                        'terms'    => $categories,
                    ),
                )
            );

        } else {

            $query_args = array(
                'post_type' => 'lp_course',
                'orderby' => $settings['orderby'],
                'order' => $settings['order'],
                'ignore_sticky_posts' => 1,
                'posts_per_page' => $number_of_posts,
                'post_status' => 'publish',
                'offset' => $settings['offset'],
                'paged' => $paged,
            );
        }

        $course_query = new \WP_Query( $query_args );
        if ( class_exists( 'LearnPress' ) ) {
        ?>
        
            <?php
            if ($course_query->have_posts()) : 

                LP()->template( 'course' )->begin_courses_loop(); ?>
               
                <?php while ($course_query->have_posts()) : $course_query->the_post();?>

                        <li id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                            <?php if( $settings['price'] == 'show' ) : ?>
                           <div class="lp-course-price">
                                <?php $course = learn_press_get_course();
                                 if ( $price_html = $course->get_course_price_html() ) { ?>
                                    <span class="price"><?php echo wp_kses_post($price_html); ?></span>
                                <?php } ?>
                            </div><!-- lp-course-price -->
                            <?php endif; ?>
                        <div class="course-item <?php echo wp_kses_post('ccol'.substr($columns, 0, 2)); ?>">
                            <?php
                            do_action( 'learn-press/before-courses-loop-item' );
                            if( $settings['title'] == 'show') : ?>
                                <a href="<?php the_permalink() ?>" rel="bookmark" class="course-permalink"><h3 class="course-title"><?php echo TX_Helper::title_lenth($settings['title_lenth']); ?></h3></a>
                                <?php endif; ?> 

                                <?php if($settings['desc'] == 'show') : ?>
                                <div class="tx-courses-excp"><?php echo TX_Helper::excerpt_limit($settings['excerpt_words']); ?></div>
                                <?php endif; ?>

                          

                            <div class="edu-course-footer">
                                <?php 
                                    if($settings['author'] == 'show') :
                                        echo tx_lp_author();
                                    endif;
                                ?>
                                <?php 
                                    if($settings['rating'] == 'show') :
                                        echo tx_lp_rating();
                                    endif;
                                ?>
                                <?php 
                                    if($settings['endrolled'] == 'show') :
                                        echo tx_lp_student_endrolled();
                                    endif;
                                ?>
                                <?php 
                                    if($settings['views'] == 'show') :
                                        echo '<div class="lp_post_views">'.tx_getPostViews(get_the_ID()).'</div>';
                                    endif;
                                ?>
                            </div><!-- edu-course-footer -->
                            
                        </div>

                        </li><!-- id="post-<?php the_ID(); ?>" <?php post_class(); ?> -->

                   
                     
                <?php endwhile; ?>
                
                <?php LP()->template( 'course' )->end_courses_loop();

            wp_reset_postdata();

            else:
                learn_press_display_message( esc_html__( 'No course found.', 'avas-core' ), 'error' );
            endif;
            ?>
        <div class="clearfix"></div>
        <!-- pagination -->
            <?php
                if($pagination == 'show') :
                tx_pagination_number($course_query->max_num_pages,"",$paged);
                endif;
            ?>
       


<?php
} else {
    echo '<h3 class="text-align-center">' . esc_html__( 'Please install and activate LearnPress plugin', 'avas-core' ) . '</h3>';
    } // 

    } // function render()
} // Class LearnPress