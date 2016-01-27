<?php
/**
 * Template for displaying portfolio single posts.
 */

    get_header();

    // menu
    get_template_part('templates/section', 'nav');

    $pPostDetailType = ep_get_meta('portfolio-detail-style');

    global $wp_query;
    if (isset($wp_query->query_vars['inner']))
    {
        $pPostDetailType = 'portfolio_detail_default';
    }
    
?>
<div id="main-content" class="main-content">
    <div id="portfoliSingle" class="wrap singlePost <?php echo esc_attr($pPostDetailType); ?>">
        <!--portfolio detail Content-->
        <?php
        if ( have_posts())
        {
            while ( have_posts() ) { the_post();

                if ($pPostDetailType == 'portfolio_detail_full_width') 
                {
                    get_template_part('templates/portfolio-detail', 'fullwidth');
                }
                else if ($pPostDetailType == 'portfolio_detail_boxed' )
                {
                    get_template_part('templates/portfolio-detail', 'boxed');
                }
                else if ($pPostDetailType == 'portfolio_detail_creative' )
                {
                        get_template_part('templates/portfolio-detail', 'creative');
                }
                else
                {
                        get_template_part('templates/portfolio-detail', 'default');
                }

            }
        }?>
        
    </div>
</div>
<!--portfolio detail Content End -->
<?php get_footer();