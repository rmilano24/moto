<?php

require_once('ivalueprovider.php');

class Ep_ThemeOptionsProvider implements IValueProvider {
    public function Ep_GetValue($key)
    {
        return ep_opt($key);
    }
}