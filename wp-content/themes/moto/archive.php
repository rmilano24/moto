<?php
/**
 * Archive template
 */

    get_header();

    // menu
    get_template_part('templates/section', 'nav');

    $pageTitle    = '';
    $post = $posts[0]; // Hack. Set $post so that the_date() works.

    if (is_category()) {
        $pageTitle = sprintf(__('All posts in %s', 'epicomedia'), single_cat_title('',false));
    }
    elseif( is_tag() ){
        $pageTitle = sprintf(__('All posts tagged %s', 'epicomedia'), single_tag_title('',false));
    }
    elseif( is_day() ){
        $pageTitle = sprintf(__('Archive for %s', 'epicomedia'), get_the_time('F jS, Y'));
    }
    elseif( is_month() ){
        $pageTitle = sprintf(__('Archive for %s', 'epicomedia'), get_the_time('F, Y'));
    }
    elseif ( is_year() ){
        $pageTitle = sprintf(__('Archive for %s', 'epicomedia'), get_the_time('Y') );
    }
    elseif ( is_author() ){
        /* Get author data */
        if(get_query_var('author_name'))
            $curauth = get_user_by('login', get_query_var('author_name'));
        else
            $curauth = get_userdata(get_query_var('author'));

        $pageTitle = sprintf(__('Posts by %s', 'epicomedia'), $curauth->display_name );
    }
    elseif ( isset( $_GET['paged'] ) && !empty( $_GET['paged'] ) ){
        $pageTitle = __('Blog Archives', 'epicomedia');
    }

?>

    <!--Content-->
    <div class="main-content" id="main-content">
        <div id="blogSingle" class="wrap singlePost">
            <div class="container">
                <div class="row">

                    <div class="span12">
                        <h2><?php echo esc_attr($pageTitle); ?></h2>
                        <?php get_template_part( 'templates/loop', 'search' );
                        ep_get_pagination();
                        ?>
                    </div>
                    <div class="span3 offset1">
                        <?php ep_get_sidebar(); ?>
                    </div>

                </div>
            </div>
        </div>
    </div>
<?php get_footer();