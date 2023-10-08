<?php
namespace EpElements\Modules\PostGrid\Widgets;

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

class PostGrid extends Widget_Base {

    public function get_name() {
        return 'ep-post-grid';
    }

    public function get_title() {
        return esc_html__( 'EP Post Grid', 'education-pro-core' );
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
        $this->add_control(
            'post_type',
            [
                'label' => esc_html__('Post Types', 'education-pro-core'),
                'type' => Controls_Manager::SELECT,
                'default' => 'post',
                'options' => TX_Helper::get_all_post_types(),
                
            ]
        );
        $this->add_control(
            'taxonomy_filter',
            [
                'type' => Controls_Manager::SELECT,
                'label' => esc_html__('Taxonomy', 'education-pro-core'),
                'options' => TX_Helper::get_all_taxonomies(),
                'default' => 'category',
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
                
            ]
        );

        $this->add_control(
            'columns',
            [
                'label' => esc_html__( 'Number of Columns', 'education-pro-core' ),
                'type' => Controls_Manager::SELECT,
                'default' => '4',
                'options' => [
                    '12' => esc_html__( 'One Column', 'education-pro-core' ),
                    '6' => esc_html__( 'Two Columns',   'education-pro-core' ),
                    '4' => esc_html__( 'Three Columns', 'education-pro-core' ),
                    '3' => esc_html__( 'Four Columns',  'education-pro-core' ),
                    '2' => esc_html__( 'Six Columns',   'education-pro-core' ),                   
                    
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Image_Size::get_type(),
            [
                'name' => 'image',
                'exclude' => [ 'custom' ],
                'default' => 'tx-bc-thumb',
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
                    'modified' => esc_html__('Modified date', 'education-pro-core'),
                    'parent' => esc_html__('By parent', 'education-pro-core'),
                    'rand' => esc_html__('Random order', 'education-pro-core'),
                    'comment_count' => esc_html__('Comment count', 'education-pro-core'),
                    'menu_order' => esc_html__('Menu order', 'education-pro-core'),
                    'post__in' => esc_html__('By include order', 'education-pro-core'),
                ),
                'default' => 'date',
                'condition' => [
                    'post_sortby' => ['latestpost'],
                ],
            ]
        );
        $this->add_control(
            'number_of_posts',
            [
                'label' => esc_html__( 'Number of Posts', 'education-pro-core' ),
                'type' => Controls_Manager::NUMBER,
                'default' => '6'
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
            'min_height',
            [
                'label' => esc_html__( 'Min Height', 'education-pro-core' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'rem' ],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 600,
                    ],
                   
                ],
                'default' => [
                    'size' => 250,
                ],
                'selectors' => [
                    '{{WRAPPER}} .details-box' => 'min-height: {{SIZE}}{{UNIT}}',
                ],
            ]
        );
        $this->add_control(
            'video',
            [
                'label' => esc_html__( 'Video', 'education-pro-core' ),
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
            'date',
            [
                'label' => esc_html__( 'Date', 'education-pro-core' ),
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
                'default' => '50',
                'condition' => [
                    'title' => 'show',
                ]

            ]
        );
        $this->add_control(
            'post_category',
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
            'comments',
            [
                'label' => esc_html__( 'Comments', 'education-pro-core' ),
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
                'default' => 'show',
            ]
        );
        $this->add_control(
            'desc',
            [
                'label' => esc_html__( 'Excerpt', 'education-pro-core' ),
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
                'label' => esc_html__( 'Excerpt Words', 'education-pro-core' ),
                'type' => Controls_Manager::NUMBER,
                'default' => '30',
                'condition' => [
                    'desc' => 'show',
                ],
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
                'label'     => esc_html__( 'Content Background Color', 'education-pro-core' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .details-box' => 'background-color: {{VALUE}}',
                ],
                
            ]
        );
        $this->add_control(
            'cont_padding',
            [
                'label'             => esc_html__( 'Padding', 'ex' ),
                'type'              => Controls_Manager::DIMENSIONS,
                'size_units'        => [ 'px', 'em', '%' ],
                'selectors'         => [
                    '{{WRAPPER}} .details-box' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_control(
            'date_color',
            [
                'label'     => esc_html__( 'Date Color', 'education-pro-core' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .details-box .post-time, {{WRAPPER}} .details-box .post-time i' => 'color: {{VALUE}};',
                ],
                'condition' => [
                    'date' => 'show',
                ],
                'separator' => 'before',
            ]
        );
        $this->add_control(
            'date_bg_color',
            [
                'label'     => esc_html__( 'Date Background Color', 'education-pro-core' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .details-box .post-time' => 'background-color: {{VALUE}};',
                ],
                'condition' => [
                    'date' => 'show',
                ],
            ]
        );
        $this->add_control(
            'date_bg_hov_color',
            [
                'label'     => esc_html__( 'Date Background Hover Color', 'education-pro-core' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .blog-cols:hover .details-box .post-time' => 'background-color: {{VALUE}};',
                ],
                'condition' => [
                    'date' => 'show',
                ],
            ]
        );
        $this->add_control(
            'title_color',
            [
                'label'     => esc_html__( 'Title Color', 'education-pro-core' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .post-title a' => 'color: {{VALUE}};',
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
                    '{{WRAPPER}} .post-title a:hover' => 'color: {{VALUE}};',
                ],
                'condition' => [
                    'title' => 'show',
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
              [
                   'name'    => 'title_typography',
                   'selector'  => '{{WRAPPER}} .post-title',
                   'condition' => [
                      'title' => 'show',
                    ],
              ]
        );
        $this->add_control(
            'title_padding',
            [
                'label'             => esc_html__( 'Padding', 'ex' ),
                'type'              => Controls_Manager::DIMENSIONS,
                'size_units'        => [ 'px', 'em', '%' ],
                'selectors'         => [
                    '{{WRAPPER}} .blog-cols .post-title' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_control(
            'desc_color',
            [
                'label'     => esc_html__( 'Description Color', 'education-pro-core' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tx-excerpt' => 'color: {{VALUE}};',
                ],
                'condition' => [
                    'desc' => 'show',
                ],
                'separator' => 'before',
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
              [
                   'name'    => 'desc_typography',
                   'selector'  => '{{WRAPPER}} .tx-excerpt',
                   'condition' => [
                      'desc' => 'show',
                    ],
              ]
        );
        $this->add_control(
            'meta_color',
            [
                'label'     => esc_html__( 'Meta Color', 'education-pro-core' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .details-box .post-category a, {{WRAPPER}} .details-box .comments-link a, {{WRAPPER}} .details-box .post-views' => 'color: {{VALUE}};',
                ],
                
                'separator' => 'before',
            ]
        );
        $this->add_control(
            'meta_icon_color',
            [
                'label'     => esc_html__( 'Meta Icons Color', 'education-pro-core' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .details-box .entry-meta i' => 'color: {{VALUE}};',
                ],
                
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
              [
                   'name'    => 'meta_typography',
                   'selector'  => '{{WRAPPER}} .details-box .post-category a, {{WRAPPER}} .details-box .comments-link a, {{WRAPPER}} .details-box .post-views, {{WRAPPER}} .details-box .entry-meta i',
              ]
        );
        $this->add_control(
            'hov_bottom_border_color',
            [
                'label'     => esc_html__( 'Hover Bottom Border Color', 'education-pro-core' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .blog-cols:hover .details-box' => 'border-color: {{VALUE}};',
                ],
                'separator' => 'before',
            ]
        );
      $this->add_control(
            'pagination_color',
            [
                'label'     => esc_html__( 'Pagination Color', 'education-pro-core' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tx-pagination span, {{WRAPPER}} .tx-pagination a' => 'color: {{VALUE}};',
                ],
                'condition' => [
                    'pagination' => 'show',
                ],
                'separator' => 'before',
            ]
      );
      $this->add_control(
            'pagination_border_color',
            [
                'label'     => esc_html__( 'Pagination Border Color', 'education-pro-core' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tx-pagination span, {{WRAPPER}} .tx-pagination a' => 'border-color: {{VALUE}};',
                ],
                'condition' => [
                    'pagination' => 'show',
                ],
            ]
      );
      $this->add_control(
            'pagination_hover_color',
            [
                'label'     => esc_html__( 'Pagination Hover Color', 'education-pro-core' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tx-pagination a:hover, {{WRAPPER}} .tx-pagination span' => 'color: {{VALUE}};',
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
                    '{{WRAPPER}} .tx-pagination a:hover, {{WRAPPER}} .tx-pagination span' => 'border-color: {{VALUE}};',
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
                    '{{WRAPPER}} .tx-pagination a:hover, {{WRAPPER}} .tx-pagination span' => 'background-color: {{VALUE}};',
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
                   'selector'  => '{{WRAPPER}} .tx-pagination span, {{WRAPPER}} .tx-pagination a',
                   'condition' => [
                      'pagination' => 'show',
                    ],
              ]
      );


      $this->end_controls_section();

	}

	protected function render() {
		$settings = $this->get_settings();
        $title = $settings['title'];
        $title_lenth = $settings['title_lenth'];
        $desc = $settings['desc'];
        $post_category = $settings['post_category'];
        $pagination = $settings['pagination'];
        $columns = $settings['columns'];
        $taxonomy_filter = $settings['taxonomy_filter'];
        $showposts = '';

        // title lenth limit
        if( $title_lenth ){
            $title_lenth = $title_lenth;
        } else {
            $title_lenth = 50;
        }
        
        if ( get_query_var('paged') ) :
            $paged = get_query_var('paged');
        elseif ( get_query_var('page') ) :
            $paged = get_query_var('page');
        else :
            $paged = 1;
        endif;
        $query_args = TX_Helper::setup_query_args($settings, $showposts);
        $post_query = new \WP_Query( $query_args );
        ?>

            <div class="row">
            <?php
                if ($post_query->have_posts()) : 
                    while ($post_query->have_posts()) : $post_query->the_post();

                     global $post;
            ?>
                    
                        <div class="col-md-<?php echo esc_attr($columns); ?> col-sm-6 blog-cols">
                            <article id="post-<?php the_ID(); ?>" <?php post_class(); ?> >
                                <?php if($settings['video'] == 'show') { ?>

                                    <?php if ( has_post_format('video') ) { ?>
                                    
                                        <?php 
                                            $post_video_link = get_post_meta( $post->ID, 'post_link', true );
                                            if( function_exists('tx_post_video_link') &&  $post_video_link ) { ?>
                                            <div class="video_post_link"><?php do_action('tx_post_video_link'); ?></div>
                                        <?php } else {
                                            if (has_post_thumbnail()) : ?>
                                                <div class="zoom-thumb featured-thumb">
                                                    <a href="<?php echo esc_url( get_permalink() ); ?>" title="<?php the_title_attribute(); ?>">
                                                    <?php the_post_thumbnail($settings['image_size']); ?>
                                                    </a>
                                                </div>
                                        <?php endif; 
                                            } ?>

                                    <?php } else { ?>
                                        <?php if(has_post_thumbnail()) : ?>
                                            <div class="zoom-thumb featured-thumb">
                                                <a href="<?php echo esc_url( get_permalink() ); ?>" title="<?php the_title_attribute(); ?>">
                                                <?php the_post_thumbnail($settings['image_size']); ?>
                                                </a>
                                            </div>
                                        <?php endif; ?>
                                        <?php } ?>    

                                <?php } else { ?>
                                <?php if(has_post_thumbnail()) : ?>
                                        <div class="zoom-thumb featured-thumb">
                                            <a href="<?php echo esc_url( get_permalink() ); ?>" title="<?php the_title_attribute(); ?>">
                                            <?php the_post_thumbnail($settings['image_size']); ?>
                                            </a>
                                        </div>
                                        
                                <?php endif; ?>
                            <?php } ?>

                                

                                <div class="details-box">
                                    <?php if($settings['date'] == 'show') : tx_date(); endif; ?>
                                     <?php if($title == 'show') : ?>
                                        <h4 class="post-title">
                                        <a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>" rel="bookmark">
                                        <?php echo TX_Helper::title_lenth($title_lenth); ?>
                                        </a></h4>
                                    <?php endif; ?>
                                        <?php if ('post' == get_post_type()) : ?>
                                    <div class="entry-meta">
                                    <?php if($post_category == 'show') : tx_category(); endif ?>
                                    <?php if($settings['comments'] == 'show') : tx_comments(); endif; ?>
                                    <?php if($settings['views'] == 'show') :
                                        echo tx_getPostViews(get_the_ID());
                                        endif;
                                    ?>
                                    </div>
                                    <?php endif; ?><!-- .entry-meta -->
                                    <?php if($desc == 'show') : ?>
                                        <div class="tx-excerpt"><?php echo TX_Helper::excerpt_limit($settings['excerpt_words']); ?></div>
                                    <?php endif; ?>

                                <div class="clear"></div>
                  
                                </div>
                            </article>
                        </div><!-- blog-cols -->

                <?php endwhile;
                    wp_reset_postdata();
                else:  
                    get_template_part('template-parts/content/content', 'none');
                endif; ?>
        
            <div class="tx-clear"></div>
            <!-- pagination -->
            <?php
                if($pagination == 'show') :
                tx_pagination_number($post_query->max_num_pages,"",$paged);
                endif;
            ?>
        </div><!-- /.row -->

<?php	} // function render()
} // class 
