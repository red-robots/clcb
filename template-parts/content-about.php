<?php
global $post;
$post_id = ( isset($post->ID) && $post->ID ) ? $post->ID : 0;
?>

<?php  
    /* OUR PROMISE */
	$promise_title = get_field('our_promise_title',$post_id);
	$promise_image = get_field('our_promise_image',$post_id);
	$promise_text = get_field('our_promise_text',$post_id);
	$promise_bg = '';
	$promise_class = 'no-image';
	if($promise_image) {
		$promise_class = 'has-image';
		$promise_img_src = $promise_image['url'];
		$promise_bg = 'style="background-image:url('.$promise_img_src.')"';
	}
    
    if ($promise_text) { ?>
	<div class="promise-info clear wrap-image <?php echo $promise_class?>" <?php echo $promise_bg?>>
		<div class="tile left transparentbg">
			<div class="flexwrap clear">
                <div class="inside clear">
                    <h2 class="op-title"><?php echo $promise_title; ?></h2>
                    <div class="copy">
                        <?php echo nl2br($promise_text); ?>
                    </div>
                </div>
			</div>
		</div>
	</div>
<?php } ?>

<?php  
/* Jacks and Jills... */
$content_2_title = get_field('content_2_title',$post_id);
$content_2_text = get_field('content_2_text',$post_id);
$content_2_learn_more_link = get_field('learn_more_link',$post_id);
if ($content_2_text) { ?>
	<div class="jack_jill content2_wrap whitediv clear">
		<div class="textwrapper clear">
			<h2 class="h2-title title_line_bottom"><?php echo $content_2_title; ?></h2>
			<div class="copy"><?php echo $content_2_text; ?></div>
			<div class="button buttondiv clear">
				<a href="<?php echo ($content_2_learn_more_link) ? $content_2_learn_more_link:'#'?>"><span>learn more</span></a>
			</div>
		</div>
	</div>
<?php } ?>


<?php
/* HISTORY */
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
<div class="content3-info clear wrap-image">
	<div class="imagediv flexcol <?php echo $content3Class?>" <?php echo $content3bg?>>
		<?php if ($content_3_image) { ?>
			<img src="<?php echo $content_3_image['url'] ?>" alt="<?php echo $content_3_image['title'] ?>" style="display:none;">
		<?php } ?>
	</div>
	<div class="textdiv flexcol">
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