<?php

require_once(THEME_LIB . '/forms/fieldtemplate.php');
require_once(THEME_LIB . '/forms/theme-options-provider.php');

class Ep_AdminForm extends Ep_FieldTemplate
{
    protected $template = array();

    function __construct()
    {
        $this->template = ep_admin_get_form_settings();
        parent::__construct(new Ep_ThemeOptionsProvider(), THEME_LIB . '/forms/templates');
    }

    public function GetHeader()
    {
        return $this->EP_GetTemplate('admin-header');
    }

    public function GetBody()
    {
        return $this->EP_GetTemplate('admin-sidebar') .
               $this->EP_GetTemplate('admin-panels');
    }

    public function Ep_GetImage($filename, $alt='', $class='')
    {
        return $this->EP_GetTemplate('image', array('filename'=>$filename, 'alt'=>$alt, 'class'=>$class));
    }
}