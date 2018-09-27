<?php
/**
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package ACStarter
 */
get_header();
$post_id = get_the_ID();
$is_about_page = get_post_meta($post_id,'_our_promise_title');
$is_services_page = get_post_meta($post_id,'_services_2_title');
?>
	<div id="primary" class="content-area clear">
		<main id="main" class="site-main clear" role="main">
			<?php
			while ( have_posts() ) : the_post();

				get_template_part( 'template-parts/content', 'page' );

				// If comments are open or we have at least one comment, load up the comment template.
				if ( comments_open() || get_comments_number() ) :
					comments_template();
				endif;

			endwhile; // End of the loop.
			?>

		</main><!-- #main -->

		<?php /* ABOUT PAGE */ ?>
		<?php if($is_about_page) { ?>
			<?php get_template_part('template-parts/content', 'about'); ?>
		<?php } ?>

		<?php /* SERVICES PAGE */ ?>
		<?php if($is_services_page) { ?>
			<?php get_template_part('template-parts/content', 'services'); ?>
		<?php } ?>


	</div><!-- #primary -->

<?php
get_footer();
