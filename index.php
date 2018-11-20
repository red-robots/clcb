<?php
/**
 * The main template file.
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package ACStarter
 */

get_header(); 
/* Start the Loop */
$wp_query = new WP_Query(array('post_status'=>'private','pagename'=>'homepage'));
$is_home_page = ( is_front_page() ) ? true:false;
if ( have_posts() ) : the_post();

$quote_homepage=get_field('quote_homepage');
$quote_title=get_field('quote_title');
$quote_description=get_field('quote_description');
$content_section_2_title=get_field('content_section_2_title');
$content_section_2_text=get_field('content_section_2_text');
$content_section_2_image=get_field('content_section_2_image');
$learn_more_link=get_field('learn_more_link');
$learn_more_link_2=get_field('learn_more_link_2');
$tagline=get_field('tagline');

//$first_box_image=get_field('first_box_image');
//$first_box_title=get_field('first_box_title');
//$first_box_link=get_field('first_box_link');
//$second_box_image=get_field('second_box_image');
//$second_box_title=get_field('first_box_title');
//$second_box_link=get_field('second_box_link');
//$third_box_title=get_field('third_box_title');
//$third_box_image=get_field('third_box_image');
//$third_box_link=get_field('third_box_link');

$box_images = array('first_box_image','second_box_image','third_box_image');
$box_title = array('first_box_title','second_box_title','third_box_title');
$box_link = array('first_box_link','second_box_link','third_box_link');

$content_section_3_title=get_field('content_section_3_title');
$content_section_3_text=get_field('content_section_3_text');
$content_section_3_image=get_field('content_section_3_image');
$content_section_3_text=get_field('content_section_3_text');
$learn_more_link_3=get_field('learn_more_link_2');

?>
	<div id="primary" class="content-area-full">
		<main id="main" class="site-main" role="main">
			<div class="home-opener">

				<?php if($tagline) { ?>
					<div class="quote-desc">
						<header class="home-tagline"><h2><?php echo $tagline;?></h2></header>
					</div>
				<?php } ?>

				<div class="innerpad clear">
                <?php if($quote_description || $quote_title) { ?>
                    
					<div class="quote-desc">
                        <?php if($quote_title) { ?>
                            <h2 class="quoteTitle title_line_bottom"><?php echo $quote_title; ?></h2>
                        <?php } ?>
                        <?php if($quote_description) { ?>
                            <div class="qquoteContent"><?php echo nl2br($quote_description); ?></div>
                        <?php } ?>
                    </div>
				<?php } ?>
                </div>    
			</div>

			<?php if ($content_section_2_image) { ?>
				<div class="row content1 divCol2" style="background-image:url('<?php echo $content_section_2_image['url']; ?>')">
			<?php } else { ?>
				<div class="row content1 divCol2 no-bg-image">
			<?php } ?>
				<div class="tile right transparentbg">
					<div class="flexwrap clear">
                        <div class="inside clear">
                            <?php if($content_section_2_title) { ?>
                                <h2 class="text-red"><?php echo $content_section_2_title; ?></h2>
                            <?php } ?>
                            <?php if($content_section_2_text) { ?>
                                <div class="copy"><?php echo nl2br($content_section_2_text); ?></div>
                            <?php } ?>
                        </div>    
					</div>
				</div>
			</div>

			<?php if ($content_section_3_image) { ?>
				<div class="row content2 divCol2">
			         <div class="imageRight" style="background-image:url('<?php echo $content_section_3_image['url']; ?>')"></div>
            <?php } else { ?>
				<div class="row content2 divCol2 no-bg-image">
			<?php } ?>
				<div class="tile left transparentbg">
					<div class="flexwrap clear">
                        <div class="inside clear">
                            <?php if($content_section_3_title) { ?>
                                <h2 class="title_line_bottom"><?php echo $content_section_3_title; ?></h2>
                            <?php } ?>
                            <?php if($content_section_3_text) { ?>
                                <div class="copy"><?php echo nl2br($content_section_3_text); ?></div>
                                <div class="button buttondiv clear">
                                    <a href="<?php echo $learn_more_link_3; ?>"><span>learn more</span></a>
                                </div>
                            <?php } ?>
                        </div>    
					</div>
				</div>
			</div>
			
			<section class="home-thirds">

				<?php foreach ($box_images as $k => $img_field) { 
					$box_img_src = get_field($img_field);
					$box_title_txt = get_field($box_title[$k]); 
					$box_permalink = get_field($box_link[$k]);
					?>

					<?php if ($box_img_src) { ?>
					<div class="link has-image">
						<div class="inner clear" style="background-image:url('<?php echo $box_img_src['url']?>');">
							<img src="<?php echo $box_img_src['sizes']['square']; ?>" alt="<?php echo $box_img_src['title']; ?>">
					<?php } else { ?>
					<div class="link no-image">
						<div class="inner clear">
					<?php } ?>
							<div class="overlay">
								<a href="<?php echo $box_permalink; ?>">
									<span class="flex">
										<h2><?php echo $box_title_txt; ?></h2>
									</span>
								</a>
							</div>
						</div>
					</div>

				<?php } ?>
				
			</section>
		</main><!-- #main -->
	</div><!-- #primary -->
<?php endif; ?>
	

<?php
get_footer();
