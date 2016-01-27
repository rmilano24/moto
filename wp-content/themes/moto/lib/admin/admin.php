<?php 

require_once('admin-base.php');

//Extended admin class
class Ep_Admin extends Ep_ThemeAdmin
{

    function Ep_Enqueue_Scripts()
    {
        wp_enqueue_script('jquery');
        wp_enqueue_script('thickbox');
        wp_enqueue_style('thickbox');
        wp_enqueue_script('media-upload');
        wp_enqueue_script('hoverIntent');
        wp_enqueue_script('jquery-easing');
        wp_enqueue_style('nouislider');
        wp_enqueue_script('nouislider');
        wp_enqueue_style('colorpicker0');
        wp_enqueue_script('colorpicker0');
        wp_enqueue_style('chosen');
        wp_enqueue_script('chosen');
        wp_enqueue_style('theme-admin-css');
        wp_enqueue_script('theme-admin-script');
        wp_enqueue_script('theme-admin-options', THEME_ADMIN_URI . '/scripts/options-panel.js');
    }
}

new Ep_Admin();