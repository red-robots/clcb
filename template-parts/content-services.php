<?php
global $post;
$post_id = ( isset($post->ID) && $post->ID ) ? $post->ID : 0;
?>
<?php  
	$services_1_title = get_field('services_1_title',$post_id);
	$services_1_text = get_field('services_1_text',$post_id);
	$services_1_image = get_field('services_1_image',$post_id);
	$services_1_button_text = get_field('services_1_button_text',$post_id);
	$services_1_button_link = get_field('services_1_button_link',$post_id);
	$service1bg = '';
	$service1_class = 'no-image';
	if($services_1_image) {
		$service1_class = 'has-image';
		$service1_img_src = $services_1_image['url'];
		$service1bg = 'style="background-image:url('.$service1_img_src.')"';
	}
?>

<?php if ($services_1_text) { ?>
	<div class="wrap-image clear two-column greydiv rowImg rowImg1 serviceinfo">
		<div class="imagediv" <?php echo $service1bg;?>>
			
		</div>
		<div class="tile textdiv">
			<div class="textwrapper clear">
				<h2 class="h2"><?php echo $services_1_title; ?></h2>
				<div class="copy"><?php echo $services_1_text; ?></div>
				<div class="button buttondiv clear">
					<a href="<?php echo $services_1_button_link; ?>"><span><?php echo $services_1_button_text; ?></span></a>
				</div>
			</div>
		</div>
	</div>
<?php } ?>

<?php  
	$services_2_title = get_field('services_2_title',$post_id);
	$services_2_text = get_field('services_2_text',$post_id);
	$services_2_image = get_field('services_2_image',$post_id);
	$services_2_button_text = get_field('services_2_button_text',$post_id);
	$services_2_button_link = get_field('services_2_button_link',$post_id);
	$service2bg = '';
	$service_class = 'no-image';
	if($services_2_image) {
		$service_class = 'has-image';
		$service_img_src = $services_2_image['url'];
		$service2bg = 'style="background-image:url('.$service_img_src.')"';
	}
?>
<?php if ($services_2_text) { ?>
	<div class="wrap-image clear two-column rowImg rowImg2 serviceinfo">
		<div class="imagediv" <?php echo $service2bg;?>>
			
		</div>
		<div class="tile textdiv">
			<div class="textwrapper clear">
				<h2 class="h2"><?php echo $services_2_title; ?></h2>
				<div class="copy"><?php echo $services_2_text; ?></div>
				<div class="button buttondiv clear">
					<a href="<?php echo $services_2_button_link; ?>"><span><?php echo $services_2_button_text; ?></span></a>
				</div>
			</div>
		</div>
		
	</div>
<?php } ?>
