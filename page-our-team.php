<?php
/**
 * Template Name: Our Team
 * 
 *
 * @package ACStarter
 */

get_header(); ?>

	<div id="primary" class="content-area ourteam text-left-align clear">
		<main id="main" class="site-main" role="main">
			<?php
			while ( have_posts() ) : the_post();

				if( get_the_content() ) {
					get_template_part( 'template-parts/intro' );
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
            <div class="wrapper">
			<div class="teamlist ">
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
                    $show = get_field('show_on_team_page',$post_id);
                    $is_show = ($show=='no') ? false : true;
                    if( $is_show ) { ?>
                    <div class="member-info">   
                        
                        <?php if($img_src) { ?>
                            <div class="image-wrap has-image">
                                <img src="<?php echo $img_src; ?>" alt="<?php echo $img_alt; ?>" />
                            </div>
                        <?php } else { ?>
                            <div class="image-wrap no-image">
                                <span><i class="fa fa-user" aria-hidden="true"></i></span>
                            </div>
                        <?php } ?>
                        <div class="member-details">
                        
                            <div class="nameWrap">
                                <h4 class="name"><?php echo get_the_title(); ?></h4>
                                <div class="title"><?php echo ($title) ? $title : '<span class="na">N/A</span>';?></div>
                            </div>
                        </div>
                        <div class="link">
                            <a class="btn_effect" href="<?php echo get_permalink(); ?>">
                                <span>Bio</span>
                            </a>
                        </div>

                        
                    </div>
                    <?php } ?>
				<?php endwhile; wp_reset_postdata(); ?>
			</div>
            </div>
			<?php } ?>
            
            
		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_footer();
