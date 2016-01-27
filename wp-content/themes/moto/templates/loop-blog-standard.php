<?php get_template_part( 'templates/loop', "blog-meta" ); ?>
<div class="post-content">

    <?php
    //Post thumbnail
    if ( function_exists('has_post_thumbnail') && has_post_thumbnail() ) { ?>
    <div class="post-media">
        <a class="post-image" title="<?php echo esc_attr(get_the_title()); ?>" href="<?php the_permalink(); ?>"><?php the_post_thumbnail(); ?></a>
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