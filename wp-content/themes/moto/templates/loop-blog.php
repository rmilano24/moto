<?php 

    $attachment_id = 6;
    $image = wp_get_attachment_image_src(get_post_thumbnail_id(), 'large');
    
    //check social share is Enable or not
    $socialshare = get_post_meta( get_the_ID(), "post-social-share", true );
    
?>

<div class="blog_loop_item">
    <div  <?php post_class('togglePost'); ?> id="post_<?php the_ID(); ?>">

        <!-- Desktop Blog -->
        <div class="desktopBlog">
            <div class="container">
            
                <div class="blogAccordion accordionClosed" data-value="0" style="background-image: url('<?php  echo esc_url($image[0]); ?> ')">
                
                    <div class="accordion_box2">
                        <div class="accordion_title" >
                            <!-- blog Post date - day -->
                            <span class="day"><?php echo ( get_the_time('d') ); ?></span>
                        </div>
                    </div>
                    
                    <div class="accordion_box10">
                        <!-- blog Post date -->
                        <div class="leftBorder">

                            <!-- Post title  -->
                            <div class="blogTitle">
                                <?php the_title(); ?>
                            </div>
                            
                            <div class="monthYear">
                                <span class="month"><?php echo ( get_the_time('M') ); ?></span>
                                <span class="year"><?php echo( get_the_time('Y') ); ?></span>
                            </div>
                                                                
                        </div>
                    </div>

                    <div class="accordion_content">
                        <!-- blog Post text -->
                        <p>
                            <?php $excerpt = get_the_excerpt();
                                echo $excerpt;
                            ?>
                            <a class="moretag hidden-phone" href="<?php the_permalink(get_the_ID()) ?>"><?php _e('[ Read more ]', 'epicomedia') ?> </a>
                        </p>
                        
                        <div class="readmoreLine"></div>
                            <a class="moretag visible-phone" href="<?php the_permalink(get_the_ID()) ?>"><?php _e('[ Read more ]', 'epicomedia') ?> </a>

                        <?php if( $socialshare == 1 ) { ?>
                            <div class="blog_social_share hidden-phone">
                                <!-- social share buttons -->
                                <div class="socialShareContainer">
                                    <div class="social_share_toggle">
                                        <i class="icon-share2"></i>
                                        <?php get_template_part('templates/social-share'); ?>
                                    </div>
                                </div>
                            </div>
                        <?php } ?>
                        
                    </div>
                    
                    <!-- gray Overlay -->
                    <div class="grayOverlay"></div>
                    
                    <div class="clearfix"></div>

                    <!-- Toggle Opening Handel  -->
                    <div class="plus span12"></div>
                    <div class="minus span12"></div>

                </div>
                
            </div>
        </div>
    </div>
</div>