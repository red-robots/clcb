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
                    <div class="banner-bottom-text clear">
                        <div class="leftdiv"><div id="triangle-left"></div></div>
                        <div class="rightdiv">
                            <div class="left-skew"></div>
                            <div id="triangle-right"></div>
                            <?php if ( strip_tags($tagline) ) { ?>
                            <div class="titlediv">
                                <div class="top-triangle"></div>
                                <div class="title"><h1 class="ptitle"><?php echo $tagline; ?></h1></div>
                            </div>
                            <?php } ?>
                            <div class="quote-container">
                                <div class="bg nocolor"></div>
                                <div class="inner"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
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
        <div class="banner-outer-wrap clear">
            <div class="banner inner-page" style="background-image:url('<?php echo $bannerImageURL; ?>')">
                <div class="banner-bottom-text clear">
                    <div class="leftdiv"><div id="triangle-left"></div></div>
                    <div class="rightdiv">
                        <div class="left-skew"></div>
                        <div id="triangle-right"></div>
                        <?php if ( $page_title ) { ?>
                        <div class="titlediv">
                            <div class="top-triangle"></div>
                            <div class="title"><h1 class="ptitle"><?php echo $page_title; ?></h1></div>
                        </div>
                        <div class="quote-container">
                            <div class="bg"></div>
                            <div class="inner"><?php echo $quote; ?></div>
                        </div>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>   
        <?php } ?>

	<?php } ?>

<?php
}
?>