<?php 
    $checkTitle = get_post_meta( get_the_ID(), "title-bar", true );
?>

<!-- Blog -->
<section  id="blog" class="blogSection">
  <span class="menuSpace" id="<?php echo esc_attr($post->post_name);?>"></span>
    <div class="wrap">

        <div class="container clearfix <?php  if ( $checkTitle != 0 ){	?> exPageTitleSpace <?php } ?>">

            <?php get_template_part( 'templates/page-title' ); ?>

        </div>

        <!-- blog post items -->
        <div id="content">
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

                            get_template_part( 'templates/loop', 'blog' );
                        }
                    }

                    wp_reset_postdata();
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
    </div>
</section>
<!-- End Blog -->