<?php

require_once('post-type.php');

class Ep_Slider extends Ep_PostType
{

    function __construct()
    {
        parent::__construct('slider');
    }

    function Ep_CreatePostType()
    {
        $labels = array(
            'name' => __('Slides', 'epicomedia'),
            'singular_name' => __('Slide', 'epicomedia' ),
            'add_new' => __('Add New Slide', 'epicomedia'),
            'add_new_item' => __('Add New Slide', 'epicomedia'),
            'edit_item' => __('Edit Slide', 'epicomedia'),
            'new_item' => __('New Slide', 'epicomedia'),
            'view_item' => __('View Slide', 'epicomedia'),
            'search_items' => __('Search Slide', 'epicomedia'),
            'not_found' =>  __('No Slides found', 'epicomedia'),
            'not_found_in_trash' => __('No Slides found in Trash', 'epicomedia'),
            'parent_item_colon' => ''
        );

        $args = array(
            'labels' =>  $labels,
            'public' => true,
            'capability_type' => 'post',
            'has_archive' => true,
            'hierarchical' => false,
            'exclude_from_search' => false,
            'menu_icon' => THEME_IMAGES_URI . '/post-format-icon/slide-icon.png',
            'rewrite' => array('slug' => __('Slides', 'epicomedia' ), 'with_front' => true),
            'supports' => array('title',
                'editor',
                'thumbnail', 
            ),
            "show_in_nav_menus" => false
        );

        register_post_type( $this->postType, $args );

        /* Register the corresponding taxonomy */

        register_taxonomy('slider_cats', $this->postType,
            array("hierarchical" => true,
                "label" => __("Categories", 'epicomedia' ),
                "singular_label" => __("Category",  'epicomedia' ),
                "rewrite" => array( 'slug' => 'slider_cats','hierarchical' => true),
                "show_in_nav_menus" => false
            ));
    }

    function Ep_RegisterScripts()
    {
        wp_register_script('ep_slider', THEME_LIB_URI . '/post-types/js/slider.js', array('jquery'), THEME_VERSION);

        parent::Ep_RegisterScripts();
    }

    function Ep_EnqueueScripts()
    {
        wp_enqueue_script('hoverIntent');
        wp_enqueue_script('jquery-easing');
        
        wp_enqueue_script('nouislider');
        wp_enqueue_style('nouislider');

        wp_enqueue_style('theme-admin');
        wp_enqueue_script('theme-admin');

        wp_enqueue_script('ep_slider');
    }

    function Ep_OnProcessFieldForStore($post_id, $key, $settings)
    {
        return false;
    }


    protected function Ep_GetOptions()
    {
        $fields = array(
            'title-text' => array(
                'type' => 'text',
                'label'=> __('Caption Title', 'epicomedia'),
                'placeholder' => __('Override title text', 'epicomedia'),

            ),
            'subtitle-text' => array(
                'type' => 'text',
                'label'=> __('Caption Subtitle', 'epicomedia'),
                'placeholder' => __('Subtitle text', 'epicomedia'),
            ),
            'caption-icon-image' => array(
                'type' => 'visual-select',
                'title' => 'choose caption image/icon',
                'label'=> __('Caption image/icon', 'epicomedia'),
                'options' => array('image' => 'image', 'icon'=> 'icon'),
            ),
            'caption-icon-image-animation' => array(
                'type'   => 'switch',
                'label'  => __('Icon/image animation', 'epicomedia'),
                'state0' => __('Off', 'epicomedia'),
                'state1' => __('On', 'epicomedia'),
                'default'   => 1
            ),
            'caption-image' => array(
                'type'  => 'upload',
                'class' => 'caption-image-field',
                'title' => 'Upload caption image',
                'referer' => 'ep-caption-image',
            ),
            'caption-icon' => array(
                'type'  => 'icon',
                'title' => __('Caption Icon', 'epicomedia'),
                'class' => 'caption-icon-field',
                'desc'  => __('Select an icon for top of caption', 'epicomedia'),
                'flags' => 'attribute',//CSV
            ),
            'background-type' => array(
                'type' => 'visual-select',
                'title' => 'choose Background type',
                'label'=> __('Background type', 'epicomedia'),
                'options' => array('image' =>'image', 'video'=> 'video'),
            ),
            'background-image' => array(
                'type'  => 'upload',
                'title' => 'Upload Slider image',
                'class' => 'slider-image-upload',
                'referer' => 'ep-slide-image',
            ),
            'video-url-webm' => array(
                'type' => 'text',
                'class' => 'slider-video-url',
                'placeholder' => __('Video URL ( .webm format)', 'epicomedia'),
            ),//video id
            'video-url-mp4' => array(
                'type' => 'text',
                'class' => 'slider-video-url',
                'placeholder' => __('Video URL ( .mp4 format)', 'epicomedia'),
            ),//video id
            'video-prev-image' => array(
                'type'  => 'upload',
                'title' => 'Upload Video preview image',
                'class' => 'slider-video-prev',
                'referer' => 'ep-video-prev-image',
            ),
            'button-url' => array(
                'type' => 'text',
                'placeholder' => __('URL', 'epicomedia'),
            ),//Button
            'button-text' => array(
                'type' => 'text',
                'placeholder' => __('Text', 'epicomedia'),
            ),//Button text
            'caption-style' => array(
                'type' => 'visual-select',
                'title' => 'choose your caption style',
                'label'=> __('Caption Style', 'epicomedia'),
                'options' => array('style1' =>'style1', 'style2'=> 'style2', 'style3'=>'style3','style4'=>'style4','style5' =>'style5'),
            ),
            'caption-align' => array(
                'type' => 'visual-select',
                'title' => 'choose caption alignment',
                'class' => 'caption-align-field',
                'label'=> __('Caption Alignment', 'epicomedia'),
                'options' => array('left' =>'left', 'center'=> 'center', 'right'=>'right'),
                'default' => 'center'
            ),
            'caption-dark-light' => array(
                'type'   => 'switch',
                'label'  => __('Choose a style for your captions.', 'epicomedia'),
                'state0' => __('Dark', 'epicomedia'),
                'state1' => __('Light', 'epicomedia'),
                'default'   => 1
            ),
        );
        //Option sections
        $options = array(
            'caption-dark-light' => array(
                'title'   => __('Caption Style', 'epicomedia'),
                'tooltip' => __('Choose an style for slide', 'epicomedia'),
                'fields'  => array(
                    'caption-dark-light'   => $fields['caption-dark-light'],
               )
            ),//slide style sec
            'background' => array(
                'title'   => __('Choose a background format', 'epicomedia'),
                'tooltip' => __('Choose a format for your slide.', 'epicomedia'),
                'fields'  => array(
                    'background-type'   => $fields['background-type'],
               )
            ),//Background
            'background-image' => array(
                'title'   => __('Background image', 'epicomedia'),
                'tooltip' => __('Choose an image for slide', 'epicomedia'),
                'fields'  => array(
                    'background-image'   => $fields['background-image'],
               )
            ),//Background
            'background-video' => array(
                'title'   => __('Background video', 'epicomedia'),
                'tooltip' => __('Enter video urls', 'epicomedia'),
                'fields'  => array(
                    'video-url-webm'   => $fields['video-url-webm'],
                    'video-url-mp4'   => $fields['video-url-mp4'],
                    'video-prev-image'   => $fields['video-prev-image'],
               )
            ),//Background
            'caption' => array(
                'title'   => __('Caption style', 'epicomedia'),
                'tooltip' => __('Choose a caption style.', 'epicomedia'),
                'fields'  => array(
                    'caption-style' => $fields['caption-style'],
                    'caption-align' => $fields['caption-align'],
                )
            ),//Caption style
            'title-bar' => array(
                'title'   => __('Caption Text', 'epicomedia'),
                'tooltip' => __('Choose a title and a subtitle for your slide. These fields can be left empty.', 'epicomedia'),
                'fields'  => array(
                    'title-text'   => $fields['title-text'],
                    'subtitle-text'   => $fields['subtitle-text'],
               )
            ),//Title bar sec
            'caption-image-icon' => array(
                'title'   => __('Caption icon/image', 'epicomedia'),
                'tooltip' => __('Choose an image or an icon for your caption. This Field can be left empty.', 'epicomedia'),
                'fields'  => array(
                    'caption-icon-image-animation' => $fields['caption-icon-image-animation'],
                    'caption-icon-image' => $fields['caption-icon-image'],
                )
            ),//Caption image/icon
            'caption-image' => array(
                'title'   => __('Caption image', 'epicomedia'),
                'tooltip' => __('Choose image of caption', 'epicomedia'),
                'fields'  => array(
                    'caption-image' => $fields['caption-image'],
                )
            ),//Caption image
            'caption-icon' => array(
                'title'   => __('Caption icon', 'epicomedia'),
                'tooltip' => __('Choose icon of caption', 'epicomedia'),
                'fields'  => array(
                    'caption-icon' => $fields['caption-icon'],
                )
            ),//Caption image
            'button' => array(
                'title'   => __('Button', 'epicomedia'),
                'tooltip' => __('By specifying a URL and a label text, you can add a button to your slide that redirects users to another webpage.', 'epicomedia'),
                'fields'  => array(
                    'button-url' => $fields['button-url'],
                    'button-text' => $fields['button-text'],
                )
            ),//button
        );

        return array(
            array(
                'id' => 'slider_meta_box',
                'title' => __('Slider Options', 'epicomedia'),
                'context' => 'normal',
                'priority' => 'default',
                'options' => $options,
            )//Meta box
        );
    }
}
new Ep_Slider();