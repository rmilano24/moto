<?php 
    //footer style
    $style = ep_opt('footerStyle');

    if ( $style == 0) {
        $style = "light";
    } else {
        $style = "dark";
    }
    
?>

<footer class="footer-bottom <?php echo esc_attr($style); ?>">
    <div class="wrap">
        <div class="container">
        
            <!-- Footer Content   -->
            <div class="footer_content <?php if ( !(ep_opt('footer-logo'))) { ?> nologo <?php } ?> <?php if ( !(ep_opt('footer-copyright'))) { ?> nocopyRight <?php } ?>">
                
                <div class="footer_content_left">
                    <div class="copyright_logo">
                                            
                        <?php if ( ep_opt('footer-logo') ) { ?>
            
                            <!-- Footer logo  -->
                            <div class="footerlogo">
                                <img class="secoundLogo" src=" <?php ep_eopt('footer-logo'); ?>" alt="footer_Logo">
                            </div>
                
                        <?php } ?>
                        
                        <?php if ( ep_opt('footer-copyright') ) { ?>
                        
                             <!-- Footer CopyRight   -->
                            <div class="copyright">
                                 <?php ep_eopt('footer-copyright'); ?>
                            </div>
                            
                        <?php } ?>
                                                  
                    </div>
                </div>
            
                <div class="footer_content_right">
                
                    <!-- Footer Social Link  -->
                    <ul class="social-icons">
                                
                        <?php
                            ep_socialLink('social_facebook_url', __('Facebook', 'epicomedia'), 'icon-facebook3' , 'facebook');//Facebook
                            ep_socialLink('social_twitter_url', __('Twitter', 'epicomedia'), 'icon-twitter2' , 'twitter'); // Twitter
                            ep_socialLink('social_vimeo_url', __('Vimeo', 'epicomedia'), 'icon-vimeo' , 'vimeo'); // Vimeo
                            ep_socialLink('social_youtube_url', __('YouTube', 'epicomedia'), 'icon-youtube' , 'youtube'); // Youtube
                            ep_socialLink('social_googleplus_url', __('Google+', 'epicomedia'), 'icon-googleplus2' , 'googleplus2'); //Google+
                            ep_socialLink('social_dribbble_url', __('Dribbble', 'epicomedia'), 'icon-dribbble2', 'dribbble2');//Dribbble
                            ep_socialLink('social_tumblr_url', __('Tumblr', 'epicomedia'), 'icon-tumblr2', 'tumblr2');//Tumblr
                            ep_socialLink('social_linkedin_url', __('LinkedIn', 'epicomedia'), 'icon-linkedin2', 'linkedin2');//Linkedin
                            ep_socialLink('social_flickr_url', __('Flickr', 'epicomedia'), 'icon-flickr2', 'flickr2');//flickr
                            ep_socialLink('social_forrst_url', __('Forrst', 'epicomedia'), 'icon-forrst' , 'forrst');//forrst
                            ep_socialLink('social_github_url', __('Github', 'epicomedia'), 'icon-github' , 'github5');//github
                            ep_socialLink('social_lastfm_url', __('Lastfm', 'epicomedia'), 'icon-lastfm', 'lastfm');//lastfm
                            ep_socialLink('social_paypal_url', __('Paypal', 'epicomedia'), 'icon-paypal', 'paypal');//paypal
                            ep_socialLink('social_rss_url', __('RSS', 'epicomedia'), 'icon-feed2', 'feed2');//rss
                            ep_socialLink('social_skype_url', __('Skype', 'epicomedia'), 'icon-skype' , 'skype');//skype
                            ep_socialLink('social_wordpress_url', __('WordPress', 'epicomedia'), 'icon-wordpress', 'wordpress');//wordpress
                            ep_socialLink('social_yahoo_url', __('Yahoo', 'epicomedia'), 'icon-yahoo' , 'yahoo');//Yahoo
                            ep_socialLink('social_deviantart_url', __('Deviantart', 'epicomedia'), 'icon-deviantart', 'deviantart');//Deviantart
                            ep_socialLink('social_steam_url', __('Steam', 'epicomedia'), 'icon-steam', 'steam');//steam
                            ep_socialLink('social_reddit_url', __('Reddit', 'epicomedia'), 'icon-reddit' , 'reddit');//reddit
                            ep_socialLink('social_stumbleupon_url', __('StumbleUpon', 'epicomedia'), 'icon-stumbleupon' , 'stumbleupon');//stumbleupon
                            ep_socialLink('social_pinterest_url', __('Pinterest', 'epicomedia'), 'icon-pinterest', 'pinterest');//Pinterest
                            ep_socialLink('social_xing_url', __('Xing', 'epicomedia'), 'icon-xing', 'xing');//xing
                            ep_socialLink('social_blogger_url', __('Blogger', 'epicomedia'), 'icon-blogger', 'blogger');//blogger
                            ep_socialLink('social_soundcloud_url', __('Soundcloud', 'epicomedia'), 'icon-soundcloud', 'soundcloud');//soundcloud
                            ep_socialLink('social_delicious_url', __('Delicious', 'epicomedia'), 'icon-delicious', 'delicious');//delicious
                            ep_socialLink('social_foursquare_url', __('FourSquare', 'epicomedia'), 'icon-foursquare', 'foursquare');//foursquare
                            ep_socialLink('social_instagram_url', __('Instagram', 'epicomedia'), 'icon-instagram', 'instagram');//instagram
                            ep_socialLink('social_behance_url', __('Behance', 'epicomedia'), 'icon-behance', 'behance');//Behance
							ep_socialLink('social_custom1_url', 'social_custom1_title', 'icon-custom1', 'custom1');//Custom 1
							ep_socialLink('social_custom2_url', 'social_custom2_title', 'icon-custom2', 'custom2');//Custom 2
                        ?>

                    </ul>
                    
                </div>
            </div>
            
        </div>
    </div>
</footer>
