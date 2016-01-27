<?php 
    
    // Get Page Post Id
    $post_id = get_the_ID();
    
    // Visual Composer option , true if Visual composer is be Active in page
    $wpb_vc_js_status = get_post_meta( $post_id, "_wpb_vc_js_status", true );
    
?>

<!-- Custom Section  -->
<section class="epicoSection customSection">
    <h1 style="display:none!important"><?php the_title(); ?> </h1>
    <div id="<?php echo esc_attr($post->post_name);?>" class="wrap">
        <div class="container clearfix">

            <!-- headr title And Subtitle -->
            <?php
                $checkTitle = get_post_meta( get_the_ID(), "title-bar", true );
                $title = get_post_meta( get_the_ID(), "title-text", true );
                $subTitle = get_post_meta( get_the_ID() , "subtitle-text", true );
            ?>
            
            <?php  if ( (!empty( $subTitle ) || !empty( $title ) ) || $checkTitle == 2 ) { ?>
            
                <?php if ( $checkTitle == 1 ) { ?>
                    <div class="titleSpace">
                    
                        <?php if ( ( $checkTitle == 1 ) && ! empty( $title )) { ?>
                                
                            <div class="title"><h3><?php echo esc_attr($title); ?></h3></div>
                    
                        <?php } if (  ( $checkTitle == 1 ) && ! empty( $subTitle ) ) { ?>
                         
                            <div class="subtitle"><?php echo esc_attr($subTitle) ; ?></div>
                         
                        <?php } ?>
                        
                    </div>
                <?php }  if ( $checkTitle == 2  ) { ?>
                    
                    <div class="titleSpace">
                        <div class="title"><h3><?php the_title(); ?></h3></div>
                    </div>
                    
               <?php } ?>
               
            <?php } ?>

        </div>

       <?php  
        
            if ( $wpb_vc_js_status == 'false' || $wpb_vc_js_status == '' ) { ?>
            
                <!-- container div Add when Classic Editor is Enable - Visual Composer not Enable -->
                <div class="container customContent clearfix">
            
        <?php } else { ?>
        
                <div class="customContent clearfix">
                    
        <?php }  ?>
             
            <?php the_content(); ?>
            
        </div>
    </div>
</section>
<!-- End Custom Section  -->
