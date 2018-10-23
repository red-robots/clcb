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
        <div class="banner-outer-wrap clear single-banner">
            <div class="banner" style="background-image:url('<?php echo $bannerImageURL; ?>')">
                <div class="banner-bottom-text clear">
                    <div class="leftdiv"><div id="triangle-left"></div></div>
                    <div class="rightdiv">
                        <div class="left-skew"></div>
                        <div id="triangle-right"></div>
                        <?php if ( $the_page_title ) { ?>
                        <div class="titlediv">
                            <div class="top-triangle"></div>
                            <div class="title"><h2 class="ptitle"><?php echo $the_page_title; ?></h2></div>
                        </div>
                        <?php } ?>
                        
                        <?php if( $post_type=='position' && $email ) { ?>
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
                        
                        
                        <?php if( $post_type=='team') { 
                            $args = array(
                                    'posts_per_page'   => -1,
                                    'orderby'          => 'date',
                                    'order'            => 'DESC',
                                    'post_type'        => 'team',
                                    'post_status'      => 'publish'
                            );
                            $teams = get_posts($args);
        
                        ?>
                        <div class="quote-container other-team-members <?php echo ($teams) ? 'has-members':'no-members'?>">
                            <div class="bg"></div>
                            <div class="inner">
                                <?php if($teams) { ?>
                                    <?php 
                                    $s_show = get_field('show_on_team_page',$post_id); 
                                    $show_navi = ($s_show=='no') ? false : true;
                                    if($show_navi) { ?>
                                        <div id="viewMemberList" class="om_title">
                                            <div class="skew"></div>
                                            <span class="txt">
                                                <span>Other Team Members</span> 
                                                <i class="arrow down"></i>
                                            </span>
                                        </div>
                                        <div id="otherMembers" class="dropdownList">
                                            <ul>
                                                <?php foreach($teams as $tm) {  
                                                $mem_id = $tm->ID;
                                                $member_name = get_the_title($mem_id);
                                                $pagelink = get_permalink($mem_id);
                                                $show = get_field('show_on_team_page',$mem_id);
                                                $is_show = ($show=='no') ? false : true;
                                                if($is_show) {
                                                        if($post_id!=$mem_id) { ?> 
                                                            <li><a href="<?php echo $pagelink;?>"><?php echo $member_name;?></a></li>
                                                        <?php } ?>
                                                    <?php } ?>
                                                <?php } ?>
                                            </ul>
                                        </div>
                                    <?php } ?>
                                <?php } ?>
                            </div>
                        </div>
                        <?php } ?>
                        
                    </div>
                </div>
            </div>
        </div>
    <?php } ?>

<?php } 