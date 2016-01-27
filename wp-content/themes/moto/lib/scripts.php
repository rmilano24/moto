<?php
function ep_theme_scripts() {

    //Register google fonts
    ep_theme_fonts();

    //Register Styles
    wp_enqueue_style('ep_style', get_bloginfo('stylesheet_url'), false, THEME_VERSION);

    //responcive style
    wp_enqueue_style('ep_responsive-style', THEME_CSS_URI . '/responsive.css', false, THEME_VERSION);

    //Add style overrides
    ob_start();
    include(ep_path_combine(THEME_CSS, 'styles-inline.php'));
    wp_add_inline_style('ep_style', ob_get_clean());

    if (!is_admin()) {
        wp_enqueue_script('jquery');
    }

    // All Scripts
    wp_register_script('ep_allscripts', THEME_JS_URI . '/allscripts.js', false, '1.0', true );
    
    // modernizr ( include Html5shiv - Touch events - Add css classes - modernizer load
    wp_register_script('ep_modernizr', THEME_JS_URI . '/modernizr.js', false, '2.8.3', true );
     
    // Modified Scripts
    wp_register_script('ep_modifiedscripts', THEME_JS_URI . '/modifiedscripts.js', false, '1.0', true );    
    
    //smothScroll
    wp_register_script( 'ep_smoothscroll', THEME_JS_URI . '/jquery.smoothscroll.min.js', false, '1.3.8', true );
   
    //select2
    wp_register_script( 'ep_select2', THEME_JS_URI . '/select2.min.js', false, '3.5.2', true );
    
    //swiper Slider
    wp_register_style('ep_swiper', THEME_CSS_URI. '/swiper.min.css', false, '3.1.0', 'screen');
   
    //Media Element
    wp_register_style('ep_mediaelementCSS', THEME_CSS_URI. '/mediaelementplayer.min.css', false, '2.17.0', 'screen');
    wp_register_script('ep_mediaelementJSS', THEME_JS_URI . '/mediaelement-and-player.min.js', false, '2.17.0', true );
    
	// Gallery
    wp_register_style('ep_lightGalleryCSS', THEME_CSS_URI . '/lightgallery.min.css', false, '2.17.0', 'screen'); 
	wp_register_script('ep_lightGallery', THEME_JS_URI . '/lightgallery.min.js', false, '2.17.0', true); 
	
    //isotope
    wp_register_style('ep_portfolio-isotope', THEME_CSS_URI. '/isotope.css', false, '1.5.26', 'screen');

    //Custom Scrollbar
    wp_register_style('ep_mCustomScrollbar', THEME_CSS_URI. '/jquery.mCustomScrollbar.min.css', false, '3.0.9', 'screen');

    //Google map
    wp_register_script( 'ep_gmap3', THEME_JS_URI . '/gmap3.min.js', false,'6.0.0',true );

    if (class_exists('WPBakeryVisualComposerAbstract')) {
        //functions of js_composer_front.js ( Visual composer plugin) redefined in document ready state of page
        wp_register_script( 'ep_visual_composer_functions', THEME_URI . '/extendvc/js/js_composer_front_functions.js', false,WPB_VC_VERSION,true );
    }
    
    // Svg Script For Wave menu 
    wp_register_script( 'ep_snapsvg', THEME_JS_URI . '/snap.svg-min.js', false,'0.4.1',true );
        
    // Swiper slider 
    wp_enqueue_style('ep_swiper');
    
    //Isotope Plugin
    wp_enqueue_style('ep_portfolio-isotope');
	
    // Custom Scroll Bar 
   	wp_enqueue_style('ep_mCustomScrollbar');
       
    // all scripts
    wp_enqueue_script('ep_allscripts');

    //modernizr 
    wp_enqueue_script('ep_modernizr');
    
    // Modified Scripts
    wp_enqueue_script('ep_modifiedscripts');
    
    // Media Element
    wp_enqueue_style('ep_mediaelementCSS');
    wp_enqueue_script('ep_mediaelementJSS');
	
	//Gallery
    wp_enqueue_script('ep_lightGallery');
    wp_enqueue_style('ep_lightGalleryCSS');
    
    if(isset($_SERVER['HTTP_USER_AGENT']) ) {
        if (!(strstr($_SERVER['HTTP_USER_AGENT'], 'iPad'))) {
            if (strpos($_SERVER['HTTP_USER_AGENT'], 'Chrome') !== false) {
            // User agent is Google Chrome
                wp_enqueue_script('ep_smoothscroll');//SmoothScroll
            }
        }         
    }
    
    if ( function_exists( 'is_woocommerce' )) {
        wp_enqueue_script( 'ep_select2');  // products page top selector
    }    

    //Google maps handler
    wp_enqueue_script('ep_googleMap',"http://maps.google.com/maps/api/js?v=3.15?sensor=false&amp;language=en",array(),THEME_VERSION,true);

    //google Map - gmap3
    wp_enqueue_script('ep_gmap3');

    if (class_exists('WPBakeryVisualComposerAbstract')) {
        //js_composer_front.js ( visual composer plugin )functions redefined in document ready state of jquery
        wp_enqueue_script('ep_visual_composer_functions');
    }   
    
    $headerstyle = ep_opt('header-style');
    
    if ($headerstyle == 'wave-menu' ) { // SVG For Wave  Menu 
        // SVG For Wave  Menu 
        wp_enqueue_script('ep_snapsvg');
    }
    

	
    //Custom Script
    wp_enqueue_script(
        'ep_custom',
        THEME_JS_URI . '/custom.js',
        false,
        THEME_VERSION,
        true
    );
    
    // Localize custom.js with url of site
    wp_localize_script( 'ep_custom', 'site_url', array(
        'url' => get_site_url(),
        )
    );

    // Enqueue scripts for like system
    wp_localize_script( 'ep_custom', 'ajax_var', array(
		'url' => admin_url( 'admin-ajax.php' ),
		'nonce' => wp_create_nonce( 'ajax-nonce' )
		)
	);
    
    // home And Footer Google Map Variables
    $mapJs = array(
        'zoomLevel' => ep_opt('footerMapZoom'),
        'iconMap' => (ep_opt('map_marker') ? ep_opt('map_marker') : get_template_directory_uri() ."/assets/img/marker.png") ,
        'customMap' => ep_opt('footerStyleMap'),
        'cityMapCenterLat' => ep_opt('footerMapLatitude'),
        'cityMapCenterLng' => ep_opt('footerMapLongitude'),
        'homeZoomLevel' => ep_opt('homeMapZoom'),
        'homeIconMap' =>  get_template_directory_uri() ."/assets/img/marker.png",
        'homeCustomMap' => ep_opt('homeStyleMap'),
        'homeCityMapCenterLat' => ep_opt('homeMapLatitude'),
        'homeCityMapCenterLng' => ep_opt('homeMapLongitude')
    );
    wp_localize_script('ep_custom', 'epicoJsMap', $mapJs );

    // scrooling options
    $speedJs = array(
        'scrolling_speed' => ep_opt('scrolling-speed'),
        'scrolling_easing' => ep_opt('scrolling-easing'),
    );
    wp_localize_script('ep_custom', 'epicoJsSpeed', $speedJs );
    
    
    // additional scripts
	$custom=ep_opt('additional-js');
	$custom=str_replace("<script>","",$custom);
	$custom=str_replace("</script>","",$custom);
	
    $additionaljs = array(
        'additionaljs' => $custom,
    );

    wp_localize_script('ep_custom', 'epicoAdditionalJs', $additionaljs );

    wp_localize_script(
        'ep_custom',
        'theme_uri',
        array(
            'img' => THEME_IMAGES_URI
        )
    );

    wp_localize_script( 'ep_custom', 'theme_strings', array('contact_submit'=>__('Send', 'epicomedia') ) );

    //get exception pages of ajax
    $no_ajax_pages = no_ajax_pages();
    wp_localize_script( 'ep_custom', 'no_ajax_objects', array(
        'no_ajax_pages' => $no_ajax_pages
    ));

    ep_Load_Posts_Init();

}
add_action('wp_enqueue_scripts', 'ep_theme_scripts' , 1);

function ep_remove_prettyphoto () {

    if ( function_exists( 'is_woocommerce' )  ) {
      
        wp_dequeue_style('woocommerce_prettyPhoto_css');
        wp_dequeue_script('prettyPhoto'); 
        wp_dequeue_script('prettyPhoto-init'); 
    }
}
add_action('wp_enqueue_scripts', 'ep_remove_prettyphoto' , 99 );

//load more function
function ep_Load_Posts_Init() {

    // Add some parameters for the JS - blog load more .
    $queryArgsPost = array (
        'post_type'      => 'post',
    );
    $query = new WP_Query($queryArgsPost);
    $max = $query-> max_num_pages;
    $paged = ( get_query_var('paged') > 1 ) ? get_query_var('paged') : 1;

    wp_localize_script(
        'ep_custom',
        'paged_data',
        array(
            'startPage' => $paged,
            'maxPages' => $max,
            'nextLink' => next_posts($max, false),
            'loadingText' => __('Loading...', 'epicomedia'),
            'loadMoreText' => __('More posts', 'epicomedia'),
            'noMorePostsText' => __('No More Posts', 'epicomedia')
        )
    );
    wp_reset_postdata();

}

//Custom stylesheet file to the TinyMCE visual editor
function ep_add_editor_styles()
{
    add_editor_style();
}

add_action( 'init', 'ep_add_editor_styles' );

function ep_theme_fonts()
{
    $fontBody     = ep_opt('font-body');
    $fontHeading  = ep_opt('font-headings');
    $fontNav      = ep_opt('font-navigation');
    $ShortcodeFont  = ep_opt('font-shortcode');
    $fontTextRotator = '';

    
    $slides = get_posts(array(
      'post_type' => 'slider',
      'numberposts' => -1,
      'tax_query' => array(
        array(
          'taxonomy' => 'slider_cats',
          'field' => 'slug',
          'terms' =>  ep_opt('home-slider-cat'), 
        )
      )
    ));


    foreach ($slides as $slideID) {
        $caption_style = get_post_meta( $slideID->ID, 'caption-style' ,true );
        if ( $caption_style == 'style5') {    
            $fontTextRotator = 'Arvo';        
        }
    }
    
    
    //Fix for setup problem (shouldn't happen after the update, just for old setups)
    if('' == $fontBody && '' == $fontHeading && '' == $fontNav && '' == $ShortcodeFont )
        $fontBody = $fontHeading  = $fontNav = $ShortcodeFont = '';
        

    if ($fontTextRotator != '' ){
    
        $fonts  = array($fontBody, $fontHeading , $fontNav , $ShortcodeFont , $fontTextRotator);
        $fontVariants = array(array(300,400,500,600,700), array(300,400,500,600), array(400) , array(300,400,500,600) , array(400));//Suggested variants if available 
       
    } else {
        
        $fonts  = array($fontBody, $fontHeading , $fontNav , $ShortcodeFont);
        $fontVariants = array(array(300,400,500,600,700), array(300,400,500,600), array(400) , array(300,400,500,600));//Suggested variants if available
    }

    $fonts        = array_filter($fonts);//remove empty elements
    $fontList     = array();
    $fontReq      = 'http://fonts.googleapis.com/css?family=';
    $gf           = new ep_GoogleFonts(ep_path_combine(THEME_LIB, 'googlefonts.json'));

    //Build font list
    foreach($fonts as $key => $font)
    {
        $duplicate = false;
        //Search for duplicate
        foreach($fontList as $item)
        {
            if($font == $item['font'])
            {
                $duplicate = true;
                $item['variants'] = array_unique(array_merge($item['variants'], $fontVariants[$key]));
                break;
            }
        }

        //Add
        if(!$duplicate)
            $fontList[] = array('font'=>$font, 'variants'=>$fontVariants[$key]);
    }

    $temp=array();
    foreach($fontList as $item)
    {
        $font = $gf->GetFontByName($item['font']);

        if(null==$font)
            continue;

        $variants = array();
        foreach($item['variants'] as $variant)
        {
            //Check if font object has the variant
            if(in_array($variant, $font->variants))
            {
                $variants[] = $variant;
            }
            else if(400 == $variant && in_array('regular', $font->variants))
            {
                $variants[] = $variant;
            }
        }

        $query = preg_replace('/ /', '+', $item['font']);

        if(count($variants))
            $query .= ':' . implode(',', $variants);

        $temp[] = $query;
    }

    if(count($temp))
    {
        $fontReq .= implode('|', $temp);
        wp_enqueue_style('ep_fonts', $fontReq);
    }
}
