<div id="ep-sidebar">
    <!--<h5 class="heading"><?php echo $this->template['tabs-title'] ?></h5>-->
    <div id="ep-sidebar-accordion">
        <?php
        $tabGroups = $this->template['tab-groups'];
        $tabs      = $this->template['tabs'];
        $gcnt = 1;

        foreach($tabGroups as $groupKey => $group)
        {
            $tabsRef = $group['tabs'];
            $activeGroupClass = $gcnt == 1 ? 'class="active"' : '';
        ?>
            <h3><a href="#<?php echo $group['text']; ?>" <?php echo $activeGroupClass; ?>><span class="dashicons <?php echo $group['icon']; ?>"></span><?php echo $group['text']; ?></a></h3>
            <div>
                <ul class="ep-tab">
        <?php
                foreach($tabsRef as $tabKey)
                {
                    $tab = $tabs[$tabKey];
                    $tcnt = 1;
                    $activeTabClass = $tcnt == 1 && $gcnt == 1? 'class="active"' : '';
                    ?>
                    <li><a href="#<?php echo $tab['panel']; ?>" <?php echo $activeTabClass; ?>><?php echo $tab['text']; ?></a></li>
                    <?php
                    $tcnt++;
                }
        ?>
                </ul>
            </div>
        <?php
            $gcnt++;
        }
        ?>


    </div>
</div>