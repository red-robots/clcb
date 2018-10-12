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
?>
    <?php if($bannerImageURL) { ?>
        <div class="banner-outer-wrap clear single-banner">
            <div class="banner" style="background-image:url('<?php echo $bannerImageURL; ?>')">
                <div class="banner-bottom-text clear">
                    <div class="leftdiv"><div id="triangle-left"></div></div>
                    <div class="rightdiv">
                        <div class="left-skew"></div>
                        <div id="triangle-right"></div>
                        <?php if ( $page_title ) { ?>
                        <div class="titlediv">
                            <div class="top-triangle"></div>
                            <div class="title"><h1 class="ptitle small"><?php echo $page_title; ?></h1></div>
                        </div>
                        <?php } ?>
                        
                        <?php if( $email ) { ?>
                        <div class="quote-container">
                            <div class="bg"></div>
                            <div class="inner">
                                <span class="email_link">
                                    <span class="icon"><i class="far fa-envelope"></i></span>
                                    <a href="mailto:<?php echo $email; ?>"><?php echo $email; ?></a>
                                </span>
                            </div>
                        </div>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
    <?php } ?>

<?php } 