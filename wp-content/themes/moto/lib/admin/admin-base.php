<?php

require_once('mediabox-strings.php');
include_once('form-settings.php');

class Ep_ThemeAdmin
    {
    function __construct() {
        $this->ep_Activation();

        add_action("admin_menu", array( &$this, "Ep_Setup_Menus"));
        add_action( 'admin_bar_menu', array(&$this,'Ep_toolbar_link_theme_setting'), 999 );
        add_action('admin_enqueue_scripts', array(&$this, 'Ep_Admin_Scripts'));
        add_action('admin_init', array(&$this, 'Ep_Admin_Init') );
        add_action('after_setup_theme', array(&$this, 'Ep_After_Setup') );
        add_action('wp_ajax_theme_save_options', array(&$this, 'Ep_Save_Options'));
    }

    function Ep_toolbar_link_theme_setting( $wp_admin_bar ) {
        $args = array(
            'id'    => 'theme_setting',
            'title' => __('Epico Theme Setting','epicomedia'),
            'parent'=> 'site-name',
            'href'  => admin_url("admin.php?page=theme_settings"),
            'meta'  => array( 'class' => 'my-toolbar-page' ),
        );
        $wp_admin_bar->add_node( $args );
    }
    
    function Ep_Save_Options()
    {
        $options = get_option( OPTIONS_KEY );

        foreach($options as $key => $value)
        {
            $newVal = isset($_POST[$key]) ? $_POST[$key] : '';
            $options[$key] = $newVal;
        }

        update_option(OPTIONS_KEY, $options);

        echo 'OK';
        die(); // this is required to return a proper result
    }


    function Ep_After_Setup()
    {
    
        if (class_exists('WPBakeryVisualComposerAbstract')) {
        
            //Enable Visual composer in portfolio
            $pt_array = vc_settings()->get( 'content_types' );
            if(is_array($pt_array))
            {
                if(!in_array("portfolio",$pt_array))
                    $pt_array[] = "portfolio";

                if(!in_array("page",$pt_array))
                    $pt_array[] = "page";

                vc_settings()->set( 'content_types', $pt_array );
            }
        }
        
        //Initialize default options
        //delete_option(OPTIONS_KEY);
        $options  = get_option( OPTIONS_KEY );
        $defaults = ep_admin_get_defaults();

        // Are our options saved in the DB?
        if ( false !== $options )
        {
            $changed = false;
            //Add new keys if any
            foreach($defaults as $key => $value)
            {
                if(!array_key_exists($key, $options))
                {
                    //Add default value
                    $options[$key] = $value;
                    $changed = true;
                }
            }

            //Check if any key removed from defaults
            foreach($options as $key => $value)
            {
                if(!array_key_exists($key, $defaults))
                {
                    //Remove the option
                    unset($options[$key]);
                    $changed = true;
                }
            }

            if($changed)
                update_option(OPTIONS_KEY, $options);

            return;
        }

        // If not, we'll save our default options
        add_option( OPTIONS_KEY, $defaults );
    }

    function ep_Activation()
    {
        // Redirect To Theme Options Page on Activation
        if (isset($_GET['activated'])){
            wp_redirect(admin_url("admin.php?page=theme_settings"));
        }
    }

    function Ep_Setup_Menus() {
        add_theme_page(THEME_NAME, 'Theme Settings', 'manage_options',
        'theme_settings', array(&$this, 'Ep_Admin_Page'));
    }

    function Ep_Admin_Init()
    {
        if(in_array($GLOBALS['pagenow'], array('media-upload.php', 'async-upload.php'))) {
            // Now we'll replace the 'Insert into Post Button' inside Thickbox
            add_filter( 'gettext', array(&$this, 'Ep_Replace_Thickbox_Text')  , 1, 3 );
        }

        wp_enqueue_style( 'icomoon', THEME_CSS_URI . '/icomoon.css' );
        wp_enqueue_style( 'elegant', THEME_CSS_URI . '/elegant.css' );
    }

    function Ep_Replace_Thickbox_Text($translated_text, $text, $domain)
    {
        if ('Insert into Post' == $text) {

            $texts = ep_get_mediaBox_strings();

            foreach($texts as $key => $value)
            {
                $referer = strpos( wp_get_referer(), $key );

                if ( $referer !== false ) {
                    return $value;
                }

            }

        }

        return $translated_text;
    }

    function Ep_Admin_Page()
    {
        $page = include(THEME_ADMIN . '/forms.php');
    }

    function Ep_Admin_Scripts()
    {
        if (!isset($_GET['page']) || $_GET['page'] != 'theme_settings' )
            return;

        $this->Ep_Register_Scripts();
        $this->Ep_Enqueue_Scripts();
    }

    function Ep_Register_Scripts()
    {
        wp_register_script('jquery-easing', THEME_ADMIN_URI  .'/scripts/jquery.easing.1.3.js', array('jquery'), '1.3.0');

        wp_register_style( 'nouislider', THEME_ADMIN_URI . '/css/jquery.nouislider.min.css', false, '7.0.10', 'screen' );
        wp_register_script('nouislider', THEME_ADMIN_URI  .'/scripts/jquery.nouislider.min.js', array('jquery'), '7.0.10');

        wp_register_style( 'colorpicker0', THEME_ADMIN_URI . '/css/colorpicker.css', false, '1.0.0', 'screen' );
        wp_register_script('colorpicker0', THEME_ADMIN_URI  .'/scripts/colorpicker.js', array('jquery'), '1.0.0');

        wp_register_style( 'chosen', THEME_ADMIN_URI . '/css/chosen.css', false, '1.0.0', 'screen' );
        wp_register_script('chosen', THEME_ADMIN_URI  .'/scripts/chosen.jquery.min.js', array('jquery'), '1.0.0');

        wp_register_style( 'theme-admin-css', THEME_ADMIN_URI . '/css/style.css', false, '1.0.0', 'screen' );
        wp_register_script('theme-admin-script', THEME_ADMIN_URI  .'/scripts/admin.js', array('jquery'), '1.0.0');
    }

    function Ep_Enqueue_Scripts()
    {

    }
	
}