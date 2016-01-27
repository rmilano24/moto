<?php

$images = ep_get_meta('image');

if(count($images))
{?>

    <div id="pDSwiper" class="swiper-container clearfix">
        <div class="swiper-wrapper">
            
            <?php

            $imageSize = 'ep_portfolio-detail-gallery';

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
}?>



