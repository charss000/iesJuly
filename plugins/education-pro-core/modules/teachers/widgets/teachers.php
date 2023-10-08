<?php
namespace EpElements\Modules\Teachers\Widgets;

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

class Teachers extends Widget_Base {

    public function get_name() {
        return 'ep-teachers';
    }

    public function get_title() {
        return esc_html__( 'EP Teachers', 'education-pro-core' );
    }

    public function get_icon() {
        return 'fa fa-users';
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
                'description' => esc_html__('If you can not see any Team item then please add Team via WordPress Dashboard > Team > Add New','education-pro-core'),
                'default' => 'teacher',
                'options' => TX_Helper::get_all_post_types(),
            ]
        );
        $this->add_control(
            'taxonomy_filter',
            [
                'type' => Controls_Manager::SELECT,
                'label' => esc_html__('Taxonomy', 'education-pro-core'),
                'options' => TX_Helper::get_all_taxonomies(),
                'default' => 'teachers-category',
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
        $this->add_group_control(
            Group_Control_Image_Size::get_type(),
            [
                'name' => 'image',
                'exclude' => [ 'custom' ],
                'default' => 'tx-t-thumb',
            ]
        );
        $this->add_control(
            'columns',
            [
                'label' => esc_html__( 'Number of Columns', 'education-pro-core' ),
                'type' => Controls_Manager::SELECT,
                'default' => '3',
                'options' => [
                    '12' => esc_html__( 'One Column', 'education-pro-core' ),
                    '6' => esc_html__( 'Two Columns',   'education-pro-core' ),
                    '4' => esc_html__( 'Three Columns', 'education-pro-core' ),
                    '3' => esc_html__( 'Four Columns',  'education-pro-core' ),
                    '2' => esc_html__( 'Six Columns',   'education-pro-core' ),                   
                    
                ],
            ]
        );
        $this->add_control(
            'column_bottom_gap',
            [
                'label' => esc_html__( 'Column Bottom Gap', 'education-pro-core' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%' ],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                        'step' => 1,
                    ],
                    '%' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'default' => [
                    'unit' => 'px',
                    'size' => 30,
                ],
                'selectors' => [
                    '{{WRAPPER}} .team figure' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                ],
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
                'label' => esc_html__( 'Number of Teams', 'education-pro-core' ),
                'type' => Controls_Manager::NUMBER,
                'default' => 8
            ]
        );
        $this->add_control(
            'offset',
            [
              'label'         => esc_html__( 'Offset', 'education-pro-core' ),
              'type'          => Controls_Manager::NUMBER,
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
                'default' => '15',
                'condition' => [
                    'desc' => 'show',
                ],
            ]
        );
        $this->add_control(
            'serv_category',
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
                'condition' => [
                    'display' => 'grid',
                ]
            ]
        );
        $this->add_control(
            'social_media',
            [
                'label' => esc_html__( 'Social Media', 'education-pro-core' ),
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
            'overlay_bg_color',
            [
                'label'     => esc_html__( 'Background Color', 'education-pro-core' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .team figcaption' => 'background-color: {{VALUE}}',
                ],
                
            ]
        );
        $this->add_control(
            'title_color',
            [
                'label'     => esc_html__( 'Title Color', 'education-pro-core' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .team figcaption h4 a' => 'color: {{VALUE}};',
                ],
               
                'separator' => 'before',
                'condition' => [
                    'title' => 'show',
                ],

            ]
      );
      $this->add_control(
            'title_color_hover',
            [
                'label'     => esc_html__( 'Title Hover Color', 'education-pro-core' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .team figcaption h4 a:hover' => 'color: {{VALUE}};',
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
                   'selector'  => '{{WRAPPER}} .team figcaption h4',
                   'condition' => [
                    'title' => 'show',
                ],
                   
              ]
      );
      
      $this->add_control(
            'desc_color',
            [
                'label'     => esc_html__( 'Description Color', 'education-pro-core' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .team .team-bio' => 'color: {{VALUE}};',
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
                   'selector'  => '{{WRAPPER}} .team .team-bio',
                   'condition' => [
                    'desc' => 'show',
                ],
              ]
      );
      
      
      $this->add_control(
            'cat_color',
            [
                'label'     => esc_html__( 'Category Color', 'education-pro-core' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .team .team-cat a' => 'color: {{VALUE}};',
                ],
                'condition' => [
                    'serv_category' => 'show',
                ],
                'separator' => 'before',
            ]
      );
      $this->add_control(
            'cat_color_hover',
            [
                'label'     => esc_html__( 'Category Hover Color', 'education-pro-core' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .team .team-cat a:hover' => 'color: {{VALUE}};',
                ],
                 'condition' => [
                    'serv_category' => 'show',
                ],
            ]
      );
      $this->add_group_control(
            Group_Control_Typography::get_type(),
              [
                   'name'    => 'cat_typography',
                   'selector'  => '{{WRAPPER}} .team .team-cat a',
                    'condition' => [
                    'serv_category' => 'show',
                ],
              ]
      );
      $this->add_control(
            'social_media_color',
            [
                'label'     => esc_html__( 'Social Media Color', 'education-pro-core' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .team-social a, {{WRAPPER}} .team-social i' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .team-social li' => 'border-color: {{VALUE}};'
                ],
               
                'separator' => 'before',
                'condition' => [
                    'social_media' => 'show',
                ],

            ]
      );
      $this->add_control(
            'social_media_hov_color',
            [
                'label'     => esc_html__( 'Social Media Hover Color', 'education-pro-core' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .team-social li:hover, {{WRAPPER}} .team-social li:hover i' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .team-social li:hover' => 'border-color: {{VALUE}};'

                ],
               
                'condition' => [
                    'social_media' => 'show',
                ],

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
            ]
        );


      $this->end_controls_section();

	}

	protected function render() {
		$settings = $this->get_settings();
        $title = $settings['title'];
        $desc = $settings['desc'];
        $serv_category = $settings['serv_category'];
        $thumb = $settings['image_size'];
        $pagination = $settings['pagination'];
        $columns = $settings['columns'];
        $taxonomy_filter = $settings['taxonomy_filter'];
        $social_media = $settings['social_media'];
        $showposts = '';
        $offset = $settings['offset'];
        $number_of_posts = $settings['number_of_posts'];

        if ( get_query_var('paged') ) :
            $paged = get_query_var('paged');
        elseif ( get_query_var('page') ) :
            $paged = get_query_var('page');
        else :
            $paged = 1;
        endif;

        $query_args = TX_Helper::setup_query_args($settings, $showposts);
        $queryd = new \WP_Query( $query_args );
        ?>


            <div class="row">
                <?php
                    if ($queryd->have_posts()) : 
                        while ($queryd->have_posts()) : $queryd->the_post();

                        global $post;
                        $terms = get_the_terms( $post->ID, $taxonomy_filter );
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
                    
                        <div class="col-lg-<?php echo esc_attr($columns); ?> col-xs-12 col-sm-6">
                            <div class="team">
                                <figure>
                                    <a href="<?php the_permalink(); ?>" rel="bookmark">
                                    <?php the_post_thumbnail($thumb); ?>      
                                    </a>
                                    <figcaption>
                                        <?php if($title == 'show') : ?>
                                        <h4><a href="<?php the_permalink(); ?>" rel="bookmark"><?php echo TX_Helper::title_lenth($settings['title_lenth']); ?></a></h4>
                                        <?php endif; ?>
                                        
                                        <?php if( !empty($cat_name) && $settings['category_display'] == 'show' ) : ?>
                                        <p class="team-cat"><a href="<?php echo esc_url($cat_link); ?>"><?php echo esc_html($cat_name); ?></a></p>
                                        <?php endif; ?>

                                        <?php if($desc == 'show') : ?>
                                        <div class="team-bio"><?php echo TX_Helper::excerpt_limit($settings['excerpt_words']); ?></div>
                                        <?php endif; ?>

                                        <?php if($social_media =='show') : ?>
                                        <ul class="team-social">
                                            <?php
                                            $team_fb = get_post_meta( $post->ID, 'team_fb', true );
                                            $team_tw = get_post_meta( $post->ID, 'team_tw', true );
                                            $team_gp = get_post_meta( $post->ID, 'team_gp', true );
                                            $team_ln = get_post_meta( $post->ID, 'team_ln', true );
                                            $team_in = get_post_meta( $post->ID, 'team_in', true );
                                            ?>
                                            <?php if($team_fb) : ?>
                                            <li><a href="<?php echo esc_url($team_fb); ?>" target="_blank"><i class="fa fa-facebook"></i></a></li>
                                            <?php endif; ?>
                                            <?php if($team_tw) : ?>
                                            <li><a href="<?php echo esc_url($team_tw); ?>" target="_blank"><i class="fa fa-twitter"></i></a></li>
                                            <?php endif; ?>
                                            <?php if($team_gp) : ?>
                                            <li><a href="<?php echo esc_url($team_gp); ?>" target="_blank"><i class="fa fa-youtube-play"></i></a></li>
                                            <?php endif; ?>
                                            <?php if($team_ln) : ?>
                                            <li><a href="<?php echo esc_url($team_ln); ?>" target="_blank"><i class="fa fa-linkedin"></i></a></li>
                                            <?php endif; ?>
                                            <?php if($team_in) : ?>
                                            <li><a href="<?php echo esc_url($team_in); ?>" target="_blank"><i class="fa fa-instagram"></i></a></li>
                                            <?php endif; ?>
                                        </ul>
                                        <?php endif; ?>
                                    </figcaption>
                                    </a>
                                </figure>
                            </div><!-- col-md -->
                    </div><!-- team -->
            <?php endwhile; ?>
            <?php
                 if($pagination == 'show') :
            ?>
                <div class="tx-pagination-widgets">
                <?php
                $page_tot = ceil(($queryd->found_posts - (int)$offset) / (int)$number_of_posts);
                if ( $page_tot > 1 ) {
                $big = 999999999;
                echo paginate_links( array(
                      'base'      => str_replace( $big, '%#%',get_pagenum_link( 999999999, false ) ),
                      'format'    => '?paged=%#%',
                      'current'   => max( 1, $paged ),
                      'total'     => ceil(($queryd->found_posts - (int)$offset) / (int)$number_of_posts),
                      'prev_next' => true,
                        'prev_text'    => esc_html__( 'Prev', 'education-pro-core' ),
                        'next_text'    => esc_html__( 'Next', 'education-pro-core' ),
                      'end_size'  => 1,
                      'mid_size'  => 2,
                      'type'      => 'list'
                        )
                    );
                }
                ?>
                </div><!-- /.tx-pagination-widgets -->
            <?php endif; ?>
            <?php
                    wp_reset_postdata();
                else:  
                    get_template_part('template-parts/content/content', 'none');
                endif; ?>
            </div><!-- /.row -->
        <div class="clearfix"></div>

        <?php
           
	} // function render()
} // class Portfolio
