<?php
/**
 * Template Name: Contact
 * 
 *
 * @package ACStarter
 */

get_header(); ?>

	<div id="primary" class="content-area ourteam text-left-align clear">
		<main id="main" class="site-main" role="main">
			<?php while ( have_posts() ) : the_post(); ?>
                <h2 class="title_line_bottom">Locations</h2>
				<?php if( get_the_content() ) {
					get_template_part( 'template-parts/content', 'page' );
				}
			
            ?>
            
            <?php
                /* Locations */
                $locations[] = array(
                        'name'=>'Charlotte',
                        'address1'=>get_field('charlotte_address_line_1','option'),
                        'address2'=>get_field('charlotte_address_line_2','option'),
                        'phone1'=>get_field('charlotte_phone_1','option'),
                        'phone2'=>get_field('charlotte_phone_2','option'),
                        'google_map'=>get_field('charlotte_google_map','option')
                    );
                $locations[] = array(
                        'name'=>'New York',
                        'address1'=>get_field('new_york_address_line_1','option'),
                        'address2'=>get_field('new_york_address_line_2','option'),
                        'phone1'=>get_field('new_york_phone_1','option'),
                        'phone2'=>get_field('new_york_phone_2','option'),
                        'google_map'=>get_field('new_york_google_map','option')
                    );
            ?>
            <div class="locationsInfo clear">
                <div class="flexbox-contact">
                    <?php foreach($locations as $loc) { ?>
                    <div class="box box1">
                        <div class="bg"><div></div></div>
                        <div class="pad clear">
                            <div class="pad2 clear">
                                <h3><?php echo $loc['name']; ?></h3>
                                <div class="info"><?php echo $loc['address1']; ?></div>
                                <div class="info"><?php echo $loc['address2']; ?></div>
                                <div class="info"><?php echo $loc['phone1']; ?></div>
                                <div class="info"><?php echo $loc['phone2']; ?></div>
                                <div class="map-wrapper">
                                <?php if( $loc['google_map'] ) { ?>
                                    <?php echo $loc['google_map']; ?>
                                <?php } ?>
                                </div>
                            </div>    
                        </div>
                    </div>
                    <?php } ?>
                </div>
            </div>
            
            <?php
                /* Submit Your Resume */
                $submit_title = get_field('submit_resume_title');
                $column1 = get_field('column_details_1');
                $button_option = get_field('button_link_options');
                $button_text = get_field('column_button_text_1');
                $button_field = $button_option . '_link';
                $button_link = get_field($button_field);
                $button_pagelink = ($button_link) ? $button_link : '#';
                $column2 = get_field('column_details_2');
                $form_title = get_field('form_title');
                $form_note = get_field('form_note');
                $contact_form_shortcode = get_field('contact_form_shortcode');
            ?>
                <h2 class="submit-title"><?php echo $submit_title;?></h2>
                <div class="flexbox-contact clear submit-resume-info">
                    
                    <?php if($column1) { ?>
                    <div class="box box1">
                        <div class="bg"><div></div></div>
                        <div class="pad">
                            <?php echo $column1; ?>
                            <div class="button buttondiv clear">
                                <a href="<?php echo $button_pagelink;?>"><span><?php echo ($button_text) ? $button_text:'Submit';?></span></a>
                            </div>
                        </div>
                    </div>
                    <?php } ?>
                    
                    <?php if($column2) { ?>
                    <div class="box box1">
                        <div class="bg"><div></div></div>
                        <div class="pad">
                            <?php echo $column2; ?>
                        </div>
                    </div>    
                    <?php } ?>
                    
                </div>
                    
                <h2 class="submit-title"><?php echo $form_title;?></h2>
                <?php if($form_note) { ?>
                <div class="form-note-text">
                    <?php echo $form_note; ?>
                </div>
                <?php } ?>
            
                <?php if($contact_form_shortcode) { ?>
                <div class="contact-form-wrapper clear">
                    <?php if( $shortcode = do_shortcode($contact_form_shortcode) ) { ?>
                        <?php echo $shortcode; ?>
                        <div class="button buttondiv clear">
                            <a id="submitButton"><span>Submit</span></a>
                        </div>
                    <?php } ?>
                </div>
                <?php } ?>
            <?php endwhile; ?> 
            
            
		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_footer();
