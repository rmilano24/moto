<?php get_template_part( 'templates/loop', "blog-meta" ); ?>
<div class="post-content">
    <?php
    //Parse the content for the first occurrence of video url
    $audio = ep_extract_audio_info(get_post_meta(get_the_ID(), 'audio-url', true ));

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
