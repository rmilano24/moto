<?php

function ep_register_menus() {
    register_nav_menu( 'primary-nav', __('Primary Navigation', 'epicomedia' ) );
}

add_action( 'init', 'ep_register_menus' );