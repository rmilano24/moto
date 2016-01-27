<div class="hidden-desktop">
    <nav id="phoneNavItems" class="navigation-mobile">
        <?php
        wp_nav_menu(array(
            'container' =>'',
            'theme_location' => 'primary-nav',
            'fallback_cb' => false,
            'items_wrap'       	=> '<div class="phone_menu_container"><ul id="%1$s" class="%2$s">%3$s</ul></div>',
            'walker'      =>   new Ep_Nav_Walker(),
        ));
        ?>
    </nav>
</div>