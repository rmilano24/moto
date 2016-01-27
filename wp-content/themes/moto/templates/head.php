<?php
$slider  = '';
$mSlider = ep_get_meta('slider');

//Revolutionslider
if( 'no-slider' != $mSlider )
{
    $slider = $mSlider;
}

//Slider
if('' != $slider && class_exists('RevSliderFront'))
{
    $revolutionslider = '[rev_slider '. $slider .']';
    echo do_shortcode($revolutionslider);
}