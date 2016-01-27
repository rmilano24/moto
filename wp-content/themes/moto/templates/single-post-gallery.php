<?php 
     //check social share is Enable or not
    $socialshare = get_post_meta( get_the_ID(), "post-social-share", true );
?>
<div <?php post_class(); ?>>
    <div class="post-media">
        <?php

        $images = ep_get_meta('gallery');
        if(count($images))
        {?>
        
            <div class="bpSwiper swiper-container clearfix">
            
                <!-- Next Arrows -->
                <div class="arrows-button-next no-select">
                    <span class="text">
                        <?php _e('NEXT', 'epicomedia'); ?>
                    </span>
                </div>


                <!-- Prev Arrows -->
                <div class="arrows-button-prev no-select">
                    <span class="text">
                        <?php _e('PREV', 'epicomedia'); ?>
                    </span>
                </div>
        
                <div class="swiper-wrapper">
                
                    <?php

                       if ( ! is_array($images)) { ?>

                        <div class="swiper-slide">  <?php echo  "<img src=\"$images\" />"; ?> </div>
                    
                    <?php } else {

                        $imageSize = 'full';
                        foreach($images as $img)
                        {
                            //For getting image size use
                            //http://php.net/manual/en/function.getimagesize.php
                            $imgId = ep_get_image_id($img);
                            if($imgId == -1)//Fallback
                                $imgTag = "<img src=\"$img\" />";
                            else
                                $imgTag = wp_get_attachment_image($imgId, $imageSize);
                             
                            ?>

                            <div class="swiper-slide">  <?php echo $imgTag; ?> </div>

                        <?php
                        }
                    } ?>
                      
                </div>

            </div>
        <?php
        }?>
    </div>

    <?php
        get_template_part( 'templates/single', "post-meta" );
        the_content();
        wp_link_pages();
    ?>
    
    <div class="nav_box">
        <?php echo next_post_link('%link', '<div class="button right"><div class="frame top"><div></div></div><div class="frame right"><div></div></div><div class="frame bottom"><div></div></div><div class="frame left"><div></div></div><span class="txt">'. __('NEXT', 'epicomedia').'</span></div>'); ?>
        <?php echo previous_post_link('%link', '<div class="button right"><div class="frame top"><div></div></div><div class="frame right"><div></div></div><div class="frame bottom"><div></div></div><div class="frame left"><div></div></div><span class="txt">'. __('PREV', 'epicomedia').'</span></div>'); ?>
    </div>

</div>

<?php if ($socialshare== 1 )  { ?>

    <div class="bd_socail_share">
        <!-- social share buttons -->
        <div class="socialShareContainer">
            <div class="social_share_toggle">
                <i class="icon-share2"></i>
                <?php get_template_part('templates/social-share'); ?>
            </div>
        </div>    
    </div>
    
<?php } ?>
        
<div class="commentWrap">
    <?php
        $num_comments = get_comments_number();
        if ( $num_comments == 0 ) { } else { ?>
            <div class="commentTitle">
                <h3>
                    <span class="comment_count">
                        <?php comments_popup_link( __('0', 'epicomedia' ) , __('01', 'epicomedia' ) , __('%', 'epicomedia' ) ); ?>
                    </span>
                    <?php _e("COMMENTS", 'epicomedia'); ?>
                </h3>
            </div>
    <?php }  comments_template('', true); ?>
</div>