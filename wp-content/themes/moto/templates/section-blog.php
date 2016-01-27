<!-- Blog -->
<section  id="blog" class="epicoSection blogSection">
    <h1 style="display:none!important"><?php the_title(); ?> </h1>
    <div id="<?php echo esc_attr($post->post_name);?>" class="wrap">
        <div class="container clearfix">
            <!-- headr title And Subtitle -->
            <?php
                $checkTitle = get_post_meta( get_the_ID(), "title-bar", true );
                $title = get_post_meta( get_the_ID(), "title-text", true );
                $subTitle = get_post_meta( get_the_ID() , "subtitle-text", true );
            ?>

            <?php  if ( (!empty( $subTitle ) || !empty( $title ) ) || $checkTitle == 2 ) { ?>
            
                <?php if ( $checkTitle == 1 ) { ?>
                    <div class="titleSpace">
                    
                        <?php if ( ( $checkTitle == 1 ) && ! empty( $title )) { ?>
                                
                            <div class="title"><h3><?php echo esc_attr($title); ?></h3></div>
                    
                        <?php } if (  ( $checkTitle == 1 ) && ! empty( $subTitle ) ) { ?>
                         
                            <div class="subtitle"><?php echo esc_attr($subTitle) ; ?></div>
                         
                        <?php } ?>
                        
                    </div>
                <?php }  if ( $checkTitle == 2  ) { ?>
                    
                    <div class="titleSpace">
                        <div class="title"><h3><?php the_title(); ?></h3></div>
                    </div>
                    
                <?php } ?>
                  
            <?php } ?>
            
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

                    if ( $main_query->have_posts() ) {
                        
                        while ($main_query->have_posts()) { $main_query -> the_post();

                            get_template_part( 'templates/loop', 'blog' );
                        }
                    
                    } else {
                        echo("No Post Found !");
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

    </div>
</section>
<!-- End Blog -->