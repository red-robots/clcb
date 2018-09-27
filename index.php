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
$quote_description=get_field('quote_description');
$content_section_2_title=get_field('content_section_2_title');
$content_section_2_text=get_field('content_section_2_text');
$content_section_2_image=get_field('content_section_2_image');
$learn_more_link=get_field('learn_more_link');
$content_section_3_title=get_field('content_section_3_title');
$content_section_3_text=get_field('content_section_3_text');
$content_section_3_image=get_field('content_section_3_image');
$learn_more_link_2=get_field('learn_more_link_2');

$first_box_image=get_field('first_box_image');
$first_box_title=get_field('first_box_title');
$first_box_link=get_field('first_box_link');
$second_box_image=get_field('second_box_image');
$second_box_title=get_field('first_box_title');
$second_box_link=get_field('second_box_link');
$third_box_title=get_field('third_box_title');
$third_box_image=get_field('third_box_image');
$third_box_link=get_field('third_box_link');

$box_images = array('first_box_image','second_box_image','third_box_image');
$box_title = array('first_box_title','second_box_title','third_box_title');
$box_link = array('first_box_link','second_box_link','third_box_link');

?>
	<div id="primary" class="content-area-full">
		<main id="main" class="site-main" role="main">
			<div class="home-opener">
				<?php if($quote_description) { ?>
					<div class="quote-desc"><?php echo nl2br($quote_description); ?></div>
				<?php } ?>
			</div>

			<?php if ($content_section_2_image) { ?>
				<div class="row home-content-1" style="background-image:url('<?php echo $content_section_2_image['url']; ?>')">
					<img src="<?php echo $content_section_2_image['url']; ?>" alt="<?php echo $content_section_2_image['alt']; ?>" style="display:none;">
			<?php } else { ?>
				<div class="row home-content-1 no-bg-image">
			<?php } ?>
				<div class="tile right transparentbg">
					<div class="flexwrap clear">
						<?php if($content_section_2_title) { ?>
							<h2><?php echo $content_section_2_title; ?></h2>
						<?php } ?>
						<?php if($content_section_2_title) { ?>
							<div class="copy"><?php echo $content_section_2_text; ?></div>
						<?php } ?>
					</div>
				</div>
			</div>

			<div class="row home-content-2">
				<div class="textwrapper">
					<?php if($content_section_3_title) { ?>
						<h2 class="h2-title"><?php echo $content_section_3_title; ?></h2>
					<?php } ?>
					<?php if($content_section_3_title) { ?>
						<div class="copy"><?php echo nl2br($content_section_3_text); ?></div>
					<?php } ?>
					<div class="button buttondiv clear text-center">
						<a href="<?php echo $learn_more_link_2; ?>"><span>learn more</span></a>
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
							<img src="<?php echo $box_img_src['url']; ?>" alt="<?php echo $box_img_src['title']; ?>">
					<?php } else { ?>
					<div class="link no-image">
						<div class="inner clear">
					<?php } ?>
							<div class="overlay">
								<a href="<?php echo $box_permalink; ?>">
									<div class="flex">
										<h2><?php echo $box_title_txt; ?></h2>
									</div>
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
