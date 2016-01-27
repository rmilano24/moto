<?php
/*-----------------------------------------------------------------------------------

	Theme Shortcodes
    
-----------------------------------------------------------------------------------*/


/*-----------------------------------------------------------------------------------*/
/*	Allowed tags for wp_kses
/*-----------------------------------------------------------------------------------*/

$GLOBALS["allowed_tags"]= array(
    'strong' => array(),
    'br' => array(),
    'em' => array(),
    'a' => array(
        'href' => array(),
        'title' => array()
    ),
);

/*-----------------------------------------------------------------------------------*/
/*	Shortcode forms ajax handler
/*-----------------------------------------------------------------------------------*/

function ep_sc_popup()
{   
    include('forms.php');
    die();
}

add_action('wp_ajax_ep_sc_popup', 'ep_sc_popup');

/*-----------------------------------------------------------------------------------*/
/*	Shortcode helpers
/*-----------------------------------------------------------------------------------*/

//Generate ID for shortcodes
function ep_sc_id($key)
{
    $globalKey = "ep_sc_$key";

    if(array_key_exists($globalKey, $GLOBALS))
        $GLOBALS[$globalKey]++;
    else
        $GLOBALS[$globalKey] = 1;

    $id    = $GLOBALS[$globalKey];
    return $key . '_' . $id;
}

/*-----------------------------------------------------------------------------------*/
/*  Separators
/*-----------------------------------------------------------------------------------*/

function ep_sc_separator( $atts, $content = null ) {
    extract(shortcode_atts(array(
        'size'   => 'full',  // small, small-center, medium, medium-center
        'margin' => 'default',//small, medium
        'pxthickness' => '1',
        'color' => '#888',
    ), $atts));

    $id = ep_sc_id('vc_separator');
    $class = '';

    switch($size)
    {
        case 'small':
            $class[] = 'hr-small';
            break;
        case 'small-center':
            $class[] = 'hr-small hr-center';
            break;
        case 'extra-small':
            $class[] = 'hr-extra-small';
            break;
        case 'extra-small-center':
            $class[] = 'hr-extra-small hr-center   ';
            break;
        case 'medium':
            $class[] = 'hr-medium';
            break;
        case 'medium-center':
            $class[] = 'hr-medium hr-center';
            break;
        case 'full':
            $class[] = ' full';
            break;   
    }
 
    switch($margin)
    {
        case 'small':
            $class[] = 'hr-margin-small';
            break;
        case 'medium':
            $class[] = 'hr-margin-medium';
            break;
    }

    $hasStyle = '' != $color || '' != $pxthickness;
    
    if($hasStyle)
    {
    ?>
    <style type="text/css" media="all" scoped>
        <?php if(strlen($color))
        {
            echo "hr#$id"; ?>
            {
                background-color: <?php echo esc_attr($color); ?>;
            }

        <?php
        }
         if(strlen($pxthickness))
        {
            echo "hr#$id"; ?>
            {
                height: <?php echo esc_attr($pxthickness); ?>px;
            }

        <?php
        }
        ?>
    </style>
    <?php
    }//if($hasStyle)

    ob_start();
    ?>

        <hr id="<?php echo esc_attr($id); ?>"  class="<?php echo implode(' ',$class)?>" />

    <?php
    return ob_get_clean();
}

add_shortcode('vc_separator', 'ep_sc_separator');

/*-----------------------------------------------------------------------------------*/
/*	Title with horizontal line
/*-----------------------------------------------------------------------------------*/

function ep_sc_title( $atts, $content = null ) {
    extract(shortcode_atts(array(
        'title'   => 'Title',
        'title_align'   => 'separator_align_center',
        'title_font_size'   => '20',
        'title_border_enable'   => 'enable',
        'pxthickness' => '1',
        'title_color' => '',
        'color' => '#888',
		'class'=> '',
    ), $atts));
    
    $id = ep_sc_id('vc_text_separator');
       
    $hasStyle = '' != $color || '' != $pxthickness;
    
    if($hasStyle)
    {
    ?>
    <style type="text/css" media="all" scoped>
        <?php if(strlen(esc_attr($color)))
        {
            echo "#$id.vc_separator .vc_sep_holder .vc_sep_line"; ?>
            {
               border-top-color: <?php echo esc_attr($color); ?>;
            }
            
          <?php echo "#$id.vc_separator.separator_align_left .title , #$id.vc_separator.separator_align_right .title , #$id.vc_separator.separator_align_center .title"; ?>
            {
               border-left-color: <?php echo esc_attr($color); ?>;
               border-right-color: <?php echo esc_attr($color); ?>;
            }

        <?php
        }
         if(strlen(esc_attr($pxthickness)))
        {
            echo "#$id.vc_separator .vc_sep_holder .vc_sep_line"; ?>
            {
                border-top-width: <?php echo esc_attr($pxthickness); ?>px;
                height:<?php echo esc_attr($pxthickness); ?>px;
                top:<?php echo ceil(((int)esc_attr($pxthickness))/2); ?>px;
            }

        <?php
        }
        if(strlen(esc_attr($title_font_size)))
        {
            echo "#$id.vc_separator .title"; ?>
            {
                font-size: <?php echo esc_attr($title_font_size); ?>px;
            }
        <?php
        }
        if(strlen(esc_attr($title_color)))
        {
            echo "#$id.vc_separator .title "; ?>
            {
                color:<?php echo esc_attr($title_color); ?>;
            }

        <?php
        }
        ?>
    </style>
    <?php
    }//if($hasStyle)
    
    ob_start();
    ?>
    <div id=<?php echo esc_attr($id); ?> class="vc_separator <?php echo esc_attr($class); ?> <?php echo esc_attr($title_align); ?> <?php echo esc_attr($title_border_enable); ?>">
        <span class="vc_sep_holder vc_sep_holder_l"><span class="vc_sep_line"></span></span>
        <div class="title"><?php echo esc_attr($title); ?></div>
        <span class="vc_sep_holder vc_sep_holder_r"><span class="vc_sep_line"></span></span>
    </div>
    

    <?php
    return ob_get_clean();
}

add_shortcode('vc_text_separator', 'ep_sc_title');

/*-----------------------------------------------------------------------------------*/
/*	Team Member
/*-----------------------------------------------------------------------------------*/

function ep_sc_team_member( $atts, $content = null ) {

    extract(shortcode_atts(array(
        'name'   => 'JOHN DOE',
        'job_title' => 'Designer',
        'image'  => '',
        'signature'  => '',
        'style'  => 'dark',
        'team_color_preset'  => 'd02d48',
        'team_color'  => '#cccccc',
        'description'  => '',
        'url'    => '',
        'target' => '_self',
        'team_animation' => 'none',
        'team_animation_delay' => '0',
        'team_icon1'  => '',
        'team_icon2'  => '',
        'team_icon3'  => '',
        'team_icon4'  => '',
        'team_icon5'  => '',
        'team_icon_url1'  => '',
        'team_icon_url2'  => '',
        'team_icon_url3'  => '',
        'team_icon_url4'  => '',
        'team_icon_url5'  => '',
        'team_icon_target1'  => '_self',
        'team_icon_target2'  => '_self',
        'team_icon_target3'  => '_self',
        'team_icon_target4'  => '_self',
        'team_icon_target5'  => '_self',
    ), $atts));
    
    if (is_numeric($image)) {
        $image = wp_get_attachment_url($image);
    }

    if (is_numeric($signature)) {
        $signature = wp_get_attachment_url($signature);
    }
    
    $hasTeamIcon = '' != $team_icon1 || '' != $team_icon2  || '' != $team_icon3 || '' != $team_icon4 || '' != $team_icon5;
     
    $hasStyle = '' != $team_color || '' != $team_color_preset;
    $id     = ep_sc_id('team_member');

    ob_start();

    if($hasStyle)
    {
    ?>
    <style type="text/css" media="all" scoped>
        <?php
        $color = "";
        if(strlen(esc_attr($team_color_preset)))
        {
            if($team_color_preset == 'custom')
            {
                $color = $team_color;
            }
            else
            {
                $color = "#" . $team_color_preset;
            }
        }
        
        echo "#$id.team-member .member-line"; ?>
        {
            background-color:<?php echo esc_attr($color); ?>;
        }
        <?php
        echo "#$id.team-member:hover .member-plus"; ?>
        {
            background-color: <?php echo esc_attr($color); ?>;
        }
        <?php
        echo "#$id.team-member .icons li:hover a"; ?>
        {
            color: <?php echo esc_attr($color); ?>;
        }

    </style>
    <?php
    }//if($hasStyle)

    ob_start();
    ?>
        <div id="<?php echo $id; ?>" class="team-member <?php if( strlen($style)) { echo esc_attr($style);  } ?> <?php if($team_animation != 'none') { echo 'teamWithAnimation';} ?>"  <?php if($team_animation != 'none') { ?> data-delay="<?php echo esc_attr($team_animation_delay); ?>" data-animation="<?php echo esc_attr($team_animation); ?>" <?php } ?>>

            <?php if($image)
            {
            ?>
            <div class="member-pic-container">

                <div class="member-line"></div>

                <div class="member-pic">
                    <?php if($image)
                        {
                        ?>
                            <img class ="bg-image" src="<?php echo esc_url($image); ?>" alt="<?php echo esc_attr($name) ?>">
                        <?php
                        }
                    ?>
                </div>

                <div class="member-plus">
                    <span class="member-plus-line"></span>
                </div>
                            
                <?php if ($hasTeamIcon) { ?>
                        <ul class="icons">
                           
                            <?php if ($team_icon1) { ?>
                                <li>
                                    <a href="<?php echo esc_url($team_icon_url1); ?>" title="<?php echo esc_attr($job_title); ?>" target="<?php echo esc_attr($team_icon_target1); ?>">
                                        <span class="icon-<?php echo esc_attr($team_icon1); ?>" ></span>
                                    </a>
                                </li>
                             <?php } ?>
                             
                            <?php if ($team_icon2) { ?>
                                <li>
                                    <a href="<?php echo esc_url($team_icon_url2); ?>" title="<?php echo esc_attr($job_title); ?>" target="<?php echo esc_attr($team_icon_target2); ?>">
                                        <span class="icon-<?php echo esc_attr($team_icon2); ?>" ></span>
                                    </a>
                                </li>
                            <?php } ?>
                            
                            <?php if ($team_icon3) { ?>
                                <li>
                                    <a href="<?php echo esc_url($team_icon_url3); ?>" title="<?php echo esc_attr($job_title); ?>" target="<?php echo esc_attr($team_icon_target3); ?>">
                                        <span class="icon-<?php echo esc_attr($team_icon3); ?>" ></span>
                                    </a>
                                </li>
                            <?php } ?>
                            
                            <?php if ($team_icon4) { ?>
                                <li>
                                    <a href="<?php echo esc_url($team_icon_url4); ?>" title="<?php echo esc_attr($job_title); ?>" target="<?php echo esc_attr($team_icon_target4); ?>">
                                        <span class="icon-<?php echo esc_attr($team_icon4); ?>" ></span>
                                    </a>
                                </li>
                            <?php } ?>
                            
                            <?php if ($team_icon5) { ?>
                                <li>
                                    <a href="<?php echo esc_url($team_icon_url5); ?>" title="<?php echo esc_attr($job_title); ?>" target="<?php echo esc_attr($team_icon_target5); ?>">
                                        <span class="icon-<?php echo esc_attr($team_icon5); ?>" ></span>
                                    </a>
                                </li> 
                            <?php } ?>
                            
                        </ul>
                <?php } ?>

                <div class="overlay"></div>
            </div>

            <div class="member-info">

                 <span class="member-name"> <?php echo esc_attr($name); ?></span>

                <cite><?php echo esc_attr($job_title); ?></cite>

                <div class="member-description">

                    <p><?php echo wp_kses( $description, $GLOBALS["allowed_tags"] ); ?></p>

                    <?php
                    if($url)
                    {
                        $link = vc_build_link( $atts['url'] );
                        if ( strlen( $link['url'] ) ) { 
                        ?>
                        <a href="<?php echo esc_url($link['url']); ?>" target="<?php echo esc_attr( $link['target'] ); ?>" class="more-link-arrow" title="<?php echo esc_attr($link['title']); ?>">[ <?php echo esc_attr($link['title']); ?> ]</a>
                        <?php
                        }
                    }
                    ?>

                    <?php if('' != esc_url($signature)){ ?>

                        <div class="signature">

                            <img src="<?php echo esc_url($signature); ?>" alt="<?php echo esc_attr($name) ?>">

                        </div>

                    <?php } ?>
                    
                </div>

            </div>

            <?php
            }
            ?>

        </div>
    <?php
    return ob_get_clean();
}

add_shortcode('team_member', 'ep_sc_team_member');

/*-----------------------------------------------------------------------------------*/
/* Testimonials shortcode 
/*-----------------------------------------------------------------------------------*/

function ep_sc_testimonial ($atts, $content = null) {

    extract(shortcode_atts(array(
        "style"			=> "dark",
        "testimonial_color_preset"			=> "d02d48",
        "testimonial_color"			=> "",
        "testimonial_animation"     => "none",
        "testimonial_animation_delay" => "0",
    ), $atts));

    $animation_params = "";
    $testimonialWithAnimation = '';
    
    if( $testimonial_animation != 'none') {
        $testimonialWithAnimation = ' testimonialWithAnimation';
        $animation_params = " data-delay='" . esc_attr($testimonial_animation_delay) . "' data-animation='" . esc_attr($testimonial_animation) . "'";
    };

    $id = ep_sc_id('testimonial');
    
    $hasStyle = '' != $testimonial_color_preset || '' != $testimonial_color ;
   
    if($hasStyle)
    {
    ?>
    <style type="text/css" media="all" scoped>
        <?php
        $color = "";
        if(strlen(esc_attr($testimonial_color_preset)))
        {
            if($testimonial_color_preset == 'custom')
            {
                $color = $testimonial_color;
            }
            else
            {
                $color = "#" . $testimonial_color_preset;
            }
        }
        
        echo "#$id.testimonials:after"; ?>
        {
            border-top: 3px solid <?php echo esc_attr($color); ?>;
        }
        <?php
        echo "#$id.testimonials:before"; ?>
        {
            border-top: 3px solid <?php echo esc_attr($color); ?>;
        }
        <?php
        echo "#$id.testimonials .quot-icon"; ?>
        {
            background-color:<?php echo esc_attr($color); ?>;
        }   
        <?php
        echo "#$id.testimonials .quot-icon:before"; ?>
        {
            border-top-color:<?php echo esc_attr($color); ?>;
            border-bottom-color:<?php echo esc_attr($color); ?>;
            border-left-color:<?php echo esc_attr($color); ?>;
        }  
        <?php
        echo "#$id.testimonials .quot-icon:after"; ?>
        {
            border-bottom-color:<?php echo esc_attr($color); ?>;
        } 
        
    </style>
    <?php
    }//if($hasStyle)
   
    ob_start();
    
    ?> 

    <div id="<?php echo $id; ?>" class="testimonials <?php echo $testimonialWithAnimation; if ($style == 'light') { echo ' skin-light'; }?>" data-id="<?php echo $id;?>" <?php echo $animation_params; ?>>
        <div class="quot-icon-container">
            <span class="quot-icon"></span>
            <span class="quot-icon"></span>
        </div>
        <div class="swiper-container swiper-container-<?php echo $id?> clearfix">
            <div class="swiper-wrapper">
                <?php echo do_shortcode($content); ?>
            </div>
        </div>

        <!-- Next Arrows -->
        <div class="arrows-button-next no-select arrows-button-next-<?php echo $id?>">
            <span class="text">
                <?php _e('NEXT', 'epicomedia'); ?>
            </span>
        </div>

        <!-- Arrows divider -->
        <div class="arrow-button-divider"></div>

        <!-- Prev Arrows -->
        <div class="arrows-button-prev no-select arrows-button-prev-<?php echo $id?>">
            <span class="text">
                <?php _e('PREV', 'epicomedia'); ?>
            </span>
        </div>

    </div>

    <?php
    
    return ob_get_clean();
}

add_shortcode('testimonial', 'ep_sc_testimonial');

/*-----------------------------------------------------------------------------------*/
/* Testimonial item shortcode 
/*-----------------------------------------------------------------------------------*/

function ep_sc_testimonial_item ($atts, $content = null) {

    extract(shortcode_atts(array(
        "author"         => "",
        "text"         => "",
        "job"         => "",
        "image_url"         => "",
    ), $atts));
    
    $html = $authorimg = "";
    if (is_numeric($image_url)) {
        $authorimg = wp_get_attachment_url($image_url);
    }

    ob_start();

    ?>

    <div class="swiper-slide testimonial">
        <div class="quote">
            <div class="head">
                <div class="author-image" style="background-image:url(<?php echo esc_attr($authorimg); ?>)"></div>
                <div class="author">
                    <h4 class="name"><?php echo esc_attr($author); ?> </h4>
                    <cite class="job"><?php echo esc_attr($job); ?> </cite>
                </div>
            </div>
            <blockquote><?php echo esc_attr($text); ?> </blockquote>
        </div>                 
    </div>

    <?php

    return ob_get_clean();
}

add_shortcode('testimonial_item', 'ep_sc_testimonial_item');

/*-----------------------------------------------------------------------------------*/
/*  Pie Chart
/*-----------------------------------------------------------------------------------*/

function ep_sc_piechart($atts ,$content=null)
{
    extract(shortcode_atts(array(
        'title'    => '',
        'title_color'    => '',
        'subtitle' => '',
        'subtitle_color' => '',
        'piechart_percent' => '70',
        'piechart_percent_display' => 'enable',
        'piechart_color_preset' => 'd02d48',
        'piechart_color'=> '',
        'main_color'=> '',
        'piechart_icon' => '',
        'piechart_animation' => 'none',
        'piechart_animation_delay' => '0',
    ), $atts));

    if($piechart_color_preset !=  'custom')
    {
        $piechart_color = "#". $piechart_color_preset;
    }

    $hasTitle   = '' != $title;
    $hasStyle = '' != $title_color || '' != $subtitle_color || '' != $main_color;
    $class = "pieChart easyPieChart";
    $pieChartWithAnimation = '';
    $id	= ep_sc_id('piechart');
    $responsiveid = ep_sc_id('piechartResponsive');


    if($piechart_animation != 'none')
        $pieChartWithAnimation = ' pieChartWithAnimation';


    ob_start();
    if($hasStyle)
    {
    ?>
    <style type="text/css" media="all" scoped>
        <?php if(strlen(esc_attr($title_color)))
        {
            echo "#$id.pieChartBox .title,";
            echo "#$responsiveid.pieChartBoxResponsive .progress_percent_value,";
            echo "#$responsiveid.pieChartBoxResponsive .progress_title";?>
            {
                color: <?php echo esc_attr($title_color); ?>;
            }

        <?php
        }
        if(strlen(esc_attr($subtitle_color)))
        {
            echo "#$id.pieChartBox .subtitle,";
            echo "#$responsiveid.pieChartBoxResponsive .subtitle";?>
            {
                color: <?php echo esc_attr($subtitle_color); ?>;
            }
        <?php
        }

        if(strlen(esc_attr($main_color)))
        {
            echo "#$id.pieChartBox .pieChart .dot-container .dot";?>
            {
                background-color: <?php echo esc_attr($main_color); ?>;
            }

            <?php
            echo "#$id.pieChartBox .iconPchart .icon,";
            echo "#$id.pieChartBox .perecent,";
            echo "#$id.pieChartBox .iconPchart .perecent,";
            echo "#$responsiveid.pieChartBoxResponsive .icon";
            ?>
            {
                color: <?php echo esc_attr($main_color); ?>;
            }
        <?php
        }

        echo "#$responsiveid.pieChartBoxResponsive .progressbar_percent,";
        echo "#$responsiveid.pieChartBoxResponsive .progressbar_percent:after";
        ?>
        {
            background-color: <?php echo esc_attr($piechart_color); ?>;
        }
    </style>
    <?php
    }//if($hasStyle)
    ?>

    <div id="<?php echo esc_attr($id); ?>" class="pieChartBox  visible-desktop<?php echo esc_attr($pieChartWithAnimation); ?> <?php if($piechart_percent_display == 'disable'){?> disablepercent <?php } ?>" <?php if(strlen(esc_attr($piechart_animation))) { ?> data-delay="<?php echo esc_attr($piechart_animation_delay); ?>" data-animation="<?php echo esc_attr($piechart_animation); ?>" <?php } ?> <?php if(esc_attr($piechart_color)){ ?> data-barColor=<?php echo esc_attr($piechart_color); }?>>
        <div class="<?php if($piechart_icon){?>iconPchart <?php } ?><?php echo esc_attr($class); ?>" data-percent="<?php echo esc_attr($piechart_percent); ?>">
            <?php if($piechart_icon){?><span class="icon icon-<?php echo esc_attr($piechart_icon); ?>"></span><?php } ?>
            <?php if($piechart_percent_display == 'enable'){?><span class="perecent"><?php echo esc_attr($piechart_percent); ?>%</span><?php } ?>
            <div class="dot-container">
                <div class="dot"></div>
            </div>
        </div>
        <p class="title"><?php echo esc_attr($title); ?></p>
        <p class="subtitle"><?php echo esc_attr($subtitle); ?></p>
    </div>

    <div id="<?php echo esc_attr($responsiveid); ?>" class="pieChartBoxResponsive progress_bar hidden-desktop <?php if($piechart_icon){ echo "have_icon"; } ?>" data-delay="0" data-animation="none">
        <div class="progressbar_holder">
            <div class="progressbar-container">
                <?php if($piechart_icon){?><span class="icon icon-<?php echo esc_attr($piechart_icon); ?>"></span><?php } ?>
                <?php if($piechart_percent_display == 'enable'){?><span class="progress_percent_value" ><?php echo esc_attr($piechart_percent); ?>%</span><?php } ?>
            </div>
            <div class="progressbar-container">
                <div class="progressbar_percent_line"></div>
                <div class="progressbar_percent" data-percentage="<?php if(esc_attr($piechart_percent)){ echo esc_attr($piechart_percent); } ?>" ></div>
                <?php if($title){?><span class="progress_title" ><?php if(esc_attr($title)){ echo esc_attr($title); } ?></span><?php } ?>
                <p class="subtitle"><?php echo esc_attr($subtitle); ?></p>
            </div>
        </div>
    </div>

    <?php
    return ob_get_clean();
}

add_shortcode( 'piechart', 'ep_sc_piechart' );

/*-----------------------------------------------------------------------------------*/
/*  Horizontal progress bar
/*-----------------------------------------------------------------------------------*/

function ep_sc_progressbar($atts ,$content=null)
{
    extract(shortcode_atts(array(
        'title'    => '',
        'title_color'    => '',
        'percent' => '50',
        'active_bg_color' => '',
        'inactive_bg_color' => '',
        'progressbar_animation' => 'none',
        'progressbar_animation_delay' => '0',
    ), $atts));

    $hasStyle = '' != $title_color || '' != $active_bg_color || '' != $inactive_bg_color ;
    $id	= ep_sc_id('progressbar');
    $progressbarWithAnimation = '';

    if($progressbar_animation != 'none')
        $progressbarWithAnimation = ' progressbarWithAnimation';
     
    ob_start();
    if($hasStyle)
    {
    ?>
    <style type="text/css" media="all" scoped>
        <?php if(strlen(esc_attr($title_color)))
        {
            echo "#$id.progress_bar  .progress_title "; ?>
            {
                color: <?php echo esc_attr($title_color); ?>;
            }

            <?php echo "#$id.progress_bar  .progress_percent_value"; ?>
            {
                color: <?php echo esc_attr($title_color); ?>;
            }

        <?php
        }
        if(strlen(esc_attr($active_bg_color)))
        {
            echo "#$id.progress_bar .progressbar_percent, #$id.progress_bar .progressbar_percent:after"; ?>
            {
                background-color: <?php echo esc_attr($active_bg_color); ?>;
            }
        <?php
        }

        if(strlen(esc_attr($inactive_bg_color)))
        {
            echo "#$id.progress_bar .progressbar_holder:after"; ?>
            {
                background-color: <?php echo esc_attr($inactive_bg_color); ?>;
            }
        <?php
        }
        ?>
    </style>
    <?php
    }
    ?>

    <div id="<?php echo esc_attr($id); ?>"  class="progress_bar <?php echo esc_attr($progressbarWithAnimation); ?>" data-delay="<?php echo esc_attr($progressbar_animation_delay); ?>" data-animation="<?php echo esc_attr($progressbar_animation); ?>">
        <div class="progressbar_holder">
            <?php if($title){?><span class="progress_title" ><?php if(esc_attr($title)){ echo esc_attr($title); } ?></span><?php } ?>
            <span class="progress_percent_value" ><?php echo esc_attr($percent); ?>%</span>
            <div class="progressbar_percent" data-percentage="<?php if(esc_attr($percent)){ echo esc_attr($percent); } ?>" ></div>
        </div>
    </div>
    
    <?php
    return ob_get_clean();
}

add_shortcode( 'progressbar', 'ep_sc_progressbar' );

/*-----------------------------------------------------------------------------------*/
/*	Social Icon 
/*-----------------------------------------------------------------------------------*/

function ep_sc_socialIocn ($atts, $content=null)
{
    extract(shortcode_atts(array(
        'sociallink_url' => '',
        'sociallink_type'=> 'facebook3',
        'sociallink_style' => 'dark',
		'sociallink_image' => '',
		'sociallink_color' => '',
    ), $atts));
	$id	= ep_sc_id('socialIcon');
    if (is_numeric($sociallink_image)) {
        $sociallink_image = wp_get_attachment_url($sociallink_image);
    }

	if(esc_attr($sociallink_type)=='custom') {
	    $sociallink_type= $id; ?>

        <style type="text/css" media="all" scoped>
            .<?php echo esc_attr($sociallink_type); ?> a:before {
			        background: <?php echo esc_url($sociallink_color); ?> !important;
			    }
		        span.icon.icon-<?php echo esc_attr($sociallink_type); ?>{
			        background-image: url('<?php echo esc_url($sociallink_image); ?>') !important;
			    }
        </style>

    <?php
   }//if social network name was custom

    ob_start();

    ?>
    <div class="socialLinkShortcode iconstyle <?php echo esc_attr($sociallink_type); ?> <?php echo esc_attr($sociallink_style); ?>">
        <a id="<?php echo esc_attr($id); ?>" href="<?php echo esc_url($sociallink_url); ?>" target="_blank" >	    
            <span class="icon icon-<?php echo esc_attr($sociallink_type); ?>" ></span>
        </a>
    </div>


    <?php
    return ob_get_clean();
}

add_shortcode( 'socialIcon', 'ep_sc_socialIocn' );

/*-----------------------------------------------------------------------------------*/
/*	Social Link 
/*-----------------------------------------------------------------------------------*/

function ep_sc_socialLink ($atts, $content=null)
{
    extract(shortcode_atts(array(
        'sociallink_url' => '',
        'sociallink_type'=> 'facebook3',
        'sociallink_style' => 'dark',
	    'sociallink_color' => '',
	    'sociallink_text' => '',
    ), $atts));
    
    $id	= ep_sc_id('socialLink');
	if(esc_attr($sociallink_type)=='custom'){
	$sociallink_type= $id; ?>

    <style type="text/css" media="all" scoped>
        .<?php echo esc_attr($sociallink_type); ?> a:before {
			background: <?php echo esc_url($sociallink_color); ?> !important;
        } 
    </style>

    <?php
   }//if social network name was custom
    
    switch($sociallink_type)
    {
        case 'facebook3':
            $sociallink_text = 'facebook';
            break;
        case 'twitter2':
            $sociallink_text = 'twitter';
            break;
        case 'vimeo':
            $sociallink_text = 'vimeo';
            break;
        case 'youtube':
            $sociallink_text = 'youtube';
            break;
        case 'googleplus2':
            $sociallink_text = 'Google+';
            break;
        case 'dribbble2':
            $sociallink_text = 'dribbble';
            break;
        case 'tumblr2':
            $sociallink_text = 'tumblr';
            break;
        case 'linkedin2':
            $sociallink_text = 'linkedin';
            break;
        case 'flickr2':
            $sociallink_text = 'Flickr';
            break;
        case 'forrst':
            $sociallink_text = 'forrst';
            break;
        case 'github':
            $sociallink_text = 'github';
            break;
        case 'lastfm':
            $sociallink_text = 'lastfm';
            break;
        case 'paypal':
            $sociallink_text = 'paypal';
            break;
        case 'feed2':
            $sociallink_text = 'RSS';
            break;
        case 'wordpress':
            $sociallink_text = 'wordpress';
            break;
        case 'skype':
            $sociallink_text = 'skype';
            break;
        case 'yahoo':
            $sociallink_text = 'yahoo';
            break;
       case 'steam':
            $sociallink_text = 'steam';
            break;
       case 'reddit':
            $sociallink_text = 'reddit';
            break;
       case 'stumbleupon':
            $sociallink_text = 'stumbleupon';
            break;
        case 'stumbleupon':
            $sociallink_text = 'stumbleupon';
            break;
        case 'pinterest':
            $sociallink_text = 'pinterest';
            break;
        case 'deviantart':
            $sociallink_text = 'deviantart';
            break;
        case 'xing':
            $sociallink_text = 'xing';
            break;
        case 'blogger':
            $sociallink_text = 'blogger';
            break;
        case 'soundcloud':
            $sociallink_text = 'soundcloud';
            break;
        case 'delicious':
            $sociallink_text = 'delicious';
            break;
        case 'foursquare':
            $sociallink_text = 'foursquare';
            break;
        case 'instagram':
            $sociallink_text = 'instagram';
            break;
        case 'behance':
            $sociallink_text = 'behance';
            break;
		case 'custom':
		    $sociallink_text = esc_attr($sociallink_text);
            break;
		
    }
    
    ob_start();
    
    ?>
    <div class="socialLinkShortcode textstyle <?php echo esc_attr($sociallink_type); ?> <?php echo esc_attr($sociallink_style); ?>">
        <a id="<?php echo esc_attr($id); ?>" href="<?php echo esc_url($sociallink_url); ?>" target="_blank">
            <span><?php echo esc_attr($sociallink_text); ?></span>
        </a>
    </div>

    <?php
    return ob_get_clean();
}

add_shortcode( 'socialLink', 'ep_sc_socialLink' );

/*-----------------------------------------------------------------------------------*/
/*  Text-Box
/*-----------------------------------------------------------------------------------*/

function ep_sc_textbox($atts)
{
    extract(shortcode_atts(array(

        'title'  => '',
        'title_color'  => '',
        'subtitle'  => '',
        'subtitle_color'  => '',
        'title_fontsize'  => '20',
        'text_title_border'  => 'none',
        'text_border_underline_color' => '',
        'text_under_align'  => 'left',
        'content_align'  => 'left',
        'text_content'  => '',
        'text_content_color'  => '',
        'content_fontsize'  => '12',
        'text_animation'  => 'none',
        'text_animation_delay'  => '0',
        'content'  => '',
        'url'  => '',
        'target' => '_self',

    ), $atts));

    $hasTitle  = '' != $title;
    $titleIsLink = '' != $url;
    $hasContent  = '' != $text_content;
    $hasStyle = '' != $title_color || '' != $text_border_underline_color || '' != $text_content_color || '' != $subtitle_color || '' ;

    $id     = ep_sc_id('textbox');
    $class  = array();
    $class[] = 'fontSize'.$title_fontsize;
    $contentFSClass = 'contentfs'.$content_fontsize;

    switch($content_align)
    {
        case 'right':
            $class[] = 'textBoxRight';
            break;
        case 'center':
            $class[] = 'textBoxCenter';
            break;
        case 'left':
        default:
            $class[] = 'textBoxleft';

    }

    switch($text_under_align)
    {
        case 'right':
            $class[] = 'textBoxUnderRight';
            break;
        case 'center':
            $class[] = 'textBoxUnderCenter';
            break;
        case 'left':
        default:
            $class[] = 'textBoxUnderleft';

    }
    
    switch($text_title_border)
    {
        case 'right_border':
            $class[] = 'textRightBorder';
            break; 
        case 'left_border':
            $class[] = 'textLeftBorder';
            break;
        case 'top_border':
            $class[] = 'textTopBorder';
            break;
        case 'bottom_border':
            $class[] = 'textBottomBorder';
            break;
        case 'none':
        default:
            $class[] = 'textBoxNoStyle';
    }
    
     if( $text_animation != 'none') {

        $class[] = ' textWithAnimation';

     }

    ob_start();

    if($hasStyle)
    {
    ?>
    <style type="text/css" media="all" scoped>
        <?php if(strlen(esc_attr($text_border_underline_color)))
        {
            echo "#$id.textBox.textRightBorder .title"; ?>
            {
                border-color: <?php echo esc_attr($text_border_underline_color); ?>;
            }

            <?php
            echo "#$id.textBox.textLeftBorder .title "; ?>
            {
                border-color: <?php echo esc_attr($text_border_underline_color); ?>;
            }

            <?php 
            echo "#$id.textBox.textTopBorder hr"; ?>
            {
                background-color: <?php echo esc_attr($text_border_underline_color); ?>;
            }
            
            <?php 
            echo "#$id.textBox.textBottomBorder hr"; ?>
            {
                background-color: <?php echo esc_attr($text_border_underline_color); ?>;
            }
            
        <?php
        }
        ?>
    </style>
    <?php
    }//if($hasStyle)
    ?>

    <div id="<?php echo esc_attr($id); ?>" class="textBox  <?php if( strlen(esc_attr($subtitle)) == 0 ) { ?>  nosubtitle  <?php } ?>  <?php echo implode(' ', $class); ?>"  <?php if(strlen(esc_attr($text_animation))) { ?> data-delay="<?php echo esc_attr($text_animation_delay); ?>" data-animation="<?php echo esc_attr($text_animation); ?>" <?php } ?> >
        
        <?php if($hasTitle) { ?>

                <?php if($titleIsLink){ ?>
                    
                    <div class="clearfix">
                        <div class="title" <?php if(strlen(esc_attr($title_color))){ ?> style="color:<?php echo esc_attr($title_color); ?>;" <?php } ?>>
                            
                                <?php if( $text_title_border == "top_border" ){ ?>
                                    <!-- top border -->
                                    <hr />
                                <?php } ?>

                                 <a href="<?php echo esc_url($url); ?>" target="<?php echo esc_attr($target); ?>">
                                    <?php echo wp_kses( $title, $GLOBALS["allowed_tags"] ); ?>
                                 </a>
                                           
                                <?php if(strlen(esc_attr($subtitle))) { ?><span class="subtitle" <?php if (strlen(esc_attr($subtitle_color))) { ?> style="color:<?php echo esc_attr($subtitle_color); ?>;" <?php } ?>>
                                    <?php echo esc_attr($subtitle); ?></span>
                                <?php } ?>

                                <?php if( $text_title_border == "bottom_border" ){ ?>
                                    <!-- bottom border -->
                                    <hr />
                                <?php } ?>
                        </div>
                    </div>

                <?php } else { ?>
                     
                    <div class="clearfix">
                        <div class="title clearfix" <?php if(strlen(esc_attr($title_color))){ ?> style="color:<?php echo esc_attr($title_color); ?>;" <?php } ?>>
                            
                            <?php if( $text_title_border == "top_border" ){ ?>
                                <!-- top border -->
                                <hr />
                            <?php } ?>

                            <?php echo wp_kses( $title, $GLOBALS["allowed_tags"] ); ?>

                            <?php if(strlen(esc_textarea($subtitle))) { ?>
                                <!-- subtitle -->
                                <span class="subtitle" <?php if(strlen(esc_attr($subtitle_color))){ ?> style="color:<?php echo esc_attr($subtitle_color); ?>;" <?php } ?>><?php echo esc_attr($subtitle); ?></span>
                            <?php } ?>

                            <?php if( $text_title_border == "bottom_border" ){ ?>
                                <!-- bottom border -->
                                <hr />
                            <?php } ?>
                        
                        </div>
                    </div>

                <?php } ?>

        <?php } ?>
        
        <?php if($hasContent){ ?>
            <div class="<?php echo esc_attr($contentFSClass); ?> text" <?php if(strlen(esc_attr($text_content_color))) { ?> style="color: <?php echo esc_attr($text_content_color); ?>;" <?php } ?>><?php echo wp_kses( $text_content, $GLOBALS["allowed_tags"] ); ?></div>
        <?php } ?>
        
    </div>

    <?php
    return ob_get_clean();
}

add_shortcode( 'textbox', 'ep_sc_textbox' );

/*-----------------------------------------------------------------------------------*/
/*  Custom textbox
/*-----------------------------------------------------------------------------------*/

function ep_sc_custom_textbox($atts)
{
    extract(shortcode_atts(array(

        'title'  => '',
        'subtitle'  => '',
        'title_color'  => '',
        'subtitle_color'  => '',
        'title_fontsize'  => '20',
        'text_align'  => 'left',
        'text_title_border'  => 'none',
        'text_border_underline_color' => '',
        'text_under_align'  => 'left',
        'text_content'  => '',
        'text_content_color'  => '',
        'content_fontsize'  => '12',
        'content'  => '',
        'url'  => '',
        'target' => '_self',
        'bg_color'  => '',
        'border_color'  => '',

    ), $atts));

    $hasTitle  = '' != $title;
    $titleIsLink = '' != $url;
    $hasContent  = '' != $text_content;
    $hasStyle = '' != $title_color || '' != $text_border_underline_color || '' != $text_content_color || ''  != $subtitle_color || '' != $border_color || ''!= $bg_color || '' ;

    $id     = ep_sc_id('textbox');
    $class  = array();
    $class[] = 'fontSize'.$title_fontsize;
    $contentFSClass = 'contentfs'.$content_fontsize;

    switch($text_align)
    {
        case 'right':
            $class[] = 'textBoxRight';
            break;
        case 'center':
            $class[] = 'textBoxCenter';
            break;
        case 'left':
        default:
            $class[] = 'textBoxleft';

    }

    switch($text_under_align)
    {
        case 'right':
            $class[] = 'textBoxUnderRight';
            break;
        case 'center':
            $class[] = 'textBoxUnderCenter';
            break;
        case 'left':
        default:
            $class[] = 'textBoxUnderleft';

    }
    
    switch($text_title_border)
    {
        case 'right_border':
            $class[] = 'textRightBorder';
            break; 
        case 'left_border':
            $class[] = 'textLeftBorder';
            break;
        case 'top_border':
            $class[] = 'textTopBorder';
            break;
        case 'bottom_border':
            $class[] = 'textBottomBorder';
            break;
        case 'none':
        default:
            $class[] = 'textBoxNoStyle';
    }

    ob_start();

    if($hasStyle)  { ?>

    <style type="text/css" media="all" scoped>
        <?php if(strlen(esc_attr($text_border_underline_color))) {

            echo "#$id .textBox.textRightBorder .title"; ?>
            {
                border-color: <?php echo esc_attr($text_border_underline_color); ?>;
            }

            <?php
            echo "#$id .textBox.textLeftBorder .title "; ?>
            {
                border-color: <?php echo esc_attr($text_border_underline_color); ?>;
            }

            <?php 
            echo "#$id .textBox.textTopBorder hr"; ?>
            {
                background-color: <?php echo esc_attr($text_border_underline_color); ?>;
            }
            
            <?php 
            echo "#$id .textBox.textBottomBorder hr"; ?>
            {
                background-color: <?php echo esc_attr($text_border_underline_color); ?>;
            }

        <?php } ?>
              
        <?php  if(strlen(esc_attr($border_color))) {
                   
            echo  "#$id .textBox .frame div"; ?>
            {
                background-color: <?php echo esc_attr($border_color); ?>;  
            }

        <?php } ?>

    </style>
    <?php
    }//if($hasStyle)
?>

    <div id="<?php echo esc_attr($id); ?>" class="custom-textbox">
        <div class="custom-textbox-bg" <?php if (strlen(esc_attr($bg_color))) { ?> style="background-color:<?php echo esc_attr($bg_color); ?>" <?php } ?>></div>
        <div  class="textBox <?php if( strlen(esc_attr($subtitle)) == 0 ) { ?>  nosubtitle  <?php } ?> <?php echo implode(' ', $class); ?>">
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
            <?php if($hasTitle) { ?>

                    <?php if($titleIsLink){ ?>
                        
                        <div class="clearfix">
                            <div class="title" <?php if(strlen(esc_attr($title_color))){ ?> style="color:<?php echo esc_attr($title_color); ?>;" <?php } ?>>
                                
                                    <?php if( $text_title_border == "top_border" ){ ?>
                                        <!-- top border -->
                                        <hr />
                                    <?php } ?>

                                     <a href="<?php echo esc_url($url); ?>" target="<?php echo esc_attr($target); ?>">
                                        <?php echo wp_kses( $title, $GLOBALS["allowed_tags"] ); ?>
                                     </a>          
                                               
                                    <?php if(strlen(esc_attr($subtitle))) { ?>
                                        <span class="subtitle" <?php if(strlen(esc_attr($subtitle_color))){ ?> style="color:<?php echo esc_attr($subtitle_color); ?>;" <?php } ?>><?php echo esc_attr($subtitle); ?></span>
                                    <?php } ?>

                                    <?php if( $text_title_border == "bottom_border" ){ ?>
                                        <!-- bottom border -->
                                        <hr />
                                    <?php } ?>
                            </div>
                        </div>

                    <?php } else { ?>
                         
                        <div class="clearfix">
                            <div class="title clearfix" <?php if(strlen(esc_attr($title_color))){ ?> style="color:<?php echo esc_attr($title_color); ?>;" <?php } ?>>
                                
                                <?php if( $text_title_border == "top_border" ){ ?>
                                    <!-- top border -->
                                    <hr />
                                <?php } ?>

                                <?php echo wp_kses( $title, $GLOBALS["allowed_tags"] ); ?>

                                <?php if(strlen(esc_textarea($subtitle))) { ?>
                                    <!-- subtitle -->
                                    <span class="subtitle" <?php if(strlen(esc_attr($subtitle_color))){ ?> style="color:<?php echo esc_attr($subtitle_color); ?>;" <?php } ?>><?php echo esc_attr($subtitle); ?></span>
                                <?php } ?>

                                <?php if( $text_title_border == "bottom_border" ){ ?>
                                    <!-- bottom border -->
                                    <hr />
                                <?php } ?>
                            
                            </div>
                        </div>

                    <?php } ?>

            <?php } ?>
            
            <?php if($hasContent){ ?>
                <div class="<?php echo esc_attr($contentFSClass); ?> text" <?php if(strlen(esc_attr($text_content_color))) { ?> style="color: <?php echo esc_attr($text_content_color); ?>;" <?php } ?>><?php echo wp_kses( $text_content, $GLOBALS["allowed_tags"] ); ?></div>
            <?php } ?>
            
        </div>
    </div>

    <?php
    return ob_get_clean();
}

add_shortcode( 'custom_textbox', 'ep_sc_custom_textbox' );


/*-----------------------------------------------------------------------------------*/
/*  Custom Title 
/*-----------------------------------------------------------------------------------*/

function ep_sc_customTitle($atts)
{
    extract(shortcode_atts(array(
        'title'  => '',
        'title_color'  => '',
        'title_fontsize' => '20',
        'hoverline_color'  => '',
        'shape_fill_color'  => '',
        'shape_border_color'  => '',
        'letter_spacing'  => '1',
        'style' => 'line'
    ), $atts));

    $class[] = 'fontSize'.$title_fontsize;
        
    $id     = ep_sc_id('custom-title');

    $hasStyle = '' != $title_color || '' != $hoverline_color || '' != $shape_fill_color || ''  != $shape_border_color || '' ;
    
    switch($letter_spacing)
    {
        case '1':
            $class[] = 'letterspacing1';
            break;
        case '2':
            $class[] = 'letterspacing2';
            break;
        case '3':
            $class[] = 'letterspacing3';
            break;
        default:
            $class[] = 'letterspacing4';

    }

    ob_start();
    
    if($hasStyle)  { ?>
   
    <?php if(strlen(esc_attr($shape_border_color)) && $style == "triangle" ) {   ?> 

         <style type="text/css" media="all" scoped>
        
            <?php
            
                echo "#$id.custom-title .shape-container .shape-line:after"; ?>
                {
                    border-color: <?php echo esc_attr($shape_border_color); ?>;
                }

            <?php
            
                echo "#$id.custom-title .shape-container .shape-line:before"; ?>
                {
                    border-color: <?php echo esc_attr($shape_border_color); ?>;
                }
            
        </style>
        
        <?php } ?>
        
    <?php
    }//if($hasStyle)
    ?>
    

    <div id="<?php echo esc_attr($id); ?>" class="custom-title <?php echo implode(' ', $class); ?>">
    
        <?php if(strlen($title)) { ?>


        <div class="title" <?php if(strlen($title_color)) { ?> style="color: <?php echo esc_attr($title_color); ?>;" <?php } ?>>
            <span>
                <?php echo wp_kses( $title, $GLOBALS["allowed_tags"] ); ?>
            </span>
            <div class="shape-container <?php echo esc_attr($style); ?>">

                <?php
                if ($style == 'line') {
                    ?>
                        <div class="back-line" <?php if(strlen($title_color)) { ?> style="background-color: <?php echo esc_attr($title_color); ?>;" <?php } ?>></div>
                        <div class="hover-line" <?php if(strlen($hoverline_color)) { ?> style="background-color: <?php echo esc_attr($hoverline_color); ?>;" <?php } ?>></div>
                    <?php
                }
                elseif($style == 'triangle')
                {
                    ?>
                        <div class="shape-line" <?php if(strlen($shape_border_color)) { ?> style="border-color: <?php echo esc_attr($shape_border_color); ?>;" <?php } ?>></div>
                        <div class="shape-fill" <?php if(strlen($shape_fill_color)) { ?> style="border-bottom-color: <?php echo esc_attr($shape_fill_color); ?>;" <?php } ?>></div>

                    <?php
                }
                else
                {
                    ?>
                        <div class="shape-line" style="<?php if(strlen($shape_fill_color) && $style != "triangle" ) { ?> background-color: <?php echo esc_attr($shape_fill_color); ?>; <?php } ?> <?php if(strlen($shape_border_color)) { ?> border-color: <?php echo esc_attr($shape_border_color); ?>; <?php } ?>"></div>
                    <?php                  
                }
                ?>

            </div>
        </div>
            
        <?php } ?>
    </div>

    <?php
    return ob_get_clean();
}

add_shortcode( 'custom_title', 'ep_sc_customTitle' );


/*-----------------------------------------------------------------------------------*/
/*  Image-Box
/*-----------------------------------------------------------------------------------*/

function ep_sc_imagebox($atts)
{
    extract(shortcode_atts(array(

        'image_url'  => '',
        'image_hover'  => 'enable',
        'image_animation'  => 'none',
        'image_animation_delay'  => '0',
        'title'  => '',
        'image_title_size' => '20',
        'title_color'  => '',
        'title_border_color' => '',
        'subtitle'  => '',
        'subtitle_color'  => '',
        'image_text_color'  => '',
        'image_text_align'  => 'left',
        'image_text_background_color'  => '',
        'image_text_border'  => 'disable',
        'image_text_border_color'  => '',
        'vccontent'  => '',
        'url'  => '',
        'target' => '_self',

    ), $atts));

    if (is_numeric($image_url)) {
        $image_url = wp_get_attachment_url($image_url);
    }
        
    $hasTitle  = '' != $title;
    $hasUrl = '' != $url;
    $hasSubTitle  = '' != $subtitle;
    $hasStyle = '' != $title_color || '' != $subtitle_color || '' != $image_text_color || '' != $image_text_background_color || '' != $image_text_border_color || '' != $title_border_color ;
    $hasTSContent = '' != $title || '' != $subtitle ;
    $hasVCContent = '' != $vccontent;

    $id     = ep_sc_id('imagebox');
    $class  = array();
    
    $class[] = 'fontSize'.$image_title_size;

    switch($image_text_align)
    {
        case 'right':
            $class[] = 'imageBoxRight';
            break;
        case 'center':
            $class[] = 'imageBoxCenter';
            break;
        case 'left':
        default:
            $class[] = 'imageBoxleft';
    }

     if( $image_animation != 'none') {

        $class[] = 'imgWithAnimation';

     }

    ob_start();

    if($hasStyle)
    {
    ?>
    <style type="text/css" media="all" scoped>
        <?php if(strlen(esc_attr($image_text_border_color)))
        {
            echo "#$id.imageBox .content "; ?>
            {
                border:solid 1px <?php echo esc_attr($image_text_border_color); ?>;
            }

        <?php
        }
        if(strlen(esc_attr($title_border_color))) 
        {

            echo "#$id .content .title"; ?>
            {
                border-left: solid 1px <?php echo esc_attr($title_border_color); ?>;
            }

        <?php 
        }         
        if(strlen(esc_attr($title_color)))
        {
            echo "#$id .content .title"; ?>
            {
                color: <?php echo esc_attr($title_color); ?>;
                
            }
            
            
        <?php
        }
        if(strlen(esc_attr($subtitle_color)))
        {
            echo "#$id  .content .subtitle "; ?>
            {
                color: <?php echo esc_attr($subtitle_color); ?>;
            }
        <?php
        }
        if(strlen(esc_attr($image_text_color)))
        {
            echo "#$id  .content .text "; ?>
            {
                color: <?php echo esc_attr($image_text_color); ?>;
            }
        <?php
        }
        if(strlen(esc_attr($image_text_background_color)))
        {
            echo "#$id  .content "; ?>
            {
                background-color: <?php echo esc_attr($image_text_background_color); ?>;
            }
        <?php
        }
        ?>  
    </style>
    <?php
    }//if($hasStyle)
    ?>

    <?php if ($hasUrl) { ?>
        
         <a id="<?php echo esc_attr($id); ?>" class="imageBox textBox textLeftBorder <?php if( strlen(esc_attr($subtitle)) == 0 ) { ?>  nosubtitle  <?php } ?> <?php echo implode(' ', $class); ?>"  <?php if(strlen(esc_attr($image_animation))) { ?> data-delay="<?php echo esc_attr($image_animation_delay); ?>" data-animation="<?php echo esc_attr($image_animation); ?>" <?php } ?>  href="<?php echo esc_url($url); ?>" target="<?php echo esc_attr($target); ?>" >

    <?php }  else { ?>          
        
         <div id="<?php echo esc_attr($id); ?>" class="imageBox textBox textLeftBorder <?php if( strlen(esc_attr($subtitle)) == 0 ) { ?>  nosubtitle  <?php } ?> <?php echo implode(' ', $class); ?>"  <?php if(strlen(esc_attr($image_animation))) { ?> data-delay="<?php echo esc_attr($image_animation_delay); ?>" data-animation="<?php echo esc_attr($image_animation); ?>" <?php } ?> >
    
    <?php } ?>  
    
        <div class="image">

            <?php if ( $image_hover == 'enable')  { ?> 
                <!-- imagebox Hover  -->
                <div class="imagebox-hover"></div>
            <?php } ?>

            <img src="<?php echo esc_url($image_url); ?>" <?php if ( esc_attr($title) ) { ?> alt="<?php echo esc_attr($title) ?>" <?php } else { ?> alt="" <?php } ?>>
        </div>
         
         <?php if ($hasTSContent) { ?>
            <div class="content">

                <?php if($hasTitle) { ?>

                    <div class="clearfix">
                        <div class="title clearfix" <?php if(strlen(esc_attr($title_color))){ ?> style="color:<?php echo esc_attr($title_color); ?>;" <?php } ?>>

                            <?php echo wp_kses( $title, $GLOBALS["allowed_tags"] ); ?>

                            <?php if($hasSubTitle) { ?>
                                <!-- subtitle -->
                                <span class="subtitle"><?php echo esc_attr($subtitle); ?></span>
                            <?php } ?>

                        </div>
                    </div>

                <?php } ?>
                <?php if($hasVCContent){ ?>
                
                    <div class="text"><?php echo wp_kses( $vccontent, $GLOBALS["allowed_tags"] ); ?></div>
                    
                <?php } ?>
            </div>
        <?php } ?>
    
    <?php if ($hasUrl) { ?>
        
         </a>
       
    <?php }  else { ?>          
        
        </div>

    <?php } ?>  
    

    <?php
    return ob_get_clean();
}

add_shortcode( 'imagebox', 'ep_sc_imagebox' );

/*-----------------------------------------------------------------------------------*/
/*  Custom image-box
/*-----------------------------------------------------------------------------------*/

function ep_sc_custom_imagebox($atts)
{
    extract(shortcode_atts(array(

        'title'  => '',
        'subtitle'  => '',
        'image_url'  => '',
        'title_color'  => '',
        'subtitle_color'  => '',
        'title_border'  => 'none',
        'title_fontsize'  => '20',
        'box_position'  => 'left',
        'title_border_color' => '',
        'text_content'  => '',
        'text_content_color'  => '',
        'content_fontsize'  => '12',
        'content'  => '',
        'url'  => '',
        'target' => '_self',
        'bg_color'  => '',
        'border_color'  => '',

    ), $atts));

    $hasTitle  = '' != $title;
    $titleIsLink = '' != $url;
    $hasContent  = '' != $text_content;
    $hasStyle = '' != $title_color || '' != $title_border_color || '' != $text_content_color || ''  != $subtitle_color || ''  !=$border_color;

    $id     = ep_sc_id('custom-imagebox');
    $class  = array();
    $class[] = 'fontSize'.$title_fontsize;
    $contentFSClass = 'contentfs'.$content_fontsize;

    if (is_numeric($image_url)) {
        $image_url = wp_get_attachment_url($image_url);
    }

    if($title_border == 'left')
        $class[] = 'textLeftBorder';
    
    $class[] = 'textBoxUnderleft';

    $boxclass = "";
    switch($box_position)
    {
        case 'right':
            $boxclass = 'Boxright';
            break;
        case 'left':
        default:
            $boxclass = 'Boxleft';

    }

    ob_start();
?>

    <div id="<?php echo esc_attr($id); ?>" class="custom-imageBox <?php echo $boxclass; ?>" >

        <?php
        //Just show custom image box when image selected
        if($image_url)
        {
        ?>
        
        <div class="image">
            <div class="overlay"></div>
            <img src="<?php echo esc_url($image_url); ?>" <?php if ( esc_attr($title) ) { ?> alt="<?php echo esc_attr($title) ?>" <?php } else { ?> alt="" <?php } ?>>
        </div>

        <div class="custom-textbox">
            <div class="custom-textbox-bg" <?php if (strlen(esc_attr($bg_color))) { ?> style="background-color:<?php echo esc_attr($bg_color); ?>" <?php } ?>></div>
            <div  class="textBox <?php if( strlen(esc_attr($subtitle)) == 0 ) { ?>  nosubtitle  <?php } ?> <?php echo implode(' ', $class); ?>">

                <div class="frame top">
                    <div <?php if (strlen(esc_attr($border_color))) { ?> style="background-color:<?php echo esc_attr($border_color); ?>" <?php } ?>></div>
                </div>
                <div class="frame right">
                    <div <?php if (strlen(esc_attr($border_color))) { ?> style="background-color:<?php echo esc_attr($border_color); ?>" <?php } ?>></div>
                </div>
                <div class="frame bottom">
                    <div <?php if (strlen(esc_attr($border_color))) { ?> style="background-color:<?php echo esc_attr($border_color); ?>" <?php } ?>></div>
                </div>
                <div class="frame left">
                    <div <?php if (strlen(esc_attr($border_color))) { ?> style="background-color:<?php echo esc_attr($border_color); ?>" <?php } ?>></div>
                </div>

                <?php if($hasTitle) { ?>

                    <?php if($titleIsLink){ ?>
                        
                        <div class="clearfix">
                        
                            <div class="title" style="<?php if(strlen($title_border_color)) { ?> border-color: <?php echo esc_attr($title_border_color); ?>;<?php } ?> <?php if(strlen(esc_attr($title_color))){ ?> color:<?php echo esc_attr($title_color); ?>; <?php } ?>">

                                     <a href="<?php echo esc_url($url); ?>" target="<?php echo esc_attr($target); ?>">
                                        <?php echo wp_kses( $title, $GLOBALS["allowed_tags"] ); ?>
                                     </a>          
                                               
                                    <?php if(strlen(esc_attr($subtitle))) { ?>
                                        <span class="subtitle" <?php if(strlen(esc_attr($subtitle_color))){ ?> style="color:<?php echo esc_attr($subtitle_color); ?>;" <?php } ?>><?php echo esc_attr($subtitle); ?></span>
                                    <?php } ?>

                            </div>
                        </div>

                    <?php } else { ?>
                         
                        <div class="clearfix">
                            <div class="title clearfix" style="<?php if(strlen($title_border_color)) { ?> border-color: <?php echo esc_attr($title_border_color); ?>;<?php } ?> <?php if(strlen(esc_attr($title_color))){ ?> color:<?php echo esc_attr($title_color); ?>; <?php } ?>">

                                <?php echo wp_kses( $title, $GLOBALS["allowed_tags"] ); ?>

                                <?php if(strlen(esc_textarea($subtitle))) { ?>
                                    <!-- subtitle -->
                                    <span class="subtitle" <?php if(strlen(esc_attr($subtitle_color))){ ?> style="color:<?php echo esc_attr($subtitle_color); ?>;" <?php } ?>><?php echo esc_attr($subtitle); ?></span>
                                <?php } ?>
                            
                            </div>
                        </div>

                    <?php } ?>

                <?php } ?>
                
                <?php if($hasContent){ ?>
                    <div class="<?php echo esc_attr($contentFSClass); ?> text" <?php if(strlen(esc_attr($text_content_color))) { ?> style="color: <?php echo esc_attr($text_content_color); ?>;" <?php } ?>><?php echo wp_kses( $text_content, $GLOBALS["allowed_tags"] ); ?></div>
                <?php } ?>
                
            </div>
        </div>

        <?php
        }
        ?>
    </div>

    <?php
    return ob_get_clean();
}

add_shortcode( 'custom_imagebox', 'ep_sc_custom_imagebox' );


/*-----------------------------------------------------------------------------------*/
/*  Icon-Box-custom
/*-----------------------------------------------------------------------------------*/

function ep_sc_iconbox_custom($atts, $content=null)
{
    extract(shortcode_atts(array(
        'title'         => '',
        'icon'          => 'lightbulb',
        'icon_color'         => 'd02d48',
        'icon_color_preset'         => 'd02d48',
        'url'           => '',
        'content_text' => '',
    ), $atts));

    $hasTitle  = '' != $title;
    $hasStyle = '' != $icon_color ;

    $id     = ep_sc_id('iconbox');
    $class  = array("custom-iconbox");

    ob_start();

    $color = "";
    if(strlen(esc_attr($icon_color_preset)))
    {
        if($icon_color_preset == 'custom')
        {
            $color = $icon_color;
        }
        else
        {
            $color = "#" . $icon_color_preset;
        }
    }
    
    ?>

    <div id="<?php echo esc_attr($id); ?>" class="<?php echo implode(' ', $class); ?>">
        <div class="icon">
            <span class="glyph icon-<?php echo esc_attr($icon); ?>" <?php if(strlen($color)) { ?> style="color: <?php echo esc_attr($color); ?>;" <?php } ?>></span>
        </div>
        <div class="hover-content" <?php if(strlen($color)) { ?> style="background-color: <?php echo esc_attr($color); ?>;" <?php } ?>>
            <div class="icon">
                <span class="glyph icon-<?php echo esc_attr($icon); ?>"></span>
            </div>
            <?php if($hasTitle){ ?>
                <h3 class="title"><?php echo esc_attr($title); ?></h3>
            <?php } ?>
            
            <!-- iconbox content -->
            <div class="content-wrap">
                <?php if(strlen(esc_attr($content_text))) { ?>
                    
                    <div class="content">
                        <?php echo wp_kses( $content_text, $GLOBALS["allowed_tags"] ); ?>
                    </div>
                
                <?php } ?>
            

                <?php
                if($url)
                {
                    $link = vc_build_link( $atts['url'] );
                    if ( strlen( $link['url'] ) ) { 
                    ?>
                    <div class="more-link">
                        <a href="<?php echo esc_url($link['url']); ?>" target="<?php echo esc_attr( $link['target'] ); ?>" title="<?php echo esc_attr($link['title']); ?>">[<?php echo esc_attr($link['title']); ?>]</a>
                    </div>
                <?php }
                }
                ?>

            </div>
        </div>
    </div>

    <?php
    return ob_get_clean();
}

add_shortcode( 'iconbox_custom', 'ep_sc_iconbox_custom' );

/*-----------------------------------------------------------------------------------*/
/*  Icon-Box-top No border 
/*-----------------------------------------------------------------------------------*/

function ep_sc_iconbox_noborder($atts, $content=null)
{
    extract(shortcode_atts(array(
        'title'         => '',
        'title_color'   => '',
        'icon_animation' => 'none',
        'icon_animation_delay' => '0',
        'icon'          => 'lightbulb',
        'icon_color'         => '',
        'icon_border_color'         => '',
        'icon_position' => 'top',
        'alignment' => 'right_alignment',
        'url'           => '',
        'content_text' => '',
        'content_color' => '',
    ), $atts));

    $hasTitle  = '' != $title;
    $hasStyle = '' != $title_color || '' != $icon_color || '' != $content_color ;

    $id     = ep_sc_id('iconbox');
    $class  = array("iconbox");

    if( strlen($icon_position)) {

        $class[] = 'iconbox-top';
        
    }
    
    if( $icon_animation != 'none') {

        $class[] = ' iconWithAnimation';

    }
    
    if( strlen($alignment)) {

        $class[] = " $alignment";

    }
    
    ob_start();
    ?>

    <div id="<?php echo esc_attr($id); ?>" class="<?php echo implode(' ', $class); ?>"  <?php if(strlen($icon_animation)) { ?> data-delay="<?php echo esc_attr($icon_animation_delay); ?>" data-animation="<?php echo esc_attr($icon_animation); ?>" <?php } ?>>
        <div class="icon">
            <span class="glyph icon-<?php echo esc_attr($icon); ?>" <?php if(strlen($icon_color)) { ?> style="<?php if(strlen($icon_border_color)) { ?> border-color: <?php echo esc_attr($icon_border_color); ?>; background-color: <?php echo esc_attr($icon_border_color); ?>;<?php } ?> color: <?php echo esc_attr($icon_color); ?>;" <?php } ?>></span>
        </div>
        <div class="content-wrap">
            <?php if($hasTitle){ ?>
                <h3 class="title" <?php if(strlen($title_color)) { ?> style="color: <?php echo esc_attr($title_color); ?>;" <?php } ?>><?php echo esc_attr($title); ?></h3>
            <?php } ?>
            
            <!-- iconbox content -->
            <?php if(strlen(esc_attr($content_text))) { ?>
                
                <div class="content">
                    <?php echo wp_kses( $content_text, $GLOBALS["allowed_tags"] ); ?>
                </div>
                
            <?php } ?>

             <!-- icon box read more button -->
            <?php if($url) {
                      
                    $link = vc_build_link( $atts['url'] );
                    if ( strlen( $link['url'] ) ) {  ?>

                    <div class="more-link">
                        <a href="<?php echo esc_url($link['url']); ?>" <?php if(strlen($content_color)) { ?> style="color: <?php echo esc_attr($content_color); ?>;" <?php } ?> target="<?php echo esc_attr( $link['target'] ); ?>">[ <?php echo esc_attr($link['title']); ?> ]</a>
                    </div>

                <?php }
                }
            ?>

        </div>
    </div>

    <?php
    return ob_get_clean();
}

add_shortcode( 'iconbox_top_noborder', 'ep_sc_iconbox_noborder' );

/*-----------------------------------------------------------------------------------*/
/*  Icon-Box-Rectangle
/*-----------------------------------------------------------------------------------*/

function ep_sc_iconbox_rectangle($atts, $content=null)
{
    extract(shortcode_atts(array(
        'title'         => '',
        'title_color'   => '',
        'icon_animation' => 'none',
        'icon_animation_delay' => '0',
        'icon'          => 'lightbulb',
        'icon_color'         => '',
        'icon_border'         => 'rectangle',
        'icon_border_color'         => '',
        'icon_background_fill'         => 'fillbackground',
        'icon_position' => 'top',
        'url'           => '',
        'content_text' => '',
        'content_color' => '',
    ), $atts));

    $hasTitle  = '' != $title;
    $hasStyle = '' != $title_color || '' != $icon_color || '' != $content_color ;

    $id     = ep_sc_id('iconbox');
    $class  = array("iconbox");

    if( strlen($icon_position)) {

        $class[] = 'iconbox-top';
        
    }
    
    if( $icon_animation != 'none') {

        $class[] = ' iconWithAnimation';

    }

    
    if( strlen($icon_border)) {

        $class[] = " $icon_border";

    }
    
    if( strlen($icon_background_fill)) {

        $class[] = " $icon_background_fill";

    }

    ob_start();

    if($hasStyle)
    {
    ?>
    <style type="text/css" media="all" scoped>
        <?php if(strlen(esc_attr($title_color)))
        {
            echo "#$id  .title "; ?>
            {
                color: <?php echo esc_attr($title_color); ?>;
            }
        <?php
        }
        if(strlen(esc_attr($icon_color)))
        {
            echo "#$id .glyph"; ?>
            {
                color: <?php echo esc_attr($icon_color); ?>;
            }
        <?php
        }
        if(strlen(esc_attr($icon_border_color)))
        {
            echo "#$id .icon span.glyph"; ?>
            {
                border-color: <?php echo esc_attr($icon_border_color); ?>;
                background-color: <?php echo esc_attr($icon_border_color); ?>;
            }
        <?php
        }
        if(strlen(esc_attr($content_color)))
        {
            echo "#$id  .content , #$id .more-link a "; ?>
            {
                color: <?php echo esc_attr($content_color); ?>;
            }
        <?php
        }?>
    </style>
    <?php
    }//if($hasStyle)
    ?>

    <div id="<?php echo esc_attr($id); ?>" class="<?php echo implode(' ', $class); ?>"  <?php if(strlen($icon_animation)) { ?> data-delay="<?php echo esc_attr($icon_animation_delay); ?>" data-animation="<?php echo esc_attr($icon_animation); ?>" <?php } ?>>
        <div class="icon">
            <span class="glyph icon-<?php echo esc_attr($icon); ?>"></span>
        </div>
        <div class="content-wrap">
            <?php if($hasTitle){ ?>
                <h3 class="title"><?php echo esc_attr($title); ?></h3>
            <?php } ?>
            
            <!-- iconbox content -->
            <?php if(strlen(esc_attr($content_text))) { ?>
            
                <div class="content">
                    <?php echo wp_kses( $content_text, $GLOBALS["allowed_tags"] ); ?>
                </div>
                
            <?php } ?>
           
            <!-- icon box read more button -->
            <?php if($url) {
                      
                    $link = vc_build_link( $atts['url'] );
                    if ( strlen( $link['url'] ) ) {  ?>

                    <div class="more-link">
                        <a href="<?php echo esc_url($link['url']); ?>" target="<?php echo esc_attr( $link['target'] ); ?>">[ <?php echo esc_attr($link['title']); ?> ]</a>
                    </div>

                <?php }
                }
            ?>

        </div>
    </div>

    <?php
    return ob_get_clean();
}

add_shortcode( 'iconbox_rectangle', 'ep_sc_iconbox_rectangle' );


/*-----------------------------------------------------------------------------------*/
/*  Icon-Box-Circle
/*-----------------------------------------------------------------------------------*/

function ep_sc_iconbox_circle($atts, $content=null)
{
    extract(shortcode_atts(array(
        'title'         => '',
        'title_color'   => '',
        'icon_animation' => 'none',
        'icon_animation_delay' => '0',
        'icon'          => 'lightbulb',
        'icon_color'         => '',
        'icon_border'         => 'circle',
        'icon_border_color'         => '',
        'icon_background_fill'         => 'fillbackground',
        'icon_position' => 'top',
        'url'           => '',
        'content_text' => '',
        'content_color' => '',
    ), $atts));

    $hasTitle  = '' != $title;
    $hasStyle = '' != $title_color || '' != $icon_color || '' != $content_color ;

    $id     = ep_sc_id('iconbox');
    $class  = array("iconbox");
    
    if( strlen($icon_position)) {

        $class[] = 'iconbox-top';

    }
    
    if( $icon_animation != 'none') {

        $class[] = ' iconWithAnimation';

    }
    
    if( strlen($icon_border)) {

        $class[] = " $icon_border";

    }
    
    if( strlen($icon_background_fill)) {

        $class[] = " $icon_background_fill";

    }

    ob_start();

    if($hasStyle)
    {
    ?>
    <style type="text/css" media="all" scoped>
        <?php if(strlen(esc_attr($title_color)))
        {
            echo "#$id  .title "; ?>
            {
                color: <?php echo esc_attr($title_color); ?>;
            }
        <?php
        }
        if(strlen(esc_attr($icon_color)))
        {
            echo "#$id .glyph"; ?>
            {
                color: <?php echo esc_attr($icon_color); ?>;
            }
        <?php
        }
        if(strlen(esc_attr($icon_border_color)))
        {
            echo "#$id .icon span.glyph"; ?>
            {
                border-color: <?php echo esc_attr($icon_border_color); ?>;
                background-color: <?php echo esc_attr($icon_border_color); ?>;
            }
        <?php
        }
        if(strlen(esc_attr($content_color)))
        {
            echo "#$id  .content , #$id .more-link a "; ?>
            {
                color: <?php echo esc_attr($content_color); ?>;
            }
        <?php
        }
        ?>
    </style>
    <?php
    }//if($hasStyle)
    ?>

    <div id="<?php echo esc_attr($id); ?>" class="<?php echo implode(' ', $class); ?>"  <?php if(strlen($icon_animation)) { ?> data-delay="<?php echo esc_attr($icon_animation_delay); ?>" data-animation="<?php echo esc_attr($icon_animation); ?>" <?php } ?>>
        <div class="icon">
            <span class="glyph icon-<?php echo esc_attr($icon); ?>"></span>
        </div>
        <div class="content-wrap">
            <?php if($hasTitle){ ?>
                <h3 class="title"><?php echo esc_attr($title); ?></h3>
            <?php } ?>
           
            <!-- iconbox content -->
            <?php if(strlen(esc_attr($content_text))) { ?>

                <div class="content">
                    <?php echo wp_kses( $content_text, $GLOBALS["allowed_tags"] ); ?>
                </div>
                
            <?php } ?>
            
            <!-- icon box read more button -->
            <?php if($url) {
                      
                    $link = vc_build_link( $atts['url'] );
                    if ( strlen( $link['url'] ) ) {  ?>

                    <div class="more-link">
                        <a href="<?php echo esc_url($link['url']); ?>" target="<?php echo esc_attr( $link['target'] ); ?>">[ <?php echo esc_attr($link['title']); ?> ]</a>
                    </div>

                <?php }
                }
            ?>

        </div>
    </div>

    <?php
    return ob_get_clean();
}

add_shortcode( 'iconbox_circle', 'ep_sc_iconbox_circle' );

/*-----------------------------------------------------------------------------------*/
/*  Icon-Box-left
/*-----------------------------------------------------------------------------------*/

function ep_sc_iconbox_left($atts, $content=null)
{
    extract(shortcode_atts(array(
        'title'         => '',
        'title_color'   => '',
        'icon_animation' => 'none',
        'icon_animation_delay' => '0',
        'icon'          => 'lightbulb',
        'icon_color'         => '',
        'icon_border_color'         => '',
        'icon_position' => 'left',
        'url'           => '',
        'content_text' => '',
        'content_color' => '',
    ), $atts));

    $hasTitle  = '' != $title;
    $hasStyle = '' != $title_color || '' != $icon_color || '' != $content_color ;

    $id     = ep_sc_id('iconbox');
    $class  = array("iconbox");
    
    if( strlen($icon_position)) {

        $class[] = 'iconbox-left';

    }
    
    if( $icon_animation != 'none') {

        $class[] = ' iconWithAnimation';

    }

    if( strlen($icon_animation)) {

        $class[] = ' iconWithAnimation';

    }

    ob_start();

    if($hasStyle)
    {
    ?>
    <style type="text/css" media="all" scoped>
        <?php if(strlen(esc_attr($title_color)))
        {
            echo "#$id  .title "; ?>
            {
                color: <?php echo esc_attr($title_color); ?>;
            }
        <?php
        }
        if(strlen(esc_attr($icon_color)))
        {
            echo "#$id .glyph"; ?>
            {
                color: <?php echo esc_attr($icon_color); ?>;
            }
        <?php
        }
        if(strlen(esc_attr($icon_border_color)))
        {
            echo "#$id .icon span.glyph"; ?>
            {
                border-color: <?php echo esc_attr($icon_border_color); ?>;
                background-color: <?php echo esc_attr($icon_border_color); ?>;
            }
        <?php
        }
        if(strlen($content_color))
        {
            echo "#$id  .content , #$id .more-link a "; ?>
            {
                color: <?php echo esc_attr($content_color); ?>;
            }
        <?php
        }?>
    </style>
    <?php
    }//if($hasStyle)
    ?>

    <div id="<?php echo esc_attr($id); ?>" class="<?php echo implode(' ', $class); ?>"  <?php if(strlen(esc_attr($icon_animation))) { ?> data-delay="<?php echo esc_attr($icon_animation_delay); ?>" data-animation="<?php echo esc_attr($icon_animation); ?>" <?php } ?>>
        <div class="icon">
            <span class="glyph icon-<?php echo esc_attr($icon); ?>"></span>
        </div>
        <div class="content-wrap">
            <?php if(esc_attr($hasTitle)){ ?>
                <h3 class="title"><?php echo esc_attr($title); ?></h3>
            <?php } ?>
            <!-- iconbox content -->
            <?php if(strlen(esc_attr($content_text))) { ?>
                
                <div class="content">
                    <?php echo wp_kses( $content_text, $GLOBALS["allowed_tags"] ); ?>
                </div>
                    
            <?php } ?>      
            
            <!-- icon box read more button -->
            <?php if($url) {
                      
                    $link = vc_build_link( $atts['url'] );
                    if ( strlen( $link['url'] ) ) {  ?>

                    <div class="more-link">
                        <a href="<?php echo esc_url($link['url']); ?>" target="<?php echo esc_attr( $link['target'] ); ?>">[ <?php echo esc_attr($link['title']); ?> ]</a>
                    </div>

                <?php }
                }
            ?>

        </div>
    </div>

    <?php
    return ob_get_clean();
}

add_shortcode( 'iconbox_left', 'ep_sc_iconbox_left' );

/*-----------------------------------------------------------------------------------*/
/*	Counter Box
/*-----------------------------------------------------------------------------------*/

function ep_sc_conterbox($atts, $content=null)
{
    extract(shortcode_atts(array(
        'counter_number'  => '500',
        'counter_number_color' => '',
        'counter_text_color' => '' ,
        'counter_animation' => 'none' ,
        'counter_text'   =>  __('Description', 'epicomedia'),
    ), $atts));

    $hasStyle = '' != $counter_number_color || '' != $counter_text_color ;
    $counter_number = intval($counter_number);
    $id     = ep_sc_id('conterbox');

    $class  = array("counterBox");

    if( $counter_animation != 'none') {

        $class[] = 'counterWithAnimation';

     }

    ob_start();

    ?>
    
    <div id="<?php echo esc_attr($id); ?>" class="<?php echo implode(' ', $class); ?>" <?php if(strlen(esc_attr($counter_animation))) { ?> data-delay="1000" data-animation="<?php echo esc_attr($counter_animation); ?>" <?php } ?> data-countNmber="<?php echo esc_attr($counter_number); ?>">
        <span class="counterBoxNumber highlight" <?php if(strlen(esc_attr($counter_number_color))){ ?> style="color:<?php echo esc_attr($counter_number_color); ?>;" <?php } ?>>0<?php //echo esc_attr($counter_number); ?></span>
        <h4 class="counterBoxDetails" <?php if(strlen(esc_attr($counter_text_color))){ ?> style="color:<?php echo esc_attr($counter_text_color); ?>; border-color:<?php echo esc_attr($counter_text_color); ?>;" <?php } ?>><?php echo esc_attr($counter_text); ?></h4>
    </div>

    <?php
    return ob_get_clean();
}

add_shortcode( 'conterbox', 'ep_sc_conterbox' );

/*-----------------------------------------------------------------------------------*/
/*  Video Vimeo
/*-----------------------------------------------------------------------------------*/

function ep_sc_video_vimeo($atts, $content=null)
{
    extract(shortcode_atts(array(
        'vimeo_id'  => '',
    ), $atts));

    $vimeo_height = 315;
    $vimeo_width = 560;

    $id     = ep_sc_id('video_vimeo');
    $class  = array("video_vimeo");

    ob_start();
    ?>

        <div id="<?php echo esc_attr($id); ?>">
            <iframe src="http://player.vimeo.com/video/<?php echo esc_attr($vimeo_id) ?>" width="<?php echo esc_attr($vimeo_width); ?>" height="<?php echo esc_attr($vimeo_height); ?>" frameborder="0"></iframe>
        </div>

    <?php
    return ob_get_clean();
}

add_shortcode( 'video_vimeo', 'ep_sc_video_vimeo' );

/*-----------------------------------------------------------------------------------*/
/*  Video YouTube
/*-----------------------------------------------------------------------------------*/

function ep_sc_video_youtube($atts, $content=null)
{
    extract(shortcode_atts(array(
        'youtube_id'  => '',
    ), $atts));

    $youtube_height = 315;
    $youtube_width = 560;

    $id     = ep_sc_id('video_youtube');
    $class  = array("video_youtube");

    ob_start();
    ?>

    <div id="<?php echo esc_attr($id); ?>">
        <iframe title="YouTube video player" width="<?php echo esc_attr($youtube_width); ?>" height="<?php echo esc_attr($youtube_height); ?>" src="http://www.youtube.com/embed/<?php echo esc_attr($youtube_id) ?>" frameborder="0" allowfullscreen></iframe>
    </div>

    <?php
    return ob_get_clean();
}

add_shortcode( 'video_youtube', 'ep_sc_video_youtube' );

/*-----------------------------------------------------------------------------------*/
/*  Audio SoundCloud
/*-----------------------------------------------------------------------------------*/

function ep_sc_audio_soundcloud($atts, $content=null)
{
    extract(shortcode_atts(array(
        'soundcloud_id'  => '',
        'soundcloud_height'   =>  '315',
        'soundcloud_width'   => '560',
    ), $atts));

    $soundcloud_height = intval($soundcloud_height);
    $soundcloud_width = intval($soundcloud_width);

    $id     = ep_sc_id('video_youtube');
    $class  = array("audio_soundcloud");

    ob_start();
    ?>

    <div <?php echo esc_attr($id); ?>>
        <iframe width="<?php echo esc_attr($soundcloud_width); ?>" height="<?php echo esc_attr($soundcloud_height); ?>" scrolling="no" frameborder="no" src="https://w.soundcloud.com/player/?visual=true&url=<?php echo esc_attr($soundcloud_id); ?>"></iframe>
    </div>

    <?php
    return ob_get_clean();
}

add_shortcode( 'audio_soundcloud', 'ep_sc_audio_soundcloud' );

/*-----------------------------------------------------------------------------------*/
/*  Tabs
/*-----------------------------------------------------------------------------------*/

function ep_sc_tab_group($atts, $content=null)
{
    $GLOBALS['ep_sc_tab'] = array();
    do_shortcode($content);
    $tabs = $GLOBALS['ep_sc_tab'];

    ob_start();
    ?>
    <div class="tabs">
    <?php if(count($tabs)){ ?>
        <ul class="head clearfix">
            <?php foreach($tabs as $tab){ ?>
            <li><?php echo esc_attr($tab[0]); ?></li>
            <?php } ?>
        </ul>
        <div class="content">
            <?php foreach($tabs as $tab){ ?>
                <div class="tab-content"><?php echo esc_attr($tab[1]); ?></div>
            <?php } ?>
        </div>
    <?php } ?>
    </div>
    <?php
    return ob_get_clean();
}

add_shortcode( 'tab_group', 'ep_sc_tab_group' );

function ep_sc_tab($atts, $content=null)
{
    $tabCnt = count($GLOBALS['ep_sc_tab']) + 1;

    extract(shortcode_atts(array(
        'title' => "Tab $tabCnt",
    ), $atts));

    $GLOBALS['ep_sc_tab'][] = array($title, do_shortcode($content));
}

add_shortcode( 'tab', 'ep_sc_tab' );

/*-----------------------------------------------------------------------------------*/
/*  Button
/*-----------------------------------------------------------------------------------*/

function ep_sc_button($atts, $content = null)
{
    extract(shortcode_atts(array(
        'title'            => '',
        'text'             => __('View Page', 'epicomedia'),
        'url'              => '#',
        'size'           => 'standard',
        'target'           => '_self',
        'button_color'             => '',
        'button_hover_color'             => '',
        'alignment'  => 'left',
    ), $atts));
        

    $class  = array();
    $class[] = "button";
    
    switch($size)
    {
        case 'small':
            $class[] = 'button-small';
            break;
        case 'large':
            $class[] = 'button-large';
            break;
    }
    
    switch($alignment)
    {
        case 'right':
            $class[] = 'right';
            break;
        case 'center':
            $class[] = 'center';
            break;
        case 'left':
            $class[] = 'left';
            break;
    }


    $id = ep_sc_id('button');
       
    $hasStyle = '' != $button_color || '' != $button_hover_color; 

    ob_start(); 
    
    ?>
    
    <?php if ($alignment == "center") { ?>
        <div class="centeralignment">
    <?php } ?>
    
        <a id="<?php echo esc_attr($id); ?>" class="<?php echo implode(' ', $class); ?>" <?php if(strlen($button_color)) { ?> style="color: <?php echo esc_attr($button_color); ?>;" <?php } ?> href="<?php echo esc_url($url); ?>" title="<?php echo esc_attr($title); ?>" target="<?php echo esc_attr($target); ?>">
            <div class="frame top" <?php if(strlen($button_color)) { ?> style="background-color: <?php echo esc_attr($button_color); ?>;" <?php } ?>>
                <div <?php if(strlen($button_hover_color)) { ?> style="background-color: <?php echo esc_attr($button_hover_color); ?>;" <?php } ?>></div>
            </div>
            <div class="frame right" <?php if(strlen($button_color)) { ?> style="background-color: <?php echo esc_attr($button_color); ?>;" <?php } ?>>
                <div <?php if(strlen($button_hover_color)) { ?> style="background-color: <?php echo esc_attr($button_hover_color); ?>;" <?php } ?>></div>
            </div>
            <div class="frame bottom" <?php if(strlen($button_color)) { ?> style="background-color: <?php echo esc_attr($button_color); ?>;" <?php } ?>>
                <div <?php if(strlen($button_hover_color)) { ?> style="background-color: <?php echo esc_attr($button_hover_color); ?>;" <?php } ?>></div>
            </div>
            <div class="frame left" <?php if(strlen($button_color)) { ?> style="background-color: <?php echo esc_attr($button_color); ?>;" <?php } ?>>
                <div <?php if(strlen($button_hover_color)) { ?> style="background-color: <?php echo esc_attr($button_hover_color); ?>;" <?php } ?>></div>
            </div>

            <span class="txt">
                    <?php echo esc_attr($text); ?>
	        </span>
        </a>
        <div class="clearfix"></div>
        
    <?php if ($alignment == "center") { ?>
        </div>
    <?php } ?>
    
    <?php
    return ob_get_clean();
}

add_shortcode('button', 'ep_sc_button');

/*-----------------------------------------------------------------------------------*/
/*	VC Toggle Counter Box
/*-----------------------------------------------------------------------------------*/

function ep_sc_vctoggle($atts, $content=null)
{
    extract(shortcode_atts(array(
        'title' => '',
        'open'  => 'true',
    ), $atts));

    $id     = ep_sc_id('vc_toggle');
     
    ob_start();
    ?> 
 
 
    <h4 class="wpb_toggle <?php if ($open == 'true') { ?> wpb_toggle_title_active  <?php } ?>">
        <div class="border-bottom">
            <div class="icon icon-plus"></div>
            <div class="icon icon-minus"></div>
            <div class="title"><?php echo esc_attr($title); ?></div>
        </div>
    </h4>
    <div class="wpb_toggle_content" <?php if ($open == 'true') { ?> style="display: block;"  <?php } ?>>
        <?php echo wpb_js_remove_wpautop($content); ?>
    </div>

    <?php
    return ob_get_clean();
}

add_shortcode( 'vc_toggle', 'ep_sc_vctoggle' );

/*-----------------------------------------------------------------------------------*/
/*	VC carousel
/*-----------------------------------------------------------------------------------*/

function ep_sc_imagecarousel($atts, $content=null)
{
    extract(shortcode_atts(array(
		"style"						=> "dark",
        "images"						=> "",
        "visible_items" => "2" 
    ), $atts));

    $id = ep_sc_id('image_carousel');
     
    //Make an array of image IDs
    $image_ids = array();
    if($images)
    {
        $image_ids = explode(",",esc_attr($images));
    }
    
    ob_start();
    
    ?> 

    <div class="carousel <?php if (strlen($style)) { echo esc_attr($style); }?>" data-id="<?php echo $id?>">
        <div class="swiper-container swiper-container<?php echo $id?> clearfix"  data-visibleitems="<?php if (strlen($visible_items)) { echo esc_attr($visible_items); }?>">
            <div class="swiper-wrapper">
                <?php
                    foreach($image_ids as $image_id) {
                        $image_url = wp_get_attachment_image_src( $image_id, 'large' );
                ?>

                    <div class="swiper-slide">
                        <?php echo '<img src="'.$image_url[0] . '" alt="carousel_image'.$image_id.'">'; ?>
                    </div>

                <?php } ?>

            </div>
        </div>

        <!-- Next Arrows -->
        <div class="arrows-button-next no-select arrows-button-next<?php echo $id?>">
            <span class="text">
                <?php _e('NEXT', 'epicomedia'); ?>
            </span>
        </div>

        <!-- Prev Arrows -->
        <div class="arrows-button-prev no-select arrows-button-prev<?php echo $id?>">
            <span class="text">
                <?php _e('PREV', 'epicomedia'); ?>
            </span>
        </div>

    </div>

    <?php
    
    return ob_get_clean();
}
add_shortcode( 'image_carousel', 'ep_sc_imagecarousel' );


/*-----------------------------------------------------------------------------------*/
/*  Showcase 
/*-----------------------------------------------------------------------------------*/
$GLOBALS["showcase_mobile_items"]= '';

function ep_sc_showcase($atts,$content)
{
    extract(shortcode_atts(array(

        'title'  => '',
        'subtitle' => '',
        'nextsection'  => 'show',
        'direction'  => 'left-align',
        'style'  => 'dark',
        'hover_color' => '',
        'overlay' =>'show'
    ), $atts));
        
    $id = ep_sc_id('showcase');
    
    $GLOBALS["showcase_bgs"] = array();//Set/Reset
    $GLOBALS["showcase_titles"] = array();//Set/Reset

    $hasStyle = '' != $hover_color;


    $GLOBALS["showcase_mobile_items"] = '';

    ob_start();

    if($hasStyle)  { ?>

    <style type="text/css" media="all" scoped>
        <?php if(strlen(esc_attr($hover_color))) {
            echo  "#$id.showcase .item-list h6.active,";
            echo  "#$id.showcase .item-list h6:hover"; ?>
            {
                color:<?php echo esc_attr($hover_color); ?>;
            }
            
        <?php 
            echo  "#$id .item-content:before"; ?>
            {
                background-color:<?php echo esc_attr($hover_color); ?>;
            }          
        <?php } ?>
    </style>
    <?php
    }//if($hasStyle)

    $child_content = do_shortcode($content);

    ?>

<div id="<?php echo $id; ?>" class="showcase hidden-phone <?php echo esc_attr($direction) . ' '. esc_attr($style); ?>">
    <div class="showcase-backgrounds">
        <?php
            if( esc_attr($overlay) == "show" )
            { 
        ?>

        <div class="overlay"></div>

        <?php
            }

            foreach($GLOBALS["showcase_bgs"] as $bg) {
                echo $bg;
            }
        ?>
    </div>
    <div class="container showcase-content-wrapper">
        <div class="row">
            <div class="span12">
                <div class="row">
                    <div class="span4 showcase-title">

                        <h3>
                            <?php echo wp_kses( $title, $GLOBALS["allowed_tags"] ); ?>
                            <span class="showcase_subtitle"><?php echo esc_attr($subtitle); ?></span>
                        </h3>

                    </div>
                </div>
                <div class="row">
                    <div class="span4 showcase-nav">
                        <div class="item-list">

                            <?php
                                foreach($GLOBALS["showcase_titles"] as $showcase_title_id) {
                                    echo $showcase_title_id;
                                }
                            ?>

                        </div>
                        <?php if(esc_attr($nextsection) == "show")
                        {
                        ?>
                        <span class="next-showcase">
                            <a href="#"><?php _e("Next",'epicomedia') ?></a>
                        </span>
                        <?php
                        }
                        ?>
                    </div>
                    <div class="span5 showcase-items">
                        <?php echo $child_content; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="showcase showcase-mobile visible-phone <?php echo esc_attr($direction) . ' '. esc_attr($style); ?>">
    <div class="container showcase-content-wrapper">
        <div class="row">
            <div class="span6 showcase-title">
                <h3>
                    <?php echo wp_kses( $title, $GLOBALS["allowed_tags"] ); ?>
                    <span class="showcase_subtitle"><?php echo esc_attr($subtitle); ?></span>
                </h3>
            </div>
        </div>
    </div>
    <div class="showcase-items-container">
        <?php
        if( esc_attr($overlay) == "show" )
        { 
        ?>

        <div class="overlay"></div>

        <?php
        }

        echo $GLOBALS["showcase_mobile_items"]; ?>
    </div>
</div>

<?php
    return ob_get_clean();
}

add_shortcode( 'showcase', 'ep_sc_showcase' );

/*-----------------------------------------------------------------------------------*/
/*  Showcase Items 
/*-----------------------------------------------------------------------------------*/

function ep_sc_showcase_item($atts)
{
    extract(shortcode_atts(array(

        'title'  => '',
        'text' => '',
        'text_bg' => 'hide',
        'bg'  => '',
        'images' => '',
        'outer_link' => ''
        
    ), $atts));
        
    $id = ep_sc_id('showcase-item');

    //Make an array of image IDs
    $image_ids = array();
    if($images)
    {
        $image_ids = explode(",",esc_attr($images));
    }
    

    //get background image
    $image_url = wp_get_attachment_url( esc_attr($bg), 'large' );
    $GLOBALS["showcase_bgs"][]  .= '<div data-bg-id="'. $id .'" class="showcase-bg" style="background-image:url('. $image_url .')" ></div>';     
        
    //get the title
    $GLOBALS["showcase_titles"][]  .= '<h6 class="" data-bg-id="'. $id .'">'. esc_attr($title).'</h6>';

    ob_start();
    ?>

        <div class="showcase-item" data-bg-id="<?php echo $id; ?>">

            <div class="item-content <?php if( esc_attr($text_bg) == "show" ) { echo "text_bg"; } ?>">
                <p><?php echo esc_attr($text); ?></p>
            </div>
            <?php
                if(!empty($image_ids))
                {
            ?>
                    <div class="item-pics  <?php if( esc_attr($text_bg) == "show" ) { echo "had_text_bg"; } ?>">
                        <div class="swiper-container">
                            <div class="swiper-wrapper">
                            <?php
                                foreach($image_ids as $image_id) {
                                    $image_url = wp_get_attachment_url( $image_id, 'large' );
                                ?>

                                    <div class="swiper-slide">
                                        <?php echo '<img alt="'.'" src="'.$image_url . '" >'; ?>
                                    </div>

                                <?php
                                }
                                ?>
                            </div>
                        </div>
                    </div>
            <?php
                }

                if(strlen($outer_link))
                {
                    $link = vc_build_link( $outer_link );
                    if ( strlen( $link['url'] ) )
                    {
                        ?>
                        <a href="<?php echo esc_url($link["url"]); ?>" target="<?php echo esc_attr( $link["target"] ); ?>" class="showcase-link" title="<?php echo esc_attr($link["title"]); ?>"><?php echo  esc_attr($link["title"]); ?></a>
                        <?php
                    }
                }
            ?>

        </div>

<?php
    //get background image
    $image_url = wp_get_attachment_url( $bg, 'large' );

    $GLOBALS["showcase_mobile_items"] .= '<div class="showcase-mobile-item showcase-bg" style="background-image:url(' . esc_url($image_url) .')">';
    $GLOBALS["showcase_mobile_items"] .= '<div class="container showcase-content-wrapper">';
    $GLOBALS["showcase_mobile_items"] .= '<div class="row">';
    $GLOBALS["showcase_mobile_items"] .= '<div class="span12">';
    $GLOBALS["showcase_mobile_items"] .= '<div class="row">';
    $GLOBALS["showcase_mobile_items"] .= '<div class="item-list ">';
    $GLOBALS["showcase_mobile_items"] .= '<h6 class="' . ( esc_attr($text_bg) == "show" ? "text_bg" : "" ) . '">' . esc_attr($title) . '</h6>';
    $GLOBALS["showcase_mobile_items"] .= '</div>';
    $GLOBALS["showcase_mobile_items"] .= '<div class="showcase-items">';
    $GLOBALS["showcase_mobile_items"] .= '<div class="showcase-item showcase-item-mobile visible-phone" data-bg-id="'. $id .'">';
    $GLOBALS["showcase_mobile_items"] .= '<div class="item-content '. (esc_attr($text_bg) == "show" ? "text_bg" : "" ) . '">';
    $GLOBALS["showcase_mobile_items"] .= '<p>' .esc_attr($text) . '</p>';
    $GLOBALS["showcase_mobile_items"] .= '</div>';
    if($outer_link != '')
    {
        $link = vc_build_link( $outer_link );
        if ( strlen( $link['url'] ) )
        {

            $GLOBALS["showcase_mobile_items"] .= '<a href="'. esc_url($link["url"]) .'" target="' . esc_attr( $link["target"] ) . '" class="showcase-link" title="' . esc_attr($link["title"]) . '">' . esc_attr($link["title"]) . '</a>';
        }
    }

    if(!empty($image_ids))
    {
        $GLOBALS["showcase_mobile_items"] .= '<div class="item-pics ' . (esc_attr($text_bg) == "show" ? "had_text_bg": "" ) . '">';
        $GLOBALS["showcase_mobile_items"] .= '<div class="swiper-container">';
        $GLOBALS["showcase_mobile_items"] .= '<div class="swiper-wrapper">';
        foreach($image_ids as $image_id) {
            $image_url = wp_get_attachment_url( $image_id, 'large' );
            $GLOBALS["showcase_mobile_items"] .= '<div class="swiper-slide">';
            $GLOBALS["showcase_mobile_items"] .= '<img alt="" src="'.$image_url . '">';
            $GLOBALS["showcase_mobile_items"] .= '</div>';
        }
        $GLOBALS["showcase_mobile_items"] .= '</div>';
        $GLOBALS["showcase_mobile_items"] .= '</div>';
        $GLOBALS["showcase_mobile_items"] .= '</div>';
        $GLOBALS["showcase_mobile_items"] .= '';
    }
    
    $GLOBALS["showcase_mobile_items"] .= '</div>';
    $GLOBALS["showcase_mobile_items"] .= '</div>';
    $GLOBALS["showcase_mobile_items"] .= '</div>';
    $GLOBALS["showcase_mobile_items"] .= '</div>';
    $GLOBALS["showcase_mobile_items"] .= '</div>';
    $GLOBALS["showcase_mobile_items"] .= '</div>';
    $GLOBALS["showcase_mobile_items"] .= '</div>';
?>

    <?php
    return ob_get_clean();
}

add_shortcode( 'showcase_item', 'ep_sc_showcase_item' );



/*-----------------------------------------------------------------------------------*/
/*  Portfolio
/*-----------------------------------------------------------------------------------*/

function ep_sc_portfolio($atts)
{
    extract(shortcode_atts(array(
        'type'  => 'portfolio_space',
        'title_bar' => 'show',
        'title_text' => '',
        'subtitle_text' => '',
        'portfolio_filter' => 'all',
        'filters' => '',
        'filter_display' => 'show',
        'filter_style' => 'standard',
        'filter_toggle_state' => 'close',
        'portfolio_posts_page' => '12',
        'portfolio_hover' => 'creativeType',
        'portfolio_hover_style' => 'lightStyle',
        'portfolio_hover_like_button' => 'show',
    ), $atts));
    
    $id = ep_sc_id('portfolio');
   
    $portolio_type = $type;
    $title = $title_text;
    $subTitle = $subtitle_text;

    $pDajax = false;

    
    $portfolioId = $id;
    $id = str_replace('portfolio_', '', $id);
    $portfolioLoop =  'pLoop_'.$id;
    $pLoadMore = 'pLoadMore_'.$id;
    $pagedNum = 'paged_'.$id;

    $catArr = array();
    
    $portfolioItemNumber = 0;
    /* get Portfolio Skills if there is no selected skills */
    if($portfolio_filter == 'all')
    {
       $args = array(
            'fields' => 'ids', 
        );
        
        $filters = get_terms('skills', $args);
        $catArr  = $filters;
        $portfolioItemNumber = wp_count_posts('portfolio') -> publish;
    }
    else
    {
        $catArr  = explode(',', $filters) ;

        $args = array( 
        'fields' =>'ids', //we don't really need all post data so just id wil do fine.
        'posts_per_page' => -1, //-1 to get all post
        'post_type' => 'portfolio', 
        'tax_query' => array(
            array(
                'taxonomy' => 'skills',
                'field' => 'slug',
                'terms' => $catArr
            )
        )
        );
        $ps = get_posts( $args );
        $portfolioItemNumber = count($ps);

        $args = array(
            'fields' => 'ids',
            'slug'   => $catArr,
        );
        
        $filters = get_terms('skills', $args);
        
    }
    

    if(count($catArr) == 0 || count($catArr) > 1)
    {
        if ( $portfolio_filter == 'all' ) {
            // Generate All Filter Taxonomy
            $listCatsArgs = array('title_li' => '', 'taxonomy' => 'skills', 'walker' => new Ep_portfolio_walker(), 'echo' => 0, 'include' => '' );
        } else {
             // Generate  Selected Taxonomy
            $listCatsArgs = array('title_li' => '', 'taxonomy' => 'skills', 'walker' => new Ep_portfolio_walker(), 'echo' => 0, 'include' => implode("," , $filters ));           
        }

        $catList = '<li class="current"><a class="active" data-filter="*" href="#">'.__('All', 'epicomedia').'<span class="filterline"></span><span class="post-count">'. sprintf("%02d", $portfolioItemNumber) .'</span></a></li>';
        $catList .= wp_list_categories($listCatsArgs);
    }
    
    
    if ( $portfolio_filter== 'custom' ) {


        $portfolio_skills = array();
        $cat_args = array(
            'orderby'       => 'term_id', 
            'order'         => 'ASC',
            'hide_empty'    => false,
            'slug' => $catArr
        );

        $terms = get_terms('skills', $cat_args);
        foreach($terms as $taxonomy){
             $portfolio_skills[] = $taxonomy->term_id;
        }

        // Add some parameters for the JS - portfolio load more .
        $queryArgs = array (
            'post_type'      => 'portfolio',//post type, I used 'product'
            'post_status'   => 'publish', // just tried to find all published post
            'posts_per_page' =>   -1,
            'fields' => 'ids',
            'pageVar' => 'list1',
            'tax_query' => array(
                array(
                    'taxonomy' => 'skills',
                    'terms'    => $portfolio_skills
                )
            )
        );

    } else {

        // Add some parameters for the JS - portfolio load more .
        $queryArgs = array (
            'post_type'      => 'portfolio',//post type, I used 'product'
            'post_status'   => 'publish', // just tried to find all published post
            'posts_per_page' =>   -1,
             'fields' => 'ids',
            'pageVar' => 'list1',
        );
    }

    $query = new WP_Query($queryArgs);
    $ppaged = ( get_query_var('paged') > 1 ) ? get_query_var('paged') : 1;
    $pMax = $query-> max_num_pages;
    $countPosts = $query -> found_posts;
    $maxPages =  ceil ($countPosts / $portfolio_posts_page)  ;
    wp_reset_postdata();
    ob_start();
        
    ?>

    <!-- Portfolio Section  -->
    <div id="<?php echo $portfolioId; ?>" data-portfolio-type="<?php echo esc_attr($type); ?>" data-value="<?php echo $portfolioId; ?>"  data-id="<?php echo $id; ?>" data-startPage="<?php echo $ppaged; ?>" data-maxPages="<?php echo $maxPages; ?>" data-nextLink="<?php echo next_posts($pMax, false); ?>" class="epicoSection portfolioSection <?php echo esc_attr($type); ?> <?php if ($portfolio_hover_like_button == 'hide') { ?> hideLikeBtn <?php } ?>">

        <div  class="portfoliowrap wrap <?php if ( !empty( $subTitle ) ) { ?> hassubtitle <?php } ?> ">

            <div class="container title_container <?php  if ( ($title_bar == 'show' && !empty( $title ) && !empty($subTitle)) || $filter_display == 'show' ) { ?> portfolio_height <?php } ?> clearfix">

                <?php  if ( (!empty( $subTitle ) || !empty( $title ) ) || $title_bar == 'show' ) { ?>
                
                        <?php if ( $title_bar == 'show' ) { ?>
                            <div class="titleSpace">
                    
                                <?php if ( !empty( $title )) { ?>
                                
                                    <div class="title"><h3><?php echo esc_attr($title); ?></h3></div>
                    
                                <?php } if ( !empty( $subTitle ) ) { ?>
                         
                                    <div class="subtitle"><?php echo esc_attr($subTitle); ?></div>
                         
                                <?php } ?>
                        
                            </div>
                        <?php }  ?>
                        
                    
                <?php }  ?>
                
            </div>

            <?php  if ( $filter_display == 'show' ){
                        if ( count($catArr)!== 1 ){ ?>

                    <!-- portfolio filter - desktop -->
                    <div class="container title_container visible-desktop clearfix">
                        <div class="portfolio-header">
                        
                            <ul class="filters option-set subnavigation clearfix <?php echo esc_attr($filter_style); ?>-style toggleClicked<?php if($filter_toggle_state == "open"){ echo " openToggle"; } ?>" data-option-key="filter">

                                <?php

                                echo $catList;

                                if($filter_style == 'toggle') {
                                    ?>
                                    <li class="filterToggle<?php if($filter_toggle_state == "open"){ echo " closed"; } ?>">
                                        <div class="toggleLineContainer">
                                            <span class="lineBarFirst"></span>
                                            <span class="lineBarSecond"></span>
                                        </div>
                                        <div class="filterRightLine"></div>
                                        <div class="filterLeftLine"></div>
                                    </li>
                                    <?php
                                }

                                ?>

                            </ul>
                        </div>
                    </div>

                    <!-- portfolio filter - tablet & phone -->
                    <div class="hidden-desktop clearfix">
                        <ul id="Ul1" class="filterstablet portfolio-filter" data-option-key="filter">
                            <li class="">
                                <div>
                                    <span class="text"><?php _e('All', 'epicomedia') ?></span>
                                    <span class="icon icon-angle-down"></span>
                                </div>
                                <ul class="portfolio-filter-items">
                                    <?php echo $catList; ?>
                                </ul>
                            </li>
                        </ul>
                    </div>

            <?php }
                } ?>
                
            <div class="portfolio_wrap">

                <!-- portfolio items  -->
                <div class="isotope <?php echo esc_attr($portfolio_hover) . ' ' . esc_attr($portfolio_hover_style);?>" data-skills="<?php if($portfolio_filter == 'all' ) { echo 'all'; } else {echo implode(" ",$filters); } ?>">
                    <div id="<?php echo $portfolioLoop; ?>">

                        <?php

                            $paged1 = isset( $_GET[$pagedNum] ) ? (int) $_GET[$pagedNum] : 1;

                            $queryArgs = array(

                                'post_type'      => 'portfolio',
                                'posts_per_page' => $portfolio_posts_page,
                                'paged'          => $paged1
                            );


                            if ( $portfolio_filter== 'custom' ) {

                                //Taxonomy filter
                                if(count($catArr))
                                {

                                    $queryArgs['tax_query'] =  array(
                                        // Note: tax_query expects an array of arrays!
                                        array(
                                            'taxonomy' => 'skills',
                                            'field'    => 'slug',
                                            'terms'    => $catArr
                                        ));
                                }
                            }

                            $count = 1;
                            $query = new WP_Query($queryArgs);

                            while ($query->have_posts()) {

                                $query->the_post();

                                include(locate_template('templates/portfolio-thumbnail.php'));

                                $count++;
                            }

                            wp_reset_postdata();

                        ?>
                    </div>
                </div>
            </div>
            <?php

                $query = new WP_Query($queryArgs);
                if ( $query-> have_posts()) { ?>

                    <!-- portfolio load more button -->
                    <div class="pLoadMore <?php echo esc_attr($pLoadMore); ?>  clearfix">
                        <div class="container clearfix">
                            <div class="loadMore" data-id="<?php echo $id; ?>">
                                <span class="text load-more-text"><?php _e("Load more",'epicomedia'); ?></span>
                                <span class="text loading-text"><?php _e("Loading...",'epicomedia'); ?></span>
                            </div>
                        </div>
                    </div>

            <?php } ?>

            <?php wp_reset_query(); ?>

        </div>
    </div>
    <!-- End Portfolio  -->

    <?php
    return ob_get_clean();
}

add_shortcode( 'portfolio', 'ep_sc_portfolio' );


/*-----------------------------------------------------------------------------------*/
/*  Portfolio inner
/*-----------------------------------------------------------------------------------*/

function ep_sc_portfolio_inner($atts)
{
    extract(shortcode_atts(array(
        'type'  => 'portfolio_space',
        'title_bar' => 'show',
        'title_text' => '',
        'subtitle_text' => '',
        'portfolio_filter' => 'all',
        'filters' => '',
        'filter_display' => 'show',
        'filter_style' => 'standard',
        'filter_toggle_state' => 'close',
        'portfolio_posts_page' => '12',
        'portfolio_hover' => 'creativeType',
        'portfolio_hover_style' => 'lightStyle',
        'portfolio_hover_like_button' => 'show',
    ), $atts));
    
    $id = ep_sc_id('portfolio');
   
    $portolio_type = $type;
    $title = $title_text;
    $subTitle = $subtitle_text;
    
    $portfolioId = $id;
    $id = str_replace('portfolio_', '', $id);
    $portfolioLoop =  'pLoop_'.$id;
    $pLoadMore = 'pLoadMore_'.$id;
    $pagedNum = 'paged_'.$id;
    
    $pDajax = true;

    $catArr = array();

    $portfolioItemNumber = 0;
    /* get Portfolio Skills if there is no selected skills */
    if($portfolio_filter == 'all')
    {
       $args = array(
            'fields' => 'ids', 
        );
        
        $filters = get_terms('skills', $args);
        $catArr  = $filters;
        $portfolioItemNumber = wp_count_posts('portfolio') -> publish;
    }
    else
    {
        $catArr  = explode(',', $filters) ;

        $args = array( 
        'fields' =>'ids', //we don't really need all post data so just id wil do fine.
        'posts_per_page' => -1, //-1 to get all post
        'post_type' => 'portfolio', 
        'tax_query' => array(
            array(
                'taxonomy' => 'skills',
                'field' => 'slug',
                'terms' => $catArr
            )
        )
        );
        $ps = get_posts( $args );
        $portfolioItemNumber = count($ps);

        $args = array(
            'fields' => 'ids',
            'slug'   => $catArr,
        );
        
        
        $filters = get_terms('skills', $args);
        
    }
    

    if(count($catArr) == 0 || count($catArr) > 1)
    {
        if ( $portfolio_filter == 'all' ) {
            // Generate All Filter Taxonomy
            $listCatsArgs = array('title_li' => '', 'taxonomy' => 'skills', 'walker' => new Ep_portfolio_walker(), 'echo' => 0, 'include' => '' );
        } else {
            $listCatsArgs = array('title_li' => '', 'taxonomy' => 'skills', 'walker' => new Ep_portfolio_walker(), 'echo' => 0, 'include' => implode("," , $filters) );           
        }

        $catList = '<li class="current"><a class="active" data-filter="*" href="#">'.__('All', 'epicomedia').'<span class="filterline"></span><span class="post-count">'. sprintf("%02d", $portfolioItemNumber) .'</span></a></li>';
        $catList .= wp_list_categories($listCatsArgs);
    }
    
    
    if ( $portfolio_filter == 'custom' ) {

        $portfolio_skills = array();
        $cat_args = array(
            'orderby'       => 'term_id', 
            'order'         => 'ASC',
            'hide_empty'    => false,
            'slug' => $catArr
        );

        $terms = get_terms('skills', $cat_args);
        foreach($terms as $taxonomy){
             $portfolio_skills[] = $taxonomy->term_id;
        }

        // Add some parameters for the JS - portfolio load more .
        $queryArgs = array (
            'post_type'      => 'portfolio',//post type, I used 'product'
            'post_status'   => 'publish', // just tried to find all published post
            'posts_per_page' =>   -1,
            'fields' => 'ids',
            'pageVar' => 'list1',
            'tax_query' => array(
                array(
                    'taxonomy' => 'skills',
                    'terms'    => $portfolio_skills
                )
            )
        );

    } else {

        // Add some parameters for the JS - portfolio load more .
        $queryArgs = array (
            'post_type'      => 'portfolio',//post type, I used 'product'
            'post_status'   => 'publish', // just tried to find all published post
             'fields' => 'ids',
            'posts_per_page' =>   -1,
            'pageVar' => 'list1',
        );
    }

    $query = new WP_Query($queryArgs);
    $ppaged = ( get_query_var('paged') > 1 ) ? get_query_var('paged') : 1;
    $pMax = $query-> max_num_pages;
    $countPosts = $query -> post_count;
    $maxPages =  ceil ($countPosts / $portfolio_posts_page)  ;
    wp_reset_postdata();
    ob_start();
        
    ?>

    <!-- Portfolio Section  -->
    <div id="<?php echo $portfolioId; ?>" data-portfolio-type="<?php echo esc_attr($type); ?>" data-value="<?php echo $portfolioId; ?>" data-id="<?php echo $id; ?>" data-startPage="<?php echo $ppaged; ?>" data-maxPages="<?php echo $maxPages; ?>" data-nextLink="<?php echo next_posts($pMax, false); ?>" class="epicoSection portfolioSection <?php echo esc_attr($type); ?> <?php if ($portfolio_hover_like_button == 'hide') { ?> hideLikeBtn <?php } ?>">

        <div class="portfoliowrap wrap <?php if ( !empty( $subTitle ) ) { ?> hassubtitle <?php } ?>">

        <div class="pDWrap clearfix">

            <!-- portfolio Detail loader-->
            <div id="loader">
                <svg width="35" height="35" viewbox="0 0 40 40">
                    <!-- <rect width="40" height="40" class="rect" />  <- this looks buggy in retina safari -->
                    <polygon points="0 0 0 40 40 40 40 0" class="rect" />
                </svg>
            </div>
            
            <div id="pDError"><?php _e('Sorry, we ran into a technical problem (unknown error). Please try again...', 'epicomedia') ?> </div>

             <div class="navWrap pDNavigation">
             
                <a href="#" title="<?php _e('NEXT', 'epicomedia'); ?>"  class="next no_djax">
                    <div class="arrows-button-next no-select">
                        <span class="text">
                            <?php _e('NEXT', 'epicomedia'); ?>
                        </span>
                    </div>
                </a>
                <!-- Back to portfolio -->
                <a id="PDclosePortfolio" class="no_djax" href="#" title="<?php _e('Back to portfolio', 'epicomedia'); ?>">
                    <div>
                        <span class="backToPortfolio" data-name="grid2"></span>
                    </div>
                </a>

                <!-- Prev Arrows -->
                <a href="#" title="<?php _e('PREV', 'epicomedia'); ?>"  class="previous no_djax">
                    <div class="arrows-button-prev no-select">
                        <span class="text">
                            <?php _e('PREV', 'epicomedia'); ?>
                        </span>
                    </div>
                </a>

            </div>

            <!-- portfolio Detail Content -->
            <div id="portfolioDetailAjax"></div>

        </div>
        
        <div class="container title_container <?php  if ( $title_bar == 'show'  || $filter_display == 'show' ) { ?> portfolio_height <?php } ?> clearfix">

                <?php  if ( (!empty( $subTitle ) || !empty( $title ) ) || $title_bar == 'show' ) { ?>
                
                    <?php if ( $title_bar == 'show' ) { ?>
                        <div class="titleSpace">
                    
                            <?php if ( !empty( $title )) { ?>
                                
                                <div class="title"><h3><?php echo esc_attr($title); ?></h3></div>
                    
                            <?php } if ( !empty( $subTitle ) ) { ?>
                         
                                <div class="subtitle"><?php echo esc_attr($subTitle); ?></div>
                         
                            <?php } ?>
                        
                        </div>
                    <?php }  ?>
                    
                <?php }  ?>
                
            </div>

            <?php  if ( $filter_display == 'show' ){
                        if ( count($catArr)!== 1 ){ ?>

                    <!-- portfolio filter - desktop -->
                    <div class="container title_container visible-desktop clearfix">
                        <div class="portfolio-header">
                        
                            <ul class="filters option-set subnavigation clearfix <?php echo esc_attr($filter_style); ?>-style toggleClicked<?php if($filter_toggle_state == "open"){ echo " openToggle"; } ?>" data-option-key="filter">

                                <?php

                                echo $catList;

                                if($filter_style == 'toggle') {
                                    ?>
                                    <li class="filterToggle<?php if($filter_toggle_state == "open"){ echo " closed"; } ?>">
                                        <div class="toggleLineContainer">
                                            <span class="lineBarFirst"></span>
                                            <span class="lineBarSecond"></span>
                                        </div>
                                        <div class="filterRightLine"></div>
                                        <div class="filterLeftLine"></div>
                                    </li>
                                    <?php
                                }

                                ?>

                            </ul>
                        </div>
                    </div>

                    <!-- portfolio filter - tablet & phone -->
                    <div class="hidden-desktop clearfix">
                        <ul id="Ul1" class="filterstablet portfolio-filter" data-option-key="filter">
                            <li class="">
                                <div>
                                    <span class="text"><?php _e('All', 'epicomedia') ?></span>
                                    <span class="icon icon-angle-down"></span>
                                </div>
                                <ul class="portfolio-filter-items">
                                    <?php echo $catList; ?>
                                </ul>
                            </li>
                        </ul>
                    </div>

            <?php }
                } ?>
                
            <div id="isotopePortfolio" class="portfolio_wrap">
                <!-- portfolio items  -->
                <div class="isotope ajaxPDetail <?php echo esc_attr($portfolio_hover) . ' ' . esc_attr($portfolio_hover_style);?>" data-skills="<?php if($portfolio_filter == 'all') { echo 'all'; } else {echo implode(" ",$filters); } ?>">
                    <div id="<?php echo $portfolioLoop; ?>" class="ep_lightGallery">

                        <?php

                            $paged1 = isset( $_GET[$pagedNum] ) ? (int) $_GET[$pagedNum] : 1;

                            $queryArgs = array(

                                'post_type'      => 'portfolio',
                                'posts_per_page' => $portfolio_posts_page,
                                'paged'          => $paged1
                            );


                            if ( $portfolio_filter== 'custom' ) {

                                //Taxonomy filter
                                if(count($catArr))
                                {

                                    $queryArgs['tax_query'] =  array(
                                        // Note: tax_query expects an array of arrays!
                                        array(
                                            'taxonomy' => 'skills',
                                            'field'    => 'slug',
                                            'terms'    => $catArr
                                        ));
                                }
                            }

                            $count = 1;
                            $query = new WP_Query($queryArgs);

                            while ($query->have_posts()) {

                                $query->the_post();

                                include(locate_template('templates/portfolio-thumbnail.php'));

                                $count++;
                            }

                            wp_reset_postdata();

                        ?>
                    </div>
                </div>
            </div>
            <?php

                $query = new WP_Query($queryArgs);
                if ( $query-> have_posts()) { ?>

                    <!-- portfolio load more button -->
                    <div class="pLoadMore <?php echo esc_attr($pLoadMore); ?>  clearfix">
                        <div class="container clearfix">
                            <div class="loadMore" data-id="<?php echo $id; ?>">
                                <span class="text load-more-text"><?php _e("Load more",'epicomedia'); ?></span>
                                <span class="text loading-text"><?php _e("Loading...",'epicomedia'); ?></span>
                            </div>
                        </div>
                    </div>

            <?php } ?>

            <?php wp_reset_postdata(); ?>

        </div>
    </div>
    <!-- End Portfolio  -->

    <?php
    return ob_get_clean();
}

add_shortcode( 'portfolio_inner', 'ep_sc_portfolio_inner' );

/*-----------------------------------------------------------------------------------*/
/*  Gallery
/*-----------------------------------------------------------------------------------*/

function ep_sc_gallery($atts)
{
    extract(shortcode_atts(array(
        'type'  => 'portfolio_space',
        'title_bar' => 'show',
        'title_text' => '',
		'subtitle_text'=>'',
        'portfolio_filter' => 'all',
        'filters' => '',
        'filter_display' => 'show',
        'filter_style' => 'standard',
        'filter_toggle_state' => 'close',
        'gallery_posts_page' => '12',
        'portfolio_hover_like_button' => 'show',
		'portfolio_hover' => 'simpleGallery',
        'portfolio_hover_style' => 'lightStyle',
    ), $atts));
    
    $id = ep_sc_id('portfolio');
   
    $portolio_type = $type;
    $title = $title_text;

    $pDajax = false;

    
    $portfolioId = $id;
    $id = str_replace('portfolio_', '', $id);
    $portfolioLoop =  'pLoop_'.$id;
    $pLoadMore = 'pLoadMore_'.$id;
    $pagedNum = 'paged_'.$id;

    $catArr = array();
    $portfolioItemNumber = 0;
    /* get all of the gallery categories if there is none of them was selected*/
    if($portfolio_filter == 'all')
    {
       $args = array(
            'fields' => 'ids', 
        );
        
        $filters = get_terms('gallery_cat', $args);
        $catArr  = $filters;
        $portfolioItemNumber = wp_count_posts('gallery') -> publish;
    }
    else
    {
        $catArr  = explode(',', $filters) ;

        $args = array( 
        'fields' =>'ids', //we don't really need all post data so just id will do fine.
        'posts_per_page' => -1, //-1 to get all post
        'post_type' => 'gallery', 
        'tax_query' => array(
            array(
                'taxonomy' => 'gallery_cat',
                'field' => 'slug',
                'terms' => $catArr
            )
        )
        );
        $ps = get_posts( $args );
        $portfolioItemNumber = count($ps);

        $args = array(
            'fields' => 'ids',
            'slug'   => $catArr,
        );
        
        $filters = get_terms('gallery_cat', $args);
        
    }
    

    if(count($catArr) == 0 || count($catArr) > 1)
    {
        if ( $portfolio_filter == 'all' ) {
            // Generate All Filter Taxonomy
            $listCatsArgs = array('title_li' => '', 'taxonomy' => 'gallery_cat', 'walker' => new Ep_portfolio_walker(), 'echo' => 0, 'include' => '' );
        } else {
             // Generate  Selected Taxonomy
            $listCatsArgs = array('title_li' => '', 'taxonomy' => 'gallery_cat', 'walker' => new Ep_portfolio_walker(), 'echo' => 0, 'include' => implode("," , $filters ));           
        }

        $catList = '<li class="current"><a class="active" data-filter="*" href="#">'.__('All', 'epicomedia').'<span class="filterline"></span><span class="post-count">'. sprintf("%02d", $portfolioItemNumber) .'</span></a></li>';
        $catList .= wp_list_categories($listCatsArgs);
    }
    
    
    if ( $portfolio_filter== 'custom' ) {


        $gallery_cats = array();
        $cat_args = array(
            'orderby'       => 'term_id', 
            'order'         => 'ASC',
            'hide_empty'    => false,
            'slug' => $catArr
        );

        $terms = get_terms('gallery_cat', $cat_args);
        foreach($terms as $taxonomy){
             $gallery_cats[] = $taxonomy->term_id;
        }

        // Add some parameters for the JS - gallery load more .
        $queryArgs = array (
            'post_type'      => 'gallery',
            'post_status'   => 'publish', // just tried to find all published post
            'posts_per_page' =>   -1,
            'fields' => 'ids',
            'pageVar' => 'list1',
            'tax_query' => array(
                array(
                    'taxonomy' => 'gallery_cat',
                    'terms'    => $gallery_cats
                )
            )
        );

    } else {

        // Add some parameters for the JS - gallery load more .
        $queryArgs = array (
            'post_type'      => 'gallery',//post type, I used 'product'
            'post_status'   => 'publish', // just tried to find all published post
            'posts_per_page' =>   -1,
             'fields' => 'ids',
            'pageVar' => 'list1',
        );
    }

    $query = new WP_Query($queryArgs);
    $ppaged = ( get_query_var('paged') > 1 ) ? get_query_var('paged') : 1;
    $pMax = $query-> max_num_pages;
    $countPosts = $query -> found_posts;
    $maxPages =  ceil ($countPosts / $gallery_posts_page)  ;
    wp_reset_postdata();
    ob_start();
        
    ?>

    <!-- gallery Section  -->
    <div id="<?php echo $portfolioId; ?>" data-portfolio-type="<?php echo esc_attr($type); ?>" data-value="<?php echo $portfolioId; ?>"  data-id="<?php echo $id; ?>" data-startPage="<?php echo $ppaged; ?>" data-maxPages="<?php echo $maxPages; ?>" data-nextLink="<?php echo next_posts($pMax, false); ?>" class="epicoSection portfolioSection <?php echo esc_attr($type); ?> <?php if ($portfolio_hover_like_button == 'hide') { ?> hideLikeBtn <?php } ?>">

        <div  class="portfoliowrap wrap">

            <div class="container title_container <?php  if ( ($title_bar == 'show' && !empty( $title )) || $filter_display == 'show' ) { ?> portfolio_height <?php } ?> clearfix">

                <?php  if ( ( !empty( $title ) ) || $title_bar == 'show' ) { ?>
                
                        <?php if ( $title_bar == 'show' ) { ?>
                            <div class="titleSpace">
                    
                                <?php if ( !empty( $title )) { ?>
                                
                                    <div class="title"><h3><?php echo esc_attr($title); ?></h3></div>
									
                                <?php } ?>
                        
                            </div>
                        <?php }  ?>
                        
                    
                <?php }  ?>
                
            </div>

            <?php  if ( $filter_display == 'show' ){
                        if ( count($catArr)!== 1 ){ ?>

                    <!-- gallery filter - desktop -->
                    <div class="container title_container visible-desktop clearfix">
                        <div class="portfolio-header">
                        
                            <ul class="filters option-set subnavigation clearfix <?php echo esc_attr($filter_style); ?>-style toggleClicked<?php if($filter_toggle_state == "open"){ echo " openToggle"; } ?>" data-option-key="filter">

                                <?php

                                echo $catList;

                                if($filter_style == 'toggle') {
                                    ?>
                                    <li class="filterToggle<?php if($filter_toggle_state == "open"){ echo " closed"; } ?>">
                                        <div class="toggleLineContainer">
                                            <span class="lineBarFirst"></span>
                                            <span class="lineBarSecond"></span>
                                        </div>
                                        <div class="filterRightLine"></div>
                                        <div class="filterLeftLine"></div>
                                    </li>
                                    <?php
                                }

                                ?>

                            </ul>
                        </div>
                    </div>

                    <!-- gallery filter - tablet & phone -->
                    <div class="hidden-desktop clearfix">
                        <ul id="Ul1" class="filterstablet portfolio-filter" data-option-key="filter">
                            <li class="">
                                <div>
                                    <span class="text"><?php _e('All', 'epicomedia') ?></span>
                                    <span class="icon icon-angle-down"></span>
                                </div>
                                <ul class=portfolio-filter-items">
                                    <?php echo $catList; ?>
                                </ul>
                            </li>
                        </ul>
                    </div>

            <?php }
                } ?>
                
            <div class="portfolio_wrap">

                <!-- gallery items  -->
                <div  class="isotope <?php echo esc_attr($portfolio_hover) . ' ' . esc_attr($portfolio_hover_style);?>" data-categories="<?php if($portfolio_filter == 'all' ) { echo 'all'; } else {echo implode(" ",$filters); } ?>">
                    <div id="<?php echo $portfolioLoop; ?>" class="ep_lightGallery">

                        <?php

                            $paged1 = isset( $_GET[$pagedNum] ) ? (int) $_GET[$pagedNum] : 1;

                            $queryArgs = array(

                                'post_type'      => 'gallery',
                                'posts_per_page' => $gallery_posts_page,
                                'paged'          => $paged1
                            );


                            if ( $portfolio_filter== 'custom' ) {

                                //Taxonomy filter
                                if(count($catArr))
                                {

                                    $queryArgs['tax_query'] =  array(
                                        // Note: tax_query expects an array of arrays!
                                        array(
                                            'taxonomy' => 'gallery_cat',
                                            'field'    => 'slug',
                                            'terms'    => $catArr
                                        ));
                                }
                            }

                            $count = 1;
                            $query = new WP_Query($queryArgs);

                            while ($query->have_posts()) {

                                $query->the_post();

                                include(locate_template('templates/gallery-thumbnail.php'));

                                $count++;
                            }

                            wp_reset_postdata();

                        ?>
                    </div>
                </div>
            </div>
            <?php

                $query = new WP_Query($queryArgs);
                if ( $query-> have_posts()) { ?>

                    <!-- gallery load more button -->
                    <div class="pLoadMore <?php echo esc_attr($pLoadMore); ?>  clearfix">
                        <div class="container clearfix">
                            <div class="loadMore" data-id="<?php echo $id; ?>">
                                <span class="text load-more-text"><?php _e("Load more",'epicomedia'); ?></span>
                                <span class="text loading-text"><?php _e("Loading...",'epicomedia'); ?></span>
                            </div>
                        </div>
                    </div>

            <?php } ?>

            <?php wp_reset_query(); ?>

        </div>
    </div>
    <!-- End gallery  -->

    <?php
    return ob_get_clean();
}

add_shortcode( 'ep_gallery', 'ep_sc_gallery' );
