<?php
/**
 * Template Name: Search Process
 * 
 * @package ACStarter
 */

get_header(); ?>

	<div id="primary" class="content-area ourteam text-left-align clear">
		<main id="main" class="site-main" role="main">
			<?php while ( have_posts() ) : the_post();
            if( get_the_content() ) {
                get_template_part( 'template-parts/intro' );
            }  ?>
            
            
            <?php
                $steps[] = array('step_1_title','step_1');
                $steps[] = array('step_2_title','step_2');
                $steps[] = array('step_3_title','step_3');
                $steps[] = array('step_4_title','step_4');
                $step_list = array();
                foreach($steps as $arr) {
                    $title = get_field($arr[0]);
                    $text = get_field($arr[1]);
                    if($title) {
                        $step_list[] = array($title,$text);
                    }
                }
            ?>
            
            <?php if($step_list) { ?>
            <div class="clear search-process">
                <div class="tablist">
                    <ul id="searchTabs">
                    <?php $i=1; foreach($step_list as $data) {
                    $s_title = $data[0];
                    $s_text = $data[1]; ?>
                        <li id="tab<?php echo $i;?>" class="tab<?php echo ($i==1) ? ' active':''?>">
                            <div class="wrap">
                                <div class="top">
                                    <a href="#tabcontent<?php echo $i;?>"><span><?php echo $s_title;?></span></a>
                                </div>
                                <div class="content clear">
                                    <div class="pad clear">
                                        <?php echo $s_text; ?>
                                    </div>
                                </div>
                            </div>    
                        </li>
                    <?php  $i++; } ?>
                    </ul>
                </div>
                
            </div>
             <?php } ?>
            
			<?php endwhile; ?>
            
		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_footer();
