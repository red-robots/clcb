<?php 
if( is_front_page() ) {
	$wp_query = new WP_Query(array('post_status'=>'private','pagename'=>'homepage'));
		if ( have_posts() ) : the_post(); 
			
			$banner=get_field('main_banner');
			$tagline=get_field('tagline');
			$quote=get_field('quote');
			if($banner) { ?>
           
               
               <section class="flatbanner">
               		<?php if($tagline) { ?>
               		<header><h2><?php echo $tagline; ?></h2></header>
               		<?php } ?>
               		<img src="<?php echo $banner['url']; ?>" alt="<?php echo $banner['alt']; ?>">
               </section>
                           
                            
			<?php } ?>

		<?php endif;
} else {
	$quote = get_field('quote');
	$subpage_banner = get_field('banner_image');
	$bannerImageURL = ( isset($subpage_banner['url']) && $subpage_banner['url'] ) ? $subpage_banner['url'] : '';
	$bannerAltTxt = ( isset($subpage_banner['title']) && $subpage_banner['title'] ) ? $subpage_banner['title'] : '';
	$page_title = get_the_title($post_id);
    $parentId = wp_get_post_parent_id( $post_id );
	if( !is_archive() ) { ?>

		<?php if ($bannerImageURL) { ?>
        	<section class="flatbanner">
        		<header><h1><?php the_title(); ?></h1></header>
           		<img src="<?php echo $subpage_banner['url']; ?>" alt="<?php echo $subpage_banner['alt']; ?>">
           </section>  
        <?php } ?>

	<?php } ?>

<?php
}
?>