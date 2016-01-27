<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no" />

    
    <?php if ( ! function_exists( 'has_site_icon' ) || ! has_site_icon() ) { ?>

        <?php if(ep_opt('favicon') != ""){ ?>
            <link rel="shortcut icon" href="<?php ep_eopt('favicon'); ?>"  />
        <?php } else { ?>
            <link rel="shortcut icon" href="<?php echo THEME_IMAGES_URI ?>/favicon.png" />
        <?php } ?>
        
    <?php } ?>
    

    <link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />

    <!-- Theme Hook -->
    <?php wp_head(); ?>

</head>
<body <?php body_class(); ?> data-pageid="<?php echo get_the_ID(); ?>">
    <div id="top"></div>
    
    <div id="scrollToTop" class="visible-desktop">
        <a href="#top"></a>
    </div>
    
    <div class="layout">

    <!-- Preloader -->
    <?php if( ep_opt('loader_display') == 1 ) { ?>
    
	    <div id="preloader" class="firstload <?php echo ep_opt('preloader-type'); ?>">
            
            <!-- preloader box  -->
	        <div id="preloader_box">
                    <div id="preloader_items">
                        <div class="preloader-items-container">
                            <div class="preloader-image" style="background-image:url(<?php ep_preloader(); ?>);"></div>
                        </div>
                    </div>

                    <div class="preloader-text-container">
                        <div class="preloader-text"><?php if ( ep_opt('preloader-text')) { ep_eopt('preloader-text'); } ?></div>
                    </div>

                    <svg width="334" height="334" viewbox="0 0 40 40" class="preloader">
                        <polygon points="0 0 0 40 40 40 40 0" class="rect" />
                    </svg>
            </div>

            
            <?php if ( ep_opt('preloader-type') == "simple" || ep_opt('preloader-type') == "creative"  ) { ?>
              
              
                <!-- preloader simple  -->
                <svg id="prelaoder-simple" width="50" height="50" viewbox="0 0 40 40" class="preloader">
                    <polygon points="0 0 0 40 40 40 40 0" class="rect" />
                </svg>
            
            
            <?php } else if ( ep_opt('preloader-type') == "circular" ) { ?>
                
            
                <!-- preloader circular  -->
                <svg id="prelaoder-circular" height="50" width="50" ng-show="showpreloader" class="preloader_circular">
                    <circle cx="25" cy="25" r="20" fill="none" stroke-width="2" stroke-miterlimit="10" class="path"></circle>
                </svg>

              
            <?php } else if( ep_opt('preloader-type') == "sniper" ) { ?>
            
            
                <!-- preloader sniper  -->
                <div  id="prelaoder-sniper"  class="sniperloader">
                  Loading...
                  <div class="ball"></div>
                  <div class="ball"></div>
                  <div class="ball"></div>
                </div>
                
            <?php } ?>            
            
	    </div>
        
    <?php } ?>
   
    

    
    <?php if ( ep_opt('notification_display') == 1) {  ?>

        <!-- notification bar  -->
        <div id="notification" class="visible-desktop">
            <div class="container">
        
                <!-- notification bar - message  -->
                <div class="notificationMessage">
                    
                    
                    <?php if ( ep_opt('notification_icon') ) { ?> 
                        <!-- notification bar - icon  -->
                        <div class="notificationIcon icon-<?php ep_eopt('notification_icon'); ?>"></div> 
                    <?php } ?>
                    
                    <?php if ( ep_opt('notification_title') ) { ?>
                         <!-- notification bar - title  -->
                         <div class="notificationTitle">
                            <?php ep_eopt('notification_title'); ?>
                         </div>
                    <?php } ?>
                    
                    <?php if ( ep_opt('notification_text') ) { ?>
                         <!-- notification bar - text  -->
                         <div class="notificationText">
                            <?php ep_eopt('notification_text'); ?>
                         </div>
                    <?php } ?>

                </div>

                <!-- notification bar - buttons  -->
                <div class="notificationBtns">

                    <a class="closebtn icon-close" href="#"></a>
                    
                </div>
            </div>
        </div>

    <?php } ?>