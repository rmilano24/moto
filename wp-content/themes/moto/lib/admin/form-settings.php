<?php

include_once THEME_LIB . '/google-fonts.php';

function ep_admin_get_defaults()
{
    static $values = array();

    if(count($values))
        return $values;

    //Extract key-value pairs from settings
    $settings = ep_admin_get_form_settings();
    $panels   = $settings['panels'];

    foreach($panels as $panel)
    {
        foreach($panel['sections'] as $section)
        {
            foreach($section['fields'] as $fieldKey => $field)
            {
                $values[$fieldKey] = ep_array_value('value', $field);
            }
        }
    }

    return $values;
    }

    function ep_admin_get_appearance_value($name){

    $savedThemeOption =get_option('theme_scooter_options');

    return $savedThemeOption[$name];
    }

    function ep_admin_get_color_option_attr($colors)
    {
    $tmp = json_encode($colors);
    $tmp = esc_attr($tmp);
    return "data-colors=\"$tmp\"";
    }

    function ep_admin_get_form_settings()
    {
    static $settings = array();//Cache the settings

    if(count($settings))
        return $settings;

    $args = array(
        'orderby'           => 'id', 
        'order'             => 'DESC',
        'hide_empty'        => false, 
        'fields'               => 'all',
    );
    $sliderCategories = get_terms('slider_cats', $args);
    $sliderSlugName = array();
    if ( ! empty( $sliderCategories ) && ! is_wp_error( $sliderCategories ) ){
        foreach ($sliderCategories as $sliderCat) {
            $sliderSlugName[$sliderCat->slug] = $sliderCat->name;
        }
    }

    $generalSettingsPanel = array(
        'title' => __('General Settings', 'epicomedia'),
        'sections' => array(
            'favicon' => array(
                'title'   => __('Custom Favicon', 'epicomedia'),
                'tooltip' => __('Specify custom favicon URL or upload a new one here.', 'epicomedia'),
                'fields'  => array(
                    'favicon' => array(
                        'type' => 'upload',
                        'title' => __('Upload Favicon', 'epicomedia'),
                        'class' =>"favicon",
                        'referer' => 'ep-settings-favicon'
                    ),
                )
            ),//Favicon sec
            'scrolling-easing' => array(
                'title'   => __('Scrolling Easing', 'epicomedia'),
                'tooltip' => __('Adjust the ease and the speed of vertical scrolling for pages.', 'epicomedia'),
                'fields'  => array(
                    'scrolling-easing' => array(
                        'label'  => __('Scrolling Types', 'epicomedia'),
                        'type'   => 'select',
                        'options'=> array(
                                'linear' => 'linear',
                                'easeInQuad'=> 'Ease In Quad',
                                'easeOutQuad'=> 'Ease Out Quad',
                                'easeInOutQuad'=> 'Ease In Out Quad',
                                'easeInCubic' => 'Ease In Cubic',
                                'easeOutCubic' => 'Ease Out Cubic',
                                'easeInOutCubic' => 'Ease In Out Cubic',
                                'easeInQuart' => 'Ease In Quart',
                                'easeOutQuart' => 'Ease Out Quart',
                                'easeInOutQuart' => 'Ease In Out Quart',
                                'easeInQuint' => 'Ease In Quint',
                                'easeOutQuint' => 'Ease Out Quint',
                                'easeInOutQuint' => 'Ease In Out Quint',
                                'easeInSine' => 'Ease In Sine',
                                'easeOutSine' => 'Ease Out Sine',
                                'easeInOutSine' => 'Ease In Out Sine',
                                'easeInExpo' => 'Ease In Expo',
                                'easeOutExpo' => 'Ease Out Expo',
                                'easeInOutExpo' => 'Ease In Out Expo',
                                'easeInCirc' => 'Ease In Circ',
                                'easeOutCirc' => 'Ease Out Circ',
                                'easeInOutCirc' => 'Ease In Out Circ',
                                'easeInElastic' => 'Ease In Elastic',
                                'easeOutElastic' => 'Ease Out Elastic',
                                'easeInOutElastic' => 'Ease In Out Elastic',
                                'easeInBack' => 'Ease In Back',
                                'easeOutBack' => 'Ease Out Back',
                                'easeInOutBack' => 'Ease In Out Back',
                                'easeInBounce' => 'Ease In Bounce',
                                'easeOutBounce' => 'Ease Out Bounce',
                                'easeInOutBounce' => 'Ease In Out Bounce'

                            ),
                        'default'=> 'easeInOutQuart',
                    ),
                    'scrolling-speed' => array(
                        'title'  => __('Scrolling Duration', 'epicomedia'),
                        'label'  => __('ms', 'epicomedia'),
                        'default'   => '1000',
                        'type'   => 'range',
                        'min'   => '5',
                        'max'   => '5000',
                        'step'   => '50',
                    ),
                )
            ),//page Scrolling Speed And Easing
            'login-logo' => array(
                'title'   => __('Control Panel Login Logo', 'epicomedia'),
                'tooltip' => __('Upload your Admin Panel login logo. ( best size : 302px X 62px ) ( PNG , JPG , GIF )', 'epicomedia'),
                'fields'  => array(
                    'login-logo' => array(
                        'type' => 'upload',
                        'title' => __('Control Panel Login Logo', 'epicomedia'),
                        'referer' => 'ep-settings-login-logo'
                    ),
                )
            ),// Control Panel Login logo
        )
    );//$generalSettingsPanel


       $presetColors = array();

    $presetColors['default'] = ep_admin_get_color_option_attr(
        array('style-accent-color'=>'#df3030',
              'style-highlight-color'=>'#df3030',
              'style-link-color'=>'#df3030',
              'style-link-hover-color'=>'#cbcbcb'));

    $presetColors['red'] = ep_admin_get_color_option_attr(
        array('style-accent-color'=>'#eb2130',
            'style-highlight-color'=>'#eb2130',
            'style-link-color'=>'#eb2130',
            'style-link-hover-color'=>'#333333'));

    $presetColors['orange'] = ep_admin_get_color_option_attr(
        array('style-accent-color'=>'#fe4d2c',
            'style-highlight-color'=>'#fe4d2c',
            'style-link-color'=>'#fe4d2c',
            'style-link-hover-color'=>'#333333'));

    $presetColors['pink'] = ep_admin_get_color_option_attr(
        array('style-accent-color'=>'#eb2071',
            'style-highlight-color'=>'#eb2071',
            'style-link-color'=>'#eb2071',
            'style-link-hover-color'=>'#333333'));

    $presetColors['yellow'] = ep_admin_get_color_option_attr(
        array('style-accent-color'=>'#ffdb0d',
            'style-highlight-color'=>'#ffdb0d',
            'style-link-color'=>'#ffdb0d',
            'style-link-hover-color'=>'#333333'));

    $presetColors['green'] = ep_admin_get_color_option_attr(
        array('style-accent-color'=>'#96d639',
            'style-highlight-color'=>'#96d639',
            'style-link-color'=>'#96d639',
            'style-link-hover-color'=>'#333333'));

    $presetColors['emerald'] = ep_admin_get_color_option_attr(
        array('style-accent-color'=>'#4dac46',
            'style-highlight-color'=>'#4dac46',
            'style-link-color'=>'#4dac46',
            'style-link-hover-color'=>'#333333'));

    $presetColors['teal'] = ep_admin_get_color_option_attr(
        array('style-accent-color'=>'#23d692',
            'style-highlight-color'=>'#23d692',
            'style-link-color'=>'#23d692',
            'style-link-hover-color'=>'#333333'));

    $presetColors['skyBlue'] = ep_admin_get_color_option_attr(
        array('style-accent-color'=>'#45c1e5',
            'style-highlight-color'=>'#45c1e5',
            'style-link-color'=>'#45c1e5',
            'style-link-hover-color'=>'#333333'));

    $presetColors['blue'] = ep_admin_get_color_option_attr(
        array('style-accent-color'=>'#073b87',
            'style-highlight-color'=>'#073b87',
            'style-link-color'=>'#073b87',
            'style-link-hover-color'=>'#333333'));

    $presetColors['purple'] = ep_admin_get_color_option_attr(
        array('style-accent-color'=>'#423c6c',
            'style-highlight-color'=>'#423c6c',
            'style-link-color'=>'#423c6c',
            'style-link-hover-color'=>'#333333'));

    $presetColors['golden'] = ep_admin_get_color_option_attr(
        array('style-accent-color'=>'#dbbe7c',
            'style-highlight-color'=>'#dbbe7c',
            'style-link-color'=>'#dbbe7c',
            'style-link-hover-color'=>'#333333'));

    $customColor = array('style-accent-color'=>ep_admin_get_appearance_value('style-accent-color'),
        'style-highlight-color'=>ep_admin_get_appearance_value('style-highlight-color'),
        'style-link-color'=>ep_admin_get_appearance_value('style-link-color'),
        'style-link-hover-color'=>ep_admin_get_appearance_value('style-link-hover-color'));

    $presetColors['custom'] = ep_admin_get_color_option_attr( $customColor);

    $appearancePanel = array(
        'title' => __('Color Scheme', 'epicomedia'),
        'sections' => array(

            'theme-style' => array(
                'title'   => __('Predefined Colors', 'epicomedia'),
                'tooltip' => __('Choose one of our predefined colors schemes or choose custom to set your own color scheme.', 'epicomedia'),
                'fields'  => array(
                    'style-preset-color' => array(
                        'type'   => 'select',
                        'options'=> array('default' => 'Default Theme Colors', 'red' => 'Red', 'orange' => 'Orange', 'pink' => 'Pink', 'yellow' => 'Yellow', 'green' => 'Green', 'emerald' => 'Emerald', 'teal' => 'Teal', 'skyBlue' => 'Sky Blue', 'blue' => 'Blue', 'golden' => 'Golden','custom'=>'Custom'),
                        'option-attributes' => $presetColors
                    ),
                )
            ),//theme-style sec
            'accent-color' => array(
                'title'   => __('Accent color for theme elements.', 'epicomedia'),
                'tooltip' => __('Accent color for page elements', 'epicomedia'),
                'fields'  => array(
                    'style-accent-color' => array(
                        'type'   => 'color',
                        'label'  => __('Choose', 'epicomedia'),
                        'value'  => '#ff4c2f'
                    ),
                )
            ),//accent-color sec
            'highlight-color' => array(
                'title'   => __('Highlight color', 'epicomedia'),
                'tooltip' => __('Color for highlighted elements', 'epicomedia'),
                'fields'  => array(
                    'style-highlight-color' => array(
                        'type'   => 'color',
                        'label'  => __('Choose', 'epicomedia'),
                        'value'  => '#ff4c2f'
                    ),
                )
            ),//highlight-color sec
            'link-color' => array(
                'title'   => __('Link Color', 'epicomedia'),
                'tooltip' => __('Choose link or on-hover mode color.', 'epicomedia'),
                'fields'  => array(
                    'style-link-color' => array(
                        'type'   => 'color',
                        'label'  => __('Normal Color', 'epicomedia'),
                        'value'  => '#ff4c2f'
                    ),
                    'style-link-hover-color' => array(
                        'type'   => 'color',
                        'label'  => __('on-hover Background Color', 'epicomedia'),
                        'value'  => '#cbcbcb'
                    ),
                )
            ),//link-color sec

        )
    );//$themeStylePanel

    $preloaderPanel = array(
        'title' => __('Preloader', 'epicomedia'),
        'sections' => array(
            'loader_display' => array(
                'title'   => __('Display preloader', 'epicomedia'),
                'tooltip' => __('You can enable or disable a loader. This loader would be shown before your website is loaded completely.', 'epicomedia'),
                'fields'  => array(
                    'loader_display' => array(
                        'type'   => 'switch',
                        'state0' => __('Don\'t show', 'epicomedia'),
                        'state1' => __('show', 'epicomedia'),
                        'value'  => 0
                    ),
                )
            ),//Enable Loader
            'preloader-type' => array(
                'title'   => __('Prelaoder type', 'epicomedia'),
                'tooltip' => __('Choose the type of preloader.', 'epicomedia'),
                'fields'  => array(
                    'preloader-type' => array(
                        'type' => 'visual-select',
                        'options'=> array('creative' => 'creative','simple' => 'simple', 'circular' => 'circular', 'sniper' => 'sniper'),
                        'class' => 'home-rotator',
                        'value' => 'simple',
                    ),
                )
            ),//loader type Style
            'preloader_color' => array(
                'title'   => __('Preloader color', 'epicomedia'),
                'tooltip' => __('Preloader colors', 'epicomedia'),
                'fields'  => array(
                    'preloader_color' => array(
                        'type'   => 'color',
                        'label'  => __('Color', 'epicomedia'),
                        'value'  => '#c7c7c7'
                    ),
                    'preloader_box_color' => array(
                        'type'   => 'color',
                        'label'  => __('Box color', 'epicomedia'),
                        'value'  => '#f7f7f7'
                    ),
                    'preloader_bg_color' => array(
                        'type'   => 'color',
                        'label'  => __('Background color', 'epicomedia'),
                        'value'  => '#efefef'
                    ),
                )
            ),//Preloaders color            
           'preloader-text' => array(
                'title'   => __('Preloader Text', 'epicomedia'),
                'tooltip' => __('This text will be shown in website preloader', 'epicomedia'),
                'fields'  => array(
                    'preloader-text' => array(
                        'type' => 'text',
                        'placeholder' => __('Add preloader text here', 'epicomedia'),
                    ),
                    'preloader_text_color' => array(
                        'type'   => 'color',
                        'label'  => __('Color', 'epicomedia'),
                        'value'  => '#000'
                    ),
                )
            ),// Notification more info buttons Text
            'preloader-logo' => array(
                'title'   => __('Preloader Image', 'epicomedia'),
                'tooltip' => __('Choose an image of your choice to make it appear in preloader page. (PNG, GIF, JPG)', 'epicomedia'),
                'fields'  => array(
                    'preloader-logo' => array(
                        'type' => 'upload',
                        'title' => __('Upload Preloader Logo', 'epicomedia'),
                        'referer' => 'ep-settings-preloader'
                    ),
                )
            ),//preloader logo

        )
    );//$Pre loader Panel

    
    $notificationPanel = array(
        'title' => __('Notification Bar', 'epicomedia'),
        'sections' => array(
            'notification_display' => array(
                'title'   => __('Enable Notification Bar', 'epicomedia'),
                'tooltip' => __('You can enable or disable the notification bar here. Notification bar is the bar that sticks to top of your main page.', 'epicomedia'),
                'fields'  => array(
                    'notification_display' => array(
                        'type'   => 'switch',
                        'state0' => __('Disable', 'epicomedia'),
                        'state1' => __('Enable', 'epicomedia'),
                        'value'  => 0
                    ),
                )
            ),//Enable Notification bar 
           'notification_icon' => array(
                'title'   => __('Notification Icon', 'epicomedia'),
                'tooltip' => __('Select an icon for your notification bar (notice).', 'epicomedia'),
                'fields'  => array(
                    'notification_icon' => array(
                        'type'   => 'icon',
                        'title' => __('Notification Icon', 'epicomedia'),
                        'desc'  => __('Select an icon for Notification', 'epicomedia'),
                        'flags' => 'attribute',
                    ),
                )
            ),// Notification Icon 
           'notification_title' => array(
                'title'   => __('Notification Title', 'epicomedia'),
                'tooltip' => __('Insert your notice title to make it look bolder.', 'epicomedia'),
                'fields'  => array(
                    'notification_title' => array(
                        'type' => 'text',
                        'placeholder' => __('Add notification Title here', 'epicomedia'),
                    ),
                )
            ),// Notification Title 
            'notification_text' => array(
                'title'   => __('Notification text', 'epicomedia'),
                'tooltip' => __('Write Notification Text', 'epicomedia'),
                'fields'  => array(
                    'notification_text' => array(
                        'type' => 'text',
                        'placeholder' => __('Add notification Text here', 'epicomedia'),
                    ),
                )
            ),// Notification Text
            'notification_bg_color' => array(
                'title'   => __('Notification bar background color', 'epicomedia'),
                'tooltip' => __('Notification bar background color', 'epicomedia'),
                'fields'  => array(
                    'notification_bg_color' => array(
                        'type'   => 'color',
                        'label'  => __('Choose', 'epicomedia'),
                        'value'  => '#eb473b'
                    ),
                )
            ),//Notification bar background color
        )
    );//Notification Panel
    
    $gf = new Ep_GoogleFonts(ep_path_combine(THEME_LIB, 'googlefonts.json'));
    $fontNames = $gf->GetFontNames();

    $menuPanel = array(
        'title' => __('Header | Menu', 'epicomedia'),
        'sections' => array(
            'header-position' => array(
                'title'   => __('Header Position', 'epicomedia'),
                'tooltip' => __('Select header position', 'epicomedia'),
                'fields'  => array(
                    'header-position' => array(
                        'type' => 'visual-select',
                        'options' => array('top-menu'=>1,'left-menu'=>2,'right-menu'=>3),
                        'class' => 'header-position',
                        'value' => 1,
                    ),
                )
            ),// Menu Position
            'header-style' => array(
                'title'   => __('Header Menu Style', 'epicomedia'),
                'tooltip' => __('Select menu style', 'epicomedia'),
                'fields'  => array(
                    'header-style' => array(
                        'type' => 'visual-select',
                        'options'=> array('epico-menu' => 'epico-menu','fixed-menu' => 'fixed-menu', 'scroll-sticky' => 'scroll-sticky' , 'wave-menu' => 'wave-menu'),
                        'class' => 'menu-style',
                        'value' => 'fixed-menu',
                    ),
                )
            ),//Menu Style
            'toggle-menu-style' => array(
                'title'   => __('Toggle menu style', 'epicomedia'),
                'tooltip' => __('Toggle menu style', 'epicomedia'),
                'fields'  => array(
                    'toggle-menu-style' => array(
                        'type'   => 'switch',
                        'state1' => __('Light Icon', 'epicomedia'),
                        'state0' => __('Dark Icon', 'epicomedia'),
                        'value'  => 1
                    ),
                )
            ),//Menu Style
            'social-icon-style' => array(
                'title'   => __('Social icons style', 'epicomedia'),
                'tooltip' => __('Select style of social icons in Left/Right menu', 'epicomedia'),
                'fields'  => array(
                    'social-icon-style' => array(
                        'type'   => 'switch',
                        'state1' => __('Light Icon', 'epicomedia'),
                        'state0' => __('Dark Icon', 'epicomedia'),
                        'value'  => 1
                    ),
                ),

            ),//social icons Style
            'logo' => array(
                'title'   => __('Initial Logo', 'epicomedia'),
                'tooltip' => __('It\'s the logo that will only be shown when you load the page from the top. It will be fade-out and replaced with Logo when you scroll down.', 'epicomedia'),
                'fields'  => array(
                    'logo' => array(
                        'type' => 'upload',
                        'title' => __('Upload logo', 'epicomedia'),
                        'referer' => 'ep-settings-logo'
                    ),
                )
            ),//Logo sec
            'initial-menu-color' => array(
                'title'   => __('Initial Menu Colors', 'epicomedia'),
                'tooltip' => __('Choose the color and set the opacity for initial menu.', 'epicomedia'),
                'fields'  => array(
                    'initial-menu-background-color' => array(
                        'type'   => 'color',
                        'label'  => __('Background Color', 'epicomedia'),
                        'value'  => '#ffffff'
                    ),
                    'initial-menu-text-color' => array(
                        'type'   => 'color',
                        'label'  => __('Text Color', 'epicomedia'),
                        'value'  => '#000000'
                    ),
                    'initial-menu-text-hover-color' => array(
                        'type'   => 'color',
                        'label'  => __('On-hover Background Color', 'epicomedia'),
                        'value'  => '#f83333'
                    ),
                    'initial-menu-opacity' => array(
                        'title'  => __('Opacity', 'epicomedia'),
                        'label'  => __('%', 'epicomedia'),
                        'default'   => '100',
                        'type'   => 'range',
                        'min'   => '0',
                        'max'   => '100',
                        'step'   => '1',
                    ),
                )
            ),//initial menu colors Sec
            'logo-second' => array(
                'title'   => __('Logo', 'epicomedia'),
                'tooltip' => __('It\'s your primary menu and will be shown when you scroll down.', 'epicomedia'),
                'fields'  => array(
                    'logo-second' => array(
                        'type' => 'upload',
                        'title' => __('Upload Secound Logo', 'epicomedia'),
                        'referer' => 'ep-settings-logo'
                    ),
                )
            ),//Secound Logo sec
            'vertical_menu_background' => array(
                'title'   => __('Menu Background', 'epicomedia'),
                'tooltip' => __('Select image that Shown In Menu Background', 'epicomedia'),
                'fields'  => array(
                    'vertical_menu_background' => array(
                        'type' => 'upload',
                        'title' => __('Upload Menu Background', 'epicomedia'),
                        'referer' => 'ep-settings-vertical-background'
                    ),
                )
            ),//Logo sec
            'menu-color' => array(
                'title'   => __('Menu Colors', 'epicomedia'),
                'tooltip' => __('Choose the color and set the opacity for menu.', 'epicomedia'),
                'fields'  => array(
                    'menu-background-color' => array(
                        'type'   => 'color',
                        'label'  => __('Background Color', 'epicomedia'),
                        'value'  => '#f5f5f5'
                    ),
                    'menu-text-color' => array(
                        'type'   => 'color',
                        'label'  => __('Text Color', 'epicomedia'),
                        'value'  => '#000000'
                    ),
                    'menu-text-hover-color' => array(
                        'type'   => 'color',
                        'label'  => __('On-hover Background Color', 'epicomedia'),
                        'value'  => '#f83333'
                    ),
                    'menu-opacity' => array(
                        'title'  => __('Opacity', 'epicomedia'),
                        'label'  => __('%', 'epicomedia'),
                        'default'   => '100',
                        'type'   => 'range',
                        'min'   => '0',
                        'max'   => '100',
                        'step'   => '1',
                    ),
                )
            ),//menu colors Sec
            'menu-hover-style' => array(
                'title'   => __('Menu Hover Style', 'epicomedia'),
                'tooltip' => __('Choose menu hover style.', 'epicomedia'),
                'fields'  => array(
                    'menu-hover-style' => array(
                        'type' => 'visual-select',
                        'options'=> 
                            array (
                                'hover_style2' => 0, 
                                'hover_style1' => 1, 
                            ),
                        'class' => 'menu-hover-style',
                        'value' => 0,
                    ),
                )
            ),//menu Style
            'font-navigation' => array(
                'title'   => __('Menu Font', 'epicomedia'),
                'tooltip' => __('Select your favorite font for the menu.', 'epicomedia'),
                'fields'  => array(
                    'font-navigation' => array(
                        'type'   => 'select',
                        'options'=> $fontNames,
                        'value'  => 'Dosis'
                    ),
                )
            ),//Shortcode title's Font
            'menu-search' => array(
                'title'   => __('Search form', 'epicomedia'),
                'tooltip' => __('Enable or disable search in the header. <br> Choose an icon style for search.', 'epicomedia'),
                'fields'  => array(
                    'menu-search' => array(
                        'type'   => 'switch',
                        'state1' => __('Enable', 'epicomedia'),
                        'state0' => __('Disable', 'epicomedia'),
                        'value'  => 1
                    ),
                    'search-button-style' => array(
                        'type'   => 'switch',
                        'state1' => __('Light Icon', 'epicomedia'),
                        'state0' => __('Dark Icon', 'epicomedia'),
                        'value'  => 0
                    ),
                ),

            ),//menu Style
        )
    );//$menuPanel End

    $headerPanel = array(
        'title' => __('Intro', 'epicomedia'),
        'sections' => array(
            'home-display-switch' => array(
                'title'   => __('Intro Visibility', 'epicomedia'),
                'tooltip' => __('Enable or disable Intro.', 'epicomedia'),
                'fields'  => array(
                    'home-display-switch' => array(
                        'type'   => 'switch',
                        'state0' => __('Disabled', 'epicomedia'),
                        'state1' => __('Enabled', 'epicomedia'),
                        'value'  => 0
                    ),
                )
            ),//Display Header
           'home-type' => array(
                'title'   => __('Intro Layout', 'epicomedia'),
                'tooltip' => __('Choose your Intro Layout.', 'epicomedia'),
                'fields'  => array(
                   'home-type-switch' => array(
                        'type' => 'visual-select',
                        'options' => array (
                                'home-slider' => 'home-slider',
                                'home-map' => 'home-map',
                                'home-revolutionSlider'  => 'home-revolutionSlider' 
                        ),
                        'class' => 'intro_type',
                        'value' => 'home-slider',
                    ), 
                )
            ),//Intro Fullwidth Slider
            
            'home-slider' => array(
                'title'   => __('Intro Slider Modes', 'epicomedia'),
                'tooltip' => __('Select sliding mode of home slider<br>Select a category of slides for showing in slider', 'epicomedia'),
                'fields'  => array(
                    'fullscreen-slider-mode' => array(
                        'type' => 'visual-select',
                        'options' => array (
                                'epico' => 'epico',
                                'slide' => 'slide'
                        ),
                        'class' => 'fullscreen-slider-mode',
                        'value' => 'epico',
                        'label' => 'Sliding Mode' 
                    ),
                    'home-slider-cat' => array(
                        'type'   => 'select',
                        'options' => $sliderSlugName,
                        'label' => 'Category Of Slides' 
                    ),
                )
            ),
            'home-map' => array(
                'title'   => __('Google Map Properties', 'epicomedia'),
                'tooltip' => __('Enter your map address latitude & longitude and zoom levels. Zoom value can be from 1 to 19 where 19 is the greatest and 1 the smallest.', 'epicomedia'),
                'fields'  => array(
                    'homeMapLatitude' => array(
                            'type' => 'text',
                            'label' => __('Map latitude', 'epicomedia'),
                            'placeholder' => __('Google Maps latitude', 'epicomedia'),
                    ),
                    'homeMapLongitude' => array(
                            'type' => 'text',
                            'label' => __('Map Longitude', 'epicomedia'),
                            'placeholder' => __('Google Maps longitude', 'epicomedia'),
                    ),
                    'homeMapZoom' => array(
                        'type'   => 'select',
                        'label' => __('Map Zoom', 'epicomedia'),
                        'options'=> array('1' => 'Zoom 1', '2' => 'Zoom 2', '3' => 'Zoom 3', '4' => 'Zoom 4', '5' => 'Zoom 5', '6' => 'Zoom 6', '7' => 'Zoom 7', '8' => 'Zoom 8', '9' => 'Zoom 9', '10' => 'Zoom 10', '11' => 'Zoom 11', '12' => 'Zoom 12', '13' => 'Zoom 13', '14' => 'Zoom 14', '15' => 'Zoom 15', '16' => 'Zoom 16', '17' => 'Zoom 17', '18' => 'Zoom 18', '19' => 'Zoom 19'),
                    ),
                    'homeStyleMap' => array(
                        'type'   => 'switch',
                        'state0' => __('Standard Style', 'epicomedia'),
                        'state1' => __('Custom Style', 'epicomedia'),
                        'value'  => 1
                    )
                )
            ),//Intro Google Map
            'home-revolutionSlider' => array(
                'title'   => __('Intro Revolution Slider', 'epicomedia'),
                'tooltip' => __('Choose the desired revolution slider slideshow to be shown in intro section', 'epicomedia'),
                'fields'  => array(
                    'home-rev-slide' => array(
                            'type' => 'select',
                            'options' => ep_get_revolutionSlider_slides()
                        )
                )
            ),//Intro Revolution Slider
            'home-slider-overlay' => array(
                'title'   => __('Homepage Slider Overlay', 'epicomedia'),
                'tooltip' => __('Select an overlay color., set it\'s opacity. Select a texture to be added on the foreground of your slides.', 'epicomedia'),
                'fields'  => array(
                    'home-overlay-color' => array(
                        'type'   => 'color',
                        'label'  => __('Overlay Color', 'epicomedia'),
                        'value'  => ''
                    ),
                    'home-overlay-opacity' => array(
                        'title'  => __('Overlay opacity', 'epicomedia'),
                        'label'  => __('%', 'epicomedia'),
                        'type'   => 'range',
                        'default'   => '50',
                        'min'   => '0',
                        'max'   => '100',
                        'step'   => '1',
                    ),
                    'home-overlay-texture' => array(
                        'type' => 'visual-select',
                        'title'=> __('Choose overlay texture : ', 'epicomedia'),
                        'options' => array(
                                    'texture1'=> __('Texture1', 'epicomedia'),
                                    'texture2'=> __('Texture2', 'epicomedia'),
                                    'texture3'=> __('Texture3', 'epicomedia'),
                                    'texture4'=> __('Texture4', 'epicomedia'),
                                    'texture5'=> __('Texture5', 'epicomedia'),
                                    'texture6'=> __('Texture6', 'epicomedia'),
                                    'texture7'=> __('Texture7', 'epicomedia'),
                                    'texture8'=> __('Texture8', 'epicomedia'),
                            ),
                    ),
                )
            ),
            'home-start-btn' => array(
                'title'   => __('Start Button', 'epicomedia'),
                'tooltip' => __('Enable or disable start button.', 'epicomedia'),
                'fields'  => array(
                    'home-start-btn' => array(
                        'type'   => 'switch',
                        'state0' => __('Disabled', 'epicomedia'),
                        'state1' => __('Enabled', 'epicomedia'),
                        'value'  => 1
                    )
                )
            ),//google map sec
            'home-start-btn-style' => array(
                'title'   => __('Start Button Style', 'epicomedia'),
                'tooltip' => __('Choose a style for start button.', 'epicomedia'),
                'fields'  => array(
                    'home-start-btn-style' => array(
                        'type' => 'visual-select',
                        'options' => array (
                                'style-1' => 'style-1',
                                'style-2' => 'style-2'
                        ),
                        'class' => 'home-start-btn-style',
                        'value' => 'style-1',
                    ),
                )
            ),//sidebar-position sec

        )

    );//Intro panel

    $blogPanel = array(
        'title' => __('Blog', 'epicomedia'),
        'sections' => array(
            'blog-sidebar-position' => array(
                'title'   => __('Blog Detail Sidebar Position', 'epicomedia'),
                'tooltip' => __('Here you can disable the sidebar or choose the sidebar position in the blog detail.', 'epicomedia'),
                'fields'  => array(
                    'blog-sidebar-position' => array(
                        'type' => 'visual-select',
                        'options' => array('none'=>0, 'right-side'=>1 ),
                        'class' => 'page-sidebar',
                        'value' => 1 ,
                    )
                )
            ),//blog-sidebar-position sec
        )

    );//Blog Panel
    
    $fontsPanel = array(
        'title' => __('Fonts', 'epicomedia'),
        'sections' => array(

            'font-body' => array(
                'title'   => __('Theme Main Font', 'epicomedia'),
                'tooltip' => __('Select the font that you want to be used for most of theme elements', 'epicomedia'),
                'fields'  => array(
                    'font-body' => array(
                        'type'   => 'select',
                        'options'=> $fontNames,
                        'value'  => 'Open Sans'
                    ),
                )
            ),
            'font-headings' => array(
                'title'   => __('Headings Font', 'epicomedia'),
                'tooltip' => __('Select a font for titles and headings.', 'epicomedia'),
                'fields'  => array(
                    'font-headings' => array(
                        'type'   => 'select',
                        'options'=> $fontNames,
                        'value'  => 'Dosis'
                    ),
                )
            ),
            'font-shortcode' => array(
                'title'   => __('Shortcode Title Font', 'epicomedia'),
                'tooltip' => __('Select a font for shortcode title.', 'epicomedia'),
                'fields'  => array(
                    'font-shortcode' => array(
                        'type'   => 'select',
                        'options'=> $fontNames,
                        'value'  => 'Dosis'
                    ),
                )
            ),
        )

    );//$fontsPanel

    $sidebarPanel = array(
        'title' => __('Sidebar', 'epicomedia'),
        'sections' => array(
            'custom-sidebar' => array(
                'title'   => __('Custom Sidebar', 'epicomedia'),
                'tooltip' => __('Select a sidebar for your pages. You can customise each sidebar widget from widget panel.', 'epicomedia'),
                'fields'  => array(
                    'custom_sidebars' => array(
                        'type' => 'csv',
                        'placeholder' => __('Enter a sidebar name', 'epicomedia'),
                    ),
                )
            ),//custom-sidebar sec
            'sidebar-position' => array(
                'title'   => __('Page Sidebar Position', 'epicomedia'),
                'tooltip' => __('Choose the deafault sidebar position of those pages that have a sidebar.', 'epicomedia'),
                'fields'  => array(
                    'sidebar-position' => array(
                        'type' => 'visual-select',
                        'options' => array(/*'none'=>0,*/ 'left-side'=>1, 'right-side'=>2),
                        'class' => 'page-sidebar',
                        'value' => 2,
                    ),
                )
            ),//sidebar-position sec
        )
    );//$sidebarPanel

    $woocomerceSettingsPanel = array(
        'title' => __('WooCommerce', 'epicomedia'),
        'sections' => array(
            'shop-sidebar-position' => array(
                'title'   => __('Woocomerce Sidebar Position', 'epicomedia'),
                'tooltip' => __('Choose the default sidebar position in WooCommerce pages.', 'epicomedia'),
                'fields'  => array(
                    'shop-sidebar-position' => array(
                        'type' => 'visual-select',
                        'options' => array('none'=>0, 'left-side'=>1, 'right-side'=>2),
                        'class' => 'page-sidebar',
                        'value' => 2,
                    ),
                )
            ),//Shop sidebar position sec
            'shop-enable-zoom' => array(
                'title'   => __('Zooming of Products Images', 'epicomedia'),
                'tooltip' => __('Enable or disable zooming of products images', 'epicomedia'),
                'fields'  => array(
                    'shop-enable-zoom' => array(
                        'type'   => 'switch',
                        'state0' => __('Disabled', 'epicomedia'),
                        'state1' => __('Enabled', 'epicomedia'),
                        'value'  => 1
                    )
                )
            ),//Shop title display
            'shop-title-display' => array(
                'title'   => __('Display shop page title', 'epicomedia'),
                'tooltip' => __('Show hor hide of title in shop page', 'epicomedia'),
                'fields'  => array(
                    'shop-title-display' => array(
                        'type'   => 'switch',
                        'state0' => __('Disabled', 'epicomedia'),
                        'state1' => __('Enabled', 'epicomedia'),
                        'value'  => 0
                    )
                )
            )
        )
    );//woocomerce Settings Panel
    
    $socialSettingsPanel = array(
        'title' => __('Social', 'epicomedia'),
        'sections' => array(
            'socials' => array(
                'title'   => __('Social Network URLs', 'epicomedia'),
                'tooltip' => __('Enter your social network addresses in respective fields. You can clear fields to hide icons from the website user interface', 'epicomedia'),
                'fields'  => array(
                    'social_facebook_url' => array(
                        'type' => 'text',
                        'label' => __('Facebook', 'epicomedia'),
                    ),//Facebook
                    'social_twitter_url' => array(
                        'type' => 'text',
                        'label' => __('Twitter', 'epicomedia'),
                    ),//twitter
                    'social_vimeo_url' => array(
                        'type' => 'text',
                        'label' => __('Vimeo', 'epicomedia'),
                    ),//vimeo
                    'social_youtube_url' => array(
                        'type' => 'text',
                        'label' => __('YouTube', 'epicomedia'),
                    ),//youtube
                    'social_googleplus_url' => array(
                        'type' => 'text',
                        'label' => __('Google+', 'epicomedia'),
                    ),//Google+
                    'social_dribbble_url' => array(
                        'type' => 'text',
                        'label' => __('Dribbble', 'epicomedia'),
                    ),//dribbble
                    'social_tumblr_url' => array(
                        'type' => 'text',
                        'label' => __('Tumblr', 'epicomedia'),
                    ),//Tumblr
                    'social_linkedin_url' => array(
                        'type' => 'text',
                        'label' => __('LinkedIn', 'epicomedia'),
                    ),//LinkedIn
                    'social_flickr_url' => array(
                        'type' => 'text',
                        'label' => __('Flickr', 'epicomedia'),
                    ),//flickr
                    'social_forrst_url' => array(
                        'type' => 'text',
                        'label' => __('Forrst', 'epicomedia'),
                    ),//forrst
                    'social_github_url' => array(
                        'type' => 'text',
                        'label' => __('GitHub', 'epicomedia'),
                    ),//GitHub
                    'social_lastfm_url' => array(
                        'type' => 'text',
                        'label' => __('Last.fm', 'epicomedia'),
                    ),//Last.fm
                    'social_paypal_url' => array(
                        'type' => 'text',
                        'label' => __('PayPal', 'epicomedia'),
                    ),//Paypal
                    'social_rss_url' => array(
                        'type' => 'text',
                        'label' => __('RSS Feed', 'epicomedia'),
                        'value' => get_bloginfo('rss2_url'),
                    ),//rss
                    'social_skype_url' => array(
                        'type' => 'text',
                        'label' => __('Skype', 'epicomedia'),
                    ),//skype
                    'social_wordpress_url' => array(
                        'type' => 'text',
                        'label' => __('WordPress', 'epicomedia'),
                    ),//wordpress
                    'social_yahoo_url' => array(
                        'type' => 'text',
                        'label' => __('Yahoo', 'epicomedia'),
                    ),//yahoo
                    'social_deviantart_url' => array(
                        'type' => 'text',
                        'label' => __('DeviantART', 'epicomedia'),
                    ),//DeviantArt
                    'social_steam_url' => array(
                        'type' => 'text',
                        'label' => __('Steam', 'epicomedia'),
                    ),//Steam
                    'social_reddit_url' => array(
                        'type' => 'text',
                        'label' => __('Reddit', 'epicomedia'),
                    ),//reddit
                    'social_stumbleupon_url' => array(
                        'type' => 'text',
                        'label' => __('StumbleUpon', 'epicomedia'),
                    ),//StumbleUpon
                    'social_pinterest_url' => array(
                        'type' => 'text',
                        'label' => __('Pinterest', 'epicomedia'),
                    ),//Pinterest
                    'social_xing_url' => array(
                        'type' => 'text',
                        'label' => __('XING', 'epicomedia'),
                    ),//XING
                    'social_blogger_url' => array(
                        'type' => 'text',
                        'label' => __('Blogger', 'epicomedia'),
                    ),//Blogger
                    'social_soundcloud_url' => array(
                        'type' => 'text',
                        'label' => __('SoundCloud', 'epicomedia'),
                    ),//SoundCloud
                    'social_delicious_url' => array(
                        'type' => 'text',
                        'label' => __('Delicious', 'epicomedia'),
                    ),//delicious
                    'social_foursquare_url' => array(
                        'type' => 'text',
                        'label' => __('Foursquare', 'epicomedia'),
                    ),//Foursquare
                    'social_instagram_url' => array(
                        'type' => 'text',
                        'label' => __('Instagram', 'epicomedia'),
                    ),//Instagram
                    'social_behance_url' => array(
                        'type' => 'text',
                        'label' => __('Behance', 'epicomedia'),
                    ),//Instagram
                )
            ),//// Social Links
			'customSocial1' => array(
                'title'   => __('First custom social network', 'epicomedia'),
                'tooltip' => __('Enter the social network that was not listed. The best size for logo is 25x25 pixels. ', 'epicomedia'),
                'fields'  => array(
				     'social_custom1_title' => array(
					    'title' => __('Title', 'epicomedia'),
                        'type' => 'text',
                        'label' => __('The name of custom social network', 'epicomedia'),
                    ),
                     'social_custom1_url' => array(
                        'type' => 'text',
                        'label' => __('The URL of custom social network', 'epicomedia'),
                    ),
					'social_custom1_image' => array(
                        'type' => 'upload',
                        'label' => __('Logo Image', 'epicomedia'),
                        'title' => __('Upload logo image', 'epicomedia'),
                        'referer' => 'ep-settings-custom1-logo'
                    ),
					'social_custom1_color' => array(
						'type'  => 'color',
						'label' => __('Accent color', 'epicomedia'),
                        'value'  => '#a7a7a7'
                    ),				
                )
            ),//custom Social Link
			'customSocial2' => array(
                'title'   => __('Second custom social network', 'epicomedia'),
                'tooltip' => __('Enter the social network that was not listed. The best size for logo is 25x25 pixels. ', 'epicomedia'),
                'fields'  => array(
				     'social_custom2_title' => array(
					    'title' => __('Title', 'epicomedia'),
                        'type' => 'text',
                        'label' => __('The name of custom social network', 'epicomedia'),
                    ),
                     'social_custom2_url' => array(
                        'type' => 'text',
                        'label' => __('The URL of custom social network', 'epicomedia'),
                    ),
					'social_custom2_image' => array(
                        'type' => 'upload',
                        'label' => __('Logo Image', 'epicomedia'),
                        'title' => __('Upload logo image', 'epicomedia'),
                        'referer' => 'ep-settings-custom2-logo'
                    ),
					'social_custom2_color' => array(
						'type'  => 'color',
						'label' => __('Accent color', 'epicomedia'),
                        'value'  => '#a7a7a7'
                    ),				
                )
            ),//custom Social Link
        ),
    );

    $footerSettingsPanel = array(
        'title' => __('Footer Settings', 'epicomedia'),
        'sections' => array(
            'footer_title' => array(
                'title'   => __('Footer Title And Subtitle', 'epicomedia'),
                'tooltip' => __('Enter footer title and subtitle text here. ', 'epicomedia'),
                'fields'  => array(
                    'footer_title' => array(
                        'type' => 'text',
                        'label' => __('Title Text', 'epicomedia'),
                        'value' => ''
                    ),//footer_title sec
                     'footer_subtitle' => array(
                        'type' => 'text',
                        'label' => __('Subtitle Text', 'epicomedia'),
                        'value' => ''
                    ),//footer_subtitle sec
                )
            ),//widget-areas sec
            'widget-areas' => array(
                'title'   => __('Widget Areas', 'epicomedia'),
                'tooltip' => __('Choose the style of widget area in footer', 'epicomedia'),
                'fields'  => array(
                    'footer_widgets' => array(
                        'type' => 'visual-select',
                        'options' => array('zero' => 0, 'one'=>1, 'Six-Six'=>2, 'eight-four'=>3, 'four-eight'=>4 , 'four-four-four'=>5 ),
                        'class' => 'footer-widgets',
                        'value' => 0,
                    ),
                )
            ),//widget-areas sec
            'footer-widget-banner' => array(
                'title'   => __('Widget Area Background', 'epicomedia'),
                'tooltip' => __('Upload an image to be shown as Widget area background', 'epicomedia'),
                'fields'  => array(
                    'footer-widget-banner' => array(
                        'type' => 'upload',
                        'label' => __('Background Image', 'epicomedia'),
                        'title' => __('Upload Footer banner', 'epicomedia'),
                        'referer' => 'ep-settings-footer-banner'
                    ),
                    'footer-widget-color' => array(
                        'type'   => 'color',
                        'label'  => __('Background Color', 'epicomedia'),
                        'value'  => '#fff'
                    ),
                )
            ),//Footer widget banner sec
            'copyright-message' => array(
                'title'   => __('Copyright', 'epicomedia'),
                'tooltip' => __('Enter footer copyright text. ', 'epicomedia'),
                'fields'  => array(
                    'footer-copyright' => array(
                        'type' => 'text',
                        'label' => __('Copyright Text', 'epicomedia'),
                        'value' => '&copy; 2015 EpicoMedia | Built With The Vertex Theme'
                    ),//footer_copyright sec
                )
            ),//widget-areas sec
            'footer-logo' => array(
                'title'   => __('Footer logo', 'epicomedia'),
                'tooltip' => __('Upload an image to be shown as footer logo', 'epicomedia'),
                'fields'  => array(
                    'footer-logo' => array(
                        'type' => 'upload',
                        'label' => __('Footer Logo', 'epicomedia'),
                        'title' => __('Upload Footer Logo', 'epicomedia'),
                        'referer' => 'ep-settings-footer-logo'
                    ),
                )
            ),//Footer banner sec
            'footerStyle' => array(
                'title'   => __('Footer Style', 'epicomedia'),
                'tooltip' => __('You can choose between Dark And Light', 'epicomedia'),
                'fields'  => array(
                    'footerStyle' => array(
                        'type'   => 'switch',
                        'state0' => __('Light', 'epicomedia'),
                        'state1' => __('Dark', 'epicomedia'),
                        'value'  => 0
                    )
                )
            ),//google map Style sec
        ),
    );
    
    $mapSettingsPanel = array(
        'title' => __('Map Settings', 'epicomedia'),
        'sections' => array(
            'footer-enable-map' => array(
                'title'   => __('Map Visibility', 'epicomedia'),
                'tooltip' => __('Enable or disable map in the footer.', 'epicomedia'),
                'fields'  => array(
                    'footer-enable-map' => array(
                        'type'   => 'switch',
                        'state0' => __('Disabled', 'epicomedia'),
                        'state1' => __('Enabled', 'epicomedia'),
                        'value'  => 1
                    )
                )
            ),//google map sec
            'footerStyleMap' => array(
                'title'   => __('Map Style', 'epicomedia'),
                'tooltip' => __('You can choose one of available map styles to be shown in contact section.', 'epicomedia'),
                'fields'  => array(
                    'footerStyleMap' => array(
                        'type'   => 'switch',
                        'state0' => __('Standard', 'epicomedia'),
                        'state1' => __('Custom', 'epicomedia'),
                        'value'  => 1
                    )
                )
            ),//google map Style sec
            'footer-properties-map' => array(
                'title'   => __('Google Map Properties', 'epicomedia'),
                'tooltip' => __('Enter your map address latitude & longitude and zoom levels. Zoom value can be from 1 to 19 where 19 is the greatest and 1 the smallest.', 'epicomedia'),
                'fields'  => array(
                    'footerMapLatitude' => array(
                            'type' => 'text',
                            'label' => __('Map latitude', 'epicomedia'),
                            'placeholder' => __('Google Maps latitude', 'epicomedia'),
                    ),
                    'footerMapLongitude' => array(
                            'type' => 'text',
                            'label' => __('Map longitude', 'epicomedia'),
                            'placeholder' => __('Google Maps longitude', 'epicomedia'),
                    ),
                    'footerMapZoom' => array(
                        'type'   => 'select',
                        'label' => __('Map Zoom', 'epicomedia'),
                        'options'=> array('1' => 'Zoom 1', '2' => 'Zoom 2', '3' => 'Zoom 3', '4' => 'Zoom 4', '5' => 'Zoom 5', '6' => 'Zoom 6', '7' => 'Zoom 7', '8' => 'Zoom 8', '9' => 'Zoom 9', '10' => 'Zoom 10', '11' => 'Zoom 11', '12' => 'Zoom 12', '13' => 'Zoom 13', '14' => 'Zoom 14', '15' => 'Zoom 15', '16' => 'Zoom 16', '17' => 'Zoom 17', '18' => 'Zoom 18', '19' => 'Zoom 19')
                    )
                )

            ),//footer Google Map properties
            'map_marker' => array(
                'title'   => __('Map Marker', 'epicomedia'),
                'tooltip' => __('Upload an image to be shown as google map marker', 'epicomedia'),
                'fields'  => array(
                    'map_marker' => array(
                        'type' => 'upload',
                        'label' => __('Map Marker', 'epicomedia'),
                        'title' => __('Upload Map Marker Logo', 'epicomedia'),
                        'referer' => 'ep-settings-footer-logo'
                    ),
                )
            ),// Google Map Marker
        ),
    );

    $extraSettingsPanel = array(
        'title' => __('Custom Scripts', 'epicomedia'),
        'sections' => array(

            'additional-js' => array(
                'title'   => __('Additional JavaScript', 'epicomedia'),
                'tooltip' => __('Enter custom JavaScript code such as Google Analytics code here. Please note that you should not include &lt;script&gt; tags in your scripts.', 'epicomedia'),
                'fields'  => array(
                    'additional-js' => array(
                        'type' => 'textarea'
                    ),
                )
            ),//additional-js sec
            'additional-css' => array(
                'title'   => __('Custom CSS', 'epicomedia'),
                'tooltip' => __('Enter custom CSS code such as style overrides here. Please note that you should not include &lt;style&gt; tags in your css code.', 'epicomedia'),
                'fields'  => array(
                    'additional-css' => array(
                        'type' => 'textarea'
                    ),
                )
            ),//additional-js sec

        ),
    );

    $apiSettingsPanel = array(
        'title' => __('API Keys', 'epicomedia'),
        'sections' => array(

            'google-api' => array(
                'title'   => __('Google API Key', 'epicomedia'),
                'tooltip' => __('Google API key for services such as Google Maps. Click <a href="https://developers.google.com/maps/documentation/javascript/tutorial#api_key" target="_blank">here</a> for more information on how to obtain Google API key.', 'epicomedia'),
                'fields'  => array(
                    'google-api-key' => array(
                        'type' => 'text'
                    ),
                )
            ),//additional-js sec
        ),
    );

    $panels = array(

        'general'    => $generalSettingsPanel,
        'preloader'       => $preloaderPanel,
        'notification'       => $notificationPanel,
        'menu'       => $menuPanel,
        'appearance' => $appearancePanel,
        'header'     => $headerPanel,
        'blog'       => $blogPanel,
        'fonts'      => $fontsPanel,
        'social'     => $socialSettingsPanel,
        'footer'     => $footerSettingsPanel,
        'map'        => $mapSettingsPanel,
        'woocomerce'     => $woocomerceSettingsPanel,
        'sidebar'    => $sidebarPanel,
        'extra'      => $extraSettingsPanel,
    );

    $tabs = array(
        'general'           => array( 'text' => __('General Settings', 'epicomedia'), 'panel' => 'general'),
        'preloader'         => array( 'text' => __('Preloader', 'epicomedia'), 'panel' => 'preloader'),
        'notification'      => array( 'text' => __('Notification Bar', 'epicomedia'), 'panel' => 'notification'),
        'menu'              => array( 'text' => __('Header | Menu', 'epicomedia'), 'panel' => 'menu'),
        'appearance'        => array( 'text' => __('Color Scheme', 'epicomedia'), 'panel' => 'appearance'),
        'header'            => array( 'text' => __('Homepage Slider', 'epicomedia'), 'panel'  => 'header'),
        'blog'              => array( 'text' => __('Blog', 'epicomedia'), 'panel'  => 'blog'),
        'fonts'             => array( 'text' => __('Fonts', 'epicomedia'), 'panel'  => 'fonts'),
        'footer'            => array( 'text' => __('Footer', 'epicomedia'), 'panel'  => 'footer'),
        'map'               => array( 'text' => __('Map', 'epicomedia'), 'panel'  => 'map'),
        'sidebar'           => array( 'text' => __('Sidebar', 'epicomedia'), 'panel' => 'sidebar'),
        'woocomerce'        => array( 'text' => __('WooCommerce', 'epicomedia'), 'panel' => 'woocomerce'),
        'social'            => array( 'text' => __('Social', 'epicomedia'),  'panel' => 'social'),
        'extra'             => array( 'text' => __('Additional Scripts', 'epicomedia'),  'panel' => 'extra'),
    );

    $tabGroups = array(
        'theme-settings' => array( 'text' => __('Theme Settings', 'epicomedia'), 'tabs' => array('general',  'appearance' , 'preloader', 'notification' ,  'menu',  'header' ,  'blog', 'fonts', 'sidebar', 'woocomerce' , 'footer', 'map' ,  'social' /* , 'api' */  ), 'icon' => 'dashicons-admin-generic' ),
        'advanced-settings' => array( 'text' => __('Advanced Options', 'epicomedia'), 'tabs' => array('extra'), 'icon' => 'dashicons-admin-settings' )
    );

    $settings = array(
        'document-url' => 'http://epicomedia.net/documentation/vertex/index.html',
        'support-url'  => 'http://support.epicomedia.net/',
        'tabs-title'   => __('Theme Options', 'epicomedia'),
        'tab-groups'   => $tabGroups,
        'tabs'         => $tabs,
        'panels'       => $panels,
    );

    return $settings;
}