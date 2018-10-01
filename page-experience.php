<?php
/**
 * 
 * This template is only for NEWS page.	
 *
 * @package ACStarter
 */

get_header(); ?>

	<div id="primary" class="content-area clear">
		<main id="main" class="site-main" role="main">
			<?php
			while ( have_posts() ) : the_post();

				if( get_the_content() ) {
					get_template_part( 'template-parts/content', 'page' );
				}

			endwhile; // End of the loop.
			?>
        </main><!-- #main -->

			<?php  
			$args = array(
				'posts_per_page'   => -1,
				'orderby'          => 'date',
				'order'            => 'ASC',
				'post_type'        => 'story',
				'post_status'      => 'publish'
			);
			$items = new WP_Query($args);
			if ( $items->have_posts() ) { ?>
			<div class="single-display-wrap success-stories clear">
                <div class="innerwrap clear">
                    <div id="story-carousel" class="wrapp clear">
                    <?php while ( $items->have_posts() ) : $items->the_post(); ?>
                        <div class="item-details">
                            <h2 class="item-title"><?php the_title(); ?></h2>
                            <div class="item-description"><?php the_content();?></div>
                        </div>
                    <?php endwhile; wp_reset_postdata(); ?>
                    </div>
                </div>
                <a class="s_prev s_navi"><span><i class="fa fa-chevron-left"></i></span></a>
                <a class="s_next s_navi"><span><i class="fa fa-chevron-right"></i></span></a>
			</div>
			<?php } ?>


		
	</div><!-- #primary -->

<?php
get_footer();
