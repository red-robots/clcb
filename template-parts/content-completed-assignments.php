<?php
global $post;
$page_id = (isset($post->ID)) ? $post->ID : 0;
$perpage = get_field('completed_assignments_num_items',$page_id);
$page_title = get_field('completed_assignments_title',$page_id);
$page_description = get_field('completed_assignments_content',$page_id);

$pagenum = ($perpage) ? $perpage : 9;
$args = array(
    'posts_per_page'    => $pagenum,
    'orderby'           => 'date',
    'order'             => 'DESC',
    'post_type'         => 'position',
    'post_status'       => 'publish',
    'tax_query'         => array( 
            array(
                'taxonomy' => 'status',
                'field'    => 'slug',
                'terms'    => 'completed' 
            ),
        ) 
    );
$items = new WP_Query($args);
if ( $items->have_posts() ) { ?>
<div class="textwrapper assignmentlist clear">
    <div class="row clear">
        <div class="description1 clear text-center">
            <h2 class="title3 title_line_bottom"><?php echo $page_title;?></h2>
            <div class="test"><?php echo $page_description;?></div>
        </div>
        <div class="flex-container clear">
            <?php while ( $items->have_posts() ) : $items->the_post(); 
                $post_id = get_the_ID();
                $description = get_field('assignment_institution_name', $post_id);
            ?>
            <div class="boxed-item">
                <div class="inner clear">
                    <div class="icon"><span><i class="fa fa-check"></i></span></div>
                    <h4 class="title"><?php echo get_the_title(); ?></h4>
                    <div class="desc"><?php echo $description; ?></div>
                </div>
            </div>
            <?php endwhile; wp_reset_postdata(); ?>
        </div>  
    </div>
</div>
<?php } ?>