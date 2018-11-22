<?php
/**
 * Template Name: About
 *
 */
get_header();
global $post;
$post_id = get_the_ID(); ?>

<div id="primary" class="content-area clear text-left-align">
   <main id="main" class="site-main" role="main">
       <?php  /* OUR PROMISE */ ?>
       <?php  
        $promise_title = get_field('our_promise_title',$post_id);
        $promise_image = get_field('our_promise_image',$post_id);
        $promise_text = get_field('our_promise_text',$post_id);
        $promise_bg = '';
        $promise_class = 'no-image';
        if($promise_image) {
            $promise_class = 'has-image';
            $promise_img_src = $promise_image['url'];
            $promise_bg = 'style="background-image:url('.$promise_img_src.')"';
        } ?>

        <?php if ($promise_text) { ?>
        <div class="clear wrap-image text-and-image auto-height white-bg our-promise">
            <article class="opening clear">
                <div class="imagediv image_col image_right">
                    <?php if($promise_image) { ?>
                     <img src="<?php echo $promise_image['url']; ?>" alt="<?php echo $promise_image['title']; ?>" />
                    <?php } ?>
                </div>
                <div class="textdiv text_col text_left">
                    <div class="textwrapper clear">
                        <div class="copy">
                            <?php if($promise_title) { ?>
                            <h2 class="h2-title"><?php echo $promise_title; ?></h2>
                            <?php } ?>
                            <?php echo nl2br($promise_text); ?>
                        </div>
                    </div>
                </div>
            </article>   
        </div>
        <?php } ?>


        <?php  /* OUR STORY */ ?>
        <?php
        $timelines = get_field('timelines'); 
        $meet_our_founder = get_field('meet_our_founder');
        ?>
        <div class="history-info clear">
            <div class="wrapper clear">
                <div class="entry-content history-text <?php echo ($timelines) ? 'half':'full';?>">
                <?php while ( have_posts() ) : the_post(); ?>
                   <?php the_content(); ?>
                <?php endwhile;  ?>
                </div>

                <?php if( $timelines ) { ?>
                <div class="history-timelines">
                <?php 
                $n=1; $tmcount = count($timelines);
                foreach ($timelines as $m) { 
                    $year = $m['year'];
                    $info = $m['info']; 
                    $first_class = ($n==1) ? ' first':'';
                    $last_class = ($tmcount==$n) ? ' last':'';
                    ?>
                    <div class="timeline-info<?php echo $first_class.$last_class;?>">
                        <div class="circle"></div>
                        <div class="year"><?php echo $year;?></div>
                        <div class="info"><?php echo $info;?></div>
                    </div>
                <?php $n++; } ?>

                    <?php if( $meet_our_founder ) { ?>
                    <div class="button-left button">
                        <a href="<?php echo $meet_our_founder;?>"><span>Meet Our Founder</span></a>
                    </div>
                    <?php } ?>

                </div>
                <?php } ?>

                <?php if( !$timelines ) { ?>
                    <?php if( $meet_our_founder ) { ?>
                    <div class="button-right button">
                        <a href="<?php echo $meet_our_founder;?>"><span>Meet Our Founder</span></a>
                    </div>
                    <?php } ?>
                <?php } ?>
                
            </div>
        </div>

        <?php  /* Jacks and Jills of all trade. */ ?>
        <?php  
        $content_2_title = get_field('content_2_title',$post_id);
        $content_2_text = get_field('content_2_text',$post_id);
        $content_2_image = get_field('content_2_image',$post_id);
        $content_2_learn_more_link = get_field('learn_more_link',$post_id);
        $image_col_class = '';
        if($content_2_image){
            $image_col_class = 'style="background-image:url('.$content_2_image['url'].')"';
        }
        if ($content_2_text) { ?>
            <div class="jack-jill clear wrap-image text-and-image">
                <div class="imagediv image_col image_right" <?php echo $image_col_class;?>>
                    <?php if($content_2_image) { ?>
                    <img src="<?php echo $content_2_image['url']?>" alt="<?php echo $content_2_image['title']?>" />
                    <?php } ?>
                </div>
                <div class="textdiv text_col text_left">
                    <div class="textwrapper clear">
                        <div class="copy">
                            <h2 class="h2-title"><?php echo $content_2_title; ?></h2>
                            <?php echo $content_2_text; ?>
                        </div>
                        <div class="button buttondiv clear buttondiv2">
                            <a href="<?php echo ($content_2_learn_more_link) ? $content_2_learn_more_link:'#'?>"><span>Learn More</span></a>
                        </div>
                    </div>
                </div>
            </div>
        <?php } ?>


        <?php  /* HISTORY */ ?>
        <?php
        $content_3_text = get_field('content_3_text',$post_id);
        $content_3_image = get_field('content_3_image',$post_id);
        $content_3_button_text = get_field('button_text',$post_id);
        $content_3_button_link = get_field('button_link',$post_id);
        $content3bg = '';
        $content3Class = 'no-image';
        if($content_3_image) {
            $content3Class = 'has-image';
            $content_3_img_src = $content_3_image['url'];
            $content3bg = 'style="background-image:url('.$content_3_img_src.')"';
        }
        ?>

        <?php if ($content_3_text) { ?>
        <div class="text-and-image clear wrap-image">
            <div class="imagediv image_col image_left <?php echo $content3Class?>" <?php echo $content3bg?>>
                <?php if($content_3_image) { ?>
                <img src="<?php echo $content_3_image['url']?>" alt="<?php echo $content_3_image['title']?>" />
                <?php } ?>
            </div>
            <div class="textdiv text_col text_right">
                <div class="textwrapper clear">
                    <div class="copy">
                        <?php echo $content_3_text; ?>
                    </div>
                    <div class="button buttondiv clear">
                        <a href="<?php echo ($content_3_button_link) ? $content_3_button_link:'#'?>"><span><?php echo $content_3_button_text; ?></span></a>
                    </div>
                </div>
            </div>
        </div>
        <?php } ?>
   </main>
</div><!-- #primary -->

<?php
get_footer();
