<?php
global $wp_query;
$query = isset($wp_query->query) ? $wp_query->query : '';
$post_type = ( isset($query['post_type']) ) ? $query['post_type'] : '';
?>
<?php
    if( $post_type=='team' && is_single() ) {
        $pp_id = get_page_id_with_field('_our_promise_title');
        $bannerImageURL = '';
        if( $pp_id ) {
            $banner_image = get_field('banner_image',$pp_id);
            $bannerImageURL = ( isset($banner_image['url']) && $banner_image['url'] ) ? $banner_image['url'] : '';
        }
        ?>

        <?php if ($bannerImageURL) { ?>
        <div class="banner-outer-wrap clear">
            <div class="subpage banner has-image" style="background-image:url('<?php echo $bannerImageURL; ?>')">
                <div class="pagetitlediv"><div class="innerpad animated fadeInDown"><h1 class="page-title">Our Professionals</h1></div></div>
            </div>
            <div class="quote quotediv clear">
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