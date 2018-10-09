<?php
/**
 * 
 * This template is only for NEWS page.	
 *
 * @package ACStarter
 */

get_header(); ?>
<div class="news-archive archive archive-page-wrap wrapmid clear">
	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">
			<?php
			while ( have_posts() ) : the_post();

				if( get_the_content() ) {
					get_template_part( 'template-parts/content', 'page' );
				}

			endwhile; // End of the loop.
			?>

			<?php  
			$perpage = 9;
			$paged = ( get_query_var( 'paged' ) ) ? absint( get_query_var( 'paged' ) ) : 1;
			$args = array(
				'posts_per_page'   => $perpage,
				'orderby'          => 'date',
				'order'            => 'DESC',
				'post_type'        => 'post',
				'post_status'      => 'publish',
				'paged'			   => $paged
				);
			$news = new WP_Query($args);
			if ( $news->have_posts() ) { ?>
			<div class="flex-container clear boxed-items news-list">
				<?php while ( $news->have_posts() ) : $news->the_post(); ?>
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
				<?php endwhile; wp_reset_postdata(); ?>
			</div>
			<?php } ?>

			<?php
				$total_pages = $news->max_num_pages;
			    if ($total_pages > 1){ ?>

			        <div id="pagination" class="pagination-wrapper">
				        <?php
							$the_paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
						    $pagination = array(
						        'base' => @add_query_arg('paged','%#%'),
						        'format' => '?paged=%#%',
						        'mid-size' => 1,
						        'current' => $the_paged,
						        'total' => $total_pages,
						        'prev_next' => True,
						        'prev_text' => __( '<span class="fa fa-arrow-left"></span>' ),
						        'next_text' => __( '<span class="fa fa-arrow-right"></span>' )
						    );
						    echo paginate_links($pagination);
						?>
					</div>
					<?php
			    }
			?>

		</main><!-- #main -->
	</div><!-- #primary -->
    
    <?php get_sidebar(); ?>
    <div class="vdivider"></div>
    
</div>
<?php
get_footer();
