<div class="post-meta">
    <h2 class="post-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
    <hr />
    <div class="post-info-container clearfix">
        <div class="post-comments"><?php if(comments_open()) comments_popup_link( '0', '1', '%', 'comments-link', ''); ?></div>
        <div class="post-info">
            <span class="post-categories"><?php the_category(', '); ?></span>
            <span class="post-info-separator">/</span>
            <span class="post-author"><?php _e('By ', 'epicomedia'); the_author_posts_link(); ?></span>
            <span class="post-info-separator">/</span>
            <span class="post-date"><?php echo get_the_time('d M Y'); ?></span>
        </div>
    </div>
</div>