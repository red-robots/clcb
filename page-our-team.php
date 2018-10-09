<?php
/**
 * 
 * This template is only for NEWS page.	
 *
 * @package ACStarter
 */

get_header(); ?>

	<div id="primary" class="content-area ourteam text-left-align clear">
		<main id="main" class="site-main" role="main">
			<?php
			while ( have_posts() ) : the_post();

				if( get_the_content() ) {
					get_template_part( 'template-parts/content', 'page' );
				}

			endwhile; // End of the loop.
			?>

			<?php  
			$args = array(
				'posts_per_page'   => -1,
				'orderby'          => 'date',
				'order'            => 'DESC',
				'post_type'        => 'team',
				'post_status'      => 'publish'
				);
			$teams = new WP_Query($args);
			if ( $teams->have_posts() ) { ?>
			<div class="flex-container teamlist clear">
				<?php while ( $teams->have_posts() ) : $teams->the_post(); 
                    $post_id = get_the_ID();
                    $post_thumbnail_id = get_post_thumbnail_id( $post_id );
                    $title = get_field('title',$post_id);
                    $img = get_field('team_individual_image',$post_id);
                    $img_src = '';
                    $img_alt = '';
                    if($img) {
                        $img_src = $img['url'];
                        $img_alt = $img['title'];
                    }
                ?>
                <div class="member-info">   
                    <div class="inner clear">
                        <?php if($img_src) { ?>
                            <div class="image-wrap has-image" style="background-image:url('<?php echo $img_src;?>')">
                                <img src="<?php echo $img_src; ?>" alt="<?php echo $img_alt; ?>" style="display:none;"/>
                            </div>
                        <?php } else { ?>
                            <div class="image-wrap no-image">
                                <span><i class="fa fa-user" aria-hidden="true"></i></span>
                            </div>
                        <?php } ?>
                        <div class="member-details">
                            <div class="divider">
                                <svg enable-background="new 0 0 276.2 70.9" version="1.1" viewBox="0 0 276.2 70.9" xml:space="preserve" xmlns="http://www.w3.org/2000/svg">
                                    <polygon class="st0" points="276.2 71.1 0 71.1 0 1.1 15.3 1.1 32 30.4 47 1.1 276.2 1.1"/>
                                    <polyline class="st1" points="0 1.1 15.5 1.1 32 30.4 47 1 276.2 0.8"/>
                                    <line class="st1" x1="32.3" x2="32" y1="44.1" y2="29.4"/>
                                    <circle class="st2" cx="32.2" cy="45.8" r="4.1"/>
                                </svg>
                            </div>
                            <div class="nameWrap">
                                <h4 class="name"><?php echo get_the_title(); ?></h4>
                                <div class="title"><?php echo ($title) ? $title : '<span class="na">N/A</span>';?></div>
                            </div>
                            <div class="link"><a class="btn_effect" href="<?php echo get_permalink(); ?>"><span>Full Bio</span></a></div>
                        </div>
                    </div>
                </div>
				<?php endwhile; wp_reset_postdata(); ?>
			</div>
			<?php } ?>
            
            
		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_footer();
