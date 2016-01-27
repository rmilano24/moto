<?php get_template_part( 'templates/loop', "blog-meta" ); ?>
<div class="post-content">
    <?php
    //Parse the content for the first occurrence of video url
    $video = ep_extract_video_info(get_post_meta(get_the_ID(), 'video-id', true ));
    
    if($video != null)
    {
        $w = 500; $h = 280;
        ep_get_video_meta($video);

        if(array_key_exists('width', $video))
        {
            $w = $video['width'];
            $h = $video['height'];
        }

        //Extract video ID
        ?>
        <div class="post-media video-frame">
        <?php
            if($video['type'] == 'youtube')
                $src = "http://www.youtube.com/embed/" . $video['id'];
            else
                $src = "http://player.vimeo.com/video/" . $video['id'] . "?color=ff4c2f";
        ?>
        <iframe src="<?php echo esc_url($src); ?>" width="<?php echo esc_attr($w); ?>" height="<?php echo esc_attr($h); ?>" frameborder="0" webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe>
        </div>
    <?php
    } else {
        
        echo "<script>alert('haha');</script>";
    
    }
    
    // blog Post text excerpt
    the_excerpt();
?>
    <div class="redmore_line"></div>
    
    <!-- post link button -->
    <a class="redmore_button button right" href="<?php the_permalink(); ?>" title="" target="">
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
            <?php  _e('Read more', 'epicomedia') ?> 
        </span>
    </a>
    
    <?php if(has_tag()){ ?>
        <div class="tagcloud"><?php the_tags('', '', ''); ?></div>
    <?php } ?>
    
</div>
