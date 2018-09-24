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
// $tagline=get_field('tagline');
?>
	<div id="primary" class="content-area-full">
		<main id="main" class="site-main" role="main">
			<div class="home-opener">
				<?php if($quote_homepage) { ?>
					<div class="quote"><?php echo $quote_homepage; ?></div>
				<?php } ?>
				<?php if($quote_description) { ?>
					<div class="quote-desc"><?php echo $quote_description; ?></div>
				<?php } ?>
			</div>
			<div class="row">
				<div class="tile left js-blocks lineheight">
					<img src="<?php echo $content_section_2_image['url']; ?>" alt="<?php echo $content_section_2_image['alt']; ?>">
				</div>
				<div class="tile right  js-blocks">
					<div class="flexwrap">
						<?php if($content_section_2_title) { ?>
							<h2><?php echo $content_section_2_title; ?></h2>
						<?php } ?>
						<?php if($content_section_2_title) { ?>
							<div class="copy"><?php echo $content_section_2_text; ?></div>
						<?php } ?>
						<div class="forceleft">
							<div class="button">
								<a href="<?php echo $learn_more_link; ?>"><span>learn more</span></a>
							</div>
						</div>
						
					</div>
				</div>
			</div>
			<div class="row">
				<div class="tile right  js-blocks lineheight">
					<img src="<?php echo $content_section_2_image['url']; ?>" alt="<?php echo $content_section_2_image['alt']; ?>">
				</div>
				<div class="tile left  js-blocks">
					<div class="flexwrap">
						<?php if($content_section_3_title) { ?>
							<h2><?php echo $content_section_3_title; ?></h2>
						<?php } ?>
						<?php if($content_section_3_title) { ?>
							<div class="copy"><?php echo $content_section_3_text; ?></div>
						<?php } ?>
						<div class="forceleft">
							<div class="button">
								<a href="<?php echo $learn_more_link_2; ?>"><span>learn more</span></a>
							</div>
						</div>
					</div>
				</div>
			</div>
			<section class="home-thirds">
				<div class="link">
					<img src="<?php echo $first_box_image['url']; ?>">
					<div class="overlay">
						<a href="<?php echo $first_box_link; ?>">
							<div class="flex">
								<h2><?php echo $first_box_title; ?></h2>
							</div>
						</a>
					</div>
				</div>
				<div class="link">
					<img src="<?php echo $second_box_image['url']; ?>">
					<div class="overlay">
						<a href="<?php echo $second_box_link; ?>">
							<div class="flex">
								<h2><?php echo $second_box_title; ?></h2>
							</div>
						</a>
					</div>
				</div>
				<div class="link">
					<img src="<?php echo $third_box_image['url']; ?>">
					<div class="overlay">
						<a href="<?php echo $third_box_link; ?>">
							<div class="flex">
								<h2><?php echo $third_box_title; ?></h2>
							</div>
						</a>
					</div>
				</div>
			</section>
		</main><!-- #main -->
	</div><!-- #primary -->
<?php endif; ?>
	

<?php
get_footer();
