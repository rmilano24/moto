<?php

require_once('post-type.php');

class Ep_Page extends Ep_PostType
{
    function __construct()
    {
        parent::__construct('page');
    }

    function Ep_RegisterScripts()
    {
        wp_register_script('page', THEME_LIB_URI . '/post-types/js/page.js', array('jquery'), THEME_VERSION);
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

        wp_enqueue_script('page');
    }

    private function Ep_GetSidebars()
    {
        $sidebars = array('no-sidebar' => '' , 'main-sidebar' => __('Default Sidebar', 'epicomedia'), 'page-sidebar' => __('Default Page Sidebar', 'epicomedia'));

        if(ep_opt('custom_sidebars') != '')
        {
            $arr = explode(',', ep_opt('custom_sidebars'));

            foreach($arr as $bar)
                $sidebars[$bar] = str_replace('%666', ',', $bar);
        }

        return $sidebars;
    }

    protected function Ep_GetOptions()
    {
        $fields = array(
            'title-bar-switch' => array(
                'type' => 'select',
                'label'=> __('Section Title', 'epicomedia'),
                'options' => array('2'=>__('Show post title', 'epicomedia'),'1'=>__('Show custom title', 'epicomedia'), '0'=>__('Don\'t show title', 'epicomedia')),
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
            'page-type-switch' => array(
                'type' => 'select',
                'label'=> __('Section Type', 'epicomedia'),
                'options' => array('custom-section'=>__('Custom section', 'epicomedia'),'blog-section'=>__('Blog section', 'epicomedia')),
            ),
             'page-position-switch' => array(
                'type' => 'select',
                'label'=> __('Choose your section to be shown in:', 'epicomedia'),
                'options' => array('1'=>__('Main page', 'epicomedia') , '0'=>__('External page', 'epicomedia')),
            ),
            'blog-type-switch' => array(
                'type' => 'select',
                'label'=> __('Blog Type:', 'epicomedia'),
                'options' => array('1'=>__('Classic Blog', 'epicomedia'), '0'=>__('Toggle Blog', 'epicomedia')),
            ),
            'sidebar' => array(
                'type' => 'select',
                'label'=> __('Choose the sidebar', 'epicomedia'),
                'options' => $this->Ep_GetSidebars(),
            ),
            'blog-sidebar' => array(
                'type' => 'select',
                'label'=> __('Blog Sidebar Display', 'epicomedia'),
                'options' => array('main-sidebar'=> __('Show', 'epicomedia'), 'no-sidebar'=> __('Don\'t Show', 'epicomedia')),
            ),
            'slider' => array(
                'type' => 'select',
                'label'=> __('Choose a revolution slider', 'epicomedia'),
                'options' => ep_get_revolutionSlider_slides(),
            ),
           'footer-map' => array(
                'type'   => 'switch',
                'label'  => __('Enable or disable map in the footer.', 'epicomedia'),
                'state0' => __('Disable', 'epicomedia'),
                'state1' => __('Enable', 'epicomedia'),
                'default'   => 0
            ),
           'footer-widget-area' => array(
                'type'   => 'switch',
                'label'  => __('Widget Area', 'epicomedia'),
                'state0' => __('Disable', 'epicomedia'),
                'state1' => __('Enable', 'epicomedia'),
                'default'   => 0
            ),
            'resume-exp-section'=> array(
                'type' => 'checkbox',
                'checked' => true,
                'value' => 'visible',
                'label' => __('Experience','epicomedia'),
            ),
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

        // merge fiels array With portfolio Skill Arrays
        $fields = array_merge ( $fields , ep_generate_portfolio_skill() );

        //Option sections
        $options = array(
            'page-type-switch' => array(
                'title'   => __('Section Type', 'epicomedia'),
                'tooltip' => __('Choose a section which will be shown in main page.   Create a new section. This section can be shown in any one of your pages.', 'epicomedia'),
                'fields'  => array(
                    'page-type-switch' => $fields['page-type-switch'],
                )
            ),//Section Type
            'title-bar' => array(
                'title'   => __('Title', 'epicomedia'),
                'tooltip' => __('Choose a title to be shown at the beginning of each section', 'epicomedia'),
                'fields'  => array(
                    'title-bar'    => $fields['title-bar-switch'],
                    'title-text'   => $fields['title-text'],
                    'subtitle-text'   => $fields['subtitle-text'],
               )
            ),//Title bar sec
            'page-position-switch' => array(
                'title'   => __('Section Display', 'epicomedia'),
                'tooltip' => __('Choose where you want to show your section. It can be shown in main page or be shown as an external page.', 'epicomedia'),
                'fields'  => array(
                    'page-position-switch' => $fields['page-position-switch'],
                )
            ),//Open Page As Seperate Page Or Front Page
            'blog-type-switch' => array(
                'title'   => __('Blog Type', 'epicomedia'),
                'tooltip' => __('Choose blog style between toggle Blog Or Classic blog', 'epicomedia'),
                'fields'  => array(
                    'blog-type-switch' => $fields['blog-type-switch'],
                )
            ),// Add Page Sidebar
            'page-sidebar' => array(
                'title'   => __('Page Sidebar', 'epicomedia'),
                'tooltip' => __('You can choose a sidebar to be shown in this section which is created in theme settings ', 'epicomedia'),
                'fields'  => array(
                    'sidebar' => $fields['sidebar'],
                )
            ),// Add Page Sidebar
            'blog-sidebar' => array(
                'title'   => __('Blog Sidebar', 'epicomedia'),
                'tooltip' => __('You can enable or disable log sidebar ', 'epicomedia'),
                'fields'  => array(
                    'blog-sidebar' => $fields['blog-sidebar'],
                )
            ),// Enable blog Sidebar
            'revolutionslider' => array(
                'title'   => __('Revolution Slider ', 'epicomedia'),
                'tooltip' => __('Choose one of the sliders that you created in the Revolution Slider panel.', 'epicomedia'),
                'fields'  => array(
                    'slider' => $fields['slider'],
                )
            ),//slider sec
            'footer-map' => array(
                'title'   => __('Footer Map', 'epicomedia'),
                'tooltip' => __('Choose to show or not to show the map in footer', 'epicomedia'),
                'fields'  => array(
                    'footer-map' => $fields['footer-map'],
                )
            ),//Footer Map
            'footer-widget-area' => array(
                'title'   => __('Footer Widget Area', 'epicomedia'),
                'tooltip' => __('Enable or disable widget area in the footer.', 'epicomedia'),
                'fields'  => array(
                    'footer-widget-area' => $fields['footer-widget-area'],
                )
            ),//Footer Widget Area
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

        // merge Skill Arrays
        //$options['portfolio-skill']['fields'] = array_merge ( $options['portfolio-skill']['fields'] , ep_generate_portfolio_skill($fields));

        return array(
            array(
                'id' => 'blog_meta_box',
                'title' => __('Page Settings', 'epicomedia'),
                'context' => 'normal',
                'priority' => 'high',
                'options' => $options,
            )//Meta box 0
        );
    }
}

new Ep_Page();