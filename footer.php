<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package ACStarter
 */
$cadd1=get_field('charlotte_address_line_1', 'option');
$cadd2=get_field('charlotte_address_line_2', 'option');
$cphone1=get_field('charlotte_phone_1', 'option');
$cphone2=get_field('charlotte_phone_2', 'option');
$nadd1=get_field('new_york_address_line_1', 'option');
$nadd2=get_field('new_york_address_line_2', 'option');
$nphone1=get_field('new_york_phone_1', 'option');
$nphone2=get_field('new_york_phone_2', 'option');

$facebook=get_field('facebook_link', 'option');
$linkedin=get_field('linkedin_link', 'option');
?>

	</div><!-- #content -->

	<footer id="colophon" class="site-footer" role="contentinfo">
		<div class="wrapper">
			<div class="site-info left">
				<h3>Charlotte</h3>
				<?php if($cadd1) { ?>
					<div class="item"><?php echo $cadd1; ?></div>
				<?php } ?>
				<?php if($cadd2) { ?>
					<div class="item"><?php echo $cadd2; ?></div>
				<?php } ?>
				<?php if($cphone1) { ?>
					<div class="item"><?php echo $cphone1; ?></div>
				<?php } ?>
				<?php if($cphone2) { ?>
					<div class="item"><?php echo $cphone2; ?></div>
				<?php } ?>
			</div>
			<div class="site-info left">
				<h3>New York</h3>
				<?php if($nadd1) { ?>
					<div class="item"><?php echo $nadd1; ?></div>
				<?php } ?>
				<?php if($nadd2) { ?>
					<div class="item"><?php echo $nadd2; ?></div>
				<?php } ?>
				<?php if($nphone1) { ?>
					<div class="item"><?php echo $nphone1; ?></div>
				<?php } ?>
				<?php if($nphone2) { ?>
					<div class="item"><?php echo $nphone2; ?></div>
				<?php } ?>
			</div>
			<div class="site-info right">
				<div class="social">
					<?php if($facebook) { ?>
						<a target="_blank" href="<?php echo $facebook; ?>">
							<i class="fab fa-facebook-square"></i>
						</a>
					<?php } ?>
					<?php if($linkedin) { ?>
						<a target="_blank" href="<?php echo $linkedin; ?>">
							<i class="fab fa-linkedin"></i>
						</a>
					<?php } ?>
				</div>
				<div class="item">
					&copy;<?php date('Y'); ?> Coleman Lew Canny Bowen
				</div>
			</div>
	</div><!-- wrapper -->
	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
