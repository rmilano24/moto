<?php

//Parse the content for the first occurrence of video url
$video = ep_extract_video_info(ep_get_meta('video-id'));

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
}
?>