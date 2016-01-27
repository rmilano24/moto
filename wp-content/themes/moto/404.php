<?php
/**
 * 404 (Page not found) template
 */

    get_header();
    
    // menu
    get_template_part('templates/section', 'nav');
    
    $title = __("Error 404", 'epicomedia');
     
?>
    <!-- main-content wrap pass to djax -->
    <div class="main-content" id="main-content"> 
        <div id="blogSingle" class="wrap singlePost">
            <div class="container">
                <div class="row">

                    <div class="span12 not_found_page">
                        <strong><?php _e('404 ERROR', 'epicomedia'); ?></strong>
                        <p><?php _e('PAGE NOT FOUND', 'epicomedia'); ?></p>
                        <hr />
                        <p><?php _e('Sorry, the page you are looking for is not available. You can use the search box below if you like.', 'epicomedia'); ?></p>
                        <br/>
                        <?php get_search_form(); ?>
                    </div>

                 </div>
            </div>
        </div>
    </div>

<?php get_footer();