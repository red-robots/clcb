<?php
/**
 * The template for displaying all single posts.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package ACStarter
 */
get_header(); 
global $wp_query, $post;
$post_id = ( isset($post->ID) ) ? $post->ID : 0;
$query = isset($wp_query->query) ? $wp_query->query : '';
$post_type = ( isset($query['post_type']) ) ? $query['post_type'] : '';
$obj = get_default_single_banner($post_type);
$parent_title = '';
$opt_show = get_field('show_on_team_page',$post_id); 
$show_dropdown_list = ($opt_show=='no') ? false : true;
if($obj) {
    $bannerImageURL = $obj['image_url'];
    $parent_id = $obj['parent_id'];
    $parent_title = get_the_title($parent_id);
    $parent_url = get_permalink($parent_id);
    $email = get_field('institution_email',$post_id);
}
?>
<?php  get_template_part('inc/banner-single');  ?>

    
<div class="single-outer-wrap wrapmid clear fullwidth has-breadcrumb">
    
    <?php if($show_dropdown_list) { ?>

    <?php
    $args = array(
        'post_type'=>'team',
        'posts_per_page' => -1
    );
    $wp_query = new WP_Query($args);
    //$wp_query->query();
    
    if ($wp_query->have_posts()) : ?>
        <div class="otherteam">
            <div class="dropdown-btn">
                Other Team Members <div class="rotate hover"><i class="far fa-plus"></i></div>
            </div>
            <div class="dropdown closed">
                <?php while ($wp_query->have_posts()) : $wp_query->the_post(); 
                    $postId = get_the_ID();
                    $show_option = get_field('show_on_team_page',$postId); 
                    $is_show_name =  ($show_option=='no') ? false : true;
                    if($is_show_name) { ?>
                    <li>
                        <a href="<?php the_permalink(); ?>">
                            <?php the_title(); ?>
                        </a>
                    </li>
                    <?php } ?>
                <?php endwhile; ?>
            </div>
        </div>
    <?php endif; wp_reset_query(); ?>
    
     <?php } ?>

    <div id="primary" class="content-area">
        <?php if($parent_title) { ?>
        <div class="breadcrumb clear" style="display:none;">
            <a href="<?php echo $parent_url?>"><?php echo $parent_title;?></a>
            <span class="sep">&raquo;</span>
            <span class="current"><?php the_title(); ?></span>
        </div>
        <?php } ?>
        <main id="main" class="site-main clear" role="main">
            <?php while ( have_posts() ) : the_post();  
                $post_id = get_the_ID();
                $personal_note = get_field('personal_note',$post_id);
                $title = get_field('title',$post_id);
                $img = get_field('team_individual_image',$post_id);
                $img_src = ( isset($img['url']) && $img['url'] ) ? $img['url']:'';
                $img_alt = ( isset($img['title']) && $img['title'] ) ? $img['title']:'';
                $atts = '';
                $classPic= 'no-photo';
                if($img) {
                    $atts = "style='background-image:url(".$img_src.");'";
                    $classPic = 'has-photo';
                }
            ?>
            
            <div class="m_imagecol <?php echo $classPic;?>">
                <div class="inner clear">
                    <div class="m_photo" <?php echo $atts?>>
                        <?php if(!$img) { ?>
                        <span class="nophotoIcon"><i class="fa fa-user"></i></span>
                        <?php } ?>
                    </div>
                    <div class="m_info clear">
                        <div class="smtxt red">
                            <?php if($title=='Founder') { ?>
                            <span class="large_txt"><strong><?php echo $title;?></strong></span>
                            <?php } else { ?>
                            <strong>But, wait! There's more.</strong>
                            <?php } ?>
                        </div>
                        <div class="note"><?php echo $personal_note; ?></div>
                    </div>
                </div>    
            </div>
            <div class="m_description_col">
                <div class="inner clear">
                    <header class="entry-header">
                        <?php the_title( '<h1 class="entry-title title_line_bottom">', '</h1>' ); ?>
                    </header>
                    <?php the_content(); ?>

                    <?php if( is_user_logged_in() ) { ?>
                    <footer class="entry-footer edit-post-div">
                        <?php acstarter_entry_footer(); ?>
                    </footer><!-- .entry-footer -->
                    <?php } ?>
                </div>
            </div>

            <?php endwhile; ?>
        </main><!-- #main -->
    </div><!-- #primary --> 
</div>
<?php get_footer();
