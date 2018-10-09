<?php 
global $post;
$post_id = ( isset($post->ID) && $post->ID ) ? $post->ID : 0;
$is_home_page = ( is_front_page() || is_home() ) ? true : false;
if( $is_home_page ) {
	$wp_query = new WP_Query(array('post_status'=>'private','pagename'=>'homepage'));
		if ( have_posts() ) : the_post(); 
			$banner=get_field('main_banner');
			$tagline=get_field('tagline');
			$quote=get_field('quote');
			if($banner) { ?>
            <div class="banner-outer-wrap clear">
                <div class="banner" style="background-image:url('<?php echo $banner['url']; ?>')">
                    <div class="tagline hometagline">
                        <?php if ( strip_tags($quote) ) { ?>
                        <div class="pad animated fadeInDown"><?php echo $tagline; ?></div>
                        <?php } ?>
                        <div class="yshape svgArt grey"><?php  get_template_part('template-parts/yshape'); ?></div>
                    </div>
                </div>
            </div>
			<?php } ?>

		<?php endif;
} else {
	$tagline=get_field('tagline');
	$quote=get_field('quote');
	$subpage_banner = get_field('banner_image');
	$bannerImageURL = ( isset($subpage_banner['url']) && $subpage_banner['url'] ) ? $subpage_banner['url'] : '';
	$bannerAltTxt = ( isset($subpage_banner['title']) && $subpage_banner['title'] ) ? $subpage_banner['title'] : '';
	$page_title = get_the_title($post_id);
    $parentId = wp_get_post_parent_id( $post_id );
    
    global $wp_query;
    $query = isset($wp_query->query) ? $wp_query->query : '';
    $post_type = ( isset($query['post_type']) ) ? $query['post_type'] : '';
    //if($parentId) {
        //$page_title = get_the_title($parentId);
    //}
    
	if( !is_archive() ) { ?>

		<?php if ($bannerImageURL) { ?>
        <div class="banner-outer-wrap clear">
			<div class="subpage banner has-image" style="background-image:url('<?php echo $bannerImageURL; ?>')">
            </div>
            <div class="quote quotediv clear">
                <div class="pagetitlediv"><div class="innerpad animated fadeInDown"><h1 class="page-title"><?php echo $page_title; ?></h1></div></div>
                <div class="yshape svgArt clear">
                    <?php if ( $string = strip_tags($quote) ) {
                        $total_str = strlen($string);
                        $resizeFont = ($total_str>=90) ? ' resizeFont':'';
                    ?>
                        <div class="pad quotetext animated slideInRight<?php echo $resizeFont; ?>"><?php echo $quote; ?></div>
            	   <?php } ?>
                   <?php  get_template_part('template-parts/yshape'); ?>
                </div>
            </div>  
        </div>   


        <?php } ?>

	<?php } ?>

    <?php if( $post_type=='team' && is_single() ) {
        get_template_part('template-parts/banner-staff');        
    } ?>

<?php
}
?>