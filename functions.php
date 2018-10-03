<?php
/**
 * ACStarter functions and definitions.
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package ACStarter
 */

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/theme-setup.php';

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/scripts.php';

/**
 * Custom Post Types.
 */
require get_template_directory() . '/inc/post-types.php';

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';

/**
 * Post Pagination
 */
require get_template_directory() . '/inc/pagination.php';

/**
 * Social
 */
require get_template_directory() . '/inc/social-media-links.php';

/**
 * Theme Specific additions.
 */
require get_template_directory() . '/inc/theme.php';

/**
 * Block & Disable All New User Registrations & Comments Completely.
 * Description:  This simple plugin blocks all users from being able to register no matter what, 
 *				 this also blocks comments from being able to be inserted into the database.
 */
require get_template_directory() . '/inc/block-all-registration-and-comments.php';

/**
 * Customizer additions.
 */
// require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
require get_template_directory() . '/inc/jetpack.php';


function wpb_mce_buttons_2($buttons) {
    array_unshift($buttons, 'styleselect');
    return $buttons;
}
add_filter('mce_buttons_2', 'wpb_mce_buttons_2');

function ii_mce_before_init_insert_formats( $init_array ) {
	$style_formats = array(  
        array(  
            'title' => 'Red Border Button',  
            'block' => 'span',  
            'classes' => 'red-button button',
            'wrapper' => true
        )
    );  
    // Insert the array, JSON ENCODED, into 'style_formats'
    $init_array['style_formats'] = json_encode( $style_formats );  
    return $init_array;
}
add_filter( 'tiny_mce_before_init', 'ii_mce_before_init_insert_formats' ); 

function ii_theme_add_editor_styles() {
    add_editor_style( 'editor-style.css' );
}
add_action( 'init', 'ii_theme_add_editor_styles' );

function truncate($text, $chars = 120) {
    if(strlen($text) > $chars) {
        $text = $text.' ';
        $text = substr($text, 0, $chars);
        $text = substr($text, 0, strrpos($text ,' '));
        $text = $text.'...';
    }
    return $text;
}

function get_page_id_with_field($meta_key) {
    global $wpdb;
    $post_id = '';
    if($meta_key) {
        $results = $wpdb->get_row( "SELECT * FROM {$wpdb->prefix}postmeta WHERE meta_key = '".$meta_key."'", OBJECT );
        if($results) {
            $post_id = $results->post_id;
        }
    }   
    return $post_id;
}

function friendly_string($string) {
    $string = strtolower($string);
    $string = preg_replace("/[^a-z0-9_\s-]/", "", $string);
    $string = preg_replace("/[\s-]+/", " ", $string);
    $string = preg_replace("/[\s_]/", "_", $string);
    return $string;
}

function generate_sitemap() {
    global $wpdb;
    $lists = array();
    $menus = wp_get_nav_menu_items('main-menu');
    $news_ID = 112;
    $cat_args = array('hide_empty' => 1, 'parent' => 0);
    $menu_orders = array();
    $menu_with_children = array();
    if($menus) {
        $i=0;
        foreach($menus as $m) {
            $page_id = $m->object_id;
            $menu_title = $m->title;
            $page_url = $m->url;
            $post_parent = $m->post_parent;
            $submenu = array();
            if($post_parent) {
                $submenu = array(
                        'id'=>$page_id,
                        'title'=>$menu_title,
                        'url'=>$page_url
                    );
                $menu_with_children[$post_parent][$page_id] = $submenu;
            } else {
                $menu_orders[$page_id] = $menu_title;
            } 
            $i++;
        }
    }
    
    //print_r($menu_orders);
    //print_r($menu_with_children);
    
    $results = $wpdb->get_results( "SELECT ID,post_title FROM {$wpdb->prefix}posts WHERE post_type = 'page' AND post_status='publish' AND post_parent=0 ORDER BY post_title ASC", OBJECT );
    if($results) {
        foreach($results as $row) {
            $id = $row->ID;
            $page_title = $row->post_title;
            $page_link = get_permalink($id);
            if(array_key_exists($id,$menu_orders)) {
                $page_title = $menu_orders[$id];
            }
            
            $lists[$id]['parent_id'] = $id;
            $lists[$id]['parent_title'] = $page_title;
            $lists[$id]['parent_url'] = $page_link;
            
            if(array_key_exists($id,$menu_with_children)) {
                $lists[$id]['children'] = $menu_with_children[$id];
            }
            
            if($id == $news_ID) {
                $lists[$id]['categories'] = get_categories($cat_args);
            }
        }
    }
    
    return $lists;
    
}

