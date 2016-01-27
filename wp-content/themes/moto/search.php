<?php
/**
 * Search template
 */

    get_header();

    // menu
    get_template_part('templates/section', 'nav');

    $pageHeading = have_posts() ? sprintf(__("Results for &nbsp; '%s'", 'epicomedia'), $s ) : __('No Results Found', 'epicomedia');
?>
    <!--Content-->
    <div class="main-content" id="main-content"> <!-- main-content wrap pass to djax -->
        <div id="blogSingle" class="wrap singlePost">
            <div class="container">
                <div class="row">
                    <div class="span12">
                        <h2 class="search-title"><?php echo esc_attr($pageHeading); ?></h2>
                        <hr class="search-top-line"/>
                        <?php get_template_part( 'templates/loop', 'search' );
                            ep_get_pagination();
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php get_footer();