<?php
/**
 * 
 * Template Name: Current Assignements
 *
 * @package ACStarter
 */

get_header(); ?>

	<div id="primary" class="content-area text-left-align clear">
		<main id="main" class="site-main mtop" role="main">
                <?php
                while ( have_posts() ) : the_post();

                    if( get_the_content() ) {
                        get_template_part( 'template-parts/intro' );
                    }

                endwhile; // End of the loop.
                ?>

            <?php
            $paged = ( get_query_var( 'paged' ) ) ? absint( get_query_var( 'paged' ) ) : 1;
            $pagenum = 16;
            $args = array(
                'posts_per_page'   => $pagenum,
                'post_type'        => 'position',
                'post_status'      => 'publish',
                'paged'			   => $paged,
                'tax_query'        => array( 
                        array(
                            'taxonomy' => 'status',
                            'field'    => 'slug',
                            'terms'    => 'active' 
                        ),
                    ) 
                );
            $items = new WP_Query($args);
            if ( $items->have_posts() ) { ?>
            <div class="wrapper">
            <div class="textwrapper assignmentlist clear current">
                <div class="row clear">
                    <div class="flex-container clear">
                        <?php while ( $items->have_posts() ) : $items->the_post(); ?>
                        <div class="boxed-item">
                            <div class="inner clear">
                                <a class="link hvr-rectangle-out" href="<?php echo get_permalink(); ?>">
                                    <i class="arrowtop"></i>
                                    <span class="title"><?php echo get_the_title(); ?></span>
                                </a>
                            </div>
                        </div>
                        <?php endwhile; wp_reset_postdata(); ?>
                    </div>  
                </div>


                <?php
                    $total_pages = $items->max_num_pages;
                    if ($total_pages > 1){ ?>

                        <div id="pagination" class="pagination-wrapper clear">
                            <?php
                                $the_paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
                                $pagination = array(
                                    'base' => @add_query_arg('paged','%#%'),
                                    'format' => '?paged=%#%',
                                    'mid-size' => 1,
                                    'current' => $the_paged,
                                    'total' => $total_pages,
                                    'prev_next' => True,
                                    'prev_text' => __( 'prev' ),
                                    'next_text' => __( 'next' )
                                );
                                echo paginate_links($pagination);
                            ?>
                        </div>
                        <?php
                } ?>

             </div>
            </div>
            <?php } ?>
        
        
        </main><!-- #main -->
        
		
	</div><!-- #primary -->

<?php
get_footer();
