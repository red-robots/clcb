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
		<?php
			the_content();

			wp_link_pages( array(
				'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'acstarter' ),
				'after'  => '</div>',
			) );
		?>
	</div><!-- .entry-content -->

	<footer class="entry-footer">
		<?php
			edit_post_link(
				sprintf(
					/* translators: %s: Name of current post */
					esc_html__( 'Edit %s', 'acstarter' ),
					the_title( '<span class="screen-reader-text">"', '"</span>', false )
				),
				'<span class="edit-link">',
				'</span>'
			);
		?>
	</footer><!-- .entry-footer -->
</article><!-- #post-## -->
