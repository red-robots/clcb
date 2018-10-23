<?php
/**
 * 
 * Template Name: Practice Areas
 *
 * @package ACStarter
 */

get_header(); ?>
<div id="primary" class="content-area">
    <main id="main" class="site-main" role="main">
        <?php while ( have_posts() ) : the_post();
            if( get_the_content() ) {
                get_template_part( 'template-parts/intro' );
            } ?>

            <?php if( have_rows('practice_areas') ) { ?>
            <div class="practice-areas clear">
                <div class="masonry">
                <?php $i=1; while( have_rows('practice_areas') ) : the_row(); 
                    $title = get_sub_field('practice_area_title'); 
                    $text = get_sub_field('practice_area_text'); ?>
                    <div class="masonry-brick">
                        <div class="pad">
                            <h2 class="p-title"><?php echo $title;?></h2>
                            <div class="p-content"><?php echo $text;?></div>
                        </div>
                    </div>
                <?php $i++; endwhile; ?>
                </div>
            </div>
            <?php } ?>
    

        <?php endwhile; ?>
    </main><!-- #main -->
</div><!-- #primary -->
    
<?php
get_footer();
