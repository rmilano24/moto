<?php
$shopid = get_option('woocommerce_shop_page_id'); 

$slider  = '';
$mSlider = get_post_meta($shopid, "slider", true);

//Revolution slider
if( 'no-slider' != $mSlider && !is_product() )
{
    $slider = $mSlider;
}

//Slider
if('' != $slider && class_exists('RevSliderFront'))
{
    $revolutionslider = '[rev_slider '. $slider .']';
    echo do_shortcode($revolutionslider);
}