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
?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main clear" role="main">
            
            
            <?php /* MEMBER DETAILS */ ?>
            <?php if( $post_type=='team' ) { ?>
                
                <?php while ( have_posts() ) : the_post();  
                    $post_id = get_the_ID();
                    $personal_note = get_field('personal_note',$post_id);
                    $title = get_field('title',$post_id);
                    $img = get_field('team_individual_image',$post_id);
                    $img_src = ( isset($img['url']) && $img['url'] ) ? $img['url']:'';
                    $img_alt = ( isset($img['title']) && $img['title'] ) ? $img['title']:'';
                    $atts = '';
                    if($img) {
                        $atts = "style='background-image:url(".$img_src.");'";
                    }
                ?>
                    
                    <div class="m_imagecol">
                        <div class="inner clear">
                            <div class="m_photo" <?php echo $atts?>></div>
                            <div class="m_info clear">
                                <div class="smtxt"><strong>On a personal note</strong></div>
                                <div class="note"><?php echo $personal_note; ?></div>
                            </div>
                        </div>    
                    </div>
                    <div class="m_description_col">
                        <div class="inner clear">
                            <h2 class="m_title line_bottom"><?php echo get_the_title()?></h2>
                            <?php the_content(); ?>
                            
                            <?php if( is_user_logged_in() ) { ?>
                            <footer class="entry-footer edit-post-div">
                                <?php acstarter_entry_footer(); ?>
                            </footer><!-- .entry-footer -->
                            <?php } ?>
                        </div>
                    </div>
                
                <?php endwhile; ?>
            
            <?php }  else { ?>
            
                <?php /* SINGLE POST */ ?>
                <?php while ( have_posts() ) : the_post();

                    get_template_part( 'template-parts/content', get_post_format() );

                    the_post_navigation();

                    // If comments are open or we have at least one comment, load up the comment template.
                    if ( comments_open() || get_comments_number() ) :
                        comments_template();
                    endif;

                endwhile; // End of the loop. ?>
            
            <?php }  ?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php get_footer();
