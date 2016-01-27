<?php get_template_part( 'templates/loop', "blog-meta" ); ?>
<div class="post-content">
    <div class="post-media">
    <?php
    $images= get_post_meta(get_the_ID(), 'gallery', true );
   
    if(is_array($images) && count($images))
    {?>

    <div class="bpSwiper swiper-container clearfix">
        <div class="swiper-wrapper">
        
             <?php
             
                $sidebar    = ep_get_meta('blog-sidebar');
                
                if ( $sidebar == 'no-sidebar') {
                    $imageSize = 'post-thumbnail';
                } else {
                    $imageSize = 'ep_post-thumbnail-fullwidth';
                }
                
                foreach($images as $img)
                {
                    //For getting image size use
                    //http://php.net/manual/en/function.getimagesize.php
                    $imgId = ep_get_image_id($img);
                    if($imgId == -1)//Fallback
                        $imgTag = "<img src=\"$img\" />";
                    else
                        $imgTag = wp_get_attachment_image_src($imgId, $imageSize);
                    ?>
                
                     <div class="swiper-slide" style="background :url(<?php echo $imgTag[0]; ?>);"></div>
                <?php
                }?>
                
            </div>
      </div>
        
    <?php
    }
    ?>
    </div>
    <?php
    // blog Post text excerpt
    the_excerpt();
    ?>
    <div class="redmore_line"></div>
    
    <!-- post link button -->
    <a class="redmore_button button right" href="<?php the_permalink(); ?>" title="" target="">
        <div class="frame top">
            <div></div>
        </div>
        <div class="frame right">
            <div></div>
        </div>
        <div class="frame bottom">
            <div></div>
        </div>
        <div class="frame left">
            <div></div>
        </div>
        <span class="txt">
            <?php  _e('Read more', 'epicomedia') ?> 
        </span>
    </a>
    
    <?php if(has_tag()){ ?>
        <div class="tagcloud"><?php the_tags('', '', ''); ?></div>
    <?php } ?>
    
</div>