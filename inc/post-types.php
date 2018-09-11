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
  
  } // close custom post type