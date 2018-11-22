<?php
/**
 * Template Name: Leadership
 *
 * @package ACStarter
 */
get_header(); ?>

<div id="primary" class="content-area clear text-left-align">
    <main id="main" class="site-main clear mtop" role="main">
        <?php
        while ( have_posts() ) : the_post();
            if( get_the_content() ) {
                get_template_part( 'template-parts/intro' );
            }
        ?>
        
        <?php if( have_rows('services') ) { ?>
        <div class="wrapper">
        <div class="leadership-services clear">
            <div class="tablist">
                <ul id="leadershipTabs">
                <?php $i=1; while( have_rows('services') ) : the_row(); 
                    $title = get_sub_field('title'); 
                    $text = get_sub_field('text'); ?>
                    <li id="tab<?php echo $i;?>" class="tab<?php echo ($i==1) ? ' active':''?>">
                        <div class="inside">
                            <a href="#tabcontent<?php echo $i;?>"><span><?php echo $title;?></span></a>
                        </div>
                    </li>
                    <li class="content-mobile<?php echo ($i==1) ? ' active':''?>">
                        <div class="m-content"><?php echo $text;?></div>
                    </li>
                <?php $i++; endwhile; ?>
                </ul>
            </div>
            <div class="tabcontent">
                <?php $p=1; while( have_rows('services') ) : the_row();  
                $text = get_sub_field('text'); ?>
                <div id="tabcontent<?php echo $p;?>" class="text<?php echo ($p==1) ? ' active':''?>">
                    <div class="pad"><?php echo $text;?></div>
                </div>
                <?php $p++; endwhile; ?>
            </div>
        </div>
        </div>
        <?php } ?>
        
        <?php  endwhile; ?>

    </main><!-- #main -->
</div><!-- #primary -->

<?php
get_footer();
