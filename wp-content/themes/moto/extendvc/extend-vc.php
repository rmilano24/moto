<?php

    function ep_vc_enqueue_main_css_forever() {
        wp_enqueue_style('js_composer_front');
    }

    add_action('wp_enqueue_scripts', 'ep_vc_enqueue_main_css_forever');

    function ep_vc_icons_field ($settings, $value) {
       $icons = array('mobile','laptop','desktop','tablet','phone','document','documents','search','clipboard','newspaper','notebook','book-open','browser','calendar','presentation','picture','pictures','video','camera','printer','toolbox','briefcase','wallet','gift','bargraph','grid','expand','focus','edit','adjustments','ribbon','hourglass','lock','megaphone','shield','trophy','flag','map','puzzle','basket','envelope','streetsign','telescope','gears','key','paperclip','attachment','pricetags','lightbulb','layers','pencil','tools','tools-2','scissors','paintbrush','magnifying-glass','circle-compass','linegraph','mic','strategy','beaker','caution','recycle','anchor','profile-male','profile-female','bike','wine','hotairballoon','globe','genius','map-pin','dial','chat','heart','cloud','upload','download','target','hazardous','piechart','speedometer','global','compass','lifesaver','clock','aperture','quote','scope','alarmclock','refresh','happy','sad','facebook','twitter','googleplus','rss','tumblr','linkedin','dribbble','heart2','cloud2','star','tv','sound','video2','trash','user','key2','search2','settings','camera2','tag','lock2','bulb','pen','diamond','display','location','eye','bubble','stack','cup','phone2','news','mail','like','photo','note','clock2','paperplane','params','banknote','data','music','megaphone2','study','lab','food','t-shirt','fire','clip','shop','calendar2','wallet2','vynil','truck','world','link','calendar3','calendar4','file','file2','drink','coffee','mug','cake','notice','notice2','cogs','warning','picture2','cassette','headphones','wallet3','eye2','cloud3','gamepad','sale','lab2','radio','medal','medal2','cord','locked','unlocked','stack2','stack3','lamp','umbrella','bomb','patch','pil','injection','grid2','grid3','list','list2','layout','layout2','layout3','layout4','tools2','scissors2','dollar','coins','music2','info','car','bike2','truck2','bus','bike3','rocket','target2','anchor2','navigation','facebook2','twitter-old','share','feed','bird','chat2','envelope2','envelope3','phone3','phone4','phone5','mobile2','ipod','monitor','laptop2','modem','speaker','window','server','hdd','keyboard','mouse','cd','floppy','hardware','usb','cord2','socket','socket2','socket3','printer2','camera3','pictures2','eye3','uniE68D','film','camera4','movie','tv2','camera5','camera6','volume','music3','microphone','radio2','ipod2','headphone','cassette2','broadcast','broadcast2','calculator','gamepad2','gamepad3','cog','shield2','skull','bug','mine','earth','globe2','planet','battery','battery-low','battery2','battery-full','folder','search3','zoomout','zoomin','binocular','location2','pin','file3','tag2','quote2','attachment2','bookmark','bookmark2','newspaper2','notebook2','addressbook','clipboard2','clipboard3','board','pencil2','pen2','user2','user3','user4','trashcan','cart','bag','suitcase','card','book','gift2','lamp2','settings2','support','medicine','cone','locked2','unlocked2','key3','info2','clock3','timer','food2','drink2','mug2','cup2','drink3','mug3','lollipop','lab3','puzzle2','flag2','star2','heart3','badge','cup3','scissors3','snowflake','cloud4','lightning','night','sunny','droplet','umbrella2','truck3','car2','gaspump','factory','tree','leaf','flower','direction','thumbsup','thumbsdown','pointer','pointer2','pointer3','pointer4','arrow-up','arrow-down','arrow-left','arrow-right','arrow-top-right','arrow-top-left','arrow-bottom-right','arrow-bottom-left','contract','enlarge','refresh2','eye4','paper-clip','mail2','toggle','layout5','link2','bell','image','signal','target3','clipboard4','clock4','watch','air-play','camera7','video3','monitor2','cog2','heart4','book2','layers2','stack4','stack-2','paper','paper-stack','search4','zoom-in','zoom-out','reply','circle-plus','circle-minus','circle-check','circle-cross','square-plus','square-minus','square-check','square-cross','microphone2','shuffle','repeat','folder2','umbrella3','moon','thermometer','drop','sun','cloud5','cloud-upload','cloud-download','map2','briefcase2','anchor3','box','share2','arrow-left2','arrow-right2','arrow-up2','arrow-down2','flag3','trash2','plus','minus','check','cross','menu','inbox','outbox','help','open','ellipsis','health','bolt','accessibility','account-balance-wallet','account-box','account-child','add-shopping-cart','bookmark3','credit-card','https','info3','info-outline','invert-colors','label','lock-open','lock-outline','redeem','stars','verified-user','view-list','view-module','work','videocam','invert-colors-on','content-cut','mail3','airplanemode-on','format-color-fill','computer','desktop-mac','desktop-windows','dock','headset','color-lens','straighten','style','directions-ferry','directions-subway','directions-train','directions-transit','directions-walk','flight','hotel','layers3','local-attraction','local-cafe','local-car-wash','local-gas-station','local-library','local-mall','local-restaurant','local-shipping','local-taxi','place','store-mall-directory','arrow-back','arrow-forward','check2','chevron-left','chevron-right','close','expand-less','expand-more','menu2','more-horiz','more-vert','cake2','chevron-down','chevron-left2','chevron-right2','chevron-up','flame','light-bulb','three-bars','home','office','newspaper3','pencil3','quill','droplet2','paint-format','image2','image3','camera8','headphones2','play','camera9','pacman','spades','clubs','diamonds','book3','file4','profile','file5','file6','cart2','cart3','coin','credit','support2','phone6','location3','map3','clock5','clock6','alarm','stopwatch','screen','mobile3','tablet2','quotes-left','spinner','search5','expand2','expand3','contract2','lock3','lock4','unlocked3','equalizer','cogs2','wand','aid','stats','bars','food3','leaf2','dashboard','fire2','briefcase3','switch','powercord','signup','menu3','bookmark4','brightness-medium','brightness-contrast','contrast','heart5','heart6','smiley','sad2','close2','checkmark','minus2','plus2','crop','googleplus2','google-drive','facebook3','twitter2','feed2','vimeo','flickr','flickr2','dribbble2','forrst','deviantart','steam','github','wordpress','joomla','tumblr2','yahoo','apple','android','windows8','soundcloud','skype','reddit','linkedin2','lastfm','paypal','chrome','firefox','IE','opera','safari','search6','star3','star-o','th-large','th','th-list','search-plus','search-minus','gear','trash-o','arrow-circle-o-down','arrow-circle-o-up','tag3','times-circle-o','check-circle-o','gift3','fire3','eye5','warning2','plane','calendar5','chevron-up2','chevron-down2','retweet','folder3','folder-open','twitter-square','facebook-square','key4','linkedin-square','github-square','credit-card2','rss2','bullhorn','bell-o','flask','cut','paperclip2','google-plus-square','envelope4','check-square','pencil-square','youtube-square','xing-square','dropbox','stack-overflow','instagram','flickr3','tumblr-square','vimeo-square','reddit-square','behance-square','steam-square','jsfiddle','life-bouy','xing','youtube','pinterest','stumbleupon','delicious','foursquare','blogger');
        
        foreach( $icons as $icon ) {
            $icon_fields[] = sprintf('<span class="ep-icon icon-%s" data-name="%s"></span>', $icon , $icon );
        }

       return '<div class="my_param_block ep-icon-container">'
                .implode( $icon_fields )
                .'<input type="text" name="'.esc_attr($settings['param_name'])
                .'" class="wpb_vc_param_value wpb-textinput ep-input-vc-icon hidden-field-value '
                .esc_attr($settings['param_name']).' '.esc_attr($settings['type']).'_field" type="text" value="'
                . $value . '"/>'
             .'</div>';
    }

    function ep_vc_imageselect_field ($settings, $value) {
       $options = $settings['value'];
        
        foreach( $options as $optionkey => $optionvalue ) {
            $image_options[] = sprintf('<span class="ep-image image-%s" data-name="%s"><img src="%s.png"></span>', $optionvalue , $optionvalue , get_template_directory_uri() . '/lib/admin/img/vcimages/' . $optionkey );
        }

       return '<div class="my_param_block ep-imageselect-container ' . (array_key_exists('class',$settings) ? $settings['class'] : '') .'">'
                .implode( $image_options )
                .'<input type="text" name="'.esc_attr($settings['param_name'])
                .'" class="wpb_vc_param_value wpb-textinput ep-input-vc-imageselect hidden-field-value '
                .esc_attr($settings['param_name']).' '.esc_attr($settings['type']).'_field" type="text" value="'
                . $value . '"/>'
             .'</div>';
    }
    
    function ep_vc_range_field ($settings, $value) {
        return '<div class="my_param_block ep-rangefield-container field clear-after">'
            .'<div class="label">'. esc_attr($settings['label']).'</div>'
                .'<input type="range" start="'.esc_attr($settings['min']).'" min="'.esc_attr($settings['min']).'" max="'.esc_attr($settings['max']).'" step="'.esc_attr($settings['step']).'"  value="'. $value.'" />'
                .'<input type="text" name="'.esc_attr($settings['param_name'])
                .'" class="wpb_vc_param_value wpb-textinput ep-input-vc-range hidden-field-value '
                .esc_attr($settings['param_name']).' '.esc_attr($settings['type']) . '_field" type="text" value="'
                . $value . '"/>'
            .'</div>';
    }

    function ep_vc_multi_select ($settings, $value) {
        $items = $settings['options'];
        $options = array();
        foreach( $items as $optionkey => $optionvalue ) {
            $options[] = sprintf('<input type="checkbox" name="%s" value="%s" class="ep-checkbox-field"> <span class="checkbox-label">%s</span>', $optionvalue , $optionkey , $optionvalue );
        }

        return '<div class="my_param_block ep-checkbox-container field clear-after">'
                .implode( $options )
                .'<input type="text" name="'.esc_attr($settings['param_name'])
                .'" class="wpb_vc_param_value wpb-textinput ep-input-vc-checkbox hidden-field-value '
                .esc_attr($settings['param_name']).' '.esc_attr($settings['type']) . '_field" type="text" value="'
                . $value . '"/>'
            .'</div>';
    }

    function ep_vc_add_custom_fields() {

		$dir = get_template_directory_uri();
        
        // add icon box option for vc
		vc_add_shortcode_param('vc_icons', 'ep_vc_icons_field', $dir . '/extendvc/js/vc_icon.js' );

        // add icon box option for vc
        vc_add_shortcode_param('vc_imageselect', 'ep_vc_imageselect_field', $dir . '/extendvc/js/vc_imageselect.js' );
        
        // add range field for vc
        vc_add_shortcode_param('vc_rangefield', 'ep_vc_range_field', $dir . '/extendvc/js/vc_rangefield.js' );

        // add checkbox field for vc
        vc_add_shortcode_param('vc_multiselect', 'ep_vc_multi_select', $dir . '/extendvc/js/vc_multiselect.js' );

	}
    
	add_action( 'admin_init', 'ep_vc_add_custom_fields');

	if ( ! function_exists( 'js_composer_bridge_admin' ) ) {
    
		function ep_js_composer_css_admin() {
			// presscore stuff
			wp_enqueue_style( 'ep_vc_extend_css', get_template_directory_uri() . '/lib/admin/css/vc-extend.css');

		}
	}
    
	add_action( 'admin_enqueue_scripts', 'ep_js_composer_css_admin', 15 );

// Removing frontend editor
if(function_exists('vc_disable_frontend')){
    vc_disable_frontend();
}

// Removing shortcodes
vc_remove_element("vc_wp_meta");
vc_remove_element("vc_wp_recentcomments");
vc_remove_element("vc_wp_pages");
vc_remove_element("vc_wp_custommenu");
vc_remove_element("vc_wp_text");
vc_remove_element("vc_wp_posts");
vc_remove_element("vc_wp_links");
vc_remove_element("vc_wp_categories");
vc_remove_element("vc_wp_archives");
vc_remove_element("vc_wp_rss");
vc_remove_element("vc_teaser_grid");
vc_remove_element("vc_button");
vc_remove_element("vc_cta");
vc_remove_element("vc_cta_button");
vc_remove_element("vc_cta_button2");
vc_remove_element("vc_message");
vc_remove_element("vc_progress_bar");
vc_remove_element("vc_pie");
vc_remove_element("vc_posts_slider");
vc_remove_element("vc_carousel");
vc_remove_element("vc_images_carousel");
vc_remove_element("vc_icon");
vc_remove_element("vc_custom_heading");
vc_remove_element("vc_masonry_media_grid");
vc_remove_element("vc_media_grid");
vc_remove_element("vc_gallery");
vc_remove_element("vc_round_chart");
vc_remove_element("vc_line_chart");
vc_remove_element("vc_video");
vc_remove_element("vc_tta_pageable");

// animation array
$animations = array(
	"None" => "none",
	"Fade in" => "fade-in",
	"Fade in from top" => "fade-in-top",
	"Fade in from left" => "fade-in-left",
	"Fade in from right" => "fade-in-right",
	"Fade in from bottom" => "fade-in-bottom",
    "Grow In" => "grow-in"
);

$fontsize = array (
    "20" => "20",
    "24" => "24",
    "32" => "32",
    "40" => "40",
    "48" => "48",
    "60" => "60",
    "80" => "80",
);

$Customfontsize = array (
    "20" => "20",
    "24" => "24",
    "32" => "32",
    "40" => "40",
    "48" => "48",
    "60" => "60",
    "80" => "80",
);

$contentfontsize = array (
    "12" => "12",
    "13" => "13",
    "14" => "14",
    "16" => "16",
);
//all of social icons
$socialIcon = array (
    'Facebook' => 'facebook3',
    'Twitter' => 'twitter2',
    'Vimeo' =>'vimeo',
    'YouTube' => 'youtube',
    'Google+' =>'googleplus2',
    'Dribbble' =>  'dribbble2',
    'Tumblr' => 'tumblr2',
    'linkedin' => 'linkedin2',
    'Flickr' =>  'flickr2',
    'forrst' => 'forrst',
    'github'  => 'github',
    'lastfm' => 'lastfm',
    'paypal' => 'paypal',
    'RSS' =>  'feed2',
    'skype' =>  'skype',
    'wordpress' =>  'wordpress',
    'yahoo' =>  'yahoo',
    'steam' => 'steam',
    'reddit' =>  'reddit',
    'stumbleupon' => 'stumbleupon',
    'pinterest' => 'pinterest',
    'deviantart' => 'deviantart',
    'xing'  => 'xing',
    'blogger' => 'blogger',
    'soundcloud'  => 'soundcloud',
    'delicious' =>  'delicious',
    'foursquare'  => 'foursquare',
    'instagram'  => 'instagram',
    'Behance'  => 'behance',
	'Custom Social Network'=> 'custom',
);
//List of social icons with dark/light option
$socialIconDarkLight = array (
    'facebook3',
    'twitter2',
    'vimeo',
    'youtube',
    'googleplus2',
    'dribbble2',
    'tumblr2',
    'linkedin2',
    'flickr2',
    'forrst',
    'github',
    'lastfm',
    'paypal',
    'feed2',
    'skype',
    'wordpress',
    'yahoo',
    'steam',
    'reddit',
    'stumbleupon',
    'pinterest',
    'deviantart',
    'xing',
    'blogger',
    'soundcloud',
    'delicious',
    'foursquare',
    'instagram',
    'behance',
);


$portfolio_skills = array();
$cat_args = array(
    'orderby'       => 'term_id', 
    'order'         => 'ASC',
    'hide_empty'    => false,
);

$terms = get_terms('skills', $cat_args);

foreach($terms as $taxonomy){
     $portfolio_skills[$taxonomy->slug] = $taxonomy->name;
}
//------ Fetch gallery categories-------
$gallery_cats = array();
$cat_args = array(
    'orderby'       => 'term_id', 
    'order'         => 'ASC',
    'hide_empty'    => false,
);

$terms = get_terms('gallery_cat', $cat_args);

foreach($terms as $taxonomy){
     $gallery_cats[$taxonomy->slug] = $taxonomy->name;
}


/*-----------------------------------------------------------------------------------*/
/* Accordion, Tabs, Tour Section
/*-----------------------------------------------------------------------------------*/

// remove param icon position
vc_remove_param('vc_tta_section' , 'i_position');


// remove param icon checkbox
vc_remove_param('vc_tta_section' , 'add_icon');

// remove param icon selector
vc_remove_param('vc_tta_section' , 'i_type');

// remove param icon selector
vc_remove_param('vc_tta_section' , 'i_icon_entypo');

// remove param icon selector
vc_remove_param('vc_tta_section' , 'i_icon_openiconic');

// remove param icon selector
vc_remove_param('vc_tta_section' , 'i_icon_typicons');

// remove param icon selector
vc_remove_param('vc_tta_section' , 'i_icon_linecons');

// remove param icon box
vc_remove_param('vc_tta_section' , 'i_icon_fontawesome');

// remove param icon position
vc_remove_param('vc_tta_section' , 'c_position');


/*-----------------------------------------------------------------------------------*/
/* Accordion
/*-----------------------------------------------------------------------------------*/

// remove param style
vc_remove_param('vc_tta_accordion' , 'style');

// remove param shape
vc_remove_param('vc_tta_accordion' , 'shape');

// remove param color
vc_remove_param('vc_tta_accordion' , 'color');

// remove param no_fill
vc_remove_param('vc_tta_accordion' , 'no_fill');

// remove param spacing
vc_remove_param('vc_tta_accordion' , 'spacing');

// remove param gap
vc_remove_param('vc_tta_accordion' , 'gap');

// remove param autoplay
vc_remove_param('vc_tta_accordion' , 'autoplay');

// remove param icon
vc_remove_param('vc_tta_accordion' , 'c_icon');

/*-----------------------------------------------------------------------------------*/
/* Tabs
/*-----------------------------------------------------------------------------------*/
// remove param style
vc_remove_param('vc_tta_tabs' , 'style');

// remove param shape
vc_remove_param('vc_tta_tabs' , 'shape');

// remove param color
vc_remove_param('vc_tta_tabs' , 'color');

// remove param no_fill_content_area
vc_remove_param('vc_tta_tabs' , 'no_fill_content_area');

// remove param spacing
vc_remove_param('vc_tta_tabs' , 'spacing');

// remove param gap
vc_remove_param('vc_tta_tabs' , 'gap');

// remove param autoplay
vc_remove_param('vc_tta_tabs' , 'autoplay');

// remove param pagination_style
vc_remove_param('vc_tta_tabs' , 'pagination_style');

// remove param pagination_color
vc_remove_param('vc_tta_tabs' , 'pagination_color');

/*-----------------------------------------------------------------------------------*/
/* Tour
/*-----------------------------------------------------------------------------------*/
// remove param style
vc_remove_param('vc_tta_tour' , 'style');

// remove param shape
vc_remove_param('vc_tta_tour' , 'shape');

// remove param color
vc_remove_param('vc_tta_tour' , 'color');

// remove param no_fill_content_area
vc_remove_param('vc_tta_tour' , 'no_fill_content_area');

// remove param spacing
vc_remove_param('vc_tta_tour' , 'spacing');

// remove param gap
vc_remove_param('vc_tta_tour' , 'gap');

// remove param controls_size
vc_remove_param('vc_tta_tour' , 'controls_size');

// remove param autoplay
vc_remove_param('vc_tta_tour' , 'autoplay');

// remove param pagination_style
vc_remove_param('vc_tta_tour' , 'pagination_style');

// remove param pagination_color
vc_remove_param('vc_tta_tour' , 'pagination_color');


// Improve shortcode row

// remove font color
vc_remove_param('vc_row', 'font_color');

// remove margin bottom
vc_remove_param('vc_row', 'margin_bottom');

// remove bg color
vc_remove_param('vc_row', 'bg_color');

// remove bg image
vc_remove_param('vc_row', 'bg_image');

// remove row padding
vc_remove_param( 'vc_row', 'padding' );

//remove image repeat Option
vc_remove_param( 'vc_row', 'bg_image_repeat' );

//remove css option
vc_remove_param( 'vc_row', 'css' );

//remove class option
vc_remove_param( 'vc_row', 'el_class' );

//remove fullwidth option
vc_remove_param( 'vc_row', 'full_width');

//remove prallax option
vc_remove_param( 'vc_row', 'parallax');

//remove parallax image
vc_remove_param( 'vc_row', 'parallax_image');

//remove row id
vc_remove_param( 'vc_row', 'el_id');

//remove row video bg
vc_remove_param( 'vc_row', 'video_bg');

//remove row video bg
vc_remove_param( 'vc_row', 'video_bg_url');

//remove row video bg
vc_remove_param( 'vc_row', 'full_height');

// remove content placement
vc_remove_param( 'vc_row', 'content_placement');

// remove parallax type
vc_remove_param( 'vc_row', 'video_bg_parallax');


$row_setting = array (
  "name" => "Row - Parallax - Fullwidth video",
  'show_settings_on_create' => true,
);
vc_map_update('vc_row', $row_setting);

$separator_setting = array (
  'show_settings_on_create' => true,
  "controls"	=> '',
);
vc_map_update('vc_separator', $separator_setting);

vc_add_param("vc_row", array(
    "type" => "dropdown",
    "class" => "",
    "holder" => "span",
    "show_settings_on_create"=>true,
    "heading" => __("Container Type", "js_composer"),
    "param_name" => "row_type",
    "description" => __("Choose different type of containers and set the options.", "js_composer"),
    "value" => array(
        "Row" => "row",
        "Parallax" => "parallax",
        "Video" => "video",
    ),
));

// row spacing - Padding
vc_add_param("vc_row", array(
    "type" => "textfield",
    "heading" => __("Padding Top", "js_composer"),
    "param_name" => "row_padding_top",
    "description" => __("Insert top padding for current row . example : 200 ", "js_composer"),
    'group'		=> __("Padding",  "js_composer"),
));

vc_add_param("vc_row", array(
    "type" => "textfield",
    "heading" => __("Padding Bottom", "js_composer"),
    "param_name" => "row_padding_bottom",
    "description" => __("Insert bottom padding for current row . example : 200", "js_composer"),
    'group'		=> __("Padding",  "js_composer"),
));

vc_add_param("vc_row", array(
    "type" => "textfield",
    "heading" => __("Padding Right", "js_composer"),
    "param_name" => "row_padding_right",
    "description" => __("Insert Right padding for current row . example : 200", "js_composer"),
    'group'		=> __("Padding",  "js_composer"),
));

vc_add_param("vc_row", array(
    "type" => "textfield",
    "heading" => __("Padding Left", "js_composer"),
    "param_name" => "row_padding_left",
     "description" => __("Insert left padding for current row . example : 200", "js_composer"),
    'group'		=> __("Padding",  "js_composer"),
));

// row spacing - margin
vc_add_param("vc_row", array(
    "type" => "textfield",
    "heading" => __("Margin Top", "js_composer"),
    "param_name" => "row_margin_top",
     "description" => __("Insert top margin for current row . example : 200", "js_composer"),
    'group'		=> __("Margin",  "js_composer"),
));

vc_add_param("vc_row", array(
    "type" => "textfield",
    "heading" => __("Margin Bottom", "js_composer"),
    "param_name" => "row_margin_bottom",
    "description" => __("Insert bottom margin for current row . example : 200", "js_composer"),
    'group'		=> __("Margin",  "js_composer"),
));


vc_add_param("vc_row", array(
    "type" => "dropdown",
    "class" => "",
    "heading" => __("Type", "js_composer"),
    "param_name" => "type",
    "description" => __("Full width will use all of your screen width, while Boxed will created an invisible box in middle of your screen.", "js_composer"),
    "value" => array(
        "Boxed" => "grid",
        "Full Width" => "full_width",
    ),
    "dependency" => Array(
        'element' => "row_type", 
        'value' => array('row')
    )
));
                        
//background image 
vc_add_param("vc_row", array(
    "type" => "attach_image",
    "class" => "",
    "heading" => __("Image url", "js_composer"),
    "param_name" => "background_img_id",
    "description" => __("Choose an image to be used as this section's background.", "js_composer"),
    "value" => "",
    "dependency" => Array(
        'element' => "row_type", 
        'value' => array('row','parallax')
       
    )  
));

//background color
vc_add_param("vc_row", array(
	"type" => "colorpicker",
	"class" => "",
    "heading" => __("Background color", "js_composer"),
	"param_name" => "background_color",
    "description" => __("Choose a color to be used as this section's background. Please noticed that background color, has higher priority than background image.", "js_composer"),
	"value" => "",
	"description" => "",
	"dependency" => Array(
        'element' => "row_type", 
        'value' => array('row','expandable','content_menu')
    )
));

// Add min height For row 
vc_add_param("vc_row", array(
    "type" => "textfield",
    "heading" => __("Minimum height", "js_composer"),
    "param_name" => "min_height",
    "description" => __("Insert minimum height for parallax section . example : 550", "js_composer"),
    "dependency" => Array(
        'element' => "row_type", 
        'value' => array('parallax')
    )
));

// parallax speed
vc_add_param("vc_row", array(
    "type" => "textfield",
    "class" => "",
    "heading" => __("Parallax speed",  "js_composer"),
    "param_name" => "parallax_speed",
    "description" => __("Parallax speed 0 = parallax disabled (fixed image), parallax speed 10 = page scrolling speed ,parallax speed above 10 = parallax is faster than page scrolling speed. Enter a number between 0 - 100", "js_composer"),
    "value" => "14",
    "dependency" => Array(
        'element' => "row_type", 
        'value' => array('parallax')
    )
));

//parallax position
vc_add_param("vc_row", array(
    "type" => "textfield",
    "class" => "",
    "heading" => __("Parallax Image Position",  "js_composer"),
    "param_name" => "parallax_position",
    "value" => "50",
    "description" => __("Enter the parallax image position where 50 means 50% from top and left(center of parallax container).", "js_composer"),
    "dependency" => Array(
        'element' => "row_type", 
        'value' => array('parallax')
    )
));

// video webm
vc_add_param("vc_row", array(
	"type" => "textfield",
	"class" => "",
	"heading" => "Video background (webm) file url",
	"value" => "",
	"param_name" => "video_webm",
	"description" => "",
    "dependency" => Array(
        'element' => "row_type", 
        'value' => array('video')
    )
));

// video Mp4
vc_add_param("vc_row", array(
	"type" => "textfield",
	"class" => "",
	"heading" => "Video background (mp4) file url",
	"value" => "",
	"param_name" => "video_mp4",
	"description" => "",
	"dependency" => Array(
        'element' => "row_type", 
        'value' => array('video')
    )
));

//Video Preview Image 
vc_add_param("vc_row", array(
    "type" => "attach_image",
    "holder" => "div",
    "class" => "",
    "heading" => __("Video Preview Image", "js_composer"),
    "param_name" => "video_image",
    "value" => "",
    "description" => __("Enter an image address which will be shown instead of video in tablet and mobile devices. Also it will be shown if the video does not load correctly.", "js_composer"),
    "dependency" => Array(
        'element' => "row_type", 
        'value' => array('video')
       
    )  
));

// video height
vc_add_param("vc_row", array(
	"type" => "textfield",
	"class" => "",
	"heading" => "Video Section Height",
	"value" => "",
	"param_name" => "video_height",
	"description" => __("use pixels (px). example :  550px", "js_composer"),
	"dependency" => Array(
        'element' => "row_type", 
        'value' => array('video')
    )
));

// Overlay Texture
vc_add_param("vc_row", array(
	"type" => "vc_imageselect",
	"class" => "textures",
	"heading" => __("Overlay Texture",  "js_composer"),
	"param_name" => "overlay_texture",
    "value" => array(
		"none" => "texture1",
        "texture2" => "texture2",
        "texture3" => "texture3",
        "texture4" => "texture4",
        "texture5" => "texture5",
        "texture6" => "texture6",
        "texture7" => "texture7",
        "texture8" => "texture8",
    ),
	"dependency" => array(
        "element" => "row_type",
        'value' => array('video','parallax'),
	)
));


vc_add_param("vc_row", array(
    "type" => "textfield",
    "class" => "",
    "heading" => __("Overlay Opacity",  "js_composer"),
    "param_name" => "overlay_opacity",
    "value" => ".5",
    "description" => __("Enter overlay opacity where 1 = 100% and 0 means overlay is not visible. To have 50% opacity you should enter .5 .", "js_composer") ,
    "dependency" => array(
        "element" => "row_type",
        'value' => array('video','parallax'),
    )
));


// Overlay color
vc_add_param("vc_row", array(
	"type" => "colorpicker",
	"holder" => "div",
	"class" => "",
	"heading" => __("Overlay Color", "js_composer"),
	"param_name" => "overlay_color",
	"value" => "",
	"description" => __("Select optional title color.", "js_composer") , 
    "dependency" => array(
		"element" => "row_type",
        'value' => array('video','parallax'),
	)
    
));

// Overlay Opacity 
vc_add_param("vc_row", array(
	"type" => "textfield",
	"class" => "",
	"heading" => __("Overlay Opacity",  "js_composer"),
	"param_name" => "overlay_opacity",
	"value" => ".5",
    "description" => __("Enter overlay opacity where 1 = 100% and 0 means overlay is not visible. To have 50% opacity you should enter .5 .", "js_composer") ,
	"dependency" => array(
        "element" => "row_type",
        'value' => array('video','parallax'),
	)
));

vc_add_param("vc_row", array(
    'type' => 'textfield',
    'heading' => __('Extra class name', 'js_composer' ),
    'param_name' => 'el_class',
    'description' => __('Style particular content element differently - add a class name and refer to it in custom CSS.', 'js_composer' )
));

/*-----------------------------------------------------------------------------------*/
/* VC block text
/*-----------------------------------------------------------------------------------*/

vc_remove_param('vc_column_text', 'css_animation');
vc_add_param("vc_column_text",array(
    "type" => "dropdown",
    "class" => "",
    "heading" => __("Animation", "js_composer"),
    "param_name" => "text_animation",
    "description" => __("Select animation type", "js_composer") ,
        "value" => $animations,
));

vc_add_param("vc_column_text",array(
    "type" => "textfield",
    "class" => "",
    "heading" => __("Animation Delay", "js_composer"),
    "param_name" => "text_animation_delay",
    "value" => "",
    "description" => __("Enter animation delay (in milliseconds), for example if you want 3 seconds delay, you should enter 3000 .", "js_composer") ,
));

/*-----------------------------------------------------------------------------------*/
/* Separator
/*-----------------------------------------------------------------------------------*/

vc_remove_param('vc_separator', 'style');
vc_remove_param('vc_separator', 'align');
vc_remove_param('vc_separator', 'el_width');
vc_remove_param('vc_separator', 'el_class');
vc_remove_param('vc_separator', 'accent_color');
vc_remove_param('vc_separator', 'color');
vc_remove_param('vc_separator', 'border_width');

vc_add_param("vc_separator", array(
    "type" => "colorpicker",
    "holder" => "div",
    "class" => "",
    "heading" => __("Separator's Color", "js_composer"),
    "param_name" => "color",
    "value" => "",
    "description" => __("Select optional Separator's color ", "js_composer") ,  
));

// Separator
vc_add_param("vc_separator", array(
    "type" => "dropdown",
    "class" => "",
    "heading" => __("Separator size", "js_composer"), 
    "param_name" => "size",
    "description" => __("Choose the size of separator", "js_composer") ,
    "value" => array(
        "Full Width" => "full",
        "Small" => "small",
        "Small Center" => "small-center",
        "Extra Small" => "extra-small", 
        "Extra Small Center" => "extra-small-center",
        "Medium" => "medium", 
        "Medium Center" => "medium-center"
        )
));

vc_add_param("vc_separator", array(
    "type" => "dropdown",
    "class" => "",
    "heading" => __("Margin", "js_composer"), 
    "param_name" => "margin",
    "description" => __("Select size of vertical space", "js_composer") ,
    "value" => array(
        "Default" => "default",
        "Small" => "small",
        "Medium" => "medium",
    ),
));

vc_add_param("vc_separator", array(
    "type" => "dropdown",
    "class" => "",
    "heading" => __("Separator size", "js_composer"), 
    "param_name" => "pxthickness",
    "description" => __("Select thickness of separator", "js_composer") ,
    "value" => array(
        "1px" => "1",
        "2px" => "2",
        "3px" => "3",
        "4px" => "4",
        "5px" => "5",
        "6px" => "6",
        "7px" => "7",
        "8px" => "8",
        "9px" => "9",
        "10px" => "10", 
    ),
)); 

/*-----------------------------------------------------------------------------------*/
/* Title separator
/*-----------------------------------------------------------------------------------*/

vc_remove_param('vc_text_separator', 'color');
vc_remove_param('vc_text_separator', 'accent_color');
vc_remove_param('vc_text_separator', 'style');
vc_remove_param('vc_text_separator', 'el_width');
vc_remove_param('vc_text_separator', 'el_class');
vc_remove_param('vc_text_separator', 'border_width');
vc_remove_param('vc_text_separator', 'align');


vc_add_param("vc_text_separator", array(
    "type" => "colorpicker",
    "holder" => "div",
    "icon" => "icon-wpb-text-separator",
    "class" => "",
    "heading" => __("Separator's Color", "js_composer"),
    "param_name" => "color",
    "value" => "",
    "description" => __("Select optional Separator's color ", "js_composer") ,  
));

vc_add_param("vc_text_separator", array(
    "type" => "colorpicker",
    "holder" => "",
    "class" => "",
    "heading" => __("Title's Color", "js_composer"),
    "param_name" => "title_color",
    "value" => "",
    "description" => __("Select optional title color.", "js_composer") ,  
));

vc_add_param("vc_text_separator", array(
    "type" => "dropdown",
    "holder" => "",
    "class" => "",
    "heading" => __("Separator line thickness", "js_composer"), 
    "param_name" => "pxthickness",
    "description" => __("Select thickness of separator", "js_composer") ,
    "value" => array(
        "1px" => "1",
        "2px" => "2",
        "3px" => "3",
        "4px" => "4",
        "5px" => "5",
        "6px" => "6",
        "7px" => "7",
        "8px" => "8",
        "9px" => "9",
        "10px" => "10", 
    ),
));


vc_add_param("vc_text_separator", array(
    "type" => "dropdown",
    "holder" => "",
    "class" => "",
    "heading" => __("Title Font size", "js_composer"), 
    "param_name" => "title_font_size",
    "description" => __("Select separator title font size", "js_composer") ,
    "value" => $Customfontsize,
)); 

vc_add_param("vc_text_separator", array(
    "type" => "dropdown",
    "holder" => "",
    "class" => "",
    "heading" => __("Enable border right/left For Title", "js_composer"), 
    "param_name" => "title_border_enable",
    "description" => __("Select separator title font size", "js_composer") ,
    "description" => __("Enable or Disbale right/left title border", "js_composer") ,
	    "value" => array(
           "Enable" => "enable",
		   "Disable" => "disable"
	    ),
)); 
 

/*-----------------------------------------------------------------------------------*/
/* toggle
/*-----------------------------------------------------------------------------------*/

vc_remove_param('vc_toggle', 'size');
vc_remove_param('vc_toggle', 'color');
vc_remove_param('vc_toggle', 'style');
vc_remove_param('vc_toggle', 'css_animation');

/*-----------------------------------------------------------------------------------*/
/* Testimonials
/*-----------------------------------------------------------------------------------*/
vc_map( 
    array(
        "name" => "Testimonial",
        "base" => "testimonial",
        "category" => 'by epico',
        "admin_enqueue_css" => array(get_template_directory_uri().'/lib/admin/css/vc-extend.css'),        
        "icon" => "icon-wpb-testimonial",
        "as_parent" => array('only' => 'testimonial_item'),
        "js_view" => 'VcColumnView',
        "content_element" => true,
        "params" => array(
            array (
                "type" => "dropdown",
                "class" => "",
                "heading" => __("Style", "js_composer"), 
                "param_name" => "style",
                "description" => __("Select testimonial style.", "js_composer") ,
                "value" => array(
                    "Dark" => "dark",
                    "Light" => "light"
                ),
            ),
            array(
                "type" => "vc_imageselect",
                "class" => "presets",
                "heading" => __("Color presets", "js_composer"),
                "param_name" => "testimonial_color_preset",
                "description" => __("Select testimonial color.", "js_composer") , 
                    "value" => array(
                        "d02d48" => "d02d48",
                        "a32136" => "a32136",
                        "fab816" => "fab816",
                        "f28b00" => "f28b00",
                        "00945f" => "00945f",
                        "0076a9" => "0076a9",
                        "ae895d" => "ae895d",
                        "25282a" => "25282a",
                        "002f87" => "002f87",
                        "898b8e" => "898b8e",
                        "9f968d" => "9f968d",
                        "custom-color" => "custom"
                        ),
            ),
            array(
                "type" => "colorpicker",
                "admin_label" => true,
                "class" => "",
                "heading" => __("Custom testimonial Color", "js_composer"),
                "param_name" => "testimonial_color",
                "value" => "",
                "description" => __("Enter a testimonial color", "js_composer") , 
                "dependency" => Array(
                    'element' => "testimonial_color_preset", 
                    'value' => "custom"
                ) 
            ),
            array(
                "type" => "dropdown",
                "class" => "",
                "heading" => __("Animation", "js_composer"),
                "param_name" => "testimonial_animation",
                "description" => __("Select animation type", "js_composer") ,
                    "value" => $animations,
            ),
            array(
                "type" => "textfield",
                "class" => "",
                "heading" => __("Animation Delay", "js_composer"),
                "param_name" => "testimonial_animation_delay",
                "value" => "",
                "description" => __("Enter animation delay (in milliseconds), for example if you want 3 seconds delay, you should enter 3000 .", "js_composer") ,
            ),
        )
    ) 
);


vc_map( 
    array(
		"name" => "Testimonial Item",
		"base" => "testimonial_item",
		"category" => 'by epico',
        "admin_enqueue_css" => array(get_template_directory_uri().'/lib/admin/css/vc-extend.css'),        
		"icon" => "icon-wpb-testimonial-item",
        "as_child" => array('only' => 'testimonial'),
        "content_element" => true,
		"params" => array(
            array(
                "type" => "attach_image",
                "class" => "",
                "heading" => __("image url", "js_composer"),
                "param_name" => "image_url",
                "value" => "",
                "description" => __("URL of the image", "js_composer")
            ),
            array(
                "type" => "textfield",
                "admin_label" => true,
                "class" => "",
                "heading" => __("Author", "js_composer"),
                "param_name" => "author",
            ),
            array(
				"type" => "textfield",
				"admin_label" => true,
				"class" => "",
				"heading" => __("Job", "js_composer"),
				"param_name" => "job",
			),
            array(
                "type" => "textarea",
                "class" => "",
                "admin_label" => true,
                "heading" => __("Text", "js_composer"),
                "param_name" => "text",
                "description" => __("Enter text", "js_composer") ,   
            ),
		)
    ) 
);

/*-----------------------------------------------------------------------------------*/
/* Horizontal progress bar
/*-----------------------------------------------------------------------------------*/

vc_map( array(
        "name" => "Progress Bar",
        "base" => "progressbar",
        "icon" => "icon-wpb-progressbar",
        "category" => 'by epico',

        "params" => array(
            array(
                "type" => "textfield",
                "holder" => "div",
                "class" => "",
                "heading" => "Title",
                "param_name" => "title",
                "value" => "",
                "description" => ""
            ),
            array(
                "type" => "colorpicker",
                "holder" => "div",
                "class" => "",
                "heading" => "Title Color",
                "param_name" => "title_color",
                "description" => ""
            ),
            array(
                "type" => "textfield",
                "holder" => "div",
                "class" => "",
                "heading" => "Percentage",
                "param_name" => "percent",
                "value" => "",
                "description" => "If you want it to show 85% progression, just type 85 in this box."
            ),
            array(
                "type" => "colorpicker",
                "holder" => "div",
                "class" => "",
                "heading" => "Progressed Section Color",
                "param_name" => "active_bg_color",
                "description" => "Select a color to be set as progress bar progressed section color."
            ),
            array(
                "type" => "colorpicker",
                "holder" => "div",
                "class" => "",
                "heading" => "Non-progressed Section Color",
                "param_name" => "inactive_bg_color",
                "description" => "Select a color to be set as progress bar progressed section color."
            ),
             array(
                    "type" => "dropdown",
                    "holder" => "div",
                    "class" => "",
                    "heading" => __("Animation", "js_composer"),
                    "param_name" => "progressbar_animation",
                    "description" => __("Select animation type", "js_composer") ,
                     "value" => $animations,
                ),
                array(
                    "type" => "textfield",
                    "holder" => "div",
                    "class" => "",
                    "heading" => __("Animation Delay", "js_composer"),
                    "param_name" => "progressbar_animation_delay",
                    "value" => "",
                    "description" => __("Enter animation delay (in milliseconds), for example if you want 3 seconds delay, you should enter 3000 .", "js_composer") ,
                ),
        )
) );


/*-----------------------------------------------------------------------------------*/
/* Horizontal progress bar
/*-----------------------------------------------------------------------------------*/

vc_map( array(
		"name" => "Progress Bar",
		"base" => "progressbar",
		"icon" => "icon-wpb-progressbar",
		"category" => 'by epico',

		"params" => array(
			array(
				"type" => "textfield",
				"holder" => "div",
				"class" => "",
				"heading" => "Title",
				"param_name" => "title",
                "value" => "",
				"description" => ""
			),
			array(
				"type" => "colorpicker",
				"holder" => "div",
				"class" => "",
				"heading" => "Title Color",
				"param_name" => "title_color",
				"description" => ""
			),
			array(
				"type" => "textfield",
				"holder" => "div",
				"class" => "",
				"heading" => "Percentage",
				"param_name" => "percent",
                "value" => "",
				"description" => "For example if you want to enter 85% just enter 85 ."
			),
			array(
				"type" => "colorpicker",
				"holder" => "div",
				"class" => "",
				"heading" => "Active Background Color",
				"param_name" => "active_bg_color",
				"description" => ""
			),
			array(
				"type" => "colorpicker",
				"holder" => "div",
				"class" => "",
				"heading" => "Inactive Background Color",
				"param_name" => "inactive_bg_color",
				"description" => ""
			),
             array(
					"type" => "dropdown",
					"holder" => "div",
					"class" => "",
					"heading" => __("Animation", "js_composer"),
					"param_name" => "progressbar_animation",
					"description" => __("Select animation type", "js_composer") ,
					 "value" => $animations,
				),
                array(
					"type" => "textfield",
					"holder" => "div",
					"class" => "",
					"heading" => __("Animation Delay", "js_composer"),
					"param_name" => "progressbar_animation_delay",
					"value" => "",
                    "description" => __("Enter animation delay (in milliseconds), for example if you want 3 seconds delay, you should enter 3000 .", "js_composer") ,
				),
		)
) );


/*-----------------------------------------------------------------------------------*/
/* Portfolio List
/*-----------------------------------------------------------------------------------*/

vc_map( array(
        "name" => "Portfolio",
		"base" => "portfolio",
		"icon" => "icon-wpb-portfolio",
		"category" => 'by epico',
		"params" => array(
			array(
                "type" => "vc_imageselect",
				"class" => "portfoliotype",
                "admin_label" => true,
                "heading" => __("Portfolio Type", "js_composer"),
				"param_name" => "type",
                "value" => array(
                    "portfolio_space" => "portfolio_space",
                    "portfolio_no_space" => "portfolio_no_space",
                    "portfolio_text" => "portfolio_text",
				),
				"description" => "",
			),
            array(
                "type" => "dropdown",
                "class" => "",
                "heading" => __("Show title", "js_composer"), 
                "param_name" => "title_bar",
                "description" => __("Show or hide the title", "js_composer") ,
                "value" => array(
                    __('Show custom title', 'epicomedia') => 'show',
                    __('Don\'t show title', 'epicomedia')  => 'hide'
                ),              
            ),
            array(
				"type" => "textfield",
				"class" => "",
                "admin_label" => true,
				"heading" => __("Title", "js_composer"),
				"param_name" => "title_text",
                "value" => "",
				"description" => __("Choose a title to be shown at the beginning of portfolio section", "js_composer") ,
                "dependency" => Array(
                    'element' => "title_bar", 
                    'value' => 'show'
                 )
			),
            array(
				"type" => "textfield",
				"class" => "",
                "admin_label" => true,
				"heading" => __("Subtitle", "js_composer"),
				"param_name" => "subtitle_text",
                "value" => "",
				"description" => __("Choose a subtitle to be shown at the beginning of portfolio section", "js_composer") ,
                 "dependency" => Array(
                    'element' => "title_bar", 
                    'value' => 'show'
                 )
			),
            array(
				"type" => "dropdown",
		        "admin_label" => true,
				"class" => "",
				"heading" => __("Filter Display", "js_composer"),
				"param_name" => "filter_display",
				"value" => array(
					"Show" => "show",
					"Hide" => "hide"
				),
				"description" => "",
			),
            array(
				"type" => "dropdown",
		        "admin_label" => true,
				"class" => "",
				"heading" => __("Filter Style", "js_composer"),
				"param_name" => "filter_style",
				"value" => array(
					"Standard" => "standard",
                    "Toggle" => "toggle"
				),
				"description" => "",
			),
            array(
                "type" => "dropdown",
                "class" => "",
                "heading" => __("Filter toggle beginning state", "js_composer"),
                "param_name" => "filter_toggle_state",
                "value" => array(
                    "Close"  => "close",
                    "Open"  => "open"
                ),
                "description" => "",
                "dependency" => Array(
                    'element' => "filter_style", 
                    'value' => 'toggle'
                 )
            ),
            array(
                "type" => "dropdown",
                "class" => "",
                "heading" => __("Portfolio Categories", "js_composer"),
                "param_name" => "portfolio_filter",
                "value" => array(
                    "All"  => "all",
                    "Custom"  => "custom"
                ),
                "description" => "",
            ),
            array(
                "type" => "vc_multiselect",
                "class" => "",
                "admin_label" => true,
                "heading" => __("Portfolio custom Categories", "js_composer"),
                "param_name" => "filters",
                "options" => $portfolio_skills,
                "description" => "Selected categories to be shown in portfolio section",
                "value" => "",
                 "dependency" => Array(
                    'element' => "portfolio_filter", 
                    'value' => 'custom'
                 )
            ),
            array(
                "type" => "vc_rangefield",
                "label" => "items",
                "admin_label" => true,
                "heading" => __("Portfolio Post Per Section", "js_composer"),
                "param_name" => "portfolio_posts_page",
                'min'   => '1',
                'max'   => '30',
                'step'   => '1',
                'value' => '12',
                "description" => "Choose the initial number of portfolio items to be shown before clicking load more button.",
            ),
            array(
                "type" => "dropdown",
                "class" => "",
                "admin_label" => true,
                "heading" => __("Portfolio Hover type", "js_composer"),
                "param_name" => "portfolio_hover",
                "value" => array(
                    "Creative"  => "creativeType",
                    "Border Style"  => "borderType",
                    "Simple"  => "simpleType"
                ),
                "description" => "",
                "dependency" => Array(
                    'element' => "type", 
                    'value' => array("portfolio_space" ,  "portfolio_no_space")
                )
            ),
            array(
                "type" => "dropdown",
                "class" => "",
                "admin_label" => true,
                "heading" => __("Portfolio Hover style", "js_composer"),
                "param_name" => "portfolio_hover_style",
                "value" => array(
                    "Light"  => "lightStyle",
                    "Dark"  => "darkStyle"
                ),
                "description" => "",
            ),
            array(
                "type" => "dropdown",
                "class" => "",
                "admin_label" => true,
                "heading" => __("Display like Button On hover", "js_composer"),
                "param_name" => "portfolio_hover_like_button",
                "value" => array(
					"Show" => "show",
					"Hide" => "hide"
                ),
                "description" => "",
            ),

         )
    )
);

/*-----------------------------------------------------------------------------------*/
/* Portfolio inner
/*-----------------------------------------------------------------------------------*/

vc_map( array(
        "name" => "Portfolio Inner",
        "base" => "portfolio_inner",
        "icon" => "icon-wpb-portfolio-inner",
        "category" => 'by epico',
        "params" => array(
            array(
                "type" => "vc_imageselect",
                "class" => "portfoliotype",
                "admin_label" => true,
                "heading" => __("Portfolio Type", "js_composer"),
                "param_name" => "type",
                "value" => array(
                    "portfolio_space" => "portfolio_space",
                    "portfolio_no_space" => "portfolio_no_space",
                    "portfolio_text" => "portfolio_text",
                ),
                "description" => "",
            ),
            array(
                "type" => "dropdown",
                "class" => "",
                "heading" => __("Show title", "js_composer"), 
                "param_name" => "title_bar",
                "description" => __("Show or hide the title", "js_composer") ,
                "value" => array(
                    __('Show custom title', 'epicomedia') => 'show',
                    __('Don\'t show title', 'epicomedia')  => 'hide'
                ),              
            ),
            array(
                "type" => "textfield",
                "class" => "",
                "admin_label" => true,
                "heading" => __("Title", "js_composer"),
                "param_name" => "title_text",
                "value" => "",
                "description" => __("Choose a title to be shown at the beginning of portfolio section", "js_composer") ,
                "dependency" => Array(
                    'element' => "title_bar", 
                    'value' => 'show'
                 )
            ),
            array(
                "type" => "textfield",
                "class" => "",
                "admin_label" => true,
                "heading" => __("Subtitle", "js_composer"),
                "param_name" => "subtitle_text",
                "value" => "",
                "description" => __("Choose a subtitle to be shown at the beginning of portfolio section", "js_composer") ,
                 "dependency" => Array(
                    'element' => "title_bar", 
                    'value' => 'show'
                 )
            ),
            array(
                "type" => "dropdown",
                "admin_label" => true,
                "class" => "",
                "heading" => __("Filter Display", "js_composer"),
                "param_name" => "filter_display",
                "value" => array(
                    "Show" => "show",
                    "Hide" => "hide"
                ),
                "description" => "",
            ),
            array(
                "type" => "dropdown",
                "admin_label" => true,
                "class" => "",
                "heading" => __("Filter Style", "js_composer"),
                "param_name" => "filter_style",
                "value" => array(
                    "Standard" => "standard",
                    "Toggle" => "toggle"
                ),
                "description" => "",
            ),
            array(
                "type" => "dropdown",
                "class" => "",
                "heading" => __("Filter toggle beginning state", "js_composer"),
                "param_name" => "filter_toggle_state",
                "value" => array(
                    "Close"  => "close",
                    "Open"  => "open"
                ),
                "description" => "",
                "dependency" => Array(
                    'element' => "filter_style", 
                    'value' => 'toggle'
                 )
            ),
            array(
                "type" => "dropdown",
                "class" => "",
                "heading" => __("Portfolio Categories", "js_composer"),
                "param_name" => "portfolio_filter",
                "value" => array(
                    "All"  => "all",
                    "Custom"  => "custom"
                ),
                "description" => "",
            ),
            array(
                "type" => "vc_multiselect",
                "class" => "",
                "admin_label" => true,
                "heading" => __("Portfolio custom Categories", "js_composer"),
                "param_name" => "filters",
                "options" => $portfolio_skills,
                "description" => "Selected categories to be shown in portfolio section",
                "value" => "",
                 "dependency" => Array(
                    'element' => "portfolio_filter", 
                    'value' => 'custom'
                 )
            ),
            array(
                "type" => "vc_rangefield",
                "label" => "items",
                "admin_label" => true,
                "heading" => __("Portfolio Post Per Section", "js_composer"),
                "param_name" => "portfolio_posts_page",
                'min'   => '1',
                'max'   => '30',
                'step'   => '1',
                'value' => '12',
                "description" => "Choose the initial number of portfolio items to be shown before clicking load more button.",
            ),
            array(
                "type" => "dropdown",
                "class" => "",
                "admin_label" => true,
                "heading" => __("Portfolio Hover type", "js_composer"),
                "param_name" => "portfolio_hover",
                "value" => array(
                    "Creative"  => "creativeType",
                    "Border Style"  => "borderType",
                    "Simple"  => "simpleType"
                ),
                "description" => "",
            ),
            array(
                "type" => "dropdown",
                "class" => "",
                "admin_label" => true,
                "heading" => __("Portfolio Hover style", "js_composer"),
                "param_name" => "portfolio_hover_style",
                "value" => array(
                    "Light"  => "lightStyle",
                    "Dark"  => "darkStyle"
                ),
                "description" => "",
            ),
            array(
                "type" => "dropdown",
                "class" => "",
                "admin_label" => true,
                "heading" => __("Display like Button On hover", "js_composer"),
                "param_name" => "portfolio_hover_like_button",
                "value" => array(
                    "Show" => "show",
                    "Hide" => "hide"
                ),
                "description" => "",
            ),

         )
    )
);


/*-----------------------------------------------------------------------------------*/
/* Gallery
/*-----------------------------------------------------------------------------------*/

vc_map( array(
        "name" => "Gallery",
		"base" => "ep_gallery",
		"icon" => "icon-wpb-gallery",
		"category" => 'by epico',
		"params" => array(
			array(
                "type" => "vc_imageselect",
				"class" => "portfoliotype",
                "admin_label" => true,
                "heading" => __("Gallery Type", "js_composer"),
				"param_name" => "type",
                "value" => array(
                    "portfolio_space" => "portfolio_space",
                    "portfolio_no_space" => "portfolio_no_space",
                    "portfolio_text" => "portfolio_text",
				),
				"description" => "",
			),
            array(
                "type" => "dropdown",
                "class" => "",
                "heading" => __("Show title", "js_composer"), 
                "param_name" => "title_bar",
                "description" => __("Show or hide the title", "js_composer") ,
                "value" => array(
                    __('Show custom title', 'epicomedia') => 'show',
                    __('Don\'t show title', 'epicomedia')  => 'hide'
                ),              
            ),
            array(
				"type" => "textfield",
				"class" => "",
                "admin_label" => true,
				"heading" => __("Title", "js_composer"),
				"param_name" => "title_text",
                "value" => "",
				"description" => __("Enter a title to be shown at the beginning of gallery section", "js_composer") ,
                "dependency" => Array(
                    'element' => "title_bar", 
                    'value' => 'show'
                 )
			),
            array(
				"type" => "dropdown",
		        "admin_label" => true,
				"class" => "",
				"heading" => __("Filter Display", "js_composer"),
				"param_name" => "filter_display",
				"value" => array(
					"Show" => "show",
					"Hide" => "hide"
				),
				"description" => "",
			),
            array(
				"type" => "dropdown",
		        "admin_label" => true,
				"class" => "",
				"heading" => __("Filter Style", "js_composer"),
				"param_name" => "filter_style",
				"value" => array(
					"Standard" => "standard",
                    "Toggle" => "toggle"
				),
				"description" => "",
			),
            array(
                "type" => "dropdown",
                "class" => "",
                "heading" => __("Filter toggle beginning state", "js_composer"),
                "param_name" => "filter_toggle_state",
                "value" => array(
                    "Close"  => "close",
                    "Open"  => "open"
                ),
                "description" => "",
                "dependency" => Array(
                    'element' => "filter_style", 
                    'value' => 'toggle'
                 )
            ),
            array(
                "type" => "dropdown",
                "class" => "",
                "heading" => __("Gallery Categories", "js_composer"),
                "param_name" => "portfolio_filter",
                "value" => array(
                    "All"  => "all",
                    "Custom"  => "custom"
                ),
                "description" => "",
            ),
            array(
                "type" => "vc_multiselect",
                "class" => "",
                "admin_label" => true,
                "heading" => __("Gallery custom Categories", "js_composer"),
                "param_name" => "filters",
                "options" => $gallery_cats,
                "description" => "Selected categories to be shown gallery section",
                "value" => "",
                 "dependency" => Array(
                    'element' => "portfolio_filter", 
                    'value' => 'custom'
                 )
            ),
            array(
                "type" => "vc_rangefield",
                "label" => "items",
                "admin_label" => true,
                "heading" => __("Gallery Post Per Section", "js_composer"),
                "param_name" => "gallery_posts_page",
                'min'   => '1',
                'max'   => '30',
                'step'   => '1',
                'value' => '12',
                "description" => "Choose the initial number of gallery items to be shown before clicking on load more button.",
            ),
			array(
                "type" => "dropdown",
                "class" => "",
                "admin_label" => true,
                "heading" => __("Gallery Hover type", "js_composer"),
                "param_name" => "portfolio_hover",
                "value" => array(
					"Simple Gallery" => "simpleGallery",
                    "Creative"  => "creativeType",
                    "Border Style"  => "borderType",
                    "Simple"  => "simpleType"
                ),
                "description" => "",
            ),
			array(
                "type" => "dropdown",
                "class" => "",
                "admin_label" => true,
                "heading" => __("Gallery Hover style", "js_composer"),
                "param_name" => "portfolio_hover_style",
                "value" => array(
                    "Light"  => "lightStyle",
                    "Dark"  => "darkStyle"
                ),
                "description" => "",
            ),

            array(
                "type" => "dropdown",
                "class" => "",
                "admin_label" => true,
                "heading" => __("Display like Button On hover", "js_composer"),
                "param_name" => "portfolio_hover_like_button",
                "value" => array(
					"Show" => "show",
					"Hide" => "hide"
                ),
                "description" => "",
            ),

         )
    )
);

/*-----------------------------------------------------------------------------------*/
/* soundcloud
/*-----------------------------------------------------------------------------------*/

vc_map( 
	array(
		"name" => "SoundCloud",
		"base" => "audio_soundcloud",
		"category" => 'by epico',
		"icon" => "icon-wpb-soundcloud",

		"params" => array(
				array(
					"type" => "textfield",
					"holder" => "div",
					"class" => "",
					"heading" => "SoundCloud URL",
					"param_name" => "soundcloud_id",
					"value" => "",
					"description" => "Enter SoundCloud track URL here"
				),
				array(
					"type" => "textfield",
					"holder" => "div",
					"class" => "",
					"heading" => "SoundCloud Player Height",
					"param_name" => "soundcloud_height",
					"value" => "",
					"description" => "Enter SoundCloud height"
				),
				
				array(
					"type" => "textfield",
					"holder" => "div",
					"class" => "",
					"heading" => "SoundCloud Player Width",
					"param_name" => "soundcloud_width",
					"value" => "",
					"description" => "Enter SoundCloud width"
				),		
			)
		)
	) ;
	
/*-----------------------------------------------------------------------------------*/
/* YouTube
/*-----------------------------------------------------------------------------------*/

vc_map( 
	array(
		"name" => "YouTube",
		"base" => "video_youtube",
		"category" => 'by epico',
		"icon" => "icon-wpb-youtube",

		"params" => array(
				array(
					"type" => "textfield",
					"holder" => "div",
					"class" => "",
					"heading" => "YouTube ID",
					"param_name" => "youtube_id",
					"value" => "",
					"description" => "Enter your video ID here."
				),
			)
		)
	);

/*-----------------------------------------------------------------------------------*/
/* Vimeo
/*-----------------------------------------------------------------------------------*/

vc_map( 
	array(
		"name" => "Vimeo",
		"base" => "video_vimeo",
		"category" => 'by epico',
		"icon" => "icon-wpb-vimeo",

		"params" => array(
				array(
					"type" => "textfield",
					"holder" => "div",
					"class" => "",
					"heading" => "Vimeo ID",
					"param_name" => "vimeo_id",
					"value" => "",
					"description" => "Enter vimeo video ID"
				),
			)
		)
	);

/*-----------------------------------------------------------------------------------*/
/* Image Box
/*-----------------------------------------------------------------------------------*/

vc_map( 
	array(
		"name" => "ImageBox",
		"base" => "imagebox",
		"category" => 'by epico',
		"icon" => "icon-wpb-imagebox",

		"params" => array(
				array(
					"type" => "attach_image",
					"admin_label" => true,
					"class" => "",
					"heading" => __("Image URL", "js_composer"),
					"param_name" => "image_url",
					"value" => "",
					"description" => __("URL of the image", "js_composer")
				),
               array(
					"type" => "dropdown",
					"admin_label" => true,
					"class" => "",
					"heading" => __("Hover", "js_composer"),
					"param_name" => "image_hover",
				    "value" => array(
                       "Enable" => "enable",
		               "Disable" => "disable"
	                ),
					"description" => __("You can Enable Or Disable  imagebox hover", "js_composer") ,   
				),
                array(
					"type" => "textarea",
					"admin_label" => true,
					"class" => "",
					"heading" => __("Title", "js_composer"),
					"param_name" => "title",
					"value" => "",
					"description" => __("Enter title text", "js_composer") ,   
				),
                array(
                    "type" => "dropdown",
                    "class" => "",
                    "admin_label" => true,
                    "heading" => __("Title Font Size", "js_composer"), 
                    "param_name" => "image_title_size",
                    "description" => __("Select the font size of the title.", "js_composer") ,
                    "value" => $fontsize,
                ),
               array(
					"type" => "colorpicker",
					"admin_label" => true,
					"class" => "",
					"heading" => __("Title color ", "js_composer"),
					"param_name" => "title_color",
					"value" => "",
					"description" => __("Select optional title color.", "js_composer") ,  
				),
                array(
                    "type" => "colorpicker",
                    "class" => "",
                    "admin_label" => true,
                    "heading" => __("Title Border Color", "js_composer"),
                    "param_name" => "title_border_color",
                    "value" => "",
                    "description" => __("Select optional border color.", "js_composer") ,
                ),
                array(
					"type" => "textfield",
					"admin_label" => true,
					"class" => "",
					"heading" => __("Subtitle", "js_composer"),
					"param_name" => "subtitle",
					"value" => "",
					"description" => __("Enter Subtitle text", "js_composer") ,   
				),
               array(
					"type" => "colorpicker",
					"admin_label" => true,
					"class" => "",
					"heading" => __("Subtitle color ", "js_composer"),
					"param_name" => "subtitle_color",
					"value" => "",
					"description" => __("Select optional Subtitle color.", "js_composer") ,  
				),
                array(
					"type" => "textarea",
					"admin_label" => true,
					"class" => "",
					"heading" => __("Text", "js_composer"),
					"param_name" => "vccontent",
					"value" => "",
					"description" => __("Enter your text content here", "js_composer") ,   
				),
               array(
					"type" => "colorpicker",
					"admin_label" => true,
					"class" => "",
					"heading" => __("Text Color", "js_composer"),
					"param_name" => "image_text_color",
					"value" => "",
					"description" => __("Select optional text color.", "js_composer") ,  
				),
                array(
					"type" => "dropdown",
					"admin_label" => true,
					"class" => "",
					"heading" => __("Text Align", "js_composer"), 
					"param_name" => "image_text_align",
					"description" => __("Select text align", "js_composer") ,
					"value" => array(
						"Left" => "left",
						"Right" => "right",
                        "Center" => "center",
					),
				),
                array(
					"type" => "colorpicker",
					"admin_label" => true,
					"class" => "",
					"heading" => __("Background Color", "js_composer"),
					"param_name" => "image_text_background_color",
					"value" => "",
					"description" => __("Select optional background color ", "js_composer") ,  
				),
               array(
					"type" => "colorpicker",
					"admin_label" => true,
					"class" => "",
					"heading" => __("Border Color", "js_composer"),
					"param_name" => "image_text_border_color",
					"value" => "",
					"description" => __("Select optional border's color ", "js_composer") ,  
				),
                array(
					"type" => "textfield",
					"admin_label" => true,
					"class" => "",
					"heading" => __("Link", "js_composer"),
					"param_name" => "url",
					"value" => "",
					"description" => __("Optional URL to another web page..", "js_composer") ,   
				),
                 array(
					"type" => "dropdown",
					"admin_label" => true,
					"class" => "",
					"heading" => __("Link Target", "js_composer"), 
					"param_name" => "target",
					"description" => __("Open link in the same page or a new browser page.", "js_composer") ,
					"value" => array(
						"Open in same window" => "_self",
						"Open in new window" => "_blank"   
					),
				),
                 
                array(
	                "type" => "dropdown",
	                "admin_label" => true,
	                "class" => "",
	                "heading" => __("Animation", "js_composer"),
	                "param_name" => "image_animation",
	                "description" => __("Select animation type", "js_composer") ,
		                "value" => $animations,
                ),
                array(
	                "type" => "textfield",
	                "admin_label" => true,
	                "class" => "",
	                "heading" => __("Animation Delay", "js_composer"),
	                "param_name" => "image_animation_delay",
	                "value" => "",
                    "description" => __("Enter animation delay (in milliseconds), for example if you want 3 seconds delay, you should enter 3000 .", "js_composer") ,
                ),
			)
		)
	);
  

/*-----------------------------------------------------------------------------------*/
/*  Custom image Box
/*-----------------------------------------------------------------------------------*/

vc_map( 
    array(
        "name" => "Custom Imagebox",
        "base" => "custom_imagebox",
        "category" => 'by epico',
        "icon" => "icon-wpb-custom-imagebox",
        "params" => array(
                array(
                    "type" => "attach_image",
                    "admin_label" => true,
                    "class" => "",
                    "heading" => __("Image URL", "js_composer"),
                    "param_name" => "image_url",
                    "value" => "",
                    "description" => __("URL of the image", "js_composer")
                ),
                array(
                    "type" => "textarea",
                    "class" => "",
                    "admin_label" => true,
                    "heading" => __("Title", "js_composer"),
                    "param_name" => "title",
                    "value" => "",
                    "description" => __("Enter title text", "js_composer") ,   
                ),
               array(
                    "type" => "colorpicker",
                    "class" => "",
                    "admin_label" => true,
                    "heading" => __("Title Color", "js_composer"),
                    "param_name" => "title_color",
                    "value" => "",
                    "description" => __("Select optional title color.", "js_composer") ,  
                ),
                array(
                    "type" => "dropdown",
                    "class" => "",
                    "admin_label" => true,
                    "heading" => __("Title Font Size", "js_composer"),
                    "param_name" => "title_fontsize",
                    "description" => __("Select the font size of the title.", "js_composer") , 
                     "value" => $fontsize,
                ),
                 array(
                    "type" => "dropdown",
                    "class" => "",
                    "admin_label" => true,
                    "heading" => __("Box Position", "js_composer"), 
                    "param_name" => "box_position",
                    "description" => __("Select the positioning of the box.", "js_composer") ,
                    "value" => array(
                        "Left" => "left",
                        "Right" => "right",
                    ),
                ),
                 array(
                    "type" => "dropdown",
                    "class" => "",
                    "admin_label" => true,
                    "heading" => __("Title border", "js_composer"), 
                    "param_name" => "title_border",
                    "description" => __("Select border type", "js_composer") ,
                    "value" => array(
                        "None" => "none",
                        "Left" => "left",
                    ),
                ),                 
                array(
                    "type" => "colorpicker",
                    "class" => "",
                    "admin_label" => true,
                    "heading" => __("Title Border Color", "js_composer"),
                    "param_name" => "title_border_color",
                    "value" => "",
                    "description" => __("Select optional border color.", "js_composer") ,
                ),
                array(
                    "type" => "textfield",
                    "class" => "",
                    "admin_label" => true,
                    "heading" => __("Subtitle", "js_composer"),
                    "param_name" => "subtitle",
                    "value" => "",
                    "description" => __("Enter subtitle text", "js_composer") ,   
                ),
                array(
                    "type" => "colorpicker",
                    "admin_label" => true,
                    "class" => "",
                    "heading" => __("Subtitle Color", "js_composer"),
                    "param_name" => "subtitle_color",
                    "value" => "",
                    "description" => __("Select optional subtitle color.", "js_composer") ,  
                ),
                array(
                    "type" => "textarea",
                    "admin_label" => true,
                    "class" => "",
                    "heading" => __("Content", "js_composer"),
                    "param_name" => "text_content",
                    "value" => "",
                    "description" => __("Enter your text content here", "js_composer") ,   
                ),
                array(
                    "type" => "colorpicker",
                    "class" => "",
                    "admin_label" => true,
                    "heading" => __("Content Color", "js_composer"),
                    "param_name" => "text_content_color",
                    "value" => "",
                    "description" => __("Select optional content's color ", "js_composer") ,  
                ),
                array(
                    "type" => "dropdown",
                    "class" => "",
                    "admin_label" => true,
                    "heading" => __("Content Font Size", "js_composer"),
                    "param_name" => "content_fontsize",
                    "description" => __("Select content font size.", "js_composer") , 
                     "value" => $contentfontsize,
                ),
                array(
                    "type" => "textfield",
                    "class" => "",
                    "admin_label" => true,
                    "heading" => __("Link", "js_composer"),
                    "param_name" => "url",
                    "value" => "",
                    "description" => __("Optional URL to another web page..", "js_composer") ,   
                ),
                array(
                    "type" => "dropdown",
                    "class" => "",
                    "admin_label" => true,
                    "heading" => __("Link Target", "js_composer"), 
                    "param_name" => "target",
                    "description" => __("Open link in the same page or a new browser page.", "js_composer") ,
                    "value" => array(
                        "Open in same window" => "_self",
                        "Open in new window" => "_blank"   
                    ),
                ),
                array(
                    "type" => "colorpicker",
                    "class" => "",
                    "admin_label" => true,
                    "heading" => __("Background Color ", "js_composer"),
                    "param_name" => "bg_color",
                    "value" => "",
                    "description" => __("Select background color ", "js_composer") ,  
                ),
                array(
                    "type" => "colorpicker",
                    "class" => "",
                    "admin_label" => true,
                    "heading" => __("Border Color ", "js_composer"),
                    "param_name" => "border_color",
                    "value" => "",
                    "description" => __("Select border color ", "js_composer") ,  
                )
            )
        )
);

/*-----------------------------------------------------------------------------------*/
/* text Box
/*-----------------------------------------------------------------------------------*/

vc_map( 
	array(
		"name" => "TextBox",
		"base" => "textbox",
		"category" => 'by epico',
		"icon" => "icon-wpb-textbox",
		"params" => array(
                array(
					"type" => "textarea",
					"class" => "",
                    "admin_label" => true,
					"heading" => __("Title", "js_composer"),
					"param_name" => "title",
					"value" => "",
					"description" => __("Enter title text", "js_composer") ,   
				),
                array(
					"type" => "colorpicker",
					"admin_label" => true,
					"class" => "",
					"heading" => __("Title Color", "js_composer"),
					"param_name" => "title_color",
					"value" => "",
					"description" => __("Select optional title color.", "js_composer") ,  
				),
                array(
					"type" => "dropdown",
					"admin_label" => true,
					"class" => "",
					"heading" => __("Title Font Size", "js_composer"),
					"param_name" => "title_fontsize",
					"description" => __("Select the font size of the title.", "js_composer") , 
					 "value" => $fontsize,
				),
                array(
					"type" => "textfield",
					"class" => "",
                    "admin_label" => true,
					"heading" => __("Subtitle", "js_composer"),
					"param_name" => "subtitle",
					"value" => "",
					"description" => __("Enter subtitle text", "js_composer") ,   
				),
                array(
					"type" => "colorpicker",
					"admin_label" => true,
					"class" => "",
					"heading" => __("Subtitle Color", "js_composer"),
					"param_name" => "subtitle_color",
					"value" => "",
					"description" => __("Select optional subtitle color.", "js_composer") ,  
				),
                array(
                    "type" => "dropdown",
                    "admin_label" => true,
                    "class" => "",
                    "heading" => __("Title Border", "js_composer"), 
                    "param_name" => "text_title_border",
                    "description" => __("Select title border", "js_composer") ,
                    "value" => array(
                        "None" => "none",
                        "Left Border" => "left_border",
                        "Right Border" => "right_border",
                        "Top Border" => "top_border",
                        "Bottom Border" => "bottom_border",
                    ),
                ),
                array(
					"type" => "colorpicker",
					"admin_label" => true,
					"class" => "",
					"heading" => __("Title border/underline color ", "js_composer"),
					"param_name" => "text_border_underline_color",
					"value" => "",
					"description" => __("Select an optional color for title border or underline", "js_composer") , 
                    "dependency" => Array(
                        'element' => "text_title_border", 
                        'value' => array('right_border','left_border','top_border','bottom_border')
                    )
				),
                array(
					"type" => "dropdown",
					"admin_label" => true,
					"class" => "",
					"heading" => __("Title alignment", "js_composer"), 
					"param_name" => "text_under_align",
					"description" => __("Select title Underline's align", "js_composer") ,
					"value" => array(
						"Left" => "left",
						"Right" => "right",
                        "Center" => "center",
					),
                    "dependency" => Array(
                        'element' => "text_title_border", 
                        'value' => array('top_border','bottom_border','none')
                    )
				),
                array(
					"type" => "textarea",
					"admin_label" => true,
					"class" => "",
					"heading" => __("Content", "js_composer"),
					"param_name" => "text_content",
					"value" => "",
					"description" => __("Enter your text content here", "js_composer") ,   
				),
                array(
                    "type" => "dropdown",
                    "admin_label" => true,
                    "class" => "",
                    "heading" => __("Content alignment", "js_composer"), 
                    "param_name" => "content_align",
                    "description" => __("Select content align", "js_composer") ,
                    "value" => array(
                        "Left" => "left",
                        "Right" => "right",
                        "Center" => "center",
                    ),
                    "dependency" => Array(
                        'element' => "text_title_border", 
                        'value' => array('top_border','bottom_border','none')
                    )
                ),
                array(
					"type" => "dropdown",
					"admin_label" => true,
					"class" => "",
					"heading" => __("Content Font Size", "js_composer"),
					"param_name" => "content_fontsize",
					"description" => __("Select content font size.", "js_composer") , 
					 "value" => $contentfontsize,
				),
                array(
					"type" => "colorpicker",
					"admin_label" => true,
					"class" => "",
					"heading" => __("Content Color", "js_composer"),
					"param_name" => "text_content_color",
					"value" => "",
					"description" => __("Select optional color for content.", "js_composer") ,  
				),
                array(
					"type" => "dropdown",
					"admin_label" => true,
					"class" => "",
					"heading" => __("Animation", "js_composer"),
					"param_name" => "text_animation",
					"description" => __("Select animation type", "js_composer") ,
					 "value" => $animations,
				),
                array(
					"type" => "textfield",
					"admin_label" => true,
					"class" => "",
					"heading" => __("Animation Delay", "js_composer"),
					"param_name" => "text_animation_delay",
					"value" => "",
                    "description" => __("Enter animation delay (in milliseconds), for example if you want 3 seconds delay, you should enter 3000 .", "js_composer") ,
				),
                array(
					"type" => "textfield",
					"admin_label" => true,
					"class" => "",
					"heading" => __("Link", "js_composer"),
					"param_name" => "url",
					"value" => "",
					"description" => __("Optional URL to another web page.", "js_composer") ,   
				),
                 array(
					"type" => "dropdown",
					"admin_label" => true,
					"class" => "",
					"heading" => __("Link Target", "js_composer"), 
					"param_name" => "target",
					"description" => __("Open link in the same page or a new browser page.", "js_composer") ,
					"value" => array(
						"Open in same window" => "_self",
						"Open in new window" => "_blank"   
					),
				),
			)
		)
);

/*-----------------------------------------------------------------------------------*/
/* Custom textBox
/*-----------------------------------------------------------------------------------*/

vc_map( 
    array(
        "name" => "Custom Textbox",
        "base" => "custom_textbox",
        "category" => 'by epico',
        "icon" => "icon-wpb-custom-textbox",
        "params" => array(
                array(
                    "type" => "textarea",
                    "class" => "",
                    "admin_label" => true,
                    "heading" => __("Title", "js_composer"),
                    "param_name" => "title",
                    "value" => "",
                    "description" => __("Enter title text", "js_composer") ,   
                ),
               array(
                    "type" => "colorpicker",
                    "class" => "",
                    "admin_label" => true,
                    "heading" => __("Title Color", "js_composer"),
                    "param_name" => "title_color",
                    "value" => "",
                    "description" => __("Select optional title color.", "js_composer") ,  
                ),
                array(
                    "type" => "dropdown",
                    "class" => "",
                    "admin_label" => true,
                    "heading" => __("Title Font Size", "js_composer"),
                    "param_name" => "title_fontsize",
                    "description" => __("Select the font size of the title.", "js_composer") , 
                     "value" => $fontsize,
                ),
                 array(
                    "type" => "dropdown",
                    "class" => "",
                    "admin_label" => true,
                    "heading" => __("Text Alignment", "js_composer"), 
                    "param_name" => "text_align",
                    "description" => __("Select text alignment.", "js_composer") ,
                    "value" => array(
                        "Left" => "left",
                        "Right" => "right",
                        "Center" => "center",
                    ),
                ),
                array(
                    "type" => "dropdown",
                    "class" => "",
                    "admin_label" => true,
                    "heading" => __("Title Border", "js_composer"), 
                    "param_name" => "text_title_border",
                    "description" => __("Select title border.", "js_composer") ,
                    "value" => array(
                        "None" => "none",
                        "Left Border" => "left_border",
                        "Right Border" => "right_border",
                        "Top Border" => "top_border",
                        "Bottom Border" => "bottom_border",
                    ),
                ),
                array(
                    "type" => "colorpicker",
                    "class" => "",
                    "admin_label" => true,
                    "heading" => __("Tile's Border/Underline Color ", "js_composer"),
                    "param_name" => "text_border_underline_color",
                    "value" => "",
                    "description" => __("Select optional border or underline's color ", "js_composer") , 
                    "dependency" => Array(
                        'element' => "text_title_border", 
                        'value' => array('right_border','left_border','top_border','bottom_border')
                    )
                ),
                array(
                    "type" => "dropdown",
                    "class" => "",
                    "admin_label" => true,
                    "heading" => __("Title Underline's Align", "js_composer"), 
                    "param_name" => "text_under_align",
                    "description" => __("Select title Underline's align", "js_composer") ,
                    "value" => array(
                        "Left" => "left",
                        "Right" => "right",
                        "Center" => "center",
                    ),
                    "dependency" => Array(
                        'element' => "text_title_border", 
                        'value' => array('top_border','bottom_border')
                    )
                ),
                array(
                    "type" => "textfield",
                    "class" => "",
                    "admin_label" => true,
                    "heading" => __("Subtitle", "js_composer"),
                    "param_name" => "subtitle",
                    "value" => "",
                    "description" => __("Enter subtitle text", "js_composer") ,   
                ),
                array(
					"type" => "colorpicker",
					"admin_label" => true,
					"class" => "",
					"heading" => __("Subtitle color ", "js_composer"),
					"param_name" => "subtitle_color",
					"value" => "",
					"description" => __("Select optional subtitle color.", "js_composer") ,  
				),
                array(
                    "type" => "textarea",
                    "admin_label" => true,
                    "class" => "",
                    "heading" => __("Content", "js_composer"),
                    "param_name" => "text_content",
                    "value" => "",
                    "description" => __("Enter your text content here", "js_composer") ,   
                ),
                array(
                    "type" => "dropdown",
                    "class" => "",
                    "admin_label" => true,
                    "heading" => __("Content Font Size", "js_composer"),
                    "param_name" => "content_fontsize",
                    "description" => __("Select content font size.", "js_composer") , 
                     "value" => $contentfontsize,
                ),
                array(
                    "type" => "colorpicker",
                    "class" => "",
                    "admin_label" => true,
                    "heading" => __("Content Color", "js_composer"),
                    "param_name" => "text_content_color",
                    "value" => "",
                    "description" => __("Select optional content color.", "js_composer") ,  
                ),
                array(
                    "type" => "textfield",
                    "class" => "",
                    "admin_label" => true,
                    "heading" => __("Link", "js_composer"),
                    "param_name" => "url",
                    "value" => "",
                    "description" => __("Optional URL to another web page.", "js_composer") ,   
                ),
                array(
                    "type" => "dropdown",
                    "class" => "",
                    "admin_label" => true,
                    "heading" => __("Link Target", "js_composer"), 
                    "param_name" => "target",
                    "description" => __("Open link in the same page or a new browser page.", "js_composer") ,
                    "value" => array(
                        "Open in same window" => "_self",
                        "Open in new window" => "_blank"   
                    ),
                ),
                array(
                    "type" => "colorpicker",
                    "class" => "",
                    "admin_label" => true,
                    "heading" => __("Background Color ", "js_composer"),
                    "param_name" => "bg_color",
                    "value" => "",
                    "description" => __("Select background color ", "js_composer") ,  
                ),
                array(
                    "type" => "colorpicker",
                    "class" => "",
                    "admin_label" => true,
                    "heading" => __("Border Color ", "js_composer"),
                    "param_name" => "border_color",
                    "value" => "",
                    "description" => __("Select border color ", "js_composer") ,  
                )
            )
        )
);


/*-----------------------------------------------------------------------------------*/
/* Custom Heading
/*-----------------------------------------------------------------------------------*/

vc_map( 
    array(
        "name" => "Custom Heading",
        "base" => "custom_title",
        "category" => 'by epico',
        "icon" => "icon-wpb-custom-title",
        "params" => array(
                array(
                    "type" => "textarea",
                    "class" => "",
                    "admin_label" => true,
                    "heading" => __("Title", "js_composer"),
                    "param_name" => "title",
                    "value" => "",
                    "description" => __("Enter title text", "js_composer") ,   
                ),
               array(
                    "type" => "colorpicker",
                    "class" => "",
                    "heading" => __("Title color ", "js_composer"),
                    "param_name" => "title_color",
                    "value" => "",
                    "description" => __("Select optional title's color ", "js_composer") ,  
                ),
                array(
                    "type" => "dropdown",
                    "admin_label" => true,
                    "class" => "",
                    "heading" => __("Title Font Size", "js_composer"),
                    "param_name" => "title_fontsize",
                    "description" => __("Select the font size of the title.", "js_composer") , 
                     "value" => $Customfontsize,
                ),
                array(
                    "type" => "dropdown",
                    "admin_label" => true,
                    "class" => "",
                    "heading" => __("Letter Spacing", "js_composer"),
                    "param_name" => "letter_spacing",
                    "description" => __("Select a spacing amount for your title.", "js_composer") , 
                    "value" => array(
                        "1" => "1",
                        "2" => "2",
                        "3" => "3",
                        "4" => "4",
                    ),
                ),
                array(
                    "type" => "vc_imageselect",
                    "admin_label" => true,
                    "heading" => __("Shape", "js_composer"),
                    "class" => "shapes",
                    "param_name" => "style",
                    "description" => __("Select the shape that is going to be shown in title background.", "js_composer") , 
                    "value" => array(
                        "line" => "line",
                        "circle" => "circle",
                        "square" => "square",
                        "rotated_square" => "rotated_square",
                        "triangle" => "triangle",
                    ),
                ),
                array(
                    "type" => "colorpicker",
                    "holder" => "div",
                    "class" => "",
                    "heading" => __("Hover line color ", "js_composer"),
                    "param_name" => "hoverline_color",
                    "value" => "",
                    "description" => __("Select optional hover line color ", "js_composer") ,
                    "dependency" => Array(
                        'element' => "style", 
                        'value' => array("line")
                    )
                ),
                array(
                    "type" => "colorpicker",
                    "holder" => "div",
                    "class" => "",
                    "heading" => __("Shape border color ", "js_composer"),
                    "param_name" => "shape_border_color",
                    "value" => "",
                    "description" => __("Select shape border color ", "js_composer") ,
                    "dependency" => Array(
                        'element' => "style", 
                        'value' => array("circle","square","rotated_square","triangle")
                    )
                ),
                array(
                    "type" => "colorpicker",
                    "holder" => "div",
                    "class" => "",
                    "heading" => __("Shape fill color ", "js_composer"),
                    "param_name" => "shape_fill_color",
                    "value" => "",
                    "description" => __("Select shape fill color ", "js_composer") ,
                    "dependency" => Array(
                        'element' => "style", 
                        'value' => array("circle","square","rotated_square","triangle")
                    )
                ),
            )
        )
);


/*-----------------------------------------------------------------------------------*/
/* Icon Box top - no border
/*-----------------------------------------------------------------------------------*/

vc_map( 
	array(
		"name" => "IconBox - Top",
		"base" => "iconbox_top_noborder",
		"category" => 'by epico',
		"icon" => "icon-wpb-iconbox-noborder",
		"params" => array(
                array(
					"type" => "textfield",
					"admin_label" => true,
					"class" => "",
					"heading" => __("Title", "js_composer"),
					"param_name" => "title",
					"value" => "",
					"description" => __("Enter title text", "js_composer") ,   
				),
               array(
					"type" => "colorpicker",
					"admin_label" => true,
					"class" => "",
					"heading" => __("Title Color ", "js_composer"),
					"param_name" => "title_color",
					"value" => "",
					"description" => __("Select optional title color.", "js_composer") ,  
				),
                array(
					"type" => "textarea",
					"admin_label" => true,
					"class" => "",
					"heading" => __("Content", "js_composer"),
					"param_name" => "content_text",
					"value" => "",
					"description" => __("Enter some content for your Iconbox.", "js_composer") ,   
				),
               array(
					"type" => "colorpicker",
					"admin_label" => true,
					"class" => "",
					"heading" => __("Content Color", "js_composer"),
					"param_name" => "content_color",
					"value" => "",
					"description" => __("Select optional content color", "js_composer") ,  
				),
                array(
					"type" => "vc_icons",
					"admin_label" => true,
					"class" => "",
					"heading" => __("Icon", "js_composer"),
					"param_name" => "icon",
					"value" => "",
					"description" => __("Select an icon to be located at the top of the box", "js_composer") ,   
				),
                array(
                    "type" => "dropdown",
                    "admin_label" => true,
                    "class" => "",
                    "heading" => __("Icon Alignment", "js_composer"), 
                    "param_name" => "alignment",
                    "description" => __("Choose one of available alignments.", "js_composer") ,
                    "value" => array(
                        "Right" => "right_alignment",
                        "Center" => "center_alignment",
                        "Left" => "left_alignment"   
                    ),
               ),
               array(
					"type" => "colorpicker",
					"admin_label" => true,
					"class" => "",
					"heading" => __("Icon Color", "js_composer"),
					"param_name" => "icon_color",
					"value" => "",
					"description" => __("Select optional icon color.", "js_composer") ,  
				),
                 array(
					"type" => "dropdown",
					"admin_label" => true,
					"class" => "",
					"heading" => __("Animation", "js_composer"),
					"param_name" => "icon_animation",
					"description" => __("Select an animation for Icon box.", "js_composer") , 
					 "value" => $animations,
				),
                array(
					"type" => "textfield",
					"admin_label" => true,
					"class" => "",
					"heading" => __("Animation Delay", "js_composer"),
					"param_name" => "icon_animation_delay",
					"value" => "",
                    "description" => __("Enter animation delay (in milliseconds), for example if you want 3 seconds delay, you should enter 3000 .", "js_composer") ,
				),
                array(
                    "type" => "vc_link",
                    "admin_label" => true,
                    "class" => "",
                    "heading" => __("Link", "js_composer"),
                    "param_name" => "url",
                    "value" => "",
                    "description" => __("Optional URL to another web page.", "js_composer") ,   
                ),
			)
		)
);

/*-----------------------------------------------------------------------------------*/
/* Icon Box top rectangle
/*-----------------------------------------------------------------------------------*/

vc_map( 
	array(
		"name" => "IconBox - Top Square ",
		"base" => "iconbox_rectangle",
		"category" => 'by epico',
		"icon" => "icon-wpb-iconbox-rectangle",

		"params" => array(
                array(
					"type" => "textfield",
					"admin_label" => true,
					"class" => "",
					"heading" => __("Title", "js_composer"),
					"param_name" => "title",
					"value" => "",
					"description" => __("Enter title text", "js_composer") ,   
				),
               array(
					"type" => "colorpicker",
					"admin_label" => true,
					"class" => "",
					"heading" => __("Title Color ", "js_composer"),
					"param_name" => "title_color",
					"value" => "",
					"description" => __("Select optional title color.", "js_composer") ,  
				),
                array(
					"type" => "textarea",
					"admin_label" => true,
					"class" => "",
					"heading" => __("Content", "js_composer"),
					"param_name" => "content_text",
					"value" => "",
					"description" => __("Enter some content for your Iconbox", "js_composer") ,   
				),
               array(
					"type" => "colorpicker",
					"admin_label" => true,
					"class" => "",
					"heading" => __("Content Color", "js_composer"),
					"param_name" => "content_color",
					"value" => "",
					"description" => __("Select optional content color", "js_composer") ,  
				),
                array(
					"type" => "vc_icons",
					"admin_label" => true,
					"class" => "",
					"heading" => __("Icon", "js_composer"),
					"param_name" => "icon",
					"value" => "",
					"description" => __("Select an icon to be located at the top of the box.", "js_composer") ,   
				),
               array(
					"type" => "colorpicker",
					"admin_label" => true,
					"class" => "",
					"heading" => __("Icon Color", "js_composer"),
					"param_name" => "icon_color",
					"value" => "",
					"description" => __("Select optional icon color.", "js_composer") ,  
				),
                array(
					"type" => "dropdown",
					"admin_label" => true,
					"class" => "",
					"heading" => __("Icon Background Style", "js_composer"), 
					"param_name" => "icon_background_fill",
					"description" => __("Select a style for your icon background.", "js_composer") ,
					"value" => array(
                       "Fill Background" => "fillbackground",
		               "transparent Background" => "transparentbackground"
					),
				),
                array(
					"type" => "colorpicker",
					"admin_label" => true,
					"class" => "",
					"heading" => __("Icon Border/Fill color", "js_composer"),
					"param_name" => "icon_border_color",
					"value" => "",
					"description" => __("Select optional icon border color", "js_composer") , 
				),
                 array(
					"type" => "dropdown",
					"admin_label" => true,
					"class" => "",
					"heading" => __("Animation", "js_composer"),
					"param_name" => "icon_animation",
					"description" => __("Select an animation for Icon box.", "js_composer") , 
					 "value" => $animations,
				),
                array(
					"type" => "textfield",
					"admin_label" => true,
					"class" => "",
					"heading" => __("Animation Delay", "js_composer"),
					"param_name" => "icon_animation_delay",
					"value" => "",
                    "description" => __("Enter animation delay (in milliseconds), for example if you want 3 seconds delay, you should enter 3000 .", "js_composer") ,
				),
                array(
                    "type" => "vc_link",
                    "admin_label" => true,
                    "class" => "",
                    "heading" => __("Link", "js_composer"),
                    "param_name" => "url",
                    "value" => "",
                    "description" => __("Optional URL to another web page.", "js_composer") ,   
                ),
			)
		)
);

/*-----------------------------------------------------------------------------------*/
/* Icon Box top circle
/*-----------------------------------------------------------------------------------*/

vc_map( 
	array(
		"name" => "IconBox - Top Circle ",
		"base" => "iconbox_circle",
		"category" => 'by epico',
		"icon" => "icon-wpb-iconbox-circle",

		"params" => array(
                array(
					"type" => "textfield",
					"admin_label" => true,
					"class" => "",
					"heading" => __("Title", "js_composer"),
					"param_name" => "title",
					"value" => "",
					"description" => __("Enter title text", "js_composer") ,   
				),
               array(
					"type" => "colorpicker",
					"admin_label" => true,
					"class" => "",
					"heading" => __("Title Color ", "js_composer"),
					"param_name" => "title_color",
					"value" => "",
					"description" => __("Select optional title color.", "js_composer") ,  
				),
                array(
					"type" => "textarea",
					"admin_label" => true,
					"class" => "",
					"heading" => __("Content", "js_composer"),
					"param_name" => "content_text",
					"value" => "",
					"description" => __("Enter some content for your Iconbox.", "js_composer") ,   
				),
               array(
					"type" => "colorpicker",
					"admin_label" => true,
					"class" => "",
					"heading" => __("Content Color", "js_composer"),
					"param_name" => "content_color",
					"value" => "",
					"description" => __("Select optional content color", "js_composer") ,  
				),
                array(
					"type" => "vc_icons",
					"admin_label" => true,
					"class" => "",
					"heading" => __("Icon", "js_composer"),
					"param_name" => "icon",
					"value" => "",
					"description" => __("Select an icon to be located at the top of the box.", "js_composer") ,   
				),
               array(
					"type" => "colorpicker",
					"admin_label" => true,
					"class" => "",
					"heading" => __("Icon Color", "js_composer"),
					"param_name" => "icon_color",
					"value" => "",
					"description" => __("Select optional icon color.", "js_composer") ,  
				),
                array(
					"type" => "colorpicker",
					"admin_label" => true,
					"class" => "",
					"heading" => __("Icon Border Color", "js_composer"),
					"param_name" => "icon_border_color",
					"value" => "",
					"description" => __("Select optional icon border color.", "js_composer") , 
				),
                array(
					"type" => "dropdown",
					"admin_label" => true,
					"class" => "",
					"heading" => __("Icon Background Style", "js_composer"), 
					"param_name" => "icon_background_fill",
					"description" => __("Select a style for your icon background.", "js_composer") ,
					"value" => array(
                       "Fill Background" => "fillbackground",
		               "transparent Background" => "transparentbackground"
					),
				),
                 array(
					"type" => "dropdown",
					"admin_label" => true,
					"class" => "",
					"heading" => __("Animation", "js_composer"),
					"param_name" => "icon_animation",
					"description" => __("Select an animation for Icon box.", "js_composer") , 
					 "value" => $animations,
				),
                array(
					"type" => "textfield",
					"admin_label" => true,
					"class" => "",
					"heading" => __("Animation Delay", "js_composer"),
					"param_name" => "icon_animation_delay",
					"value" => "",
                    "description" => __("Enter animation delay (in milliseconds), for example if you want 3 seconds delay, you should enter 3000 .", "js_composer") ,
				),
                array(
                    "type" => "vc_link",
                    "admin_label" => true,
                    "class" => "",
                    "heading" => __("Link", "js_composer"),
                    "param_name" => "url",
                    "value" => "",
                    "description" => __("Optional URL to another web page.", "js_composer") ,   
                ),
			)
		)
);

/*-----------------------------------------------------------------------------------*/
/* Icon Box left 
/*-----------------------------------------------------------------------------------*/

vc_map( 
	array(
		"name" => "IconBox - left ",
		"base" => "iconbox_left",
		"category" => 'by epico',
		"icon" => "icon-wpb-iconbox-left",

		"params" => array(
                array(
					"type" => "textfield",
					"admin_label" => true,
					"class" => "",
					"heading" => __("Title", "js_composer"),
					"param_name" => "title",
					"value" => "",
					"description" => __("Enter title text", "js_composer") ,   
				),
               array(
					"type" => "colorpicker",
					"admin_label" => true,
					"class" => "",
					"heading" => __("Title Color ", "js_composer"),
					"param_name" => "title_color",
					"value" => "",
					"description" => __("Select optional title color.", "js_composer") ,  
				),
                array(
					"type" => "textarea",
					"admin_label" => true,
					"class" => "",
					"heading" => __("Content", "js_composer"),
					"param_name" => "content_text",
					"value" => "",
					"description" => __("Enter some content for your IconBox", "js_composer") ,   
				),
               array(
					"type" => "colorpicker",
					"admin_label" => true,
					"class" => "",
					"heading" => __("Content Color", "js_composer"),
					"param_name" => "content_color",
					"value" => "",
					"description" => __("Select optional content color", "js_composer") ,  
				),
                array(
					"type" => "vc_icons",
					"admin_label" => true,
					"class" => "",
					"heading" => __("Icon", "js_composer"),
					"param_name" => "icon",
					"value" => "",
					"description" => __("Select an icon to be located at the top of the box.", "js_composer") ,   
				),
               array(
					"type" => "colorpicker",
					"admin_label" => true,
					"class" => "",
					"heading" => __("Icon Color", "js_composer"),
					"param_name" => "icon_color",
					"value" => "",
					"description" => __("Select optional icon color.", "js_composer") ,  
				),
                array(
					"type" => "colorpicker",
					"admin_label" => true,
					"class" => "",
					"heading" => __("Icon Border Color", "js_composer"),
					"param_name" => "icon_border_color",
					"value" => "",
					"description" => __("Select optional icon border color.", "js_composer") , 
				),
                 array(
					"type" => "dropdown",
					"admin_label" => true,
					"class" => "",
					"heading" => __("Animation", "js_composer"),
					"param_name" => "icon_animation",
					"description" => __("Select an animation for Icon box.", "js_composer") , 
					 "value" => $animations,
				),
                array(
					"type" => "textfield",
					"admin_label" => true,
					"class" => "",
					"heading" => __("Animation Delay", "js_composer"),
					"param_name" => "icon_animation_delay",
					"value" => "",
                    "description" => __("Enter animation delay (in milliseconds), for example if you want 3 seconds delay, you should enter 3000 .", "js_composer") ,
				),
               array(
                    "type" => "vc_link",
                    "admin_label" => true,
                    "class" => "",
                    "heading" => __("Link", "js_composer"),
                    "param_name" => "url",
                    "value" => "",
                    "description" => __("Optional URL to another web page.", "js_composer") ,   
                ),
			)
		)
);

/*-----------------------------------------------------------------------------------*/
/* Custom iconbox
/*-----------------------------------------------------------------------------------*/
vc_map( 
    array(
        "name" => "IconBox - Custom",
        "base" => "iconbox_custom",
        "category" => 'by epico',
        "icon" => "icon-wpb-iconbox-custom",
        "params" => array(
                array(
                    "type" => "textfield",
                    "admin_label" => true,
                    "class" => "",
                    "heading" => __("Title", "js_composer"),
                    "param_name" => "title",
                    "value" => "",
                    "description" => __("Enter title text", "js_composer") ,   
                ),
                array(
                    "type" => "textarea",
                    "admin_label" => true,
                    "class" => "",
                    "heading" => __("Content", "js_composer"),
                    "param_name" => "content_text",
                    "value" => "",
                    "description" => __("Enter some content for your IconBox", "js_composer") ,   
                ),
                array(
                    "type" => "vc_icons",
                    "admin_label" => true,
                    "class" => "",
                    "heading" => __("Icon", "js_composer"),
                    "param_name" => "icon",
                    "value" => "",
                    "description" => __("Select an icon to be located at the top of the box.", "js_composer") ,   
                ),
                array(
                    "type" => "vc_imageselect",
                    "admin_label" => true,
                    "class" => "presets",
                    "heading" => __("Color presets", "js_composer"),
                    "param_name" => "icon_color_preset",
                    "description" => __("Select Iconbox color.", "js_composer") , 
                     "value" => array(
                            "d02d48" => "d02d48",
                            "a32136" => "a32136",
                            "fab816" => "fab816",
                            "f28b00" => "f28b00",
                            "00945f" => "00945f",
                            "0076a9" => "0076a9",
                            "ae895d" => "ae895d",
                            "25282a" => "25282a",
                            "002f87" => "002f87",
                            "898b8e" => "898b8e",
                            "9f968d" => "9f968d",
                            "custom-color" => "custom"
                         ),
                ),
               array(
                    "type" => "colorpicker",
                    "admin_label" => true,
                    "class" => "",
                    "heading" => __("Custom Icon Color", "js_composer"),
                    "param_name" => "icon_color",
                    "value" => "",
                    "description" => __("Enter a custom icon color", "js_composer") , 
                    "dependency" => Array(
                        'element' => "icon_color_preset", 
                        'value' => "custom"
                    ) 
                ),
                array(
                    "type" => "vc_link",
                    "admin_label" => true,
                    "class" => "",
                    "heading" => __("Link", "js_composer"),
                    "param_name" => "url",
                    "value" => "",
                    "description" => __("Optional URL to another web page.", "js_composer") ,   
                ),
            )
        )
);

/*-----------------------------------------------------------------------------------*/
/* Social icon 
/*-----------------------------------------------------------------------------------*/

vc_map( 
	array(
		"name" => "SocialIcon ",
		"base" => "socialIcon",
		"category" => 'by epico',
		"icon" => "icon-wpb-social",

		"params" => array(
                array(
					"type" => "dropdown",
					"admin_label" => true,
					"class" => "",
					"heading" => __("Social Network Type", "js_composer"),
					"param_name" => "sociallink_type",
					"description" => __("Select social link type.", "js_composer") , 
					 "value" =>  $socialIcon,
				),
                array(
					"type" => "textfield",
					"admin_label" => true,
					"class" => "",
					"heading" => __("Socail Network URL", "js_composer"),
					"param_name" => "sociallink_url",
					"value" => "",
					"description" => __("Copy and paste social network URL.", "js_composer") ,   
				),
                array(
					"type" => "dropdown",
					"admin_label" => true,
					"class" => "",
					"heading" => __("Social Network Style", "js_composer"),
					"param_name" => "sociallink_style",
					"description" => __("Select social link style.", "js_composer") , 
                    "value" => array(
                       "Dark" => "dark",
		               "Light" => "light"
					),
					"dependency" => Array(
                    'element' => "sociallink_type", 
                    'value' => $socialIconDarkLight,
                   )
				),
				array(
					"type" => "attach_image",
					"admin_label" => true,
					"class" => "",
					"heading" => __("Image url", "js_composer"),
					"param_name" => "sociallink_image",
					"description" => __("Choose an image to be used as social icon's logo.", "js_composer") , 
					"value" => "",
					"dependency" => Array(
                    'element' => "sociallink_type", 
                    'value' =>"custom"
                   )
				),
               array(
					"type" => "colorpicker",
					"admin_label" => true,
					"class" => "",
					"heading" => __("Social color", "js_composer"),
					"param_name" => "sociallink_color",
					"description" => __("Choose a color to be used as social icon's accent color.", "js_composer") , 
					"value" => "",
					"dependency" => Array(
                    'element' => "sociallink_type", 
                    'value' =>"custom"
                   )
				), 				
			)
		)
);

/*-----------------------------------------------------------------------------------*/
/* Social link 
/*-----------------------------------------------------------------------------------*/

vc_map( 
	array(
		"name" => "SocialLink ",
		"base" => "socialLink",
		"category" => 'by epico',
		"icon" => "icon-wpb-sociallink",

		"params" => array(
                array(
					"type" => "dropdown",
					"admin_label" => true,
					"class" => "",
					"heading" => __("Social Network Type", "js_composer"),
					"param_name" => "sociallink_type",
					"description" => __("Select social link type.", "js_composer") , 
					 "value" =>  $socialIcon,
				),
                array(
					"type" => "textfield",
					"admin_label" => true,
					"class" => "",
					"heading" => __("Socail Network URL", "js_composer"),
					"param_name" => "sociallink_url",
					"value" => "",
					"description" => __("Copy and paste social network URL.", "js_composer") ,   
				),
                array(
					"type" => "dropdown",
					"admin_label" => true,
					"class" => "",
					"heading" => __("Social Network Style", "js_composer"),
					"param_name" => "sociallink_style",
					"description" => __("Select social link style.", "js_composer") , 
                    "value" => array(
                       "Dark" => "dark",
		               "Light" => "light"
					),
					"dependency" => Array(
                    'element' => "sociallink_type", 
                    'value' => $socialIconDarkLight,
                   )
				),
               array(
					"type" => "colorpicker",
					"admin_label" => true,
					"class" => "",
					"heading" => __("Social color", "js_composer"),
					"param_name" => "sociallink_color",
					"description" => __("Choose a color to be used as social icon's accent color.", "js_composer") , 
					"value" => "",
					"dependency" => Array(
                    'element' => "sociallink_type", 
                    'value' =>"custom"
                   )
				), 
                array(
					"type" => "textfield",
					"admin_label" => true,
					"class" => "",
					"heading" => __("Social network name", "js_composer"),
					"param_name" => "sociallink_text",
					"description" => __("Enter a name for your social link", "js_composer") , 
					"value" => "",
					"dependency" => Array(
                    'element' => "sociallink_type", 
                    'value' =>"custom"
                   )
				),
			)
		)
);


/*-----------------------------------------------------------------------------------*/
/* Counter Box
/*-----------------------------------------------------------------------------------*/

vc_map( 
    array(
        "name" => "Counter Box",
        "base" => "conterbox",
        "category" => 'by epico',
        "icon" => "icon-wpb-counterbox",
        "params" => array(
                array(
                    "type" => "textfield",
                    "admin_label" => true,
                    "class" => "",
                    "heading" => __("Number", "js_composer"),
                    "param_name" => "counter_number",
                    "value" => "",
                    "description" => __("Enter number to be shown in counter", "js_composer") ,   
                ),
                 array(
                    "type" => "colorpicker",
                    "admin_label" => true,
                    "class" => "",
                    "heading" => __("Counter's number, Color", "js_composer"),
                    "param_name" => "counter_number_color",
                    "value" => "",
                    "description" => __("Select optional ounter's number color", "js_composer") ,  
                ),
                array(
                    "type" => "textfield",
                    "admin_label" => true,
                    "class" => "",
                    "heading" => __("Counter title", "js_composer"),
                    "param_name" => "counter_text",
                    "value" => "",
                    "description" => __("Enter counter title", "js_composer") ,   
                ),
                array(
                    "type" => "colorpicker",
                    "admin_label" => true,
                    "class" => "",
                    "heading" => __("Title Color ", "js_composer"),
                    "param_name" => "counter_text_color",
                    "value" => "",
                    "description" => __("Select optional title color.", "js_composer") ,  
                ),
                array(
                    "type" => "dropdown",
                    "admin_label" => true,
                    "class" => "",
                    "heading" => __("Animation", "js_composer"),
                    "param_name" => "counter_animation",
                    "description" => __("Select counter's animation", "js_composer") , 
                     "value" => $animations,
                ),
            )
        )
    );

/*-----------------------------------------------------------------------------------*/
/*  Piechart
/*-----------------------------------------------------------------------------------*/

vc_map( 
	array(
		"name" => "Pie Chart",
		"base" => "piechart",
		"category" => 'by epico',
		"icon" => "icon-wpb-piechart",

		"params" => array(
                array(
					"type" => "textfield",
					"admin_label" => true,
					"class" => "",
					"heading" => __("Pie Chart Progress Percentage", "js_composer"),
					"param_name" => "piechart_percent",
					"value" => "",
					"description" => __("Enter the number that shows your progress in related skill here.", "js_composer") ,   
				),
               array(
					"type" => "dropdown",
					"admin_label" => true,
					"class" => "",
					"heading" => __("Pie Chart Percentage visibility", "js_composer"),
					"param_name" => "piechart_percent_display",
				    "value" => array(
                       "Enable" => "enable",
		               "Disable" => "disable"
	                ),
					"description" => __("You can enable Or disable progress bar percentage visibility.", "js_composer") ,   
				),
                array(
                    "type" => "vc_icons",
                    "admin_label" => true,
                    "class" => "",
                    "heading" => __("Icon", "js_composer"),
                    "param_name" => "piechart_icon",
                    "value" => "",
                    "description" => __("Select an icon to be located into the chart.", "js_composer") ,   
                ),
                array(
                    "type" => "colorpicker",
                    "admin_label" => true,
                    "class" => "",
                    "heading" => __("Main Color", "js_composer"),
                    "param_name" => "main_color",
                    "value" => "#444",
                    "description" => __("Enter the main color of pie chart that includes its icon, percentage related data and dot color.", "js_composer") ,  
                ),
                array(
                    "type" => "vc_imageselect",
                    "admin_label" => true,
                    "class" => "presets",
                    "heading" => __("Pie Chart Line Color", "js_composer"),
                    "param_name" => "piechart_color_preset",
                    "description" => __("Select piechart line color", "js_composer") , 
                        "value" => array(
                            "d02d48" => "d02d48",
                            "a32136" => "a32136",
                            "fab816" => "fab816",
                            "f28b00" => "f28b00",
                            "00945f" => "00945f",
                            "0076a9" => "0076a9",
                            "ae895d" => "ae895d",
                            "25282a" => "25282a",
                            "002f87" => "002f87",
                            "898b8e" => "898b8e",
                            "9f968d" => "9f968d",
                            "custom-color" => "custom"
                            ),
                ),
                array(
					"type" => "colorpicker",
					"admin_label" => true,
					"class" => "",
					"heading" => __("Piechart line custom Color", "js_composer"),
					"param_name" => "piechart_color",
					"value" => "",
                    "dependency" => array(
                        "element" => "piechart_color_preset",
                        'value' => 'custom',
                    ),
					"description" => __("Enter optional Pie Chart's line color", "js_composer") ,  
				),
               array(
                    "type" => "textfield",
                    "admin_label" => true,
                    "class" => "",
                    "heading" => __("Piechart Title", "js_composer"),
                    "param_name" => "title",
                    "value" => "",
                    "description" => __("Enter pie chart title.", "js_composer") ,   
                ),
               array(
                    "type" => "colorpicker",
                    "admin_label" => true,
                    "class" => "",
                    "heading" => __("Title Color", "js_composer"),
                    "param_name" => "title_color",
                    "value" => "",
                    "description" => __("Select optional title color. ", "js_composer") ,  
                ),
                array(
                    "type" => "textfield",
                    "admin_label" => true,
                    "class" => "",
                    "heading" => __("Pie Chart Subtitle", "js_composer"),
                    "param_name" => "subtitle",
                    "value" => "",
                    "description" => __("Enter pie chart subtitle.", "js_composer") ,   
                ),
               array(
                    "type" => "colorpicker",
                    "admin_label" => true,
                    "class" => "",
                    "heading" => __("Subtitle Color", "js_composer"),
                    "param_name" => "subtitle_color",
                    "value" => "",
                    "description" => __("Select optional subtitle color.", "js_composer") ,  
                ),
                array(
					"type" => "dropdown",
					"admin_label" => true,
					"class" => "",
					"heading" => __("Animation", "js_composer"),
					"param_name" => "piechart_animation",
					"description" => __("Select an animation for pie chart.", "js_composer") , 
					 "value" => $animations,
				),
                array(
					"type" => "textfield",
					"admin_label" => true,
					"class" => "",
					"heading" => __("Animation Delay", "js_composer"),
					"param_name" => "piechart_animation_delay",
					"value" => "",
                    "description" => __("Enter animation delay (in milliseconds), for example if you want 3 seconds delay, you should enter 3000 .", "js_composer") ,
				), 
			)
		)
);


/*-----------------------------------------------------------------------------------*/
/*  Team member
/*-----------------------------------------------------------------------------------*/

vc_map( 
	array(
		"name" => "Team Member",
		"base" => "team_member",
		"category" => 'by epico',
		"icon" => "icon-wpb-teammemmber",

		"params" => array(
                array(
					"type" => "textfield",
					"admin_label" => true,
					"class" => "",
					"heading" => __("Name", "js_composer"),
					"param_name" => "name",
					"value" => "",
					"description" => __("Name of the team member", "js_composer") ,   
				),
               array(
					"type" => "textfield",
					"admin_label" => true,
					"class" => "",
					"heading" => __("Job Title", "js_composer"),
					"param_name" => "job_title",
					"value" => "",
					"description" => __("Team member's job title", "js_composer") ,  
				),
                array(
					"type" => "dropdown",
					"admin_label" => true,
					"class" => "",
					"heading" => __("style", "js_composer"), 
					"param_name" => "style",
					"description" => __("Choose between dark and light styles", "js_composer") ,
					"value" => array(
						"Dark" => "dark",
						"Light" => "light"   
					),
			    ),
                array(
                    "type" => "vc_imageselect",
                    "admin_label" => true,
                    "class" => "presets",
                    "heading" => __("Color presets", "js_composer"),
                    "param_name" => "team_color_preset",
                    "description" => __("Select team member's color", "js_composer") , 
                     "value" => array(
                            "d02d48" => "d02d48",
                            "a32136" => "a32136",
                            "fab816" => "fab816",
                            "f28b00" => "f28b00",
                            "00945f" => "00945f",
                            "0076a9" => "0076a9",
                            "ae895d" => "ae895d",
                            "25282a" => "25282a",
                            "002f87" => "002f87",
                            "898b8e" => "898b8e",
                            "9f968d" => "9f968d",
                            "custom-color" => "custom"
                         ),
                ),
               array(
                    "type" => "colorpicker",
                    "admin_label" => true,
                    "class" => "",
                    "heading" => __("Custom team member Color", "js_composer"),
                    "param_name" => "team_color",
                    "value" => "",
                    "description" => __("Enter a team member color", "js_composer") , 
                    "dependency" => Array(
                        'element' => "team_color_preset", 
                        'value' => "custom"
                    ) 
                ),
               array(
					"type" => "attach_image",
					"admin_label" => true,
					"class" => "",
					"heading" => __("Image", "js_composer"),
					"param_name" => "image",
					"value" => "",
					"description" => __("Optional URL of the person's image", "js_composer")
				),
               array(
                    "type" => "attach_image",
                    "admin_label" => true,
                    "class" => "",
                    "heading" => __("Signature", "js_composer"),
                    "param_name" => "signature",
                    "value" => "",
                    "description" => __("Optional URL of the person's signature", "js_composer")
                ),
                array(
					"type" => "textarea",
					"admin_label" => true,
					"class" => "",
					"heading" => __("Content", "js_composer"),
					"param_name" => "description",
					"value" => "",
					"description" => __("Small content text about the person", "js_composer") ,   
				),
                array(
                    "type" => "vc_link",
                    "holder" => "",
                    "class" => "",
                    "heading" => __("Link", "js_composer"),
                    "param_name" => "url",
                    "value" => "",
                    "description" => __("Optional url to another web page", "js_composer") ,   
                ),
                array(
                    "type" => "dropdown",
                    "admin_label" => true,
                    "class" => "",
                    "heading" => __("Animation", "js_composer"),
                    "param_name" => "team_animation",
                    "description" => __("Select team member's animation", "js_composer") , 
                     "value" => $animations,
                ),
                array(
                    "type" => "textfield",
                    "admin_label" => true,
                    "class" => "",
                    "heading" => __("Animation Delay", "js_composer"),
                    "param_name" => "team_animation_delay",
                    "value" => "",
                    "description" => __("Enter animation delay (in milliseconds), for example if you want 3 seconds delay, you should enter 3000 .", "js_composer") ,
                ),
                array(
					"type" => "vc_icons",
					"class" => "",
					"heading" => __("Choose an icon for team member icon 1", "js_composer"),
					"param_name" => "team_icon1",
					"value" => "",
                    "group" => "social icons",
					"description" => __("Select an icon for team member icon 1(You can use it for social network icons)", "js_composer") ,
				),
               array(
					"type" => "textfield",
					"class" => "",
					"heading" => __("icon 1 Link", "js_composer"),
					"param_name" => "team_icon_url1",
					"value" => "",
                    "group" => "social icons",
					"description" => __("Optional url to another web page", "js_composer") ,   
				),
               array(
					"type" => "dropdown",
					"class" => "",
					"heading" => __("icon 1 Link's target", "js_composer"), 
					"param_name" => "team_icon_target1",
                    "group" => "social icons",
					"description" => __("Open the link in the same tab or a blank browser tab", "js_composer") ,
					"value" => array(
						"Open in same window" => "_self",
						"Open in new window" => "_blank"   
					),
			   ),
               array(
					"type" => "vc_icons",
					"class" => "",
					"heading" => __("Choose an icon for team member icon 2", "js_composer"),
					"param_name" => "team_icon2",
					"value" => "",
                    "group" => "social icons",
					"description" => __("Select an icon for team member icon 2(You can use it for social network icons)", "js_composer") ,
				),
               array(
					"type" => "textfield",
					"class" => "",
					"heading" => __("icon 2 Link", "js_composer"),
					"param_name" => "team_icon_url2",
					"value" => "",
                    "group" => "social icons",
					"description" => __("Optional url to another web page", "js_composer") ,   
				),
               array(
					"type" => "dropdown",
					"class" => "",
					"heading" => __("icon 2 Link's target", "js_composer"), 
					"param_name" => "team_icon_target2",
                    "group" => "social icons",
					"description" => __("Open the link in the same tab or a blank browser tab", "js_composer") ,
					"value" => array(
						"Open in same window" => "_self",
						"Open in new window" => "_blank"   
					),
				),
               array(
					"type" => "vc_icons",
					"class" => "",
					"heading" => __("Choose an icon for team member icon 3", "js_composer"),
					"param_name" => "team_icon3",
                    "group" => "social icons",
					"value" => "",
					"description" => __("Select an icon for team member icon 3(You can use it for social network icons)", "js_composer") ,
				),
               array(
					"type" => "textfield",
					"class" => "",
					"heading" => __("icon 3 Link", "js_composer"),
					"param_name" => "team_icon_url3",
                    "group" => "social icons",
					"value" => "",
					"description" => __("Optional url to another web page", "js_composer") ,   
				),
               array(
					"type" => "dropdown",
					"class" => "",
					"heading" => __("icon 3 Link's target", "js_composer"), 
					"param_name" => "team_icon_target3",
                    "group" => "social icons",
					"description" => __("Open the link in the same tab or a blank browser tab", "js_composer") ,
					"value" => array(
						"Open in same window" => "_self",
						"Open in new window" => "_blank"   
					),
				),
              array(
					"type" => "vc_icons",
					"class" => "",
					"heading" => __("Choose an icon for team member icon 4" , "js_composer"),
					"param_name" => "team_icon4",
                    "group" => "social icons",
					"value" => "",
					"description" => __("Select an icon for team member icon 4(You can use it for social network icons)", "js_composer") ,
				),
               array(
					"type" => "textfield",
					"class" => "",
					"heading" => __("icon 4 Link", "js_composer"),
					"param_name" => "team_icon_url4",
                    "group" => "social icons",
					"value" => "",
					"description" => __("Optional url to another web page", "js_composer") ,   
				),
               array(
					"type" => "dropdown",
					"class" => "",
					"heading" => __("icon 4 Link's target", "js_composer"), 
					"param_name" => "team_icon_target4",
                    "group" => "social icons",
					"description" => __("Open the link in the same tab or a blank browser tab", "js_composer") ,
					"value" => array(
						"Open in same window" => "_self",
						"Open in new window" => "_blank"   
					),
				),
                array(
					"type" => "vc_icons",
					"class" => "",
					"heading" => __("Choose an icon for team member icon 5", "js_composer"),
					"param_name" => "team_icon5",
                    "group" => "social icons",
					"value" => "",
					"description" => __("Select an icon for team member icon 5(You can use it for social network icons)", "js_composer") ,
				),
               array(
					"type" => "textfield",
					"class" => "",
					"heading" => __("icon 5 Link", "js_composer"),
					"param_name" => "team_icon_url5",
                    "group" => "social icons",
					"value" => "",
					"description" => __("Optional url to another web page", "js_composer") ,   
				),
               array(
					"type" => "dropdown",
					"class" => "",
					"heading" => __("icon 5 Link's target", "js_composer"), 
					"param_name" => "team_icon_target5",
                    "group" => "social icons",
					"description" => __("Open the link in the same tab or a blank browser tab", "js_composer") ,
					"value" => array(
						"Open in same window" => "_self",
						"Open in new window" => "_blank"   
					),
				),  
			)
		)
);

/*-----------------------------------------------------------------------------------*/
/*  Button
/*-----------------------------------------------------------------------------------*/

vc_map( 
	array(
		"name" => "Button",
		"base" => "button",
		"category" => 'by epico',
		"icon" => "icon-wpb-button",

		"params" => array(
                array(
					"type" => "textfield",
					"admin_label" => true,
					"class" => "",
					"heading" => __("Text", "js_composer"),
					"param_name" => "text",
					"value" => "",
					"description" => __("Button text", "js_composer") ,   
				),
                array(
					"type" => "textfield",
					"admin_label" => true,
					"class" => "",
					"heading" => __("Title text", "js_composer"),
					"param_name" => "title",
					"value" => "",
					"description" => __("Enter the text that you want to be shown on your button tooltip.", "js_composer") ,   
				),
                array(
					"type" => "textfield",
					"admin_label" => true,
					"class" => "",
					"heading" => __("Link", "js_composer"),
					"param_name" => "url",
					"value" => "",
					"description" => __("URL to another web page", "js_composer") ,   
				),
                array(
					"type" => "dropdown",
					"admin_label" => true,
					"class" => "",
					"heading" => __("Link Target", "js_composer"), 
					"param_name" => "target",
					"description" => __("Open the link in the same page or a new browser page.", "js_composer") ,
					"value" => array(
						"Open in same window" => "_self",
						"Open in new window" => "_blank"   
					),
				),
                array(
					"type" => "dropdown",
					"admin_label" => true,
					"class" => "",
					"heading" => __("Button Size", "js_composer"),
					"param_name" => "size",
					"description" => __("Choose between three button sizes", "js_composer") ,
					"value" => array(
						"Standard" => "standard",
						"Small" => "small",
                        "Large" => "large"   
					),
				),
                array(
                    "type" => "dropdown",
                    "admin_label" => true,
                    "class" => "",
                    "heading" => __("Button Alignment", "js_composer"), 
                    "param_name" => "alignment",
                    "description" => __("Choose one of available button alignments.", "js_composer") ,
                    "value" => array(
                        "Left" => "left",
                        "Center" => "center",
                        "Right" => "right"
                    ),
                ),
                array(
					"type" => "colorpicker",
					"admin_label" => true,
					"class" => "",
					"heading" => __("Button Color", "js_composer"),
					"param_name" => "button_color",
					"value" => "",
					"description" => __("Enter optional button's color", "js_composer") ,  
				),
                array(
                    "type" => "colorpicker",
                    "admin_label" => true,
                    "class" => "",
                    "heading" => __("Button Hover Color", "js_composer"),
                    "param_name" => "button_hover_color",
                    "value" => "",
                    "description" => __("Select an optional on-hover color for your button.", "js_composer") ,  
                ),
			)
		)
);

/*-----------------------------------------------------------------------------------*/
/*  image Carousel
/*-----------------------------------------------------------------------------------*/

vc_map( 
	array(
		"name" => "Image Carousel",
		"base" => "image_carousel",
		"category" => 'by epico',
		"icon" => "icon-wpb-imagecarousel",

		"params" => array(
                array (
					"type" => "dropdown",
					"admin_label" => true,
					"class" => "",
					"heading" => __("Visible Items", "js_composer"), 
					"param_name" => "visible_items",
					"description" => __("Enter the maximum number of visible items that you want to be shown in the carousel.", "js_composer") ,
					"value" => array(
						"2" => "2",
                        "3" => "3",
						"4" => "4",
                        "5" => "5",
						"6" => "6",
                        "7" => "7",
                        "8" => "8",
					),
				),
                array(
                    "type" => "dropdown",
                    "admin_label" => true,
                    "class" => "",
                    "heading" => __("Style", "js_composer"),
                    "param_name" => "style",
                    "description" => __("Choose dark or light style", "js_composer") ,
                        "value" => array(
                            "Dark" => "dark",
                            "Light" => "light",
                        ),
                ),
                array (
                    "type" => "attach_images",
                    "class" => "",
                    "heading" => __("Images", "js_composer"),
                    "param_name" => "images",
                    "value" => "",
                    "description" => __("Select images from media library.", "js_composer")
                ),
        )
    )
);


/*-----------------------------------------------------------------------------------*/
/* Showcase
/*-----------------------------------------------------------------------------------*/

vc_map( 
    array(
        "name" => "Showcase",
        "base" => "showcase",
        "category" => 'by epico',     
        "icon" => "icon-wpb-showcase",
        "as_parent" => array('only' => 'showcase_item'),
        "js_view" => 'VcColumnView',
        "content_element" => true,
        "params" => array( 
            array(
                "type" => "textarea",
                "class" => "",
                "heading" => __("Title", "js_composer"),
                "param_name" => "title",
                "description" => "Type in a title for your showcase."
            ),
            array(
                "type" => "textfield",
                "holder" => "",
                "class" => "",
                "heading" => __("Subtitle", "js_composer"),
                "param_name" => "subtitle",
                "description" => "Type in a subtitle for your showcase."
            ),
            array(
                "type" => "dropdown",
                "holder" => "",
                "class" => "",
                "heading" => __("Next Section Button Visibility", "js_composer"),
                "param_name" => "nextsection",
                "description" => __("Enable or disable showing next section button", "js_composer") ,
                    "value" => array(
                       "Enable" => "show",
                       "Disable" => "hide"
                    ),
            ),
            array(
                "type" => "dropdown",
                "holder" => "",
                "class" => "",
                "heading" => __("Overlay", "js_composer"),
                "param_name" => "overlay",
                "description" => __("Enable or disable overlaying on the background.", "js_composer") ,
                    "value" => array(
                       "Enable" => "show",
                       "Disable" => "hide"
                    ),
            ),
            array(
                "type" => "dropdown",
                "holder" => "",
                "class" => "",
                "heading" => __("Style", "js_composer"),
                "param_name" => "style",
                "description" => __("Choose dark or light style", "js_composer") ,
                    "value" => array(
                        "Dark" => "dark",
                        "Light" => "light",
                    ),
            ),
            array(
                "type" => "colorpicker",
                "class" => "",
                "heading" => __("Hover Color", "js_composer"),
                "param_name" => "hover_color",
                "value" => "",
                "description" => __("Enter optional color for On-Hover state", "js_composer") ,  
            ),
            array(
                "type" => "dropdown",
                "holder" => "",
                "class" => "",
                "heading" => __("Direction", "js_composer"),
                "param_name" => "direction",
                "description" => __("Select your showcase location (left or right).", "js_composer") ,
                    "value" => array(
                        "Left" => "left-align",
                        "Right" => "right-align",
                    ),
            ),
        )
    ) 
);

vc_map( 
    array(
        "name" => "Showcase item",
        "base" => "showcase_item",
        "category" => 'by epico',
        "admin_enqueue_css" => array(get_template_directory_uri().'/lib/admin/css/vc-extend.css'),        
        "icon" => "icon-wpb-showcase-item",
        "content_element" => true,
        "as_child" => array('only' => 'showcase'),
        "params" => array( 
            array(
                "type" => "textfield",
                "holder" => "div",
                "class" => "",
                "heading" => __("Title", "js_composer"),
                "param_name" => "title",
                "description" => ""
            ),
            array(
                "type" => "textarea",
                "holder" => "",
                "class" => "",
                "heading" => __("Content", "js_composer"),
                "param_name" => "text",
                "description" => ""
            ),
            array(
                "type" => "dropdown",
                "holder" => "",
                "class" => "",
                "heading" => __("Text background", "js_composer"),
                "param_name" => "text_bg",
                "description" => __("Enable or disable showing background under the text", "js_composer") ,
                    "value" => array(
                        "Hide" => "hide",
                        "Show" => "show"
                    ),
            ),
            array(
                "type" => "attach_image",
                "class" => "",
                "heading" => __("Background image", "js_composer"),
                "param_name" => "bg",
                "value" => "",
                "description" => __("Select image as background", "js_composer")
            ),
            array(
                "type" => "attach_images",
                "class" => "",
                "heading" => __("images", "js_composer"),
                "param_name" => "images",
                "value" => "",
                "description" => __("Select images from media library.", "js_composer")
            ),
            array(
                "type" => "vc_link",
                "admin_label" => false,
                "class" => "",
                "heading" => __("Link", "js_composer"),
                "param_name" => "outer_link",
                "value" => "",
                "description" => __("Optional URL to another web page.", "js_composer") ,   
            ),
        )
    ) 
);


/*-----------------------------------------------------------------------------------*/
/* VC basic grid
/*-----------------------------------------------------------------------------------*/
// remove filter
vc_remove_param( 'vc_basic_grid', 'show_filter' );
vc_remove_param( 'vc_basic_grid', 'filter_source' );
vc_remove_param( 'vc_basic_grid', 'exclude_filter' );
vc_remove_param( 'vc_basic_grid', 'filter_style' );
vc_remove_param( 'vc_basic_grid', 'filter_align' );
vc_remove_param( 'vc_basic_grid', 'filter_color' );
vc_remove_param( 'vc_basic_grid', 'filter_size' );

// remove load more button style
vc_remove_param( 'vc_basic_grid', 'button_color' );
vc_remove_param( 'vc_basic_grid', 'button_size' );
vc_remove_param( 'vc_basic_grid', 'button_style' );

// remove pagination options
vc_remove_param( 'vc_basic_grid', 'arrows_design' );
vc_remove_param( 'vc_basic_grid', 'arrows_color' );
vc_remove_param( 'vc_basic_grid', 'arrows_position' );
vc_remove_param( 'vc_basic_grid', 'paging_design' );
vc_remove_param( 'vc_basic_grid', 'paging_color' );


/*-----------------------------------------------------------------------------------*/
/* VC masonry grid
/*-----------------------------------------------------------------------------------*/
// remove filter
vc_remove_param( 'vc_masonry_grid', 'show_filter' );
vc_remove_param( 'vc_masonry_grid', 'filter_source' );
vc_remove_param( 'vc_masonry_grid', 'exclude_filter' );
vc_remove_param( 'vc_masonry_grid', 'filter_style' );
vc_remove_param( 'vc_masonry_grid', 'filter_align' );
vc_remove_param( 'vc_masonry_grid', 'filter_color' );
vc_remove_param( 'vc_masonry_grid', 'filter_size' );

// remove load more button style
vc_remove_param( 'vc_masonry_grid', 'button_color' );
vc_remove_param( 'vc_masonry_grid', 'button_size' );
vc_remove_param( 'vc_masonry_grid', 'button_style' );

// remove pagination options
vc_remove_param( 'vc_masonry_grid', 'arrows_design' );
vc_remove_param( 'vc_masonry_grid', 'arrows_color' );
vc_remove_param( 'vc_masonry_grid', 'arrows_position' );
vc_remove_param( 'vc_masonry_grid', 'paging_design' );
vc_remove_param( 'vc_masonry_grid', 'paging_color' );

/*-----------------------------------------------------------------------------------*/
/* Add container functionality to shortcodes
/*-----------------------------------------------------------------------------------*/

if ( class_exists( 'WPBakeryShortCodesContainer' ) ) {
    
    class WPBakeryShortCode_showcase extends WPBakeryShortCodesContainer {
    }

    class WPBakeryShortCode_testimonial extends WPBakeryShortCodesContainer {
    }
}

if ( class_exists( 'WPBakeryShortCode' ) ) {
    class WPBakeryShortCode_showcase_item extends WPBakeryShortCode {

        // Show Images in images Selector ( VC )
        
        public function singleParamHtmlHolder( $param, $value ) {
            $output = '';
            // Compatibility fixes
            $old_names = array( 'yellow_message', 'blue_message', 'green_message', 'button_green', 'button_grey', 'button_yellow', 'button_blue', 'button_red', 'button_orange' );
            $new_names = array( 'alert-block', 'alert-info', 'alert-success', 'btn-success', 'btn', 'btn-info', 'btn-primary', 'btn-danger', 'btn-warning' );
            $value = str_ireplace( $old_names, $new_names, $value );

            $param_name = isset( $param['param_name'] ) ? $param['param_name'] : '';
            $type = isset( $param['type'] ) ? $param['type'] : '';
            $class = isset( $param['class'] ) ? $param['class'] : '';
    
            if ( isset( $param['holder'] ) == false || $param['holder'] == 'hidden' || $param['holder'] == '') {
                $output .= '<input type="hidden" class="wpb_vc_param_value ' . $param_name . ' ' . $type . ' ' . $class . '" name="' . $param_name . '" value="' . $value . '" />';
                if ( ( $param['type'] ) == 'attach_images' ) {
                    $images_ids = empty( $value ) ? array() : explode( ',', trim( $value ) );
                    $output .= '<ul class="attachment-thumbnails thumb-attach-images' . ( empty( $images_ids ) ? ' image-exists' : '' ) . '" data-name="' . $param_name . '">';
                    foreach ( $images_ids as $image ) {
                        $img = wpb_getImageBySize( array( 'attach_id' => (int)$image, 'thumb_size' => 'thumbnail' ) );
                        $output .= ( $img ? '<li>' . $img['thumbnail'] . '</li>' : '<li><img width="32" height="32" test="' . $image . '" src="' . vc_asset_url( 'vc/blank.gif' ) . '" class="attachment-thumbnail" alt="" title="" /></li>' );
                    }
                    $output .= '</ul>';
                }
    
            } else {
                $output .= '<' . $param['holder'] . ' class="wpb_vc_param_value ' . $param_name . ' ' . $type . ' ' . $class . '" name="' . $param_name . '">' . $value . '</' . $param['holder'] . '>';
            }
    
            if ( ! empty( $param['admin_label'] ) && $param['admin_label'] === true ) {
                $output .= '<span class="vc_admin_label admin_label_' . $param['param_name'] . ( empty( $value ) ? ' hidden-label' : '' ) . '"><label>' . __( $param['heading'], 'js_composer' ) . '</label>: ' . $value . '</span>';
            }
    
            return $output;
        }
        protected function outputTitle($title) {
            return '';
        }
        protected function outputTitleTrue($title) {
            return  '<h4 class="wpb_element_title">'. $title.' '.$this->settings('logo').'</h4>';
        }
    }

   class WPBakeryShortCode_testimonial_item extends WPBakeryShortCode {

        // Show Images in images Selector ( VC )
                    public function singleParamHtmlHolder( $param, $value ) {
                    $output = '';
                    // Compatibility fixes
                    $old_names = array( 'yellow_message', 'blue_message', 'green_message', 'button_green', 'button_grey', 'button_yellow', 'button_blue', 'button_red', 'button_orange' );
                    $new_names = array( 'alert-block', 'alert-info', 'alert-success', 'btn-success', 'btn', 'btn-info', 'btn-primary', 'btn-danger', 'btn-warning' );
                    $value = str_ireplace( $old_names, $new_names, $value );
                    //$value = __($value, "js_composer");
                    //
                    $param_name = isset( $param['param_name'] ) ? $param['param_name'] : '';
                    $type = isset( $param['type'] ) ? $param['type'] : '';
                    $class = isset( $param['class'] ) ? $param['class'] : '';

            
                    if ( isset( $param['holder'] ) == false || $param['holder'] == 'hidden' ) {
                        $output .= '<input type="hidden" class="wpb_vc_param_value ' . $param_name . ' ' . $type . ' ' . $class . '" name="' . $param_name . '" value="' . $value . '" />';
                        if ( ( $param['type'] ) == 'attach_image' ) {
                            $element_icon = $this->settings('icon');
                            $img = wpb_getImageBySize( array( 'attach_id' => (int)preg_replace( '/[^\d]/', '', $value ), 'thumb_size' => 'thumbnail' ) );
                            $this->setSettings('logo', ( $img ? $img['thumbnail'] : '<img width="150" height="150" src="' . vc_asset_url( 'vc/blank.gif' ) . '" class="attachment-thumbnail vc_element-icon"  data-name="' . $param_name . '" alt="" title="" style="display: none;" />' ) . '<span class="no_image_image vc_element-icon' . ( !empty($element_icon) ? ' '.$element_icon : '' ) . ( $img && ! empty( $img['p_img_large'][0] ) ? ' image-exists' : '' ) . '" />');
                            $output .= $this->outputTitleTrue($this->settings['name']);
                            
                        }
                        
            
                    } else {
                        $output .= '<' . $param['holder'] . ' class="wpb_vc_param_value ' . $param_name . ' ' . $type . ' ' . $class . '" name="' . $param_name . '">' . $value . '</' . $param['holder'] . '>';
                    }
        
            
                    if ( ! empty( $param['admin_label'] ) && $param['admin_label'] === true ) {
                        $output .= '<span class="vc_admin_label admin_label_' . $param['param_name'] . ( empty( $value ) ? ' hidden-label' : '' ) . '"><label>' . __( $param['heading'], 'js_composer' ) . '</label>: ' . $value . '</span>';
                    }
            
                    return $output;
                }
                protected function outputTitle($title) {
                    return '';
                }
                protected function outputTitleTrue($title) {
                    return  '<h4 class="wpb_element_title">'. $title.' '.$this->settings('logo').'</h4>';
                }
    }
    
    
    class WPBakeryShortCode_image_carousel extends WPBakeryShortCode {

        public function singleParamHtmlHolder( $param, $value ) {
            $output = '';
            // Compatibility fixes
            $old_names = array( 'yellow_message', 'blue_message', 'green_message', 'button_green', 'button_grey', 'button_yellow', 'button_blue', 'button_red', 'button_orange' );
            $new_names = array( 'alert-block', 'alert-info', 'alert-success', 'btn-success', 'btn', 'btn-info', 'btn-primary', 'btn-danger', 'btn-warning' );
            $value = str_ireplace( $old_names, $new_names, $value );

            $param_name = isset( $param['param_name'] ) ? $param['param_name'] : '';
            $type = isset( $param['type'] ) ? $param['type'] : '';
            $class = isset( $param['class'] ) ? $param['class'] : '';
            
            if ( isset( $param['holder'] ) == false || $param['holder'] == 'hidden' || $param['holder'] == '') {
                $output .= '<input type="hidden" class="wpb_vc_param_value ' . $param_name . ' ' . $type . ' ' . $class . '" name="' . $param_name . '" value="' . $value . '" />';
                if ( ( $param['type'] ) == 'attach_images' ) {
                    $images_ids = empty( $value ) ? array() : explode( ',', trim( $value ) );
                    $output .= '<ul class="attachment-thumbnails thumb-attach-images' . ( !empty( $images_ids ) ? ' image-exists' : '' ) . '" data-name="' . $param_name . '">';
                    foreach ( $images_ids as $image ) {
                        $img = wpb_getImageBySize( array( 'attach_id' => (int)$image, 'thumb_size' => 'thumbnail' ) );
                        $output .= ( $img ? '<li>' . $img['thumbnail'] . '</li>' : '<li><img width="32" height="32" test="' . $image . '" src="' . vc_asset_url( 'vc/blank.gif' ) . '" class="attachment-thumbnail" alt="" title="" /></li>' );
                    }
                    $output .= '</ul>';
                }
                
            } else {
                $output .= '<' . $param['holder'] . ' class="wpb_vc_param_value ' . $param_name . ' ' . $type . ' ' . $class . '" name="' . $param_name . '">' . $value . '</' . $param['holder'] . '>';
            }
            
            if ( ! empty( $param['admin_label'] ) && $param['admin_label'] === true ) {
                $output .= '<span class="vc_admin_label admin_label_' . $param['param_name'] . ( empty( $value ) ? ' hidden-label' : '' ) . '"><label>' . __( $param['heading'], 'js_composer' ) . '</label>: ' . $value . '</span>';
            }
            
            return $output;
        }
    }
}
