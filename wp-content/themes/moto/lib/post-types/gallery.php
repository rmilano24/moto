<?php

require_once('post-type.php');
class Ep_Gallery extends Ep_PostType
{

    function __construct()
    {
        parent::__construct('gallery');
    }

    function Ep_CreatePostType()
    {
        $labels = array(
            'name' => __('Gallery', 'epicomedia'),
            'singular_name' => __('Gallery', 'epicomedia' ),
            'add_new' => __('Add New Item', 'epicomedia'),
            'add_new_item' => __('Add new gallery item', 'epicomedia'),
            'edit_item' => __('Edit Gallery', 'epicomedia'),
            'new_item' => __('New Gallery', 'epicomedia'),
            'view_item' => __('View Gallery', 'epicomedia'),
            'search_items' => __('Search Gallery', 'epicomedia'),
            'not_found' =>  __('No gallery item found', 'epicomedia'),
            'not_found_in_trash' => __('No gallery item was found in trash', 'epicomedia'),
            'parent_item_colon' => ''
        );

        $args = array(
            'labels' =>  $labels,
            'public' => true,
            'capability_type' => 'post',
            'has_archive' => true,
            'menu_icon' => THEME_IMAGES_URI . '/post-format-icon/gallery-icon.png',
            'rewrite' => array('slug' => 'gallery_cat', 'epicomedia' ),
            'supports' => array('title','thumbnail'),
        );

        register_post_type( $this->postType, $args );

        /* Register the corresponding taxonomy */

        register_taxonomy('gallery_cat', $this->postType,
            array("hierarchical" => true,
                "label" => __("Categories", 'epicomedia' ),
                "singular_label" => __("Category",  'epicomedia' ),
                "rewrite" => array( 'slug' => 'gallery_cat','hierarchical' => true),
                "show_in_nav_menus" => false
            ));
    }

    function Ep_RegisterScripts()
    {
        wp_register_script('portfolio', THEME_LIB_URI . '/post-types/js/portfolio.js', array('jquery'), THEME_VERSION);

        parent::Ep_RegisterScripts();
    }

    function Ep_EnqueueScripts()
    {
        wp_enqueue_script('hoverIntent');
        wp_enqueue_script('jquery-easing');
        
        wp_enqueue_script('nouislider');
        wp_enqueue_style('nouislider');

        wp_enqueue_script('colorpicker0');
        wp_enqueue_style('colorpicker0');

        wp_enqueue_style('theme-admin');
        wp_enqueue_script('theme-admin');

        wp_enqueue_script('portfolio');
    }

    protected function Ep_GetOptions()
    {
        $fields = array(
            'title-bar-switch' => array(
                'type' => 'select',
                'label'=> __('Section Title', 'epicomedia'),
                'options' => array('2'=>__('Show gallery item title', 'epicomedia'),'1'=>__('Show custom title', 'epicomedia')),
            ),
            'title-text' => array(
                'type' => 'text',
                'label'=> __('Title Text', 'epicomedia'),
                'placeholder' => __('Override title text', 'epicomedia'),

            ),
			'subtitle-text' => array(
                'type' => 'text',
                'label'=> __('Subtitle Text', 'epicomedia'),
                'placeholder' => __('Subtitle text', 'epicomedia'),
            ),

            'link-url' => array(
                'type' => 'text',
                'placeholder' => __('URL', 'epicomedia'),
            ),//link
            'portfolio-featured-size' => array(
                'type' => 'visual-select',
                'title' => 'choose your gallery post size',
                'label'=> __('Gallery Thumbnail Size', 'epicomedia'),
                'options' => array('square' =>'square', 'big'=> 'big', 'slim'=>'slim','hslim'=>'hslim','wide' =>'wide'),
            ), 
        );
        //Option sections
        $options = array(
            'title-bar' => array(
                'title'   => __('Gallery item Title', 'epicomedia'),
                'tooltip' => __('Enter a gallery item title.', 'epicomedia'),
                'fields'  => array(
                    'title-bar'    => $fields['title-bar-switch'],
                    'title-text'   => $fields['title-text'],
					'subtitle-text'   => $fields['subtitle-text'],
               )
            ),//Title bar sec
            'featured-size' => array(
                'title'   => __('Gallery Tumbnail Size', 'epicomedia'),
                'tooltip' => __('Choose a size for the contents of gallery.', 'epicomedia'),
                'fields'  => array(
                    'portfolio-featured-size' => $fields['portfolio-featured-size'],
                )
            ),//Gallery Tumbnail Size

        );

        return array(
            array(
                'id' => 'portfolio_meta_box',
                'title' => __('Gallery Options', 'epicomedia'),
                'context' => 'normal',
                'priority' => 'default',
                'options' => $options,
            )//Meta box
        );
    }
}
new Ep_Gallery();