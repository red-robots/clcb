<?php
/**
 * Template part for displaying page content in page.php.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package ACStarter
 */
global $post;
$has_post_parent = ( isset($post->post_parent) && $post->post_parent ) ? $post->post_parent : '';
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<?php  
		$post_id = get_the_ID();
		$subpage_banner = get_field('banner_image',$post_id);
		$bannerImageURL = ( isset($subpage_banner['url']) && $subpage_banner['url'] ) ? $subpage_banner['url'] : '';
		$display_title = true;
		if($bannerImageURL || has_post_thumbnail() ) {
			$display_title = false;
		}
	?>

	<?php if ($display_title) { ?>
	<header class="entry-header">
		<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
	</header><!-- .entry-header -->
	<?php } ?>
	
	<div class="entry-content">
		<?php the_content(); ?>
	</div><!-- .entry-content -->

	
</article><!-- #post-## -->
