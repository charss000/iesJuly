<?php
/**
 * 
 * @package tx
 * @author theme-x
 * @link https://x-theme.com/
 * ========================================
 *  Custom post types
 * ========================================
 */


/*-------------------------------------------------------
 *             Register Classes
*-------------------------------------------------------*/
if(!function_exists('tx_classes')) :
add_action( 'init', 'tx_classes' );
function tx_classes() {
		global $tx;
		if(isset($tx['classes_post_type']) && $tx['classes_post_type'] == true) {
		if(isset($tx['class-slug']) && $tx['class-slug'] != ''){
			$class_slug = $tx['class-slug'];
		} else {
			$class_slug = 'class';
		}

		if(isset($tx['classes_title'])) :
		$st = $tx['classes_title'];
		$labels = array(
		'name'               => esc_html__( $st, 'education-pro-core' ),
		'singular_name'      => esc_html__( $st,  'education-pro-core' ),
		'menu_name'          => esc_html__( $st, 'education-pro-core' ),
		'name_admin_bar'     => esc_html__( $st,  'education-pro-core' ),
		'add_new'            => esc_html__( 'Add New '.$st, 'education-pro-core' ),
		'add_new_item'       => esc_html__( 'Add New '.$st, 'education-pro-core' ),
		'new_item'           => esc_html__( 'New '.$st, 'education-pro-core' ),
		'edit_item'          => esc_html__( 'Edit '.$st, 'education-pro-core' ),
		'view_item'          => esc_html__( 'View '.$st, 'education-pro-core' ),
		'all_items'          => esc_html__( 'All '.$st, 'education-pro-core' ),
		'search_items'       => esc_html__( 'Search '.$st, 'education-pro-core' ),
		'parent_item_colon'  => esc_html__( 'Parent '.$st.':', 'education-pro-core' ),
		'not_found'          => esc_html__( 'No '.$st.' found.', 'education-pro-core' ),
		'not_found_in_trash' => esc_html__( 'No '.$st.' found in Trash.', 'education-pro-core' )
	);
	
	$args = array(
		'labels'             => $labels,
		'public'             => true,
		'publicly_queryable' => true,
		'show_ui'            => true,
		'show_in_menu'       => true,
		'query_var'          => true,
		'rewrite'            => array('slug' => $class_slug), // Permalink
		'capability_type'    => 'post',
		'has_archive'        => true,
		'hierarchical'       => false,
		'menu_icon'			 => 'dashicons-screenoptions',
		'menu_position'      => null,
		'supports'           => array( 'title','thumbnail','editor' )
	);

	register_post_type( 'class', $args );
	endif;
}
}
endif;

/*-------------------------------------------------------
 *             Classes Texonomy
*-------------------------------------------------------*/
if( !function_exists('tx_classes_taxonomy') ) :
	add_action( 'init', 'tx_classes_taxonomy'); 
	function tx_classes_taxonomy() {
		global $tx;
		if(isset($tx['classes_post_type'])) {
		if(isset($tx['classes-cat-slug']) && $tx['classes-cat-slug'] != ''){
			$class_cat_slug = $tx['classes-cat-slug'];
		} else {
			$class_cat_slug = 'classes-category';
		}
		if(isset($tx['classes_title'])) :
		$st = $tx['classes_title'];
			register_taxonomy(
			'classes-category',  		
			'class',                  //post type name
			array(
				'hierarchical'          => true,
				'label'                 => esc_html__($st.' Catagory', 'education-pro-core'),  //Display name
				'query_var'             => true,
				'show_admin_column'     => true,
				'rewrite'               => array(
				'slug'                  => $class_cat_slug, // This controls the base slug that will display before each term
				'with_front'    		=> true // Don't display the category base before
					)
				)
			);
			endif;
		}
	}
endif;

/*-------------------------------------------------------
 *    class texonomy filter show at backend
*-------------------------------------------------------*/
function tx_classes_taxonomy_filter( $post_type, $which ) {

  // Apply this only on a specific post type
  if ( 'class' !== $post_type )
    return;

  // A list of taxonomy slugs to filter by
  $taxonomies = array( 'classes-category' );

  foreach ( $taxonomies as $taxonomy_slug ) {

    // Retrieve taxonomy data
    $taxonomy_obj = get_taxonomy( $taxonomy_slug );
    $taxonomy_name = $taxonomy_obj->labels->name;

    // Retrieve taxonomy terms
    $terms = get_terms( $taxonomy_slug );

    // Display filter HTML
    echo "<select name='{$taxonomy_slug}' id='{$taxonomy_slug}' class='postform'>";
    echo '<option value="">' . sprintf( esc_html__( 'Show All %s', 'text_domain' ), $taxonomy_name ) . '</option>';
    foreach ( $terms as $term ) {
      printf(
        '<option value="%1$s" %2$s>%3$s (%4$s)</option>',
        $term->slug,
        ( ( isset( $_GET[$taxonomy_slug] ) && ( $_GET[$taxonomy_slug] == $term->slug ) ) ? ' selected="selected"' : '' ),
        $term->name,
        $term->count
      );
    }
    echo '</select>';
  }

}
add_action( 'restrict_manage_posts', 'tx_classes_taxonomy_filter' , 10, 2);

/*-------------------------------------------------------
 *   Register Teachers
*-------------------------------------------------------*/
if( !function_exists('tx_teachers') ) :
add_action( 'init', 'tx_teachers' );	
function tx_teachers() {
	global $tx;
	if(isset($tx['teachers_post_type']) && $tx['teachers_post_type'] == true) {
	if(isset($tx['teachers-slug']) && $tx['teachers-slug'] != ''){
		$teachers_slug = $tx['teachers-slug'];
	} else {
		$teachers_slug = 'teacher';
	}
	if(isset($tx['teachers_title'])) :
	$tt = $tx['teachers_title'];
	$labels = array(
		'name'               => esc_html__( $tt, 'education-pro-core' ),
		'singular_name'      => esc_html__( $tt,  'education-pro-core' ),
		'menu_name'          => esc_html__( $tt, 'education-pro-core' ),
		'name_admin_bar'     => esc_html__( $tt,  'education-pro-core' ),
		'add_new'            => esc_html__( 'Add New', 'education-pro-core' ),
		'add_new_item'       => esc_html__( 'Add New', 'education-pro-core' ),
		'new_item'           => esc_html__( 'New '.$tt, 'education-pro-core' ),
		'edit_item'          => esc_html__( 'Edit '.$tt, 'education-pro-core' ),
		'view_item'          => esc_html__( 'View '.$tt, 'education-pro-core' ),
		'all_items'          => esc_html__( 'View All', 'education-pro-core' ),
		'search_items'       => esc_html__( 'Search '.$tt, 'education-pro-core' ),
		'parent_item_colon'  => esc_html__( 'Parent '.$tt.':', 'education-pro-core' ),
		'not_found'          => esc_html__( 'No '.$tt.' found.', 'education-pro-core' ),
		'not_found_in_trash' => esc_html__( 'No '.$tt.' found in Trash.', 'education-pro-core' )
	);
	
	$args = array(
		'labels'             => $labels,
		'public'             => true,
		'publicly_queryable' => true,
		'show_ui'            => true,
		'show_in_menu'       => true,
		'query_var'          => true,
		'rewrite'            => array('slug' => $teachers_slug), // Permalink
		'capability_type'    => 'post',
		'has_archive'        => true,
		'hierarchical'       => false,
		'menu_icon'			 => 'dashicons-admin-users',
		'menu_position'      => null,
		'supports'           => array( 'title','thumbnail','editor' )
	);

	register_post_type( 'teacher', $args );
	endif;
}
}
endif;

/*-------------------------------------------------------
 *             Teachers Texonomy
*-------------------------------------------------------*/
if( !function_exists('tx_teachers_taxonomy') ) :
add_action( 'init', 'tx_teachers_taxonomy'); 
function tx_teachers_taxonomy() {
	global $tx;
	if(isset($tx['teachers_post_type'])) {
	if(isset($tx['teachers-cat-slug']) && $tx['teachers-cat-slug'] != ''){
		$teachers_cat_slug = $tx['teachers-cat-slug'];
	} else {
		$teachers_cat_slug = 'teachers-category';
	}
		if(isset($tx['teachers_title'])) :
		$tt = $tx['teachers_title'];
		register_taxonomy(
		'teachers-category',  
		'teacher',                  	//post type name
		array(
			'hierarchical'          => true,
			'label'                 => esc_html__($tt.' Catagory', 'education-pro-core'),  //Display name
			'query_var'             => true,
			'show_admin_column'     => true,
			'rewrite'               => array(
			'slug'                  => $teachers_cat_slug, // This controls the base slug that will display before each term
			'with_front'    		=> true // Don't display the category base before
				)
			)
		);
		endif;
	
}
}
endif;
/*-------------------------------------------------------
 *    Teachers texonomy filter show at backend
*-------------------------------------------------------*/
function tx_teachers_taxonomy_filter( $post_type, $which ) {

  // Apply this only on a specific post type
  if ( 'teacher' !== $post_type )
    return;

  // A list of taxonomy slugs to filter by
  $taxonomies = array( 'teachers-category' );

  foreach ( $taxonomies as $taxonomy_slug ) {

    // Retrieve taxonomy data
    $taxonomy_obj = get_taxonomy( $taxonomy_slug );
    $taxonomy_name = $taxonomy_obj->labels->name;

    // Retrieve taxonomy terms
    $terms = get_terms( $taxonomy_slug );

    // Display filter HTML
    echo "<select name='{$taxonomy_slug}' id='{$taxonomy_slug}' class='postform'>";
    echo '<option value="">' . sprintf( esc_html__( 'Show All %s', 'text_domain' ), $taxonomy_name ) . '</option>';
    foreach ( $terms as $term ) {
      printf(
        '<option value="%1$s" %2$s>%3$s (%4$s)</option>',
        $term->slug,
        ( ( isset( $_GET[$taxonomy_slug] ) && ( $_GET[$taxonomy_slug] == $term->slug ) ) ? ' selected="selected"' : '' ),
        $term->name,
        $term->count
      );
    }
    echo '</select>';
  }

}
add_action( 'restrict_manage_posts', 'tx_teachers_taxonomy_filter' , 10, 2);


/*-------------------------------------------------------
 *             EOF
*-------------------------------------------------------*/