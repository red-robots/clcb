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
        ),
        array(  
            'title' => 'Red Type',  
            'block' => 'span',  
            'classes' => 'red',
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
    
    $results = $wpdb->get_results( "SELECT ID,post_title FROM {$wpdb->prefix}posts WHERE post_type = 'page' AND post_status='publish' AND post_parent=0 ORDER BY post_title ASC", OBJECT );
    $childPages = $wpdb->get_results( "SELECT ID,post_title,post_parent as parent_id FROM {$wpdb->prefix}posts WHERE post_type = 'page' AND post_status='publish' AND post_parent>0 ORDER BY post_title ASC", OBJECT );
    $childrenList = array();
    $childrenAll = array();
    /* child pages */
    if($childPages) {
        foreach($childPages as $cp) {
            $pId = $cp->parent_id;
            $iD = $cp->ID;
            $childrenAll[$iD] = array(
                                'id'=>$cp->ID,
                                'title'=>$cp->post_title,
                                'url'=>get_permalink($iD)
                            );
            $childrenList[$pId][] = array(
                                'id'=>$cp->ID,
                                'title'=>$cp->post_title,
                                'url'=>get_permalink($cp->ID)
                            );
        }
    }

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
            
            if($menu_with_children) {

                $ii_childrens = array();
                if(array_key_exists($id,$menu_with_children)) {
                    $ii_childrens = $menu_with_children[$id];
                    $lists[$id]['children'] = $ii_childrens;
                }

                /* Show children page even if does not exist on Menu dropdown */
                if($childrenList && array_key_exists($id, $childrenList)) {
                    $cc_children = $childrenList[$id];
                    $exist_children = $lists[$id]['children'];
                    
                    foreach($cc_children as $cd) {
                        $x_id = $cd['id'];
                        if(!array_key_exists($x_id, $ii_childrens)) {
                            $addon[$x_id] = $cd;
                            $exist_children[$x_id] = $cd;
                        }
                    } 

                    $lists[$id]['children'] = $exist_children;
                }

            } else {
                if($childrenList && array_key_exists($id, $childrenList)) {
                    $c_obj = $childrenList[$id];
                    $lists[$id]['children'] = $c_obj;
                }
            }



            
            if($id == $news_ID) {
                $lists[$id]['categories'] = get_categories($cat_args);
            }
        }
    }
    
    return $lists;
    
}

function get_default_single_banner($post_type) {
    global $wpdb;
    $results = $wpdb->get_row( "SELECT p.ID as post_id, p.post_title FROM {$wpdb->prefix}postmeta as m, {$wpdb->prefix}posts as p WHERE m.meta_value = '".$post_type."' AND m.post_id = p.ID AND p.post_type='page'", OBJECT );
    $object = array();
    if($results) {
        $postId = $results->post_id;
        $img_src = get_field('default_banner_single_page',$postId);
        $object['image_url'] = $img_src;
        $object['parent_id'] = $postId;
        $object['parent_title'] = $results->post_title;
    }
    
    return $object;
}

add_filter("gform_init_scripts_footer", "init_scripts");
function init_scripts() {
    return true;
}

add_action('admin_head', 'ii_custom_css_styles');
function ii_custom_css_styles() { ?>
    <style type="text/css">
        /* Contact TinyMce Style - Contact Page */
        #acf-group_5bc3f1e77346b iframe {
            height: 150px!important;
        }
    </style>
<?php }

function add_query_vars_filter( $vars ) {
  $vars[] = "pg";
  return $vars;
}
add_filter( 'query_vars', 'add_query_vars_filter' );