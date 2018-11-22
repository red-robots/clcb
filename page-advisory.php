<?php
/**
 * Template Name: Advisory Board
 *
 */
get_header();

$content = get_field('page__content');
$image = get_field('page__image');
?>

<div id="primary" class="content-area clear text-left-align">
    <main id="main" class="site-main clear nopadtop mtop" role="main">

        <?php if($content) { ?>
        <div class="clear wrap-image text-and-image auto-height white-bg our-promise">
            <article class="opening clear">
                <div class="imagediv image_col image_right">
                    <?php if($image) { ?>
                     <img src="<?php echo $image['url']; ?>" alt="<?php echo $image['title']; ?>" />
                    <?php } ?>
                </div>
                <div class="textdiv text_col text_left">
                    <div class="textwrapper clear">
                        <div class="copy">
                            <?php echo $content; ?>
                        </div>
                    </div>
                </div>
            </article>   
        </div>
        <?php } ?>
        

        <?php
        while ( have_posts() ) : the_post();
            if( get_the_content() ) { ?>
            <div class="article-wrap clear">
                <?php  get_template_part( 'template-parts/intro' ); ?>
            </div>
            <?php } ?>
        <?php endwhile; ?>

    </main><!-- #main -->
</div><!-- #primary -->

<?php
get_footer();
