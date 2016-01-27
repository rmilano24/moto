<?php
require (THEME_LIB . '/forms/template.php');

class Ep_FieldTemplate extends Ep_Template {
    /* @var IValueProvider $valueProvider */
    private   $valueProvider = null;

    function __construct(IValueProvider $valueProvider, $templatesDir = '')
    {
        $this->valueProvider = $valueProvider;
        parent::__construct($templatesDir);
    }

    function Ep_GetValue($key)
    {
        return $this->valueProvider->Ep_GetValue($key);
    }

    public function GetField($key, array $settings, array $vars=null)
    {
        $params = array('key' => $key, 'settings' => $settings);

        if($vars != null)
            $params = array_merge($vars, $params);

        return $this->EP_GetTemplate($settings['type'] . '-field', $params);
    }
}