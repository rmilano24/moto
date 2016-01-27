<?php

function ep_add_image_size_retina($name, $width = 0, $height = 0, $crop = false)
{
    add_image_size($name, $width, $height, $crop);
    add_image_size("$name@2x", $width*2, $height*2, $crop);
}

/*-----------------------------------------------------------------------------------*/
/*  Configure WP2.9+ Thumbnails
/*-----------------------------------------------------------------------------------*/

if ( function_exists( 'add_theme_support' ) ) {
    add_theme_support( 'post-thumbnails' );

    //featured image thumbnail show in  admin columns
    add_image_size( 'ep_admin-list-thumb', 50, 50, true );
    
    //set_post_thumbnail_size( 480, 300, true );
    ep_add_image_size_retina( 'post-thumbnail', 830, 420, true ); // Default post-thumbnail name for multi-post-thumbnail plugin
    ep_add_image_size_retina( 'ep_post-thumbnail-fullwidth', 830, 420, true );
    
    //Portfolio thumbnails
    ep_add_image_size_retina('ep_thumbnail-square', 300 ,300, true);
    ep_add_image_size_retina('ep_thumbnail-big', 600 , 610, true);
    ep_add_image_size_retina('ep_thumbnail-slim', 300 , 600, true);
    ep_add_image_size_retina('ep_thumbnail-hslim', 600, 300, true);
    
    //Portfolio single
    ep_add_image_size_retina('ep_portfolio-single', 1140, 655, true);//More suited for wide images

    //Portfolio detail gallery
    ep_add_image_size_retina('ep_portfolio-detail-gallery', 1280, 720, true);//More suited for wide images

}

/*-----------------------------------------------------------------------------------*/
/*  RSS Feeds
/*-----------------------------------------------------------------------------------*/

add_theme_support( 'automatic-feed-links' );

/*-----------------------------------------------------------------------------------*/
/*  Post Formats
/*-----------------------------------------------------------------------------------*/

add_theme_support( 'post-formats', array('gallery' , 'video', 'audio' , 'link' ) );

/*-----------------------------------------------------------------------------------*/
/*  Custom Header/Background
/*-----------------------------------------------------------------------------------*/

add_theme_support('custom-header');
add_theme_support('custom-background');
add_theme_support("title-tag" );
add_theme_support('automatic-feed-links');