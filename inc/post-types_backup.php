<?php 
/* Custom Post Types */

add_action('init', 'js_custom_init');
function js_custom_init() 
{
	
	// Register the Homepage Team
  
     $labels = array(
	'name' => _x('Team', 'post type general name'),
    'singular_name' => _x('Team', 'post type singular name'),
    'add_new' => _x('Add New', 'Team'),
    'add_new_item' => __('Add New Team'),
    'edit_item' => __('Edit Team'),
    'new_item' => __('New Team'),
    'view_item' => __('View Team'),
    'search_items' => __('Search Team'),
    'not_found' =>  __('No Team found'),
    'not_found_in_trash' => __('No Team found in Trash'), 
    'parent_item_colon' => '',
    'menu_name' => 'Team'
  );
  $args = array(
	'labels' => $labels,
    'public' => true,
    'publicly_queryable' => true,
    'show_ui' => true, 
    'show_in_menu' => true, 
    'query_var' => true,
    'rewrite' => true,
    'capability_type' => 'post',
    'has_archive' => false, 
    'hierarchical' => false, // 'false' acts like posts 'true' acts like pages
    'menu_position' => 20,
    'supports' => array('title','editor','custom-fields','thumbnail'),
	
  ); 
  register_post_type('team',$args); // name used in query
  
  // Add more between here
    // Register the Homepage Success Story
  
    $labels = array(
        'name' => _x('Success Story', 'post type general name'),
        'singular_name' => _x('Success Story', 'post type singular name'),
        'add_new' => _x('Add New', 'Success Story'),
        'add_new_item' => __('Add New Success Story'),
        'edit_item' => __('Edit Success Story'),
        'new_item' => __('New Success Story'),
        'view_item' => __('View Success Story'),
        'search_items' => __('Search Success Story'),
        'not_found' =>  __('No Success Story found'),
        'not_found_in_trash' => __('No Success Story found in Trash'), 
        'parent_item_colon' => '',
        'menu_name' => 'Success Story'
    );
    
    $args = array(
        'labels' => $labels,
        'public' => true,
        'publicly_queryable' => true,
        'show_ui' => true, 
        'show_in_menu' => true, 
        'query_var' => true,
        'rewrite' => true,
        'capability_type' => 'post',
        'has_archive' => false, 
        'hierarchical' => false, // 'false' acts like posts 'true' acts like pages
        'menu_position' => 20,
        'supports' => array('title','editor','custom-fields','thumbnail'),
    ); 
    register_post_type('story',$args); // name used in query
  // and here
    
    $labels = array(
        'name' => _x('Positions', 'post type general name'),
        'singular_name' => _x('Position', 'post type singular name'),
        'add_new' => _x('Add New', 'Position'),
        'add_new_item' => __('Add New Position'),
        'edit_item' => __('Edit Position'),
        'new_item' => __('New Position'),
        'view_item' => __('View Position'),
        'search_items' => __('Search Position'),
        'not_found' =>  __('No Position found'),
        'not_found_in_trash' => __('No Position found in Trash'), 
        'parent_item_colon' => '',
        'menu_name' => 'Positions'
    );
    
    $args = array(
        'labels' => $labels,
        'public' => true,
        'publicly_queryable' => true,
        'show_ui' => true, 
        'show_in_menu' => true, 
        'query_var' => true,
        'rewrite' => true,
        'capability_type' => 'post',
        'has_archive' => false, 
        'hierarchical' => false, // 'false' acts like posts 'true' acts like pages
        'menu_position' => 20,
        'supports' => array('title','editor','custom-fields','thumbnail'),
    ); 
    register_post_type('position',$args); // name used in query
  
  } // close custom post type


// Add new taxonomy, make it hierarchical (like categories)
add_action( 'init', 'ii_custom_taxonomies', 0 );
function ii_custom_taxonomies() {
  $labels = array(
    'name' => _x( 'Assignment Categories', 'taxonomy general name' ),
    'singular_name' => _x( 'Category', 'taxonomy singular name' ),
    'search_items' =>  __( 'Search Category' ),
    'popular_items' => __( 'Popular Category' ),
    'all_items' => __( 'All Categories' ),
    'parent_item' => __( 'Parent Category' ),
    'parent_item_colon' => __( 'Parent Category:' ),
    'edit_item' => __( 'Edit Category' ),
    'update_item' => __( 'Update Category' ),
    'add_new_item' => __( 'Add New Category' ),
    'new_item_name' => __( 'New Category' ),
  );
  register_taxonomy('position_categories',array('position'), array(
    'hierarchical' => true,
    'labels' => $labels,
    'show_ui' => true,
    'query_var' => true,
    'rewrite' => array( 'slug' => 'position_categories' ),
  ));
}

// Add the custom columns to the position post type:
add_filter( 'manage_position_posts_columns', 'set_custom_edit_position_columns' );
function set_custom_edit_position_columns($columns) {
    unset( $columns['date'] );
    unset( $columns['author'] );
    $columns['status'] = __( 'Assignment Status', 'acstarter' );
    $columns['date'] = __( 'Date', 'acstarter' );

    return $columns;
}

// Add the data to the custom columns for the book post type:
add_action( 'manage_position_posts_custom_column' , 'custom_position_column', 10, 2 );
function custom_position_column( $column, $post_id ) {
    switch ( $column ) {

        case 'status' :
            $status = get_field('assignment_status',$post_id);
            if($status) {
                echo ucwords($status);
            }
            else {
                echo 'N/A';
            }
            
            break;

    }
}