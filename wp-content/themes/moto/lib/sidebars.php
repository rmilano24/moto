<?php

if ( !function_exists('register_sidebar') )
    return;

$defaults = array(
    'name' => __('Main Sidebar', 'epicomedia'),
    'before_widget' => '<div id="%1$s" class="widget %2$s">',
    'after_widget' => '</div>',
    'before_title' => '<h4 class="widget-title">',
    'after_title' => '</h4>',
);

$footerWidgets = ep_opt('footer_widgets');

if($footerWidgets ==2 || $footerWidgets ==3 || $footerWidgets == 4)
{
    $footerWidgets =2;
}
else if ($footerWidgets == 5)
{
    $footerWidgets = 3;
}

//Main sidebar
register_sidebar(array_merge($defaults, array('id'=> 'main-sidebar')));

//Page sidebar
register_sidebar(array_merge($defaults, array('name'=>__('Page Sidebar', 'epicomedia'), 'id' => 'page-sidebar')));

//Footer widgets
for($i=0; $i<$footerWidgets;$i++)
{
    register_sidebar(array_merge($defaults, array('name'=>__('Footer Widget ' . ($i+1), 'epicomedia'), 'id'   => 'footer-widget-'. ($i+1) )));
}

//Woocommerce Sidebar 
register_sidebar(array_merge($defaults, array('name'=>__('Woocommerce Sidebar', 'epicomedia'), 'id'   => 'woocommerce-sidebar')));

// WooCommerce Drop Down Cart 
register_sidebar(array_merge($defaults, array('name'=>__('Woocommerce Drop Down cart', 'epicomedia'), 'id'   => 'woocommerce_dropdown_cart', 'description' => esc_html__('This widget area should be used only for WooCommerce dropdown cart widget', 'epicomedia'))));

// WooCommerce Wishlist 
register_sidebar(array_merge($defaults, array('name'=>__('Woocommerce wishlist', 'epicomedia'), 'id'   => 'woocommerce_wishlist', 'description' => esc_html__('This widget area should be used only for WooCommerce Wishlist', 'epicomedia'))));

//Custom Sidebars
if(ep_opt('custom_sidebars') != '')
{
    $sidebars = explode(',', ep_opt('custom_sidebars'));
    $i=0;

    foreach($sidebars as $bar)
    {
        register_sidebar(array_merge($defaults, array(
            'id'   => "custom-$i",
            'name' => str_replace('%666', ',', $bar),
        )));

        $i++;
    }
}