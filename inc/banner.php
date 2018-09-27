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
	if( !is_archive() ) {

		if(has_post_thumbnail()) { ?>
			<div class="subpage banner has-image">
				<div class="pagetitlediv"><div class="innerpad"><h1 class="page-title"><?php echo $page_title; ?></h1></div></div>
				<?php the_post_thumbnail(); ?>
				<div class="quote">
					<div class="pad"><?php echo $tagline; ?></div>
				</div>
			</div>
		<?php } else { ?>

			<?php if ($bannerImageURL) { ?>
			<div class="subpage banner has-image" style="background-image:url('<?php echo $bannerImageURL; ?>')">
				<img class="banner-image" src="<?php echo $banner['url']; ?>"  alt="<?php echo $bannerAltTxt; ?>" style="display:none;">
				<div class="pagetitlediv"><div class="innerpad animated fadeInDown"><h1 class="page-title"><?php echo $page_title; ?></h1></div></div>
			</div>
			<div class="quote quotediv clear animated slideInRight">
				<div class="pad"><?php echo $quote; ?></div>
			</div>	
			<?php } ?>

		<?php } ?>

	<?php } ?>

<?php
}
?>