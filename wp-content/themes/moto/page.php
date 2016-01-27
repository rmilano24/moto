<?php
    get_header();

    // menu
    get_template_part('templates/section', 'nav');

    //Get the sidebar option
    $sidebarPos = ep_opt('sidebar-position');
    $sidebar    = ep_get_meta('sidebar');

    // Get Page Post Id
    $post_id = get_the_ID();
?>

<!-- main-content wrap pass to djax -->
<div class="main-content" id="main-content">
    <?php get_template_part('templates/head'); ?>
    <!-- Page Content-->
    <div class="wrap" id="pageHeight">
        
    <?php  if(function_exists('is_checkout') && is_checkout() ) {   ?>
        <div class="container">
    <?php } ?>
        
                <div class="pageTopSpace"></div>
            <?php

            if ( get_post_meta( $post_id, "page-type-switch", true ) == "custom-section" ) {

                 if($sidebar == 'no-sidebar' ) { ?>

                 <?php  
         
                    $wpb_vc_js_status = get_post_meta( $post_id, "_wpb_vc_js_status", true );
                    if ( $wpb_vc_js_status == 'false' || $wpb_vc_js_status == '' ) { ?>
            
                        <!-- container div Add when Classic Editor is Enable - Visual Composer not Enable -->
                        <div class="container">
            
                <?php } ?>

                    <?php  get_template_part('templates/loop-page'); ?>

                <?php  if ( $wpb_vc_js_status == 'false' || $wpb_vc_js_status == '') {  ?>
                    <!-- container div Add when Classic Editor is Enable -->
                    </div>
                <?php } ?>
  
                <?php } else {

                    $contentClass = 'span9';
                    $sidebarContainerClass = 'span3';
                    if(1 == $sidebarPos)
                        $contentClass .= ' float-right';
                ?>

                <div class="pageHasSidebar container pageBottomSpace">
                    <div class="row">
                        <div class="<?php echo esc_attr($contentClass); ?>"><?php get_template_part('templates/loop-page'); ?></div>
                        <div class="<?php echo esc_attr($sidebarContainerClass); ?>"><?php ep_get_sidebar($sidebar); ?></div>
                    </div>
                </div>

                <?php }

            }  else if ( get_post_meta( $post_id, "page-type-switch", true ) == "blog-section" ){ ?>
            
                    <?php get_template_part('templates/loop-page'); ?>
            
            <?php } else { ?>
        
                <div class="container pageBottomSpace">
                    <div class="row">
            
                        <?php get_template_part('templates/loop-page'); ?>
    
                    </div>
                </div>
        
            <?php }  ?>
    
        <?php  if(function_exists('is_checkout') && is_checkout() ) {   ?>
            </div>
        <?php } ?>
    
    </div>

<!-- Page Content End -->
<?php 

    $footerMap = get_post_meta($post_id, "footer-map", true);
    if ($footerMap == "1") {
        //Footer Map
        get_template_part('templates/section', 'location');
    }

    $widgetized_footer = get_post_meta($post_id, "footer-widget-area", true);
    if ($widgetized_footer == "1") {
        //Footer Widgetized Area
        get_template_part('templates/section', 'widgetized_footer');
    }
?>

</div>

<?php get_footer();