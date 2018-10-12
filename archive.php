<?php
/**
 * The template for displaying archive pages.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package ACStarter
 */

get_header(); ?>
<div class="topShape"><span></span></div>
<div class="archive-page-wrap single-outer-wrap wrapmid clear">
	<div id="primary" class="content-area ">
		<main id="main" class="site-main" role="main">
        <?php if ( have_posts() ) { ?>
            <header class="page-header">
				<?php
					the_archive_title( '<h1 class="entry-title title_line_bottom">', '</h1>' );
					the_archive_description( '<div class="taxonomy-description">', '</div>' );
				?>
			</header><!-- .page-header -->
            
            <div class="flex-container clear boxed-items news-list">
            <?php while ( have_posts() ) : the_post(); ?>
                <div class="excerpt postcol">
                    <div class="inner1 clear">
                        <h3 class="post-title"><?php the_title(); ?></h3>
                        <div class="post-excerpt">
                            <?php if ($content = get_the_content()) {
								$s_content = strip_shortcodes($content);
								$s_content = strip_tags($s_content); ?>
								<?php echo truncate($s_content,200); ?>
							<?php } ?>
                        </div>
                        <div class="post-link"><a href="<?php echo get_permalink()?>">Continue Reading <span>&rarr;</span></a></div>
                    </div>
                </div>
            <?php endwhile; ?>
            <?php the_posts_navigation(); ?>
            </div>
            
        <?php } ?>
        </main>
    </div>
    <?php get_sidebar(); ?>
    <div class="vdivider"></div>
</div>
<?php
get_footer();
