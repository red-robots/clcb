<?php
global $wp_query,$post;
$post_id = ( isset($post->ID) && $post->ID ) ? $post->ID : 0;
$query = isset($wp_query->query) ? $wp_query->query : '';
$post_type = ( isset($query['post_type']) ) ? $query['post_type'] : '';
?>
<?php
    if( $post_type=='team' && is_single() ) {
        $pp_id = get_page_id_with_field('_our_promise_title');
        $our_team_id = 72;
        $page_title = get_the_title($our_team_id);
        $quote = get_field('quote',$post_id);
        $bannerImageURL = '';
        if( $pp_id ) {
            $banner_image = get_field('banner_image',$pp_id);
            $bannerImageURL = ( isset($banner_image['url']) && $banner_image['url'] ) ? $banner_image['url'] : '';
        }
        ?>

        <?php if ($bannerImageURL) { ?>
        <div class="banner-outer-wrap clear">
			<div class="subpage banner has-image" style="background-image:url('<?php echo $bannerImageURL; ?>')">
            </div>
            <div class="quote quotediv clear">
                <div class="pagetitlediv"><div class="innerpad animated fadeInDown"><h1 class="page-title"><?php echo $page_title; ?></h1></div></div>
                <div class="yshape svgArt clear">
                    <?php if ( strip_tags($quote) ) { ?>
                        <div class="pad quotetext animated slideInRight"><?php echo $quote; ?></div>
            	   <?php } ?>
                   <?php  get_template_part('template-parts/yshape'); ?>
                </div>
            </div>  
        </div>    
        <?php } ?>
<?php } ?>