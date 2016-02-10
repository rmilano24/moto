<?php
/**
 * The main template file.
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 */
    get_header();

    // menu
    get_template_part('templates/section', 'nav');

    // blog Sidebar For Classic blog
    $blogSidebar = 'span9';

    $sidebar    = ep_get_meta('blog-sidebar');
    if($sidebar == 'no-sidebar' ) {
        $blogSidebar = 'span12';
    }

    $checkTitle = get_post_meta( get_the_ID(), "title-bar", true );



 ?>
    <!-- main-content wrap pass to djax -->
    <div class="main-content" id="main-content">
        <!--Content-->
        <div id="main">
	        <!-- Blog -->
	        <section class="cblog">
	            <span class="menuSpace" id="<?php echo esc_attr($post->post_name);?>"></span>
	            <div class="wrap">

	                 <?php  if ( $checkTitle == 1 ||  $checkTitle == 2 ) { ?>
	                    <div class="container clearfix <?php  if ( $checkTitle != 0 ){	?> exPageTitleSpace <?php } ?>">
	                        <?php get_template_part( 'templates/page-title' ); ?>
	                    </div>
	                <?php } ?>

			        <!-- blog post items -->
			        <div class="container" id="content">
				        <div class="row">

					        <div class="<?php echo esc_attr($blogSidebar); ?>">

	                            <div id="blogLoop">
						            <?php

							            $postpage = isset( $_GET['postpage'] ) ? (int) $_GET['postpage'] : 1;

							            $args2=array(
								            'post_type' => 'post',
								            'paged'          => $postpage
								            );

							            $main_query = new WP_Query($args2);

							            if ( have_posts() ) {
							            while ($main_query->have_posts()) { $main_query -> the_post();

									            global $post;
									            $postType = get_post_meta( get_the_ID() ,'media', true);

									            if ($postType == 'gallery' ) {
										            $postType = 'gallery';
									            } else if ($postType == 'video' ) {
										            $postType = 'video';
									            } else if ($postType == 'video_gallery' ) {
										            $postType = 'video';
									            } else if ($postType == 'audio' ){
										            $postType = 'audio';
									            } else if ($postType == 'audio_gallery' ) {
										            $postType = 'audio';
									            } else {
										            $postType = 'standard';
									            }
									            ?>

										            <div <?php post_class('clearfix'); ?>>

											            <?php  get_template_part( 'templates/loop', "blog-$postType" ); ?>

										            </div>
									            <?php
								            }
							            }
						            ?>
	                            </div>


	                            <?php if (have_posts()) { ?>

					                <!-- Single Page Navigation-->
					                <div class="pageNavigation clearfix">
						                <div class="navNext"><?php next_posts_link(__('&larr; Older Entries', 'epicomedia')) ?></div>
						                <div class="navPrevious"><?php previous_posts_link(__('Newer Entries &rarr;', 'epicomedia')) ?></div>
					                </div>

				                <?php } ?>

					        </div>

				            <?php  if( $sidebar !== 'no-sidebar' ) { ?>

				                <!-- Right Sidebar  -->
					            <div class="span3">
						            <?php  ep_get_sidebar('main-sidebar'); ?>
					            </div>


				            <?php } ?>

				        </div>
			        </div>

	            </div>
	        </section>
	        <!-- End Blog -->

	        <?php

	            $footerMap = get_post_meta($post->ID, "footer-map", true);

	            if ($footerMap == "1") {
	                //Footer Map
	                get_template_part('templates/section', 'location');
	            }

	            $widgetized_footer = get_post_meta($post->ID, "footer-widget-area", true);
	            if ($widgetized_footer == "1") {
	                //Footer Widgetized Area
	                get_template_part('templates/section', 'widgetized_footer');
	            }

	        ?>

    </div>
</div>

<?php get_footer();
