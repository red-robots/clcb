<?php
/**
 * The template for displaying all single posts.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package ACStarter
 */
get_header(); 
global $wp_query;
$query = isset($wp_query->query) ? $wp_query->query : '';
$post_type = ( isset($query['post_type']) ) ? $query['post_type'] : '';
$obj = get_default_single_banner($post_type);
$parent_title = '';
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
    <div id="primary" class="content-area">
        <?php if($parent_title) { ?>
        <div class="breadcrumb clear" style="display:none;">
            <a href="<?php echo $parent_url?>"><?php echo $parent_title;?></a>
            <span class="sep">&raquo;</span>
            <span class="current"><?php the_title(); ?></span>
        </div>
        <?php } ?>
        <main id="main" class="site-main clear" role="main">
            <?php while ( have_posts() ) : the_post(); $postId = get_the_ID(); ?>
                
            <header class="entry-header">
                <?php the_title( '<h1 class="entry-title title_line_bottom">', '</h1>' ); ?>
            </header><!-- .entry-header -->
            
                <?php if(has_post_thumbnail()) { ?>
                <div class="single-featured-image clear">
                    <?php echo  get_the_post_thumbnail($postId);  ?>
                </div>
                <?php } ?>

                <div class="entry-content">
                    <?php the_content(); ?>
                </div><!-- .entry-content -->

                <?php if( is_user_logged_in() ) { ?>
                <footer class="entry-footer edit-post-div">
                    <span class="edit-link"><a href="<?php echo get_edit_post_link(get_the_ID()) ?>">Edit</a></span>
                </footer><!-- .entry-footer -->
                <?php } ?>

            <?php endwhile; ?>
        </main><!-- #main -->
    </div><!-- #primary --> 
</div>
<?php get_footer();
