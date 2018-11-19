<?php
/**
 * The template for displaying all single posts.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package ACStarter
 */
get_header(); 
global $wp_query;
$query = isset($wp_query->query) ? $wp_query->query : '';
$post_type = ( isset($query['post_type']) ) ? $query['post_type'] : '';
$obj = get_default_single_banner($post_type);
$parent_title = '';
if($obj) {
    $bannerImageURL = $obj['image_url'];
    $parent_id = $obj['parent_id'];
    $parent_title = get_the_title($parent_id);
    $parent_url = get_permalink($parent_id);
    $email = get_field('institution_email',$post_id);
}
?>
<?php  
get_template_part('inc/banner-single');  
?>
<div id="primary" class="content-area full clear">
    <div class="wrapper clear">
        <div class="breadcrumb">
            <a href="<?php echo get_permalink(106);?>">Current Assignments</a>
            <span class="sep">&raquo;</span>
            <span class="current"><?php echo get_the_title();?></span>
        </div>

        <?php
            $for_who = get_field('for_who');
            $description = get_field('description');
            $additional_contact_info = get_field('additional_contact_info');
            $email = get_field('email');
            $phone_numbers = get_field('phone_numbers');
            $additional_info = array($additional_contact_info,$email,$phone_numbers);
            $has_contact_info = ($additional_info && array_filter($additional_info)) ? true : false;
        ?>
        <main class="content clear assignment-details">
            <?php if($description) { ?>
            <div class="entry-content"><?php echo $description;?></div>
            <?php } ?>

            <?php if($has_contact_info) { ?>
            <div class="additional-info">
                <h3 class="title">CONTACT INFORMATION:</h3>
                <?php if($additional_contact_info) { ?>
                <div class="data"><?php echo $additional_contact_info;?></div>
                <?php } ?>
                <?php if($email) { ?>
                <div class="data"><a href="mailto:<?php echo $email;?>"><?php echo $email;?></a></div>
                <?php } ?>
                <?php if($phone_numbers) { ?>
                <div class="data"><?php echo $phone_numbers;?></div>
                <?php } ?>
            </div>
            <?php } ?>
        </main> 
    </div>
</div><!-- #primary --> 
<?php get_footer();
