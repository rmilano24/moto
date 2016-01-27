<?php

    $footerWidgets = ep_opt('footer_widgets');

    if($footerWidgets == 1){

        $widgetSpan1 = 12 ;
    }
    else if ($footerWidgets == 2) {

        $widgetSpan1 = 6 ;
        $widgetSpan2 = 6 ;
    }
    else if ($footerWidgets == 3) {

        $widgetSpan1 = 8 ;
        $widgetSpan2 = 4 ;
    }
    else if ($footerWidgets == 4) {

        $widgetSpan1 = 4;
        $widgetSpan2 = 8 ;

    }
    else if ($footerWidgets == 5 ) {
    
        $widgetSpan1 = 4;
        $widgetSpan2 = 4 ;
        $widgetSpan3 = 4 ;
    }
    
?>

<?php if($footerWidgets){ ?>
<div class="footer-widgetized <?php if ( ep_opt('footer-widget-banner') ) { ?>  footer-has-banner <?php } ?>" style="background-color:<?php ep_eopt('footer-widget-color')?>;">
    <div class="<?php if ( ep_opt('footer-widget-banner') ) { ?>  footer-widgetized-gradient <?php } ?> ">
        <div class="footer-widgetized-wrap wrap">
            <div class="container clearfix">

                <?php if ( ep_opt('footer_title') || ep_opt('footer_subtitle')  ) { ?>

                    <div class="titleSpace">
                        <?php if ( ep_opt('footer_title') ) { ?>
                            <div class="title"><h3><?php ep_eopt('footer_title'); ?></h3></div>
                        <?php } if (  ep_opt('footer_subtitle') ) { ?>
                            <div class="subtitle"><?php ep_eopt('footer_subtitle'); ?></div>
                        <?php } ?>
                    </div>

                <?php } ?>

            </div>

            <div class="container clearfix">
                <!-- widgetized Area -->
                <div class="wpb_row vc_row-fluid">
                    <div class="wpb_column vc_column_container vc_col-sm-<?php echo esc_attr($widgetSpan1) ?>">
                        <div class="vc_column-inner">
                            <!--  Footer Widgetised 1 -->
                            <?php if ( !function_exists( 'dynamic_sidebar' ) || !dynamic_sidebar( 'footer-widget-1') ){}  ?>
                        </div>
                    </div>

                    <?php if(!($footerWidgets == 1)){ ?>
                    <div class="wpb_column vc_column_container vc_col-sm-<?php echo esc_attr($widgetSpan2) ?>">
                        <div class="vc_column-inner">
                            <!--  Footer Widgetised 2 -->
                            <?php	if ( !function_exists( 'dynamic_sidebar' ) || !dynamic_sidebar( 'footer-widget-2') ){} ?>
                        </div>
                    </div>
                              
                        <?php if( $footerWidgets == 5 ) { ?>
                            <div class="wpb_column vc_column_container vc_col-sm-<?php echo esc_attr($widgetSpan3) ?>">
                                <div class="vc_column-inner">
                                    <!--  Footer Widgetised 3 -->
                                    <?php	if ( !function_exists( 'dynamic_sidebar' ) || !dynamic_sidebar( 'footer-widget-3') ){} ?>
                                </div>
                            </div>
                        <?php } ?>
                    
                
                    <?php } ?>

                </div>
            </div>
        </div>
    </div>
</div>
<?php } ?>