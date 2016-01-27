<?php

//Base class for generating html code from
//given template file
class Ep_Template
{
    protected $templatesDir  = 'templates';

    function __construct($templatesDir = '')
    {
        if($templatesDir != '')
            $this->templatesDir = $templatesDir;
    }

    function Ep_SetWorkingDirectory($dir)
    {
        $this->templatesDir = $dir;
    }

    function EP_GetTemplate($file, $vars = array())
    {
        ob_start();
        require(ep_path_combine($this->templatesDir, $file) . '.php');
        return ob_get_clean();
    }

}