<div class="ep-main">
    <?php
    $panels = $this->template['panels'];

    foreach($panels as $panelKey => $panel)
    {
    ?>
        <div id="<?php echo $panelKey; ?>" class="panel">
            <div class="content-head">
                <div class="ep-content-wrap">
                    <a href="#" class="save-button" >
                        <?php echo $this->Ep_GetImage('save_icon.png', 'Save', 'save-icon'); ?>
                        <?php echo $this->Ep_GetImage('loading24.gif', 'Loading', 'loading-icon'); ?>
                        <div><?php _e('Save', 'epicomedia'); ?></div>
                    </a>
                    <h3><?php echo $panel['title']; ?></h3>

                    <div class="support">
                        <a href="<?php echo $this->template['document-url']; ?>"><?php _e('Documentation', 'epicomedia'); ?></a><span class="separator"></span><a href="<?php echo $this->template['support-url']; ?>"><?php _e('Support', 'epicomedia'); ?></a>
                    </div>
                </div>
            </div>
            <?php echo $this->EP_GetTemplate('section', $panel['sections']); ?>
        </div>
    <?php
    }
    ?>
</div>