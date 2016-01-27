<?php 
    
   $headerPosition = ep_opt('header-position');
   $headerStyle = ep_opt('header-style'); 
   $heaerStyleDefault = 'fixed-menu';
   $search = ep_opt('menu-search');

   //get menu hover Style option
   $menu_hover_style = ep_opt('menu-hover-style');
   if ( $menu_hover_style == '0') {
        $menuHoverStyle = 'borderhover';
   } else {
        $menuHoverStyle = 'fillhover';
   }

    if($headerStyle == 'epico-menu' && ep_opt('home-display-switch') !== 1)
        $headerStyle = "fixed-menu";

?>

<?php if ( $headerPosition == 1 ) { // defualt positon Header - top Style ?>  

    <?php if ( $headerStyle == 'wave-menu') { ?>

        <!-- Header Navigation  -->
        <header id="epHeader" class="wave-menu-header">
	        <div class="wrap headerWrap">

                <div class="wave-menu  hidden-tablet hidden-phone">  
		            <div class="menu-wrap">

                        <nav class="navigation menu">

                            <!-- Secound Logo -->
				            <?php $logoSecond = ep_opt('logo-second') == "" ? THEME_ASSETS_URI . "/content/img/logo.png" : ep_opt('logo-second'); ?>

				            <a class="locallink logo" href="<?php echo get_site_url(); ?>/#home">
					            <img  class="secoundLogo" src="<?php echo esc_url($logoSecond); ?>" alt="Logo" />
				            </a>
                            
                            <a class="externalLink logo" href="<?php echo get_site_url(); ?>">
					            <img  class="secoundLogo" src="<?php echo esc_url($logoSecond); ?>" alt="Logo" />
				            </a>
                            
                            <div class="menu-list">

                                <?php
					                wp_nav_menu(array(
						                'container' =>'',
						                'menu_class' => 'clearfix',
						                'before'     => '',
                                        'menu_class' => 'menu-list',
						                'theme_location' => 'primary-nav',
						                'walker'     => new Ep_Nav_Walker(),
						                'fallback_cb' => false , 
                                        'after' => ''
					                ));
					            ?>
                    
                            </div>

			            </nav>

			            <div class="morph-shape" id="morph-shape" data-morph-open="M0,100h1000V0c0,0-136.938,0-224,0C583,0,610.924,0,498,0C387,0,395,0,249,0C118,0,0,0,0,0V100z">
				            <svg xmlns="http://www.w3.org/2000/svg" width="100%" height="100%" viewBox="0 0 1000 100" preserveAspectRatio="none">

                                <path d="m1,100.5l1000,0l0,0c0,0-136.93799,-102-224,-102c-156,-3 -195.23499,27.74399 -260,54c-72.76501,30.25601-120,48-236,47c-116,1-280,1-280,1l0,0z" transform="rotate(180 499,46.375)"/>
  
                            </svg>
			            </div>

		            </div>
                </div> 

		        <!-- menu button -->
                <div class="container clearfix">
                <?php
                $toggle_menu_style = (ep_opt('toggle-menu-style') == 1) ? 'light':'dark';
                ?>
                <a id="open-button" class="hidden-tablet hidden-phone link-menu trigger <?php echo esc_attr($toggle_menu_style); ?>"><span>Menu</span></a>
            
                <?php   
          
                    //Check if WooCommerce is active
                    if ( class_exists( 'WooCommerce' ) ) {
                                    
                        /*  woocomerce drop down cart widget */
                        dynamic_sidebar( 'woocommerce_dropdown_cart' );

                        if (class_exists('YITH_WCWL')) { /*  woocomerce wishlist widget */
                            dynamic_sidebar( 'woocommerce_wishlist' );
                        }
                                   
                    }
                   
                ?>

                <!-- Show search button -->
                <?php
                if($search == 1)
                {
                     ?>
                    <span class="search-button icon-search4 no-select <?php if(ep_opt('search-button-style') ==1) { echo 'light-icon '; }; if ( is_active_sidebar( 'woocommerce_dropdown_cart' ) ) { echo "has_dropdown_cart"; }  if ( is_active_sidebar( 'woocommerce_wishlist' ) ) { echo " has_wishlist"; } ?>"></span>
                     <?php
                }
                ?>

                <a id="phoneNav" class="navigation-button hidden-desktop no_djax" href="#">
                    <span id="phoneNavIcon" class="icon-menu"></span>
                </a>

                <a class="locallink logo res-logo" href="<?php echo get_site_url(); ?>/#home">
                    <img  class="secoundLogo" src="<?php echo esc_url($logoSecond); ?>" alt="Logo" />
                </a>
                
                <a class="externalLink logo res-logo" href="<?php echo get_site_url(); ?>">
                    <img  class="secoundLogo" src="<?php echo esc_url($logoSecond); ?>" alt="Logo" />
                </a>
                </div>

                <?php
                    //Because it pushes the entire content to a side, it should be placed outside of layout element
                    get_template_part( 'templates/navigation-mobile' );
                ?>

            </div>
        </header>

    <?php }  else  {   // if Menu style is Sticky - hybrid - Scroll to Fade_in ?>

        <!-- Header Navigation  -->
        <header id="epHeader" data-fixed="<?php  if ( isset($headerStyle) ) { echo esc_attr($headerStyle); } else { echo $heaerStyleDefault; } ?>"  class="<?php echo $menuHoverStyle ; ?> <?php echo $headerStyle; ?>" >
	        <div class="wrap headerWrap">
		        <div id="headerSecondState">
	
			        <!--menu background color -->
			        <div id="menuBgColor"></div>
		
			        <div class="container clearfix">

				        <!-- Secound Logo -->
				        <?php $logoSecond = ep_opt('logo-second') == "" ? THEME_ASSETS_URI . "/content/img/logo.png" : ep_opt('logo-second'); ?>

				        <a class="locallink logo" href="<?php echo get_site_url(); ?>/#home">
					        <img  class="secoundLogo" src="<?php echo esc_url($logoSecond); ?>" alt="Logo" />
				        </a>
                        
                        <a class="externalLink logo" href="<?php echo get_site_url(); ?>">
					        <img  class="secoundLogo" src="<?php echo esc_url($logoSecond); ?>" alt="Logo" />
				        </a>

                        <?php   
          
                            //Check if WooCommerce is active
                            if ( class_exists( 'WooCommerce' ) ) {
                                    
                                /*  woocomerce drop down cart widget */
                                dynamic_sidebar( 'woocommerce_dropdown_cart' );

                                if (class_exists('YITH_WCWL')) { /*  woocomerce wishlist widget */
                                    dynamic_sidebar( 'woocommerce_wishlist' );
                                }
                                   
                            }
                   
                        ?>

                        <!-- Show search button -->
                        <?php
                        if($search == 1)
                        {
                             ?>
                                <span class="search-button icon-search4 no-select <?php if(ep_opt('search-button-style') ==1) { echo 'light-icon '; }; if ( is_active_sidebar( 'woocommerce_dropdown_cart' ) ) { echo "has_dropdown_cart "; } if ( is_active_sidebar( 'woocommerce_wishlist' ) ) { echo " has_wishlist"; } ?>"></span>
                             <?php
                        }
                        ?>

                        <nav class="navigation hidden-tablet hidden-phone">

					        <?php
					            wp_nav_menu(array(
						            'container' =>'',
						            'menu_class' => 'clearfix',
						            'before'     => '',
						            'theme_location' => 'primary-nav',
						            'walker'     => new Ep_Nav_Walker(),
						            'fallback_cb' => false , 
                                    'after' => ''
					            ));
					        ?>

				        </nav>
                
				        <a	id="phoneNav" class="navigation-button hidden-desktop no_djax" href="#">
					        <span id="phoneNavIcon" class="icon-menu"></span>
				        </a>

			        </div>
		        </div>	
		
		        <?php  if ( isset($headerStyle)) { 
				        if ( $headerStyle == 'epico-menu' ) { ?>  
				
				        <div id="headerFirstState">
				
				        <!--menu background color -->
				        <div class="menuBgColor"></div>
			
					        <div class="container clearfix">
						
						        <!-- First Logo -->
						        <?php $logo = ep_opt('logo') == "" ? THEME_ASSETS_URI . "/content/img/logo.png" : ep_opt('logo'); ?>

						        <a class="locallink logo" href="<?php echo get_site_url(); ?>/#home">
							        <img  class="firstLogo" src="<?php echo esc_url($logo); ?>" alt="Logo" />
						        </a>
                                
                                <a class="externalLink logo" href="<?php echo get_site_url(); ?>">
							        <img  class="firstLogo" src="<?php echo esc_url($logo); ?>" alt="Logo" />
						        </a>
                
                                <?php   
           
                                    // Check if WooCommerce is active
                                    
                                    if ( class_exists( 'WooCommerce' ) ) {
                                    
                                        /*  woocomerce drop down cart widget */
                                        dynamic_sidebar( 'woocommerce_dropdown_cart' );

                                        if (class_exists('YITH_WCWL')) { /*  woocomerce wishlist widget */
                                            dynamic_sidebar( 'woocommerce_wishlist' );
                                        }
                                   
                                    }
                                    
                                ?>
                                
                                
                                <nav class="navigation hidden-tablet hidden-phone">

					                <?php
					                    wp_nav_menu(array(
						                    'container' =>'',
						                    'menu_class' => 'clearfix',
						                    'before'     => '',
						                    'theme_location' => 'primary-nav',
						                    'walker'     => new Ep_Nav_Walker(),
						                    'fallback_cb' => false , 
                                            'after' => ''
					                    ));
					                ?>

				                </nav>
                                
                        
					        </div>
				        </div>	
				
			        <?php  } 
		         } ?>
         
         
                <?php
                    //Because it pushes the entire content to a side, it should be placed outside of layout element
                    get_template_part( 'templates/navigation-mobile' );

                ?>

	        </div>
        </header>
        <!-- Header Navigation End -->
    
    <?php } ?>
    
<?php } else if ($headerPosition == 2 ) { // left menu  ?>
    

        <!-- tablet menu -->
        <header id="epHeader" class="hidden-desktop" >
            <div class="wrap headerWrap">
                <div id="headerSecondState">
    
                    <!--menu background color -->
                    <div id="menuBgColor"></div>
        
                    <div class="container clearfix">

                        <!-- Secound Logo -->
                        <?php $logoSecond = ep_opt('logo-second') == "" ? THEME_ASSETS_URI . "/content/img/logo.png" : ep_opt('logo-second'); ?>

                        <a class="locallink logo" href="<?php echo get_site_url(); ?>/#home">
                            <img  class="secoundLogo" src="<?php echo esc_url($logoSecond); ?>" alt="Logo" />
                        </a>
                        
                        <a class="externalLink logo" href="<?php echo get_site_url(); ?>">
                            <img  class="secoundLogo" src="<?php echo esc_url($logoSecond); ?>" alt="Logo" />
                        </a>

                        <!-- Show search button -->
                        <?php
                        if($search == 1)
                        {
                             ?>
                            <span class="search-button icon-search4 no-select hidden-desktop <?php if(ep_opt('search-button-style') ==1) { echo 'light-icon '; }; if ( is_active_sidebar( 'woocommerce_dropdown_cart' ) ) { echo "has_dropdown_cart"; }  if ( is_active_sidebar( 'woocommerce_wishlist' ) ) { echo " has_wishlist"; } ?>"></span>
                             <?php
                        }
                        ?>

                        <a  id="phoneNav" class="navigation-button hidden-desktop no_djax" href="#">
                            <span id="phoneNavIcon" class="icon-menu"></span>
                        </a>

                    </div>
                </div>  
        
         
                <?php
                    //Because it pushes the entire content to a side, it should be placed outside of layout element
                    get_template_part( 'templates/navigation-mobile' );

                ?>

            </div>
        </header>
        <!-- tablet menu End -->

    <aside class="vertical_menu_area visible-desktop left_menu" style="background_image=''">

        <!-- Secound Logo -->
        <?php $logoSecond = ep_opt('logo-second') == "" ? THEME_ASSETS_URI . "/content/img/logo.png" : ep_opt('logo-second'); ?>
    
        <!-- background Image -->
        <?php $backgroundImage = ep_opt('vertical_menu_background'); ?> 
   
        <?php if ($backgroundImage) { ?>
            <div class="vertical_background_image" style="background-image:url('<?php echo esc_url($backgroundImage); ?>')"></div>    
        <?php } ?>
    
        <a class="locallink logo" href="<?php echo get_site_url(); ?>/#home">
	        <img  class="secoundLogo" src="<?php echo esc_url($logoSecond); ?>" alt="Logo" />
        </a>
        
       <a class="externalLink logo" href="<?php echo get_site_url(); ?>">
	        <img  class="secoundLogo" src="<?php echo esc_url($logoSecond); ?>" alt="Logo" />
        </a>
        
        <div class="set_nav_center">
            <div class="nav_tablecell_elemnt">
             
                <nav class="vertical_menu_navigation">
    
                    <div class="nav_border"></div>
        
                        <?php
                            wp_nav_menu(array(
	                            'container' =>'',
	                            'menu_class' => 'clearfix',
	                            'before'     => '',
	                            'theme_location' => 'primary-nav',
	                            'walker'     => new Ep_Nav_Walker(),
	                            'fallback_cb' => false,
                                'after' => ''
                            ));
                        ?>
                            
 
                        <?php   
          
                            //Check if WooCommerce is active
                            if ( class_exists( 'WooCommerce' ) ) {
                                    
                                /*  woocomerce drop down cart widget */
                                dynamic_sidebar( 'woocommerce_dropdown_cart' );

                                if (class_exists('YITH_WCWL')) { /*  woocomerce wishlist widget */
                                    dynamic_sidebar( 'woocommerce_wishlist' );
                                }
                                   
                            }
                   
                        ?>
                
                </nav>

                <!-- Show search button -->
                <?php
                if($search == 1)
                {
                     ?>
                    <span class="search-button icon-search4 no-select  <?php if(ep_opt('search-button-style') ==1) { echo 'light-icon '; }; if ( is_active_sidebar( 'woocommerce_dropdown_cart' ) ) { echo "has_dropdown_cart"; }  if ( is_active_sidebar( 'woocommerce_wishlist' ) ) { echo " has_wishlist"; } ?>"></span>
                     <?php
                }
                ?>
        
            </div>
        </div>
        
        <!-- Footer Social Link  -->
        <div class="vertical_menu_social">
            <?php
                $social_icons_style = (ep_opt('social-icon-style') == 1) ? 'light':'dark';
            ?>
            <ul class="social-icons <?php echo esc_attr($social_icons_style); ?>">
                                
                <?php
                    ep_socialIcon('social_facebook_url', __('Facebook Profile', 'epicomedia'), 'icon-facebook3' , 'facebook');//Facebook
                    ep_socialIcon('social_twitter_url', __('Twitter Profile', 'epicomedia'), 'icon-twitter2' , 'twitter'); // Twitter
                    ep_socialIcon('social_vimeo_url', __('Vimeo Profile', 'epicomedia'), 'icon-vimeo' , 'vimeo'); // Vimeo
                    ep_socialIcon('social_youtube_url', __('YouTube Profile', 'epicomedia'), 'icon-youtube' , 'youtube'); // Youtube
                    ep_socialIcon('social_googleplus_url', __('Google+ Profile', 'epicomedia'), 'icon-googleplus2' , 'googleplus2'); //Google+
                    ep_socialIcon('social_dribbble_url', __('Dribbble Profile', 'epicomedia'), 'icon-dribbble2', 'dribbble2');//Dribbble
                    ep_socialIcon('social_tumblr_url', __('Tumblr Profile', 'epicomedia'), 'icon-tumblr2', 'tumblr2');//Tumblr
                    ep_socialIcon('social_linkedin_url', __('Linkedin Profile', 'epicomedia'), 'icon-linkedin2', 'linkedin2');//Linkedin
                    ep_socialIcon('social_flickr_url', __('Flickr Profile', 'epicomedia'), 'icon-flickr2', 'flickr2');//flickr
                    ep_socialIcon('social_forrst_url', __('Forrst Profile', 'epicomedia'), 'icon-forrst' , 'forrst');//forrst
                    ep_socialIcon('social_github_url', __('Github Profile', 'epicomedia'), 'icon-github' , 'github5');//github
                    ep_socialIcon('social_lastfm_url', __('LastFM Profile', 'epicomedia'), 'icon-lastfm', 'lastfm');//lastfm
                    ep_socialIcon('social_paypal_url', __('Paypal Profile', 'epicomedia'), 'icon-paypal', 'paypal');//paypal
                    ep_socialIcon('social_rss_url', __('RSS Feed', 'epicomedia'), 'icon-feed2', 'feed2');//rss
                    ep_socialIcon('social_skype_url', __('Skype  Profile', 'epicomedia'), 'icon-skype' , 'skype');//skype
                    ep_socialIcon('social_wordpress_url', __('WordPress Profile', 'epicomedia'), 'icon-wordpress', 'wordpress');//wordpress
                    ep_socialIcon('social_yahoo_url', __('Yahoo Profile', 'epicomedia'), 'icon-yahoo' , 'yahoo');//Yahoo
                    ep_socialIcon('social_deviantart_url', __('Deviantart', 'epicomedia'), 'icon-deviantart', 'deviantart');//Deviantart
                    ep_socialIcon('social_steam_url', __('Steam Profile', 'epicomedia'), 'icon-steam', 'steam');//steam
                    ep_socialIcon('social_reddit_url', __('Reddit Profile', 'epicomedia'), 'icon-reddit' , 'reddit');//reddit
                    ep_socialIcon('social_stumbleupon_url', __('StumbleUpon Profile', 'epicomedia'), 'icon-stumbleupon' , 'stumbleupon');//stumbleupon
                    ep_socialIcon('social_pinterest_url', __('Pinterest Profile', 'epicomedia'), 'icon-pinterest', 'pinterest');//Pinterest
                    ep_socialIcon('social_xing_url', __('Xing Profile', 'epicomedia'), 'icon-xing', 'xing');//xing
                    ep_socialIcon('social_blogger_url', __('Blogger Profile', 'epicomedia'), 'icon-blogger', 'blogger');//blogger
                    ep_socialIcon('social_soundcloud_url', __('SoundCloud Profile', 'epicomedia'), 'icon-soundcloud', 'soundcloud');//soundcloud
                    ep_socialIcon('social_delicious_url', __('Delicious Profile', 'epicomedia'), 'icon-delicious', 'delicious');//delicious
                    ep_socialIcon('social_foursquare_url', __('FourSquare Profile', 'epicomedia'), 'icon-foursquare', 'foursquare');//foursquare
                    ep_socialIcon('social_instagram_url', __('Instagram Profile', 'epicomedia'), 'icon-instagram', 'instagram');//instagram
                    ep_socialIcon('social_behance_url', __('Behance profile', 'epicomedia'), 'icon-behance', 'behance');//Behance
					ep_socialIcon('social_custom1_url', __('Custom Profile', 'epicomedia'), 'icon-custom1' , 'custom1');//Custom 1
					ep_socialIcon('social_custom2_url', __('Custom Profile', 'epicomedia'), 'icon-custom2' , 'custom2');//Custom 2
                ?>
                        
            </ul>
        </div>
                    
    </aside>

<?php } else if ($headerPosition == 3 ) { //right menu  ?>


    <!-- tablet menu -->
    <header id="epHeader" class="hidden-desktop " >
        <div class="wrap headerWrap">
            <div id="headerSecondState">

                <!--menu background color -->
                <div id="menuBgColor"></div>

                <div class="container clearfix">

                    <!-- Secound Logo -->
                    <?php $logoSecond = ep_opt('logo-second') == "" ? THEME_ASSETS_URI . "/content/img/logo.png" : ep_opt('logo-second'); ?>

                    <a class="locallink logo" href="<?php echo get_site_url(); ?>/#home">
                        <img  class="secoundLogo" src="<?php echo esc_url($logoSecond); ?>" alt="Logo" />
                    </a>
                    
                    <a class="externalLink logo" href="<?php echo get_site_url(); ?>">
                        <img  class="secoundLogo" src="<?php echo esc_url($logoSecond); ?>" alt="Logo" />
                    </a>

                    <!-- Show search button -->
                    <?php
                    if($search == 1)
                    {
                         ?>
                        <span class="search-button icon-search4 no-select hidden-desktop <?php if(ep_opt('search-button-style') ==1) { echo 'light-icon '; }; if ( is_active_sidebar( 'woocommerce_dropdown_cart' ) ) { echo "has_dropdown_cart"; }  if ( is_active_sidebar( 'woocommerce_wishlist' ) ) { echo " has_wishlist"; } ?>"></span>
                         <?php
                    }
                    ?>

                    <a  id="phoneNav" class="navigation-button hidden-desktop no_djax" href="#">
                        <span id="phoneNavIcon" class="icon-menu"></span>
                    </a>


                </div>
            </div>  

     
            <?php
                //Because it pushes the entire content to a side, it should be placed outside of layout element
                get_template_part( 'templates/navigation-mobile' );

            ?>

        </div>
    </header>
    <!-- tablet menu End -->


    <aside class="vertical_menu_area visible-desktop left_menu">

        <!-- Secound Logo -->
        <?php $logoSecond = ep_opt('logo-second') == "" ? THEME_ASSETS_URI . "/content/img/logo.png" : ep_opt('logo-second'); ?>

        <!-- background Image -->
        <?php $backgroundImage = ep_opt('vertical_menu_background'); ?> 
   
        <?php if ($backgroundImage) { ?>
            <div class="vertical_background_image" style="background-image:url('<?php echo esc_url($backgroundImage); ?>')"></div>    
        <?php } ?>
    
        <a class="locallink logo" href="<?php echo get_site_url(); ?>/#home">
	        <img  class="secoundLogo" src="<?php echo esc_url($logoSecond); ?>" alt="Logo" />
        </a>
        
        <a class="externalLink logo" href="<?php echo get_site_url(); ?>">
	        <img  class="secoundLogo" src="<?php echo esc_url($logoSecond); ?>" alt="Logo" />
        </a>
    
        <div class="set_nav_center">
            <div class="nav_tablecell_elemnt">
        
            <nav class="vertical_menu_navigation">
    
                <div class="nav_border"></div>
        
                    <?php
                        wp_nav_menu(array(
	                        'container' =>'',
	                        'menu_class' => 'clearfix',
	                        'before'     => '',
	                        'theme_location' => 'primary-nav',
	                        'walker'     => new Ep_Nav_Walker(),
	                        'fallback_cb' => false,
                            'after' => ''
                        ));
                    ?>
                
                
                    <?php   
          
                        //Check if WooCommerce is active
                        if ( class_exists( 'WooCommerce' ) ) {
                                    
                            /*  woocomerce drop down cart widget */
                            dynamic_sidebar( 'woocommerce_dropdown_cart' );

                            if (class_exists('YITH_WCWL')) { /*  woocomerce wishlist widget */
                                dynamic_sidebar( 'woocommerce_wishlist' );
                            }
                                   
                        }
                   
                    ?>
                
            </nav>

            <!-- Show search button -->
            <?php
            if($search == 1)
            {
                 ?>
                <span class="search-button icon-search4 no-select <?php if(ep_opt('search-button-style') ==1) { echo 'light-icon '; }; if ( is_active_sidebar( 'woocommerce_dropdown_cart' ) ) { echo "has_dropdown_cart"; }  if ( is_active_sidebar( 'woocommerce_wishlist' ) ) { echo " has_wishlist"; } ?>"></span>
                 <?php
            }
            ?>

            </div>  
        </div>    
        
        <!-- Footer Social Link  -->
        <div class="vertical_menu_social">
            <?php
                $social_icons_style = (ep_opt('social-icon-style') == 1) ? 'light':'dark';
            ?>
            <ul class="social-icons <?php echo esc_attr($social_icons_style); ?>">
                                
                <?php
                    ep_socialIcon('social_facebook_url', __('Facebook Profile', 'epicomedia'), 'icon-facebook3' , 'facebook');//Facebook
                    ep_socialIcon('social_twitter_url', __('Twitter Profile', 'epicomedia'), 'icon-twitter2' , 'twitter'); // Twitter
                    ep_socialIcon('social_vimeo_url', __('Vimeo Profile', 'epicomedia'), 'icon-vimeo' , 'vimeo'); // Vimeo
                    ep_socialIcon('social_youtube_url', __('YouTube Profile', 'epicomedia'), 'icon-youtube' , 'youtube'); // Youtube
                    ep_socialIcon('social_googleplus_url', __('Google+ Profile', 'epicomedia'), 'icon-googleplus2' , 'googleplus2'); //Google+
                    ep_socialIcon('social_dribbble_url', __('Dribbble Profile', 'epicomedia'), 'icon-dribbble2', 'dribbble2');//Dribbble
                    ep_socialIcon('social_tumblr_url', __('Tumblr Profile', 'epicomedia'), 'icon-tumblr2', 'tumblr2');//Tumblr
                    ep_socialIcon('social_linkedin_url', __('Linkedin Profile', 'epicomedia'), 'icon-linkedin2', 'linkedin2');//Linkedin
                    ep_socialIcon('social_flickr_url', __('Flickr Profile', 'epicomedia'), 'icon-flickr2', 'flickr2');//flickr
                    ep_socialIcon('social_forrst_url', __('forrst Profile', 'epicomedia'), 'icon-forrst' , 'forrst');//forrst
                    ep_socialIcon('social_github_url', __('github Profile', 'epicomedia'), 'icon-github' , 'github5');//github
                    ep_socialIcon('social_lastfm_url', __('lastfm Profile', 'epicomedia'), 'icon-lastfm', 'lastfm');//lastfm
                    ep_socialIcon('social_paypal_url', __('paypal Profile', 'epicomedia'), 'icon-paypal', 'paypal');//paypal
                    ep_socialIcon('social_rss_url', __('RSS Feed', 'epicomedia'), 'icon-feed2', 'feed2');//rss
                    ep_socialIcon('social_skype_url', __('skype  Profile', 'epicomedia'), 'icon-skype' , 'skype');//skype
                    ep_socialIcon('social_wordpress_url', __('wordpres Profile', 'epicomedia'), 'icon-wordpress', 'wordpress');//wordpress
                    ep_socialIcon('social_yahoo_url', __('yahoo Profile', 'epicomedia'), 'icon-yahoo' , 'yahoo');//Yahoo
                    ep_socialIcon('social_deviantart_url', __('deviantart', 'epicomedia'), 'icon-deviantart', 'deviantart');//Deviantart
                    ep_socialIcon('social_steam_url', __('steam Profile', 'epicomedia'), 'icon-steam', 'steam');//steam
                    ep_socialIcon('social_reddit_url', __('reddit Profile', 'epicomedia'), 'icon-reddit' , 'reddit');//reddit
                    ep_socialIcon('social_stumbleupon_url', __('stumbleupon Profile', 'epicomedia'), 'icon-stumbleupon' , 'stumbleupon');//stumbleupon
                    ep_socialIcon('social_pinterest_url', __('pinterest Profile', 'epicomedia'), 'icon-pinterest', 'pinterest');//Pinterest
                    ep_socialIcon('social_xing_url', __('xing Profile', 'epicomedia'), 'icon-xing', 'xing');//xing
                    ep_socialIcon('social_blogger_url', __('blogger Profile', 'epicomedia'), 'icon-blogger', 'blogger');//blogger
                    ep_socialIcon('social_soundcloud_url', __('soundcloud Profile', 'epicomedia'), 'icon-soundcloud', 'soundcloud');//soundcloud
                    ep_socialIcon('social_delicious_url', __('delicious Profile', 'epicomedia'), 'icon-delicious', 'delicious');//delicious
                    ep_socialIcon('social_foursquare_url', __('foursquare Profile', 'epicomedia'), 'icon-foursquare', 'foursquare');//foursquare
                    ep_socialIcon('social_instagram_url', __('instagram Profile', 'epicomedia'), 'icon-instagram', 'instagram');//foursquare
                    ep_socialIcon('social_behance_url', __('behance profile', 'epicomedia'), 'icon-behance', 'behance');//Behance
					ep_socialIcon('social_custom1_url', __('Custom Profile', 'epicomedia'), 'icon-custom1' , 'custom1');//Custom 1
					ep_socialIcon('social_custom2_url', __('Custom Profile', 'epicomedia'), 'icon-custom2' , 'custom2');//Custom 2

                ?>
                        
            </ul>
        </div>
    
    </aside>
    
<?php }

if($search == 1)
{
    ?>
    <div id="search-form">
        <?php
            get_search_form();
        ?>
        <span id="search-caption"><?php _e('Type and press enter', 'epicomedia'); ?> </span>
    </div>
    <?php
}
    

?>