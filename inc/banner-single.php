<?php
global $wp_query, $post;
$post_id = ( isset($post->ID) ) ? $post->ID : 0;
$query = isset($wp_query->query) ? $wp_query->query : '';
$post_type = ( isset($query['post_type']) ) ? $query['post_type']:'';
$obj = get_default_single_banner($post_type);
if($obj) {
    $bannerImageURL = $obj['image_url'];
    $parent_id = $obj['parent_id'];
    $page_title = get_the_title($post_id);
    $email = get_field('institution_email',$post_id);
    $custom_title = get_field('custom_single_page_title',$parent_id);
    $the_page_title = ($custom_title) ? $custom_title : $page_title;
?>
    <?php if($bannerImageURL) { ?>
        <section class="flatbanner">
        		<header><h1><?php the_title(); ?></h1></header>
           		<img src="<?php echo $bannerImageURL; ?>" alt="<?php echo $subpage_banner['alt']; ?>">
           </section>  

<?php } }