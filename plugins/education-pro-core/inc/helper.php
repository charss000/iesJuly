<?php
namespace EpElements;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class TX_Helper {

	// get all post types
	static function get_all_post_types() {

    $tx_post_types = get_post_types( array( 'public'   => true, 'show_in_nav_menus' => true ) );
    $tx_exclude_post_types = array( 'elementor_library', 'attachment', 'product', 'lp_course', 'lp_lesson', 'lp_quiz', 'give_forms' );

    foreach ( $tx_exclude_post_types as $exclude_cpt ) {
        unset($tx_post_types[$exclude_cpt]);
    }

    $post_types = array_merge($tx_post_types);
    return $post_types;

	}

    // get all registered taxonomies
    static function get_all_taxonomies() {
        $map = array();
        $taxonomies = get_taxonomies();
        foreach ($taxonomies as $taxonomy) {
            $map [$taxonomy] = $taxonomy;
        }
        return $map;
    }

    // get categories from taxonomies
    static function get_post_type_categories($catarg) {

        $categories = get_terms( $catarg );

        $options = [];
        foreach ( $categories as $category ) {
            $options[ $category->slug ] = $category->name;
        }

        return $options;
    }


	// get all taxonomies
	static function get_all_categories() {

    global $wpdb;

    $results = array();
    foreach ($wpdb->get_results("
        SELECT terms.slug AS 'slug', terms.name AS 'label', termtaxonomy.taxonomy AS 'type'
        FROM $wpdb->terms AS terms
        JOIN $wpdb->term_taxonomy AS termtaxonomy ON terms.term_id = termtaxonomy.term_id
        LIMIT 999
    ") as $result) {
        $results[$result->type . ':' . $result->slug] = $result->type . ':' . $result->label;
    }

    return $results;
	}

    // query arguements setup
	static function setup_query_args($settings, $showposts) {
        
        if ( $settings['post_sortby'] == 'popularposts' ) {
            $query_args = [
                'order' => $settings['order'],
                'ignore_sticky_posts' => 1,
                'post_status' => 'publish',
                'showposts'   => $showposts,
                'meta_key' => 'post_views_count',
                'orderby' => 'meta_value_num',
            ];
        } elseif ( $settings['post_sortby'] == 'mostdiscussed' ) {
            $query_args = [
                'orderby' => 'comment_count',
                'order' => $settings['order'],
                'ignore_sticky_posts' => 1,
                'post_status' => 'publish',
                'showposts'   => $showposts,
            ];
        } else {
            $query_args = [
                'orderby' => $settings['orderby'],
                'order' => $settings['order'],
                'ignore_sticky_posts' => 1,
                'post_status' => 'publish',
                'showposts'   => $showposts,
            ];
        }

            if (!empty($settings['post_type'])) {
                $query_args['post_type'] = $settings['post_type'];
            }
            if (!empty($settings['tax_query'])) {
                $tax_queries = $settings['tax_query'];
                $query_args['tax_query'] = array();
                $query_args['tax_query']['relation'] = 'OR';
                foreach ($tax_queries as $taxquery) {
                    list($tax, $term) = explode(':', $taxquery);
                    if (empty($tax) || empty($term))
                        continue;
                    $query_args['tax_query'][] = array(
                        'taxonomy' => $tax,
                        'field' => 'slug',
                        'terms' => $term
                    );
                }
            }

       	$query_args['offset'] = (isset($settings['offset'])) ? $settings['offset'] : '';
        $query_args['posts_per_page'] = (isset($settings['number_of_posts'])) ? $settings['number_of_posts'] : '';
        $query_args['paged'] = ( get_query_var('paged') ) ? get_query_var('paged') : 1;
        return $query_args;
    }

    // Post Title Lenth
    static function title_lenth($charlength) {

        $title = get_the_title();
        $charlength++;

        if ( mb_strlen( $title ) > $charlength ) {
            $subex = mb_substr( $title, 0, $charlength - 0 );
            $exwords = explode( ' ', $subex );
            $excut = - ( mb_strlen( $exwords[ count( $exwords ) - 1 ] ) );
            if ( $excut < 0 ) {
                return mb_substr( $subex, 0, $excut );
            } else {
                return $subex;
            }

        } else {
            return $title;
        }
    }

    // Post excerpt limit
    static function excerpt_limit($limit) {
      $excerpt = explode(' ', get_the_excerpt(), $limit);
      if (count($excerpt)>=$limit) {
        array_pop($excerpt);
        $excerpt = implode(" ",$excerpt).' ';
      } else {
        $excerpt = implode(" ",$excerpt);
      } 
      $excerpt = preg_replace('`[[^]]*]`','',$excerpt);
      return $excerpt;
    }

    // woocommerce product gallery first image hover on product
    static function woo_image_hover() {
        global $product;

        $attachment_ids = $product->get_gallery_image_ids();
        $count = 0;
        foreach( $attachment_ids as $attachment_id ) { 
            $count++;
            
            if($count <= 1) {
            ?>
            <div class="product-secondary-image" style="background-image:url('<?php echo wp_get_attachment_image_src( $attachment_id, 'full' )[0]; ?> '); "></div>
            <?php 
            }
        }
    }


    // social profile 
    static function social_profile($link) {

        $email = $link['email'];
        $facebook = $link['facebook'];
        $twitter = $link['twitter'];
        $linkedin = $link['linkedin'];
        $instagram = $link['instagram'];
        $behance = $link['behance'];
        $dribbble = $link['dribbble'];
        $pinterest = $link['pinterest'];
        $youtube = $link['youtube'];
        ?>

        <div class="tx-social-profile">
            <?php if ( !empty($email) ) : ?>
                <a href="mailto:<?php echo esc_attr( $email ); ?>"><i class="fa fa-envelope" aria-hidden="true"></i></a>
            <?php endif; ?>
            <?php if ( !empty($facebook) ) : ?>
                <a href="<?php echo esc_url( $facebook ); ?>"><i class="fab fa-facebook" aria-hidden="true"></i></a>
            <?php endif; ?>
            <?php if ( !empty($twitter) ) : ?>
                <a href="<?php echo esc_url( $twitter ); ?>"><i class="fa fa-twitter" aria-hidden="true"></i></a>
            <?php endif; ?>
            <?php if ( !empty($linkedin) ) : ?>
                <a href="<?php echo esc_url( $linkedin ); ?>"><i class="fa fa-linkedin" aria-hidden="true"></i></a>
            <?php endif; ?>
            <?php if ( !empty($instagram) ) : ?>
                <a href="<?php echo esc_url( $instagram ); ?>"><i class="fa fa-instagram" aria-hidden="true"></i></a>
            <?php endif; ?>
            <?php if ( !empty($behance) ) : ?>
                <a href="<?php echo esc_url( $behance ); ?>"><i class="fa fa-behance" aria-hidden="true"></i></a>
            <?php endif; ?>
            <?php if ( !empty($dribbble) ) : ?>
                <a href="<?php echo esc_url( $dribbble ); ?>"><i class="fa fa-dribbble" aria-hidden="true"></i></a>
            <?php endif; ?>          
            <?php if ( !empty($pinterest) ) : ?>
                <a href="<?php echo esc_url( $pinterest ); ?>"><i class="fa fa-pinterest" aria-hidden="true"></i></a>
            <?php endif; ?>
            <?php if ( !empty($youtube) ) : ?>
                <a href="<?php echo esc_url( $youtube ); ?>"><i class="fa fa-youtube" aria-hidden="true"></i></a>
            <?php endif; ?>
        </div><!-- tx-social-profile -->

    <?php
    }

    // Instagram Feed
    static function instagram_feed() {

    global $tx;
    $access_token = $tx['instagram_api'];

        if (!empty($access_token)) {

            $api_url = 'https://api.instagram.com/v1/users/self/media/recent/?access_token=' . $access_token;
            $json_data = wp_remote_fopen( $api_url );
            $data  = json_decode( $json_data, true );
            $meta = [];

                if ( ! empty( $data['data'] ) ) {

                    foreach ( $data['data'] as $feed ) {

                        array_push( $meta, 
                            array(
                                'image' => [
                                    'small'  => $feed['images']['thumbnail']['url'],
                                    'medium' => $feed['images']['low_resolution']['url'],
                                    'large'  => $feed['images']['standard_resolution']['url'],
                                ],
                                'link'      => $feed['link'],
                                'like'      => $feed['likes']['count'],
                                'comment'   => [
                                    'count' => $feed['comments']['count']
                                ],
                            ) 
                        );

                    }

                    return $meta;
                }

        } 

    } 

    // Contact Form 7
    static function contact_form_seven() {
        $wpcf7_form_list = get_posts(array(
            'post_type' => 'wpcf7_contact_form',
            'showposts' => -1,
        ));
        $options = array();
        $options[0] = esc_html__( 'Select a Contact Form', 'education-pro-core' );
        if ( ! empty( $wpcf7_form_list ) && ! is_wp_error( $wpcf7_form_list ) ) {
            foreach ( $wpcf7_form_list as $post ) {
                $options[ $post->ID ] = $post->post_title;
            }
        } else {
            $options[0] = esc_html__( 'Create a Form First', 'education-pro-core' );
        }
        return $options;
    }




} //class TX_Helper



