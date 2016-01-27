<?php wp_nonce_field( 'theme-post-meta-form', THEME_NAME_SEO . '_post_nonce' ); ?>

<div class="ep-container post-meta">
    <div class="ep-main">
        <?php
            $this->Ep_SetWorkingDirectory(ep_path_combine(THEME_LIB, 'forms/templates'));
            echo $this->EP_GetTemplate('section', $vars);
        ?>
    </div>
</div>
