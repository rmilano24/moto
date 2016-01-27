<?php 
        
$termNames = get_the_term_list( $id , 'skills', '<span>#', '</span>  <span>#', ' </span>' ); // get the item skills

$pPostType = get_post_format();

if($pPostType == false)
{
    $pPostType = "standard";
}

?>
<div <?php post_class(); ?>>
    <!-- Portfolio Detail Title  -->
    <div id="PDetail">

        <div class="pd_creative_fixed_content">
            
            <!--  Portfolio Detail title  -->
            <div class="title_container no-select">

                <?php get_template_part( 'templates/pd-title' ); ?>
                
                <div class="project-subtitle project-skill">
                    <?php echo $termNames ?>
                </div>
            
            </div>

             <?php 
            // get portfolio social share 
            $portfolio_social_share = ep_get_meta('portfolio-social-share');
        
            if( $portfolio_social_share == 1 ) { ?>
                <div class="social_share_container">
                    <!-- portfolio Socail share -->
                    <div class="socialShareContainer">
                        <div class="social_share_toggle">
                            <i class="icon-share2"></i>
                            <?php get_template_part('templates/social-share'); ?>
                        </div>
                    </div>
                </div>
            <?php } ?>
            
        
            <!-- Portfolio Detail content  -->
            <div class="desc<?php if( $portfolio_social_share != 1 ) { echo " pd-no-social";} ?>"> 
                <?php the_content();?> 
            </div>
            <a class="home" href="<?php echo get_site_url(); ?>"></a>

            <div class="like"><?php echo getPostLikeLink($id); ?></div>

            <!-- Portfolio Detail navigation  -->
            <div id="PDnavigation"></div>
            
        </div>
    
         <!--  Portfolio Detail Slider  -->
        <div class="pd_creative_item">
            <div class="pDHeader pDHeader-<?php echo esc_attr($pPostType) ?>">
                <?php
                    if( $pPostType == 'gallery')
                    {
                        get_template_part('templates/pd', 'creative-gallery');
                        
                    } else if ( $pPostType == 'audio' ) {
                    
                        get_template_part('templates/pd', 'audio');
                    
                    } else if ( $pPostType == 'video' ) {
                    
                        get_template_part('templates/pd', 'video');
                        
                    }
                
                ?>
            </div>
        </div>

    </div>
</div>