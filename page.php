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
global $post;
$post_id = get_the_ID();
$is_about_page = get_post_meta($post_id,'_our_promise_title');
$is_services_page = get_post_meta($post_id,'services_2_title');
$has_post_parent = ( isset($post->post_parent) && $post->post_parent ) ? $post->post_parent : '';
?>

<div id="primary" class="content-area clear text-left-align">
    <main id="main" class="site-main clear" role="main">
        <?php
        while ( have_posts() ) : the_post();

            if( get_the_content() ) {

                get_template_part( 'template-parts/content', 'page' );
            }

        endwhile; // End of the loop.
        ?>

    </main><!-- #main -->

    <?php /* ABOUT PAGE */ ?>
    <?php if( $is_about_page && !$has_post_parent ) { ?>
        <?php get_template_part('template-parts/content', 'about'); ?>
    <?php } ?>

    <?php /* SERVICES PAGE */ ?>
    <?php if( $is_services_page && !$has_post_parent ) { ?>
        <?php get_template_part('template-parts/content', 'services'); ?>
    <?php } ?>
</div><!-- #primary -->

<?php
get_footer();
