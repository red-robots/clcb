<?php
global $post;
$paged = ( get_query_var( 'pg' ) ) ? absint( get_query_var( 'pg' ) ) : 1;
$page_id = (isset($post->ID)) ? $post->ID : 0;
$perpage = get_field('completed_assignments_num_items',$page_id);
$page_title = get_field('completed_assignments_title',$page_id);
$page_description = get_field('completed_assignments_content',$page_id);

$pagenum = ($perpage) ? $perpage : 12;
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
        ),
    'paged'            => $paged     
    );
$items = new WP_Query($args);
if ( $items->have_posts() ) { ?>
<div class="textwrapper assignmentlist clear">
    <div class="divspinner"><img src="<?php echo get_stylesheet_directory_uri()?>/images/ajax-loader" alt="" /></div>
    <div class="reloaddiv clear">
        <div id="js_reload" class="outer_content_wrap clear">
            <div id="data_assignments" class="midwrapper">
                <div id="the_list_content" class="row clear">
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

            <?php
                $total_pages = $items->max_num_pages;
                if ($total_pages > 1){ ?>

                    <div id="pagination" class="pagination-wrapper clear assignment_pagination">
                        <div class="the_paginate_list clear">
                            <?php
                                $big = 999999999;
                                $pagination = array(
                                    'base' => @add_query_arg('pg','%#%'),
                                    'format' => '?paged=%#%',
                                    'current' => $paged,
                                    'total' => $total_pages,
                                    'prev_text' => __( '&laquo;', 'red_partners' ),
                                    'next_text' => __( '&raquo;', 'red_partners' ),
                                    'type' => 'plain'
                                );
                                echo paginate_links($pagination);
                            ?>
                        </div>
                    </div>
                    <?php
                }
            ?>
        </div>
    </div>
</div>

<?php } ?>