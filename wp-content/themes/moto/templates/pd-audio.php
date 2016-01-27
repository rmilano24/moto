<?php

//Parse the content for the first occurrence of video url
$audio = ep_extract_audio_info(ep_get_meta('audio-url'));

if($audio != null)
{
    //Extract video ID
    ?>
    <div class="post-media audio-frame">
        <?php
        echo ep_soundcloud_get_embed($audio['url']);
        ?>
    </div>
<?php
}?>