<?php

	// try getting featured image -  pinterest icon 
	$featured_img = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'full' );
	if( ! $featured_img )
	{
		$featured_img = '';
	}
	else
	{
		$featured_img = $featured_img[0];
	}
    
?>

<div class="social_links">
    <ul class="social_links_list">
        <!-- facebook Social share button -->
        <li>
            <a href="http://www.facebook.com/sharer.php?u=<?php echo urlencode(get_permalink(get_the_ID()))?>" onclick="return popitup(this.href, this.title)" title="<?php _e('Share on Facebook!','epicomedia') ?>">
                <i class="icon-facebook3"></i>
            </a>
        </li>
                                    
        <!-- google plus social share button -->
        <li>
            <a href="https://plus.google.com/share?url=<?php echo urlencode(get_permalink(get_the_ID()))?>" onclick="return popitup(this.href, this.title)" title="<?php _e('Share on Google+!','epicomedia') ?>">
                <i class="icon-googleplus2"></i>
            </a>
        </li>
                                    
        <!-- twitter icon  --> 
        <li>
            <a href="https://twitter.com/intent/tweet?original_referer=<?php echo urlencode(get_permalink(get_the_ID()))?>&amp;source=tweetbutton&amp;text=<?php echo urlencode(get_the_title())?>&amp;url=<?php echo urlencode(get_permalink(get_the_ID()))?> ?>" onclick="return popitup(this.href, this.title)"
                title="<?php _e('Share on Twitter!', 'epicomedia') ?>">
                <i class="icon-twitter2"></i>
            </a>
        </li>
                        
        <!-- pinterest icon --> 
        <li>
	        <a href="http://pinterest.com/pin/create/button/?url=<?php echo urlencode(get_permalink()); ?>
		        &amp;media=<?php echo esc_attr($featured_img); ?>
		        &amp;description=<?php echo urlencode(get_the_title()); ?>" 
		        class="pin-it-button" 
		        count-layout="horizontal">
		            <i class="icon-pinterest2"></i>
	        </a>
        </li>
                        
    </ul>
</div>
                
                