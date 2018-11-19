<?php
/**
 * Template Name: Sitemap
 *
*/
get_header();
?>

<div id="primary" class="content-area clear text-left-align">
    <main class="wrapper clear" role="main">
        <?php  while ( have_posts() ) : the_post(); ?>
            <h1 class="page-title"><?php the_title();?></h1>
            <div class="entry-content"><?php the_content();?></div>
        <?php endwhile; ?>

        <?php get_template_part('template-parts/content', 'sitemap'); ?>

    </main><!-- #main -->
</div><!-- #primary -->

<?php
get_footer();
