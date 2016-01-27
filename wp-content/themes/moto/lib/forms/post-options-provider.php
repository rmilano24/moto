<?php

require_once('ivalueprovider.php');

class Ep_PostOptionsProvider implements IValueProvider {

    public function Ep_GetValue($key)
    {
        global $post;
        return get_post_meta( $post->ID, $key, true );
	
    }
}