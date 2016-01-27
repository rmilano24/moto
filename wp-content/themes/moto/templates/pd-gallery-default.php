<?php
$images = ep_get_meta('image');

if(count($images))
{?>

    <div id="pDSwiper" class="swiper-container clearfix">
        <div class="swiper-wrapper">
            
            <?php

            $imageSize = 'ep_portfolio-single';

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
                <div class="swiper-slide">
                    <?php echo $imgTag; ?>
                </div>
            <?php
            }?>

        </div>
    </div>
<?php
}?>



