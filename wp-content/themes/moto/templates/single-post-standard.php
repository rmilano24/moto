<?php 
     //check social share is Enable or not
    $socialshare = get_post_meta( get_the_ID(), "post-social-share", true );
?>
<div <?php post_class(); ?>>

    <?php //Post thumbnail
        if ( function_exists('has_post_thumbnail') && has_post_thumbnail() ) { ?>
        <div class="post-media">
            <div class="post-media">
                <?php the_post_thumbnail('full'); ?>
            </div>
        </div>
    <?php }?>
   
    
    <?php
        get_template_part( 'templates/single', "post-meta" );
        the_content();
        wp_link_pages();
    ?>
    
    <!-- nav box And Social share -->
    <div class="nav_box">
        <?php echo next_post_link('%link', '<div class="button right"><div class="frame top"><div></div></div><div class="frame right"><div></div></div><div class="frame bottom"><div></div></div><div class="frame left"><div></div></div><span class="txt">'.__('NEXT', 'epicomedia').'</span></div>'); ?>
        <?php echo previous_post_link('%link', '<div class="button right"><div class="frame top"><div></div></div><div class="frame right"><div></div></div><div class="frame bottom"><div></div></div><div class="frame left"><div></div></div><span class="txt">' .__('PREV', 'epicomedia').'</span></div>'); ?>
    </div>

</div>

<?php if ($socialshare== 1 )  { ?>

    <div class="bd_socail_share">
        <!-- social share buttons -->
        <div class="socialShareContainer">
            <div class="social_share_toggle">
                <i class="icon-share2"></i>
                <?php get_template_part('templates/social-share'); ?>
            </div>
        </div>    
    </div>
    
<?php } ?>

<div class="commentWrap">
    <?php
        $num_comments = get_comments_number();
        if ( $num_comments == 0 ) { } else { ?>
            <div class="commentTitle">
                <h3>
                    <span class="comment_count">
                        <?php comments_popup_link( __('0', 'epicomedia' ) , __('01', 'epicomedia' ) , __('%', 'epicomedia' ) ); ?>
                    </span>
                    <?php _e("COMMENTS", 'epicomedia'); ?>
                </h3>
            </div>
    <?php }  comments_template('', true); ?>
</div>