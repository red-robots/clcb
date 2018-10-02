<?php 
global $post;
$post_id = ( isset($post->ID) && $post->ID ) ? $post->ID : 0;
if(is_front_page()) {
	$wp_query = new WP_Query(array('post_status'=>'private','pagename'=>'homepage'));
		if ( have_posts() ) : the_post(); 
			$banner=get_field('main_banner');
			$tagline=get_field('tagline');
			$quote=get_field('quote');
			if($banner) { ?>
			<div class="banner" style="background-image:url('<?php echo $banner['url']; ?>')">
				<img class="banner-image" src="<?php echo $banner['url']; ?>"  alt="<?php echo $banner['alt']; ?>" style="display:none;" />
				<div class="tagline animated fadeInUp">
					<div class="pad"><?php echo $quote; ?></div>
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
    if($parentId) {
        $page_title = get_the_title($parentId);
    }
    
	if( !is_archive() ) { ?>

		<?php if ($bannerImageURL) { ?>
        <div class="banner-outer-wrap clear">
			<div class="subpage banner has-image" style="background-image:url('<?php echo $bannerImageURL; ?>')">
				<img class="banner-image" src="<?php echo $bannerImageURL; ?>"  alt="<?php echo $bannerAltTxt; ?>" style="display:none;">
				<div class="pagetitlediv"><div class="innerpad animated fadeInDown"><h1 class="page-title"><?php echo $page_title; ?></h1></div></div>
            </div>
            <div class="quote quotediv clear">
                <div class="pad quotetext animated slideInRight"><?php echo $quote; ?></div>
                <div class="banner-bottom svgArt">
                   <svg enable-background="new 0 0 412.2 52.6" version="1.1" viewBox="0 0 412.2 52.6" xml:space="preserve" xmlns="http://www.w3.org/2000/svg">
                        <polygon class="st0" points="412.2 52.6 0 52.6 0 1.1 15.3 1.1 32 30 47 1.1 412.2 1.1"/>
                        <polyline class="st1" points="0 1.1 15.5 1.1 32 30.4 47 1 412.2 0.8"/>
                        <line class="st1" x1="32.3" x2="32" y1="44.1" y2="29.4"/>
                        <circle class="st2" cx="32.2" cy="45.8" r="3.3"/>
                    </svg>
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