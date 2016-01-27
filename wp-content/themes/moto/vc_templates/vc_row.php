<?php
$output = $el_class = '';
extract(shortcode_atts(array(
	'el_class' => '',
	'row_type' => 'row',
    'type' => '',
    'background_img_id' => '',
    'background_color' => '',
    'min_height' => '500',
    'parallax_speed' => '14',
    'parallax_position' => '50',
    'video_height' => '550px',
  	'video_mp4' => '',
	'video_webm' => '',
	'video_image' => '',
    'overlay_texture' => '',  
    'overlay_color' => '',  
    'overlay_opacity' => '',
    'row_padding_top' => '',
    'row_padding_bottom' => '',
    'row_padding_right' => '',
    'row_padding_left' => '',
    'row_margin_top' => '',
    'row_margin_bottom' => '',
    'equal_height' => 'no'
), $atts));

wp_enqueue_style( 'js_composer_front' );
wp_enqueue_script( 'wpb_composer_front_js' );
wp_enqueue_style('js_composer_custom_css');

// generate uniqe id for Row 
$id = ep_sc_id('vc_row');

if(is_numeric($overlay_opacity))
{
    if(floatval($overlay_opacity) >1)
        $overlay_opacity = '1';
    elseif(floatval($overlay_opacity) <0)
        $overlay_opacity = '0';
}
else
{
    $overlay_opacity = '';
}


$rowspace = "";
//row spacing
if ( $row_padding_top != "" || $row_padding_bottom != "" || $row_padding_left != "" || $row_padding_right != "" || $row_margin_top != "" || $row_margin_bottom != "" ) {

    if ( $row_padding_top != "") {
        $rowspace .= 'padding-top:'.$row_padding_top.'px;';
    } 
        
    if ( $row_padding_bottom != "") {
        $rowspace .= 'padding-bottom:'.$row_padding_bottom.'px;';
    } 
           
    if ( $row_padding_right != "") {
        $rowspace .= 'padding-right:'.$row_padding_right.'px;';
    } 
        
    if ( $row_padding_left != "") {
        $rowspace .= 'padding-left:'.$row_padding_left.'px;';
    } 
        
    if ( $row_margin_top != "") {
        $rowspace .= 'margin-top:'.$row_margin_top.'px;';
    } 
        
    if ( $row_margin_bottom != "") {
        $rowspace .= 'margin-bottom:'.$row_margin_bottom.'px;';
    }
}

$el_class = $this->getExtraClass($el_class);

$css_class = apply_filters(VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, 'section '.vc_shortcode_custom_css_class($el_class).$el_class, $this->settings['base']);

$row_class= '';

if ( ! empty( $equal_height ) && $equal_height == "yes" ) {
    $flex_row = true;
    $row_class = ' vc_row vc_row-o-equal-height';
}

if ( ! empty( $flex_row ) ) {
     $row_class .= ' vc_row-flex';
}

$_image ="";
if($background_img_id != '' || $background_img_id != ' ') { 
	$_image = wp_get_attachment_image_src( $background_img_id, 'full');
}


$overlay_image ="";
if($video_image != '' && $video_image != ' ') { 
	$overlay_image = wp_get_attachment_image_src( $video_image, 'full');
}

if($type == "full_width"){
	$css_class_type =  " fullWidth";
} else {
	$css_class_type =  "";
}

if ($row_type == 'row') {

	$output .= '<div id='.$id.' class="background_cover row_section ' . $css_class_type .' ' . $css_class.'"';
    $output .= " style='";
	    if($background_color != "" || $_image != ""){
			    if($background_color != ""){
				    $output .="background-color:".$background_color.";";
			    }
			    if($_image != ""){
				    $output .="background-image:url(".$_image[0].");";
			    }
	    }
    $output.= $rowspace;
    $output.="'";
	$output.=">";
                  
	$output .= '<div class="clearfix"></div>';
    $output .='<div class="container"><div class="wpb_row vc_row-fluid parallax_content ' . $row_class.'">';
     
    
} else if ($row_type == 'parallax') {

    if ( $overlay_color != ""  ||  $overlay_opacity != "" ) {

            $output .= '<style type="text/css" media="all" scoped> ';
         
              $output .= '#'.$id.'.'.$overlay_texture.':after {';

                    if (  $overlay_color != "" ) {   
                        
                            $output .= 'background-color:'.$overlay_color.';';  
                    } 
                    
                    if ( $overlay_opacity!= "" ) { 
                            
                            $output .= 'opacity:'. $overlay_opacity.';'; 
                    }
                    
             $output .= '}';

        $output .= ' </style>';
    }

    $css_class = "";

    if($equal_height == "enable")
    {
        $css_class = 'equal-column-height';
    }
    
    $output .='<div id='.$id.' class="parallax sectionOverlay' . ' ' . $css_class . ' ' . $el_class .' '. $overlay_texture .'"  data-speed="'. $parallax_speed .'"  data-position="50" style = "';

    if($min_height !='' || $min_height!=' '){

        if( strpos($min_height, 'px')) { } else {
            $min_height .= 'px';
        }

        $output .= ' min-height:' . $min_height . ';';
    }
    
    
    $output .= ($background_img_id !== '' || $background_img_id !== ' ') ? " background-image:url('" . $_image[0] . "');" : "";
    $output.= $rowspace;
    $output .= '"';
    $output .= '>';
	$output .='<div class="container"><div class="wpb_row vc_row-fluid parallax_content ' . $row_class.'">';
    
  
} else if ($row_type == 'video')  { 
    
    $css_class_type =  " fullWidth";

    if ( $overlay_color != ""  ||  $overlay_opacity != "" ) {

            $output .= '<style type="text/css" media="all" scoped> ';
         
              $output .= '#'.$id.'.'.$overlay_texture.':after {';

                    if (  $overlay_color != "" ) {   
                        
                            $output .= 'background-color:'.$overlay_color.';';  
                    } 
                    
                    if ( $overlay_opacity!= "" ) { 
                            
                            $output .= 'opacity:'. $overlay_opacity.';'; 
                    }
                    
             $output .'}';

        $output .= ' </style>';
    } 

    $css_class = '';
    if($equal_height == "enable")
    {
        $css_class = 'equal-column-height';
    }

     $v_image = wp_get_attachment_url($video_image);
    $output .= '<div class="wrap" style="height:'.$video_height.'">';
    $output .= '<div class="vc_videowrap" style="height:'.$video_height.'">';
    $output .= '<div style="background-image:url('.$v_image.')" class="hidden-desktop videoHomePreload"></div>';
    $output .= '<div id='.$id.' class="videoHome sectionOverlay ' . $css_class . ' '. $css_class_type .' '. $overlay_texture .'" style="'.$rowspace.'">';	
    $output .= '<div class="videoWrap">';
    $output .= '<video class="video" width="1900" height="800" poster="'.$v_image.'" controls="controls" preload="auto" loop="true" autoplay="true">';
    
            
            if(!empty($video_webm)) {   $output .= '<source type="video/webm" src="'.$video_webm.'">'; }     
            if(!empty($video_mp4))  {   $output .= '<source type="video/mp4" src="'.$video_mp4.'">'; }   
            				            $output .='<object width="320" height="240" type="application/x-shockwave-flash" data="'.get_template_directory_uri().'/js/flashmediaelement.swf">
						                <param name="movie" value="'.get_template_directory_uri().'/js/flashmediaelement.swf" />
						                <param name="flashvars" value="controls=true&file='.$video_mp4.'" />
						                <img src="'.$v_image.'" width="1920" height="800" title="No video playback capabilities" alt="Video thumb" />
				</object>
		</video>		
</div>';   

    $output .='<div class="container"><div class="wpb_row vc_row-fluid videoContent vc_videocontent ' . $row_class.'">';

}

     $output .= wpb_js_remove_wpautop($content);

    
if($row_type == 'row') {
	$output .= '</div></div></div>'.$this->endBlockComment('row');
    
} elseif($row_type == 'parallax'){
	$output .= '</div></div></div>'.$this->endBlockComment('row');
	
} elseif ($row_type == 'video') {
    $output .= '</div></div></div></div></div>'.$this->endBlockComment('row');
}
echo $output;