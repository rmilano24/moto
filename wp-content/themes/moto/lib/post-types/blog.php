<?php

require_once('post-type.php');

class Ep_Blog extends Ep_PostType
{
    function __construct()
    {
        parent::__construct('post');
    }

    function Ep_RegisterScripts()
    {
        wp_register_script('blog', THEME_LIB_URI . '/post-types/js/blog.js', array('jquery'), THEME_VERSION);
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

        wp_enqueue_script('blog');
    }

    function Ep_OnProcessFieldForStore($post_id, $key, $settings)
    {
        //Process media field
        if($key != 'media')
            return false;

        $selectedOpt = $_POST[$key];
		
        switch($selectedOpt)
        {
            case "image":
            {
                //delete video meta
                delete_post_meta($post_id, "video-type");
                delete_post_meta($post_id, "video-id");

                $images = $_POST["gallery"];

                update_post_meta( $post_id, "gallery", $images );

                break;
            }
            case "video":
            {
                //Delete images
                delete_post_meta($post_id, "image");

                $videoType = $_POST["video-type"];
                $videoId   = $_POST["video-id"];

                update_post_meta( $post_id, "video-type", $videoType );
                update_post_meta( $post_id, "video-id", $videoId );

                break;
            }
            default:
            {
                //Delete all
                delete_post_meta($post_id, "video-type");
                delete_post_meta($post_id, "video-id");
                delete_post_meta($post_id, "image");

                break;
            }
        }

        return false;
    }

    protected function Ep_GetOptions()
    {
        $fields = array(
          'post-social-share' => array(
                'type'   => 'switch',
                'state0' => __('Disable', 'epicomedia'),
                'state1' => __('Enable', 'epicomedia'),
                'default'   => 0
            ),
            'media' => array(
                'type' => 'visual-select',
                'title' => 'Specify kind of media',
                'options' => array(
                    'none'  => 'none',
                    'gallery' => 'gallery',
                    'video' => 'video',
                    'video_gallery' => 'video_gallery',
                    'audio' => 'audio',
                    'audio_gallery' =>'audio_gallery'
                ),
                'class' => 'post_type'
            ),
            'video-type' => array(
                'type' => 'select',
                'options' => array(
                    'vimeo' => __("Vimeo",  'epicomedia' ),
                    'youtube' => __("YouTube",  'epicomedia' ),
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
            'gallery' => array(
                'type'  => 'upload',
                'title' => __('Gallery Image', 'epicomedia'),
                'referer' => 'ep-post-gallery-image',
                'meta'  => array('array'=>true),
            ),//gallery image
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
           'post-social-share' => array(
                'title'   => __('Display social share icons', 'epicomedia'),
                'tooltip' => __('Choose to Show or Not to show social share icons in blog detail', 'epicomedia'),
                'fields'  => array(
                    'post-social-share' => $fields['post-social-share'],
                )
            ),//Enable And Disable social share icon in blog detail
            'media' => array(
                'title'   => __('Display Media Type', 'epicomedia'),
                'tooltip' => __('Specify what kind of media (Image(s), Video , Audio , Video and Image(s) or Audio and Image(s)) you would like to be displayed in  blog detail page. You can always use shortcodes to add other media types in content', 'epicomedia'),
                'fields'  => array(
                    'media' => $fields['media']
                )
            ),//media sec
             'video' => array(
                'title'   => __('Post Video', 'epicomedia'),
                'tooltip' => __('Copy and paste your browser URL in this section to automatically load a video into your portfolio. Additional information can be uploaded in the content area.', 'epicomedia'),
                'fields'  => array(
                    'video-type' => $fields['video-type'],
                    'video-id' => $fields['video-id'],
                )
            ),//Video sec
            'audio' => array(
                'title'   => __('Post Audio', 'epicomedia'),
                'tooltip' => __('Copy the URL of an audio that is uploaded on the SoundCloud.', 'epicomedia'),
                'fields'  => array(
                    'audio-url' => $fields['audio-url'],
                )
            ),//Audio sec
            'gallery' => array(
                'title'   => __('Post Gallery', 'epicomedia'),
                'tooltip' => __('Upload images to be shown in blog detail page slider', 'epicomedia'),
                'fields'  => array(
                    'gallery' => $fields['gallery'],
                )
            ),//Gallery sec
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
                'id' => 'blog_meta_box',
                'title' => __('Settings', 'epicomedia'),
                'context' => 'normal',
                'priority' => 'default',
                'options' => $options,
            )//Meta box
        );
    }
}

new Ep_Blog();