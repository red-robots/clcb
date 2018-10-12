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
$exclude = array('team');
?>
<div class="topShape"><span></span></div>
<div class="single-outer-wrap wrapmid clear">
    <div id="primary" class="content-area">
        <main id="main" class="site-main clear" role="main">
            
                <?php /* SINGLE POST */ ?>
                <?php while ( have_posts() ) : the_post(); $postId = get_the_ID(); ?>

                    <header class="entry-header">
                        <?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
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
    <?php get_sidebar(); ?>
</div>
<?php get_footer();
