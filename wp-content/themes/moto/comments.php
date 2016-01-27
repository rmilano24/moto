<?php

/*-----------------------------------------------------------------------------------*/
/*	Functions
/*-----------------------------------------------------------------------------------*/

    function ep_comment_fields($fields) {

        $commenter = wp_get_current_commenter();

        $fields['author'] = "<div class=\"input-text\"><input name=\"author\" value=\"" . esc_attr($commenter['comment_author']) . "\" type=\"text\" tabindex=\"1\"><span class=\"label\">" . __('Your Name', 'epicomedia') . "</span><span class=\"graylabel\">" . __('Your Name', 'epicomedia') . "</span></div>";

        $fields['email'] = "<div class=\"input-text\"><input name=\"email\" value=\"" . esc_attr($commenter['comment_author_email']). "\" type=\"text\" tabindex=\"2\"><span class=\"label\">" . __('Email', 'epicomedia') . "</span><span class=\"graylabel\">" . __('Email', 'epicomedia') . "</span></div>";

        $fields['url'] = "<div  class=\"input-text\"><input name=\"url\" value=\"" . esc_attr($commenter['comment_author_url']). "\" type=\"text\" tabindex=\"3\"><span class=\"label\">" . __('WEBSITE', 'epicomedia') . "</span><span class=\"graylabel\">" . __('WEBSITE', 'epicomedia') . "</span></div>";

        return $fields;
    }

    add_filter('comment_form_default_fields','ep_comment_fields');

    function ep_comment_form_before()
    {
        echo '<div class="form-fields clearfix">';
    }

    function ep_comment_form_after()
    {
        echo '</div>';
    }

    add_action('comment_form_before_fields', 'ep_comment_form_before');
    add_action('comment_form_after_fields', 'ep_comment_form_after');

    //Comment styling

    function ep_theme_comment($comment, $args, $depth) {

        $isByAuthor = false;

        if($comment->comment_author_email == get_the_author_meta('email')) {
            $isByAuthor = true;
        }

        $GLOBALS['comment'] = $comment; ?>

        <li>
            <div id="comment-<?php comment_ID() ?>" <?php comment_class('clearfix'); ?> data-id="<?php comment_ID(); ?>">
                <div class="comment-image">
                    <?php echo get_avatar($comment,$size='64'); ?>
                </div>
                <div class="comment-content">
                    <div class="comment-meta">
                        <?php printf(__('<cite>%s</cite>', 'epicomedia'), get_comment_author_link()) ?>
                        <?php if($isByAuthor) { ?><span class="author-tag"><?php _e('(Author)','epicomedia') ?></span><?php } ?>
                        <a class="comment-date" href="<?php echo htmlspecialchars( get_comment_link( $comment->comment_ID ) ) ?>"><?php printf(__('%1$s at %2$s', 'epicomedia'), get_comment_date(),  get_comment_time()) ?></a>
                        <?php
                        edit_comment_link(__('Edit)', 'epicomedia'),'  ','');
                        comment_reply_link(array_merge( $args, array('depth' => $depth, 'max_depth' => $args['max_depth'])));
                        ?>
                    </div>
                    <div class="comment-text">
                        <?php comment_text() ?>
                    </div>
                </div>
                <div class="line"></div>
            </div>

    <?php
    }

    function ep_theme_list_pings($comment, $args, $depth) {
        $GLOBALS['comment'] = $comment; ?>
        <li id="comment-<?php comment_ID(); ?>"><?php comment_author_link(); ?>
    <?php }


    // Do not delete these lines
    if (!empty($_SERVER['SCRIPT_FILENAME']) && 'comments.php' == basename($_SERVER['SCRIPT_FILENAME']))
        die ('Please do not load this page directly. Thanks!');

    if ( post_password_required() ) { ?>
        <p class="nocomments"><?php _e('This post is password protected. Enter the password to view comments.', 'epicomedia') ?></p>
    <?php
        return;
    }

/*-----------------------------------------------------------------------------------*/
/*	Display the comments + Pings
/*-----------------------------------------------------------------------------------*/

if ( have_comments() ) { // if there are comments ?>
    <div class="comments-wrap">

        <?php if ( ! empty($comments_by_type['comment']) ) { // if there are normal comments ?>

            <ul class="comments-list">
                <span class="comment_list_border"></span>
            <?php wp_list_comments('type=comment&avatar_size=64&callback=ep_theme_comment'); ?>
            </ul>

        <?php } // if there are normal comments ?>

        <?php if ( ! empty($comments_by_type['pings']) ) { // if there are pings ?>

            <h4 id="pings"><?php _e('Trackbacks for this post', 'epicomedia') ?></h4>

            <ol class="ping_list">
            <?php wp_list_comments('type=pings&callback=ep_theme_list_pings'); ?>
            </ol>

        <?php } // if there are pings ?>

            <div class="navigation">
                <div class="alignleft"><?php previous_comments_link(); ?></div>
                <div class="alignright"><?php next_comments_link(); ?></div>
            </div>
    </div>
<?php

    //Deal with closed comments
    if (!comments_open()) { // if the post has comments but comments are now closed ?>

            <?php if (is_single()) { ?>
                <p class="nocomments"><?php _e('Comments are now closed.', 'epicomedia'); ?></p>
            <?php
            } else{ ?>
                <p class="nocomments"><?php _e('Comments are now closed for this article.', 'epicomedia'); ?></p>
            <?php } ?>

    <?php }

}
else //There are no comments
{
    //If there are no comments so far and comments are open
    if(comments_open())
    {
        if (is_single()) { ?>
            <p class="nocomments"><?php _e('No comments so far.', 'epicomedia'); ?></p>
        <?php
        } else{ ?>
            <p class="nocomments"><?php _e('There are no comments for this article.', 'epicomedia'); ?></p>
        <?php
        }
    }
    else
    {
        if (is_single()) { ?>
            <p class="nocomments"><?php _e('Comments are closed.', 'epicomedia'); ?></p>
        <?php
        } else{ ?>
            <p class="nocomments"><?php _e('Comments are closed for this article.', 'epicomedia'); ?></p>
        <?php
        }
    }

} // if there are comments

//Comment Form
if ( !comments_open() ) return;
?>
<div id="respond-wrap">
<?php comment_form(array( 
    'comment_notes_before' => '<p>'. __('Your email address will not be published. Website Field Is Optional', 'epicomedia') .'</p>',
    'comment_field'=>"<div class=\"input-textarea\"><textarea rows=\"10\" cols=\"58\" name=\"comment\" tabindex=\"4\"></textarea><span class=\"label\">" . __('MESSAGE', 'epicomedia') . "</span><span class=\"graylabel\">" . __('MESSAGE', 'epicomedia') . "</span></div>",
    'comment_notes_after' => '<div class="button button-large center" href="#" title=""><input name="submit" type="submit" id="new_submit" class="new_submit" value="Post Comment"><div class="frame top"><div></div></div><div class="frame right"><div></div></div><div class="frame bottom"><div></div></div><div class="frame left"><div></div></div></div>'
)); ?>
</div>
