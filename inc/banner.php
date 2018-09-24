<?php 
if(is_front_page()) {
	$wp_query = new WP_Query(array('post_status'=>'private','pagename'=>'homepage'));
		if ( have_posts() ) : the_post(); 
			$banner=get_field('main_banner');
			$tagline=get_field('tagline');
		?>
			<div class="banner">
				<img src="<?php echo $banner['url']; ?>"  alt="<?php echo $banner['alt']; ?>">
				<div class="tagline">
					<?php echo $tagline; ?>
				</div>
			</div>
		<?php endif;
} else {
	$tagline=get_field('tagline');
	if(has_post_thumbnail()) { ?>
		<div class="banner">
			<?php the_post_thumbnail(); ?>
			<div class="quote">
				<?php echo $tagline; ?>
			</div>
		</div>
		
	<?php }
}

 ?>