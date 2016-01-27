<?php

require_once('post-type.php');

class Ep_Portfolio extends Ep_PostType
{

    function __construct()
    {
        parent::__construct('portfolio');
    }

    function Ep_CreatePostType()
    {
        $labels = array(
            'name' => __( 'Portfolio', 'epicomedia'),
            'singular_name' => __( 'Portfolio', 'epicomedia' ),
            'add_new' => __('Add New Item', 'epicomedia'),
            'add_new_item' => __('Add New Portfolio', 'epicomedia'),
            'edit_item' => __('Edit Portfolio', 'epicomedia'),
            'new_item' => __('New Portfolio', 'epicomedia'),
            'view_item' => __('View Portfolio', 'epicomedia'),
            'search_items' => __('Search Portfolio', 'epicomedia'),
            'not_found' =>  __('No portfolios found', 'epicomedia'),
            'not_found_in_trash' => __('No portfolios found in Trash', 'epicomedia'),
            'parent_item_colon' => ''
        );

        $args = array(
            'labels' =>  $labels,
            'public' => true,
            'capability_type' => 'post',
            'has_archive' => true,
            'hierarchical' => false,
            'menu_icon' => THEME_IMAGES_URI . '/post-format-icon/portfolio-icon.png',
            'rewrite' => array('slug' => 'portfolios'),
            'supports' => array('title',
                'editor',
                'thumbnail', 
                'tags',
                'post-formats'
            ),
            "show_in_nav_menus" => false
        );

        register_post_type( $this->postType, $args );

        /* Register the corresponding taxonomy */

        register_taxonomy('skills', $this->postType,
            array("hierarchical" => true,
                "label" => __( "Skills", 'epicomedia' ),
                "singular_label" => __( "Skill",  'epicomedia' ),
                "rewrite" => array( 'slug' => 'skills','hierarchical' => true),
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

    function Ep_OnProcessFieldForStore($post_id, $key, $settings)
    {

        $selectedOpt = $_POST[$key];
        
        //Save Portfolio Attributes Titles
        $attributesTitles = $_POST["attribute-title"];
        $attributes = array_filter( array_map( 'trim', $attributesTitles ), 'strlen' );
        $attributes = array_values($attributesTitles);
        update_post_meta( $post_id, "attribute-title", $attributes );
        //Save Portfolio Attributes Values
        $attributesValue = $_POST["attribute-value"];
        $attributes = array_filter( array_map( 'trim', $attributesValue ), 'strlen' );
        $attributes = array_values($attributesValue);
        update_post_meta( $post_id, "attribute-value", $attributes );


        return false;
    }

    protected function Ep_GetOptions()
    {
        $fields = array(
            'title-bar-switch' => array(
                'type' => 'select',
                'label'=> __('Section Title', 'epicomedia'),
                'options' => array('2'=>__('Show post title', 'epicomedia'),'1'=>__('Show custom title', 'epicomedia')),
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
            'image' => array(
                'type'  => 'upload',
                'title' => __('Portfolio Image', 'epicomedia'),
                'referer' => 'ep-portfolio-image',
                'meta'  => array('array'=>true),
            ),
            'video-type' => array(
                'type' => 'select',
                'options' => array(
                    'vimeo' => __( "Vimeo",  'epicomedia' ),
                    'youtube' => __( "YouTube",  'epicomedia' ),
                ),
            ),
            'video-id' => array(
                'type' => 'text',
                'placeholder' => __('Video URL', 'epicomedia'),
            ),//video id
            'audio-url' => array(
                'type' => 'text',
                'placeholder' => __('Audio URL', 'epicomedia'),
            ),//Audio url
            'link-url' => array(
                'type' => 'text',
                'placeholder' => __('URL', 'epicomedia'),
            ),//link
            'portfolio-featured-size' => array(
                'type' => 'visual-select',
                'title' => 'choose your portfolio post size',
                'label'=> __('Portfolio Thumbnail Size', 'epicomedia'),
                'options' => array('square' =>'square', 'big'=> 'big', 'slim'=>'slim','hslim'=>'hslim','wide' =>'wide'),
            ),
            'portfolio-detail-style' => array(
                'type' => 'visual-select',
                'title' => 'choose portfolio detail style',
                'label'=> __('Portfolio Detail Style', 'epicomedia'),
                'options' => array('portfolio_detail_full_width' =>'portfolio_detail_full_width', 'portfolio_detail_boxed'=> 'portfolio_detail_boxed', 'portfolio_detail_creative'=>'portfolio_detail_creative'),
            ),
            'portfolio-social-share' => array(
                'type'   => 'switch',
                'state0' => __('Disable', 'epicomedia'),
                'state1' => __('Enable', 'epicomedia'),
                'default'   => 0
            ),
            'attribute-title' => array(
                'type'  => 'text',
                'class' => 'attribute-title',
                'placeholder' => __('Attribute Title', 'epicomedia'),
                'meta'  => array('array'=>true, 'dontsave'=>true),//This will indirectly get saved
            ),//Attribute Title
            'attribute-value' => array(
                'type'  => 'text',
                'class' => 'attribute-value',
                'placeholder' => __('Attribute Value', 'epicomedia'),
                'meta'  => array('array'=>true, 'dontsave'=>true),//This will indirectly get saved
            ),//Attribute Value
            'seo_description' => array(
				'type' => 'text',
				'label'=> __('Post SEO Description', 'epicomedia'),
				'placeholder' => __('SEO Description', 'epicomedia'),
			),//SEO Description
			'seo_keywords' => array(
				'type' => 'text',
				'label'=> __('Post SEO Key Words', 'epicomedia'),
				'placeholder' => __('SEO Key Words', 'epicomedia'),
			),//SEO Key Words  
        );
        //Option sections
        $options = array(
            'title-bar' => array(
                'title'   => __('Portfolio Detail Title', 'epicomedia'),
                'tooltip' => __('Choose a portfolio detail title and a subtitle.', 'epicomedia'),
                'fields'  => array(
                    'title-bar'    => $fields['title-bar-switch'],
                    'title-text'   => $fields['title-text'],
                    'subtitle-text'   => $fields['subtitle-text'],
               )
            ),//Title bar sec
            'featured-size' => array(
                'title'   => __('Portfolio Tumbnail Size', 'epicomedia'),
                'tooltip' => __('Choose a size for the post in the grid.', 'epicomedia'),
                'fields'  => array(
                    'portfolio-featured-size' => $fields['portfolio-featured-size'],
                )
            ),//Portfolio Tumbnail Size
            'portfolio-detail-style' => array(
                'title'   => __('Portfolio Detail Style', 'epicomedia'),
                'tooltip' => __('Choose a Style for portfolio detail.', 'epicomedia'),
                'fields'  => array(
                    'portfolio-detail-style' => $fields['portfolio-detail-style'],
                )
            ),//Portfolio Tumbnail Size
            'gallery' => array(
                'title'   => __('Portfolio Detail Images', 'epicomedia'),
                'tooltip' => __('Choose one image to be shown at portfolio detail page. If you choose more than one image, it will be shown as a slider.', 'epicomedia'),
                'fields'  => array(
                    'image' => $fields['image']
                )
            ),//images sec
            'video' => array(
                'title'   => __('Portfolio Video', 'epicomedia'),
                'tooltip' => __('Copy and paste your browser URL in this section to automatically load a video into your portfolio. Additional information can be uploaded in the content area.', 'epicomedia'),
                'fields'  => array(
                    'video-type' => $fields['video-type'],
                    'video-id' => $fields['video-id'],
                )
            ),//Video sec
            'audio' => array(
                'title'   => __('Post Audio', 'epicomedia'),
                'tooltip' => __('You can enter audio url hosted in SoundCloud', 'epicomedia'),
                'fields'  => array(
                    'audio-url' => $fields['audio-url'],
                )
            ),//Audio sec
            'link' => array(
                'title'   => __('Post Link', 'epicomedia'),
                'tooltip' => __('You can enter the URL of another website.', 'epicomedia'),
                'fields'  => array(
                    'link-url' => $fields['link-url'],
                )
            ),//Audio sec
            'portfolio-social-share' => array(
                'title'   => __('Portfolio Social Share', 'epicomedia'),
                'tooltip' => __('Enable or Disable Social sharing for portfolio items.', 'epicomedia'),
                'fields'  => array(
                    'portfolio-social-share' => $fields['portfolio-social-share'],
                )
            ),//portfolio social share icon sec
            'attribute' => array(
                'title'   => __('Portfolio Detatil Attributes', 'epicomedia'),
                'tooltip' => __('You can add many attributes to your portfolio item here, for example you can add the project client, date of that project and etc.', 'epicomedia'),
                'fields'  => array(
                    'attribute-title' => $fields['attribute-title'],
                    'attribute-value' => $fields['attribute-value']
                )
            ),//attribute sec 
            'seo_description' => array(
				'title'   => __('Seo Description', 'epicomedia'),
				'tooltip' => __('Enter a description for using as seo description in search engine results', 'epicomedia'),
				'fields'  => array(
				    'seo_description' => $fields['seo_description'],
				)
			),//SEO Description
			'seo_keywords' => array(
				'title'   => __('Seo Key Words', 'epicomedia'),
				'tooltip' => __('Enter Keywords for using in search engines results ( comma separated)', 'epicomedia'),
				'fields'  => array(
				    'seo_keywords' => $fields['seo_keywords'],
			    )
			),//SEO Key Words
        );

        return array(
            array(
                'id' => 'portfolio_meta_box',
                'title' => __('Portfolio Options', 'epicomedia'),
                'context' => 'normal',
                'priority' => 'default',
                'options' => $options,
            )//Meta box
        );
    }
}

new Ep_Portfolio();