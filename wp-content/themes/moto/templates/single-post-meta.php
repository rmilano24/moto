<div class="post-meta">

    <div class="post-date-title clearfix">
        <div class="post-date">
            <span class="day"><?php echo get_the_time('d'); ?></span>
            <span class="month"><?php echo get_the_time('M'); ?></span>
        </div>
        <h1 class="post-title"><?php the_title(); ?></h1>
        
        <span class="post-info">
            <span class="post-author"><?php _e('Author : ', 'epicomedia'); the_author_posts_link(); ?></span>
            <span class="post-info-separator">/</span>
            <span class="post-categories"><?php _e('Category : ', 'epicomedia'); the_category(', '); ?></span>
            <span class="post-info-separator">/</span>
            <span><?php if(comments_open()) comments_popup_link('No Comments', '1 Comment', '%', 'comments-link', ''); ?></span>
        </span>
    
    </div>
</div>