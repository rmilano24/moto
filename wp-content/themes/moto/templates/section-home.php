<?php 

    //overlay Options
    $homeOverlayTexture = ep_opt('home-overlay-texture');
    $homeOverlayColor =  ep_opt('home-overlay-color');
    $homeOverlayOpacity = (intval(ep_opt('home-overlay-opacity')))/100;

?>
<section id="home" class="<?php if ( ep_opt('home-type-switch') == 'home-revolutionSlider' ){ echo "home-rev-slider"; } ?>">
    <h1 style="display:none!important"> Home section </h1>

    <!-- inline Style For parallax background Color and color Opacity  -->
    <?php if ( isset($homeOverlayColor) || isset($homeOverlayOpacity)) { ?>

        <style type="text/css" media="all" scoped>
            #home .<?php echo esc_attr($homeOverlayTexture);?> {
                <?php if ( isset($homeOverlayColor) ) { ?> background-color:<?php echo esc_attr($homeOverlayColor);?>; <?php } ?>
                <?php if ( isset($homeOverlayOpacity) ) { ?> opacity:<?php echo esc_attr($homeOverlayOpacity);?>; <?php } ?>
            }
			<?php if ( isset($homeOverlayColor) ) { ?>
				#home .videoColorMask  {
					 background-color:<?php echo esc_attr($homeOverlayColor);?> !important;
				}
			 <?php } ?>
        </style>

    <?php } ?>

    <div class="homeWrap">
        <?php

            $slideNumber= "";
            if ( ep_opt('home-type-switch') == 'home-slider' ) {
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

            $slideNumber = count($slides);

            //duplicate slides if number of slides are 2
            if( $slideNumber == 2 )
            {
                $slides[] = $slides[0];
                $slides[] = $slides[1];
                $slideNumber = 4;
            }

            if ( $slideNumber > 1 ) { ?>
                <!-- FullScreen Slider -->
                <span id='hideMenuFirst'></span>

                <div class="wrap <?php echo ep_opt('fullscreen-slider-mode'); ?>" id="fullScreenSlider">

                    <!-- Swiper -->
                    <div id="slides" class="swiper-container no-select">
                        <div class="swiper-wrapper">

                            <?php
                            $iterator = 0;
                            foreach ($slides as $slideID) {
                                $meta_values = get_post_meta( $slideID->ID );
                                $caption_style = 'style1';
                                $caption_dark_light = 1;
                                $caption_align = 'center';

                                if(isset($meta_values['title-text']))
                                    $caption_style = $meta_values['caption-style'][0];

                                if(isset($meta_values['caption-dark-light']))
                                    $caption_dark_light = $meta_values['caption-dark-light'][0];

                                if(isset($meta_values['caption-align']))
                                    $caption_align = $meta_values['caption-align'][0];

                                if( $caption_dark_light == 1 )
                                    $caption_dark_light = 'light';
                                else
                                    $caption_dark_light = 'dark';

                                if($caption_style == 'style5')
                                    $caption_align = 'center';
                                ?>
                                
                                <div class="swiper-slide no-select <?php if($meta_values['background-type'][0] == 'video' && ($iterator == 0 || $iterator == count($slides)-1 )) { echo "has-duplicate-video"; } ?>">
                                    <div class="swiper-slide-image" style="background:url(<?php if($meta_values['background-type'][0] == 'image'){ echo esc_url($meta_values['background-image'][0]); } ?>)">
                                        <div class="caption <?php echo esc_attr($caption_style) . ' ' . esc_attr($caption_dark_light) . ' ' . esc_attr($caption_align);  ?>">
                                        
                                            <div class="caption-container">
                                            
                                                <?php

                                                    $title = $subtitle = $caption_element_type = $output = '';
                                                    $caption_image = $caption_icon = $button_url = $button_text = '';
                                                    $caption_element_animation = false;
                                                    if(isset($meta_values['title-text']))
                                                        $title = '<div class="caption-title">'. $meta_values['title-text'][0] . '</div>';
                                            
                                                    if(isset($meta_values['subtitle-text']))
                                                        $subtitle = '<div class="caption-subtitle">'. $meta_values['subtitle-text'][0] . '</div>';

                                                    if(isset($meta_values['caption-icon-image']))
                                                        $caption_element_type = $meta_values['caption-icon-image'][0];

                                                    if(isset($meta_values['caption-icon-image-animation']) && $meta_values['caption-icon-image-animation'][0] == '1')
                                                        $caption_element_animation = true;

                                                    if(isset($meta_values['caption-image']))
                                                        $caption_image = '<img alt="caption_image" class="caption-image ' .(($caption_element_animation == true) ? 'animated' : '' ) .'" src="'. $meta_values['caption-image'][0] . '">';

                                                    if(isset($meta_values['caption-icon']))
                                                        $caption_icon = '<span class="caption-icon icon-'. $meta_values['caption-icon'][0] . ' ' .(($caption_element_animation == true) ? 'animated' : '' ) .'"></span>';

                                                    if(isset($meta_values['button-url']))
                                                        $button_url = $meta_values['button-url'][0];

                                                    if(isset($meta_values['button-text']))
                                                        $button_text = $meta_values['button-text'][0];

                                                    $image_icon = '';
                                                    if($caption_element_type == 'image')
                                                    {
                                                        $image_icon = $caption_image;
                                                    }
                                                    else
                                                    {
                                                        $image_icon = $caption_icon;
                                                    }

                                                    if($caption_style =='style1')
                                                    {
                                                        $output  = $image_icon;
                                                        $output  .=  $subtitle;
                                                        $output  .=  $title;
                                                        echo $output;
                                                    }
                                                    elseif($caption_style == 'style2')
                                                    {

                                                        $output  = $image_icon;
                                                        $output  .=  $title;
                                                        $output  .=  $subtitle;
                                                        echo $output;
                                                    }
                                                    elseif($caption_style == 'style3')
                                                    {
                                                        $output  = $image_icon;
                                                        $output  .=  $title;
                                                        $output  .=  $subtitle;
                                                        echo $output;
                                                    }
                                                    elseif($caption_style == 'style4')
                                                    {
                                                        $output  = '<div class="caption-box">';
                                                        $output  .= $image_icon;
                                                        $output  .=  $title;
                                                        $output  .= '</div>';
                                                        $output  .=  $subtitle;
                                                        echo $output; 
                                                    }
                                                    else
                                                    {
                                                        $output  = '<div class="caption-box-top">';
                                                        $output  .= $image_icon;
                                                        $output  .= '</div>';
                                                        $output  .=  $title;
                                                        $output  .=  $subtitle;
                                                        $output  .= '<div class="caption-box-bottom"></div>';
                                                        echo $output; 
                                                    }
                                                ?>
                                            </div>

                                            <?php
                                            if(ep_opt('fullscreen-slider-mode') == 'epico')
                                            {
                                                ?>
                                                <!-- Add Arrows -->
                                                <div class="swiper-button-next no-selectn"></div>
                                                <div class="swiper-button-prev no-select"></div>
                                                <?php
                                            }

                                            if(!empty($button_url) && !empty($button_text))
                                            {
                                            ?>
                                                <div class="caption-container">
                                                    <a class="button center button-small" href="<?php echo esc_url($button_url); ?>" title="<?php echo esc_attr($button_text); ?>">
                                                        <div class="frame top">
                                                            <div></div>
                                                        </div>
                                                        <div class="frame right">
                                                            <div></div>
                                                        </div>
                                                        <div class="frame bottom">
                                                            <div></div>
                                                        </div>
                                                        <div class="frame left">
                                                            <div></div>
                                                        </div>

                                                        <span class="txt">
                                                                <?php echo esc_attr($button_text); ?>
                                                        </span>
                                                    </a>
                                                </div>
                                            
                                                
                                            <?php
                                            }
                                            ?>
                                            
                                        </div>
                                        <?php

                                            if($meta_values['background-type'][0] == 'video') {
                                                $video_preview ='';
                                                if(isset($meta_values['video-prev-image'][0]))
                                                    $video_preview = $meta_values['video-prev-image'][0];

                                                $output = '';
                                                $output .= '<div style="background-image:url('.$video_preview.')" class="hidden-desktop videoHomePreload"></div>';
                                                $output .= '<div class="videoHome videoWrap"><video class="video " width="1920" height="800" poster=" ' . THEME_IMAGES_URI .'/video-transparent-poster.png" style="background:url('.$video_preview.') 0 0;" preload="auto" loop="true" autoplay="true">';

                                                if ( isset( $meta_values['video-url-webm'][0] ) ) {
                                                    // WebM/VP8 for Firefox4, Opera, and Chrome
                                                    $output .= '<source type="video/webm" src="'. $meta_values['video-url-webm'][0] .'" />';
                                                }

                                                if (isset( $meta_values['video-url-mp4'][0] ) ) {
                                                    //MP4 for Safari, IE9, iPhone, iPad, Android, and Windows Phone 7
                                                    $output .= '<source type="video/mp4" src="'. $meta_values['video-url-mp4'][0] .'" />';
                                                }

                                                if ( isset( $meta_values['video-url-mp4'][0] ) ) {
                                                    //Flash fallback for non-HTML5 browsers without JavaScript
                                                    $output .= '<object width="320" height="240" type="application/x-shockwave-flash" data="'.get_template_directory_uri().'/assets/js/flashmediaelement.swf">';
                                                    $output .= '<param name="movie" value="'.get_template_directory_uri().'/assets/js/flashmediaelement.swf" />';
                                                    $output .= '<param name="flashvars" value="controls=true&file='. $meta_values['video-url-mp4'][0] .'" />';
                                                    $output .= '<img src="'.$video_preview.'" width="1920" height="800" title="No video playback capabilities" alt="#" />';
                                                    $output .= '</object>';
                                                }
                                                $output .= '</video></div>';

                                                echo $output;

                                            }
                                            
                                        ?>
                                        <div class="homeTexture sectionOverlay <?php echo esc_attr($homeOverlayTexture); ?>"></div>
                                        
                                    </div>
                                </div>

                            <?php
                            $iterator++;
                            }
                            ?>
                        </div>
                        <!-- Next Arrows -->
                        <div class="arrows-button-next no-select arrows-button-next<?php echo $id; if(ep_opt('fullscreen-slider-mode') != 'slide') { echo " hidden-desktop"; }?>">
                            <span class="text">
                                <?php _e('NEXT', 'epicomedia'); ?>
                            </span>
                        </div>

                        <!-- Prev Arrows -->
                        <div class="arrows-button-prev no-select arrows-button-prev<?php echo $id; if(ep_opt('fullscreen-slider-mode') != 'slide') { echo " hidden-desktop"; }?>">
                            <span class="text">
                                <?php _e('PREV', 'epicomedia'); ?>
                            </span>
                        </div>
                    <?php

                    if(ep_opt('home-start-btn') == 1)
                    {
                        ?>
                        <div id="caption-start" class="<?php echo ep_opt('home-start-btn-style'); ?>">
                        <?php
                        if(ep_opt('home-start-btn-style') == 'style-2')
                        {
                            ?>
                            <div class="dot"></div>
                            <?php

                        }
                        ?>
                        </div>
                        <?php
                    }
                    ?>

                </div>
            </div>
            <?php }  else if ($slideNumber == 1) { 

                $meta_values = get_post_meta( $slides[0]->ID );

                $caption_style = 'style1';
                $caption_dark_light = 1;
                $caption_align = 'center';

                if(isset($meta_values['title-text']))
                    $caption_style = $meta_values['caption-style'][0];

                if(isset($meta_values['caption-dark-light']))
                    $caption_dark_light = $meta_values['caption-dark-light'][0];

                if(isset($meta_values['caption-align']))
                    $caption_align = $meta_values['caption-align'][0];

                if( $caption_dark_light == 1 )
                    $caption_dark_light = 'light';
                else
                    $caption_dark_light = 'dark';

                if($caption_style == 'style5')
                    $caption_align = 'center';
                ?>
                <!-- FullScreen Image -->
                <span id='hideMenuFirst'></span>
                <div id="fullScreenImage" class="fullScreenImage homeParallax" style="background:url(<?php if($meta_values['background-type'][0] == 'image'){ echo esc_url($meta_values['background-image'][0]); } ?>);" >
                    <div class="caption <?php echo $caption_style . ' ' . $caption_dark_light . ' ' . $caption_align;  ?>">
                        <div class="caption-container">

                            <?php

                            $title = $subtitle = $caption_element_type = $output = '';
                            $caption_image = $caption_icon = $button_url = $button_text = '';
                            $caption_element_animation = false;
                            if(isset($meta_values['title-text']))
                                $title = '<div class="caption-title">'. $meta_values['title-text'][0] . '</div>';
                    
                            if(isset($meta_values['subtitle-text']))
                                $subtitle = '<div class="caption-subtitle">'. $meta_values['subtitle-text'][0] . '</div>';

                            if(isset($meta_values['caption-icon-image']))
                                $caption_element_type = $meta_values['caption-icon-image'][0];

                            if(isset($meta_values['caption-icon-image-animation']) && $meta_values['caption-icon-image-animation'][0] == '1')
                                $caption_element_animation = true;

                            if(isset($meta_values['caption-image']))
                                $caption_image = '<img alt="caption_image" class="caption-image ' .(($caption_element_animation == true) ? 'animated' : '' ) .'" src="'. $meta_values['caption-image'][0] . '">';

                            if(isset($meta_values['caption-icon']))
                                $caption_icon = '<span class="caption-icon icon-'. $meta_values['caption-icon'][0] . ' ' .(($caption_element_animation == true) ? 'animated' : '' ) .'"></span>';

                            if(isset($meta_values['button-url']))
                                $button_url = $meta_values['button-url'][0];

                            if(isset($meta_values['button-text']))
                                $button_text = $meta_values['button-text'][0];

                            $image_icon = '';
                            if($caption_element_type == 'image')
                            {
                                $image_icon = $caption_image;
                            }
                            else
                            {
                                $image_icon = $caption_icon;
                            }

                            if($caption_style =='style1')
                            {
                                $output  = $image_icon;
                                $output  .=  $subtitle;
                                $output  .=  $title;
                                echo $output;
                            }
                            elseif($caption_style == 'style2')
                            {

                                $output  = $image_icon;
                                $output  .=  $title;
                                $output  .=  $subtitle;
                                echo $output;
                            }
                            elseif($caption_style == 'style3')
                            {
                                $output  = $image_icon;
                                $output  .=  $title;
                                $output  .=  $subtitle;
                                echo $output;
                            }
                            elseif($caption_style == 'style4')
                            {
                                $output  = '<div class="caption-box">';
                                $output  .= $image_icon;
                                $output  .=  $title;
                                $output  .= '</div>';
                                $output  .=  $subtitle;
                                echo $output; 
                            }
                            else
                            {
                                $output  = '<div class="caption-box-top">';
                                $output  .= $image_icon;
                                $output  .= '</div>';
                                $output  .=  $title;
                                $output  .=  $subtitle;
                                $output  .= '<div class="caption-box-bottom"></div>';
                                echo $output; 
                            }

                            ?>

                        </div>
                        <?php

                        if(!empty($button_url) && !empty($button_text))
                        {
                        ?>
                            <div class="caption-container">
                                <a class="button center button-small" href="<?php echo esc_url($button_url); ?>" title="<?php echo esc_attr($button_text); ?>">
                                    <div class="frame top">
                                        <div></div>
                                    </div>
                                    <div class="frame right">
                                        <div></div>
                                    </div>
                                    <div class="frame bottom">
                                        <div></div>
                                    </div>
                                    <div class="frame left">
                                        <div></div>
                                    </div>

                                    <span class="txt">
                                            <?php echo esc_attr($button_text); ?>
                                    </span>
                                </a>
                            </div>
                        
                            
                        <?php
                        }
                        ?>
                  
                    </div>
                    <?php
                        if(ep_opt('home-start-btn') == 1)
                        {
                            ?>
                            <div id="caption-start" class="<?php echo ep_opt('home-start-btn-style'); ?>">
                                <?php
                                if(ep_opt('home-start-btn-style') == 'style-2')
                                {
                                    ?>
                                    <div class="dot"></div>
                                    <?php

                                }
                                ?>
                            </div>
                        <?php
                        }

                    if($meta_values['background-type'][0] == 'video') {
                            $video_preview ='';
                            if(isset($meta_values['video-prev-image'][0]))
                                $video_preview = $meta_values['video-prev-image'][0];

                            $output = '';
                            $output .= '<div style="background-image:url('.$video_preview.')" class="hidden-desktop videoHomePreload"></div>';
                            $output .= '<div class="videoHome videoWrap"><video class="video " width="1920" height="800" poster=" ' . THEME_IMAGES_URI .'/video-transparent-poster.png" style="background:url('.$video_preview.') 0 0;" preload="auto" loop="true" autoplay="true">';

                            if ( isset( $meta_values['video-url-webm'][0] ) ) {
                                // WebM/VP8 for Firefox4, Opera, and Chrome
                                $output .= '<source type="video/webm" src="'. $meta_values['video-url-webm'][0] .'" />';
                            }

                            if (isset( $meta_values['video-url-mp4'][0] ) ) {
                                //MP4 for Safari, IE9, iPhone, iPad, Android, and Windows Phone 7
                                $output .= '<source type="video/mp4" src="'. $meta_values['video-url-mp4'][0] .'" />';
                            }

                            if ( isset( $meta_values['video-url-mp4'][0] ) ) {
                                //Flash fallback for non-HTML5 browsers without JavaScript
                                $output .= '<object width="320" height="240" type="application/x-shockwave-flash" data="'.get_template_directory_uri().'/assets/js/flashmediaelement.swf">';
                                $output .= '<param name="movie" value="'.get_template_directory_uri().'/assets/js/flashmediaelement.swf" />';
                                $output .= '<param name="flashvars" value="controls=true&file='. $meta_values['video-url-mp4'][0] .'" />';
                                $output .= '<img src="'.$video_preview.'" width="1920" height="800" title="No video playback capabilities" />';
                                $output .= '</object>';
                            }
                            $output .= '</video></div>';

                            echo $output;

                        }
                        
                        ?>
        
                    <div class="homeTexture sectionOverlay <?php echo esc_attr($homeOverlayTexture); ?>"></div>
                </div>
            <?php } ?>
        <?php } else if ( ep_opt('home-type-switch') == 'home-map' ){ ?>
            <!-- FullScreen Map -->
            <span id='hideMenuFirst'></span>
            <?php
            if(ep_opt('home-start-btn') == 1)
            {
                ?>
                <div id="caption-start" class="<?php echo ep_opt('home-start-btn-style'); ?>">
                    <?php
                    if(ep_opt('home-start-btn-style') == 'style-2')
                    {
                        ?>
                        <div class="dot"></div>
                        <?php

                    }
                    ?>
                </div>
            <?php
            }
            ?>
            <div class="wrapGoogleMap sectionOverlay <?php echo esc_attr($homeOverlayTexture); ?>">
                <div id="homeGoogleMap">
                </div>
            </div>
        <?php } else if ( ep_opt('home-type-switch') == 'home-revolutionSlider' ){ ?>
            <!-- Revolution Slider -->
            <span id='hideMenuFirst'></span>
            <div id="homeHeight" class="revolutionSlider">
                <?php
                    $homeRevolutionslider = '[rev_slider '. ep_opt('home-rev-slide').']';
                    echo do_shortcode($homeRevolutionslider);
                ?>
            </div>

        <?php } 
        
    ?>

    </div>
</section>
<div id="startHere"></div>