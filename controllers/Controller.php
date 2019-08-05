<?php
namespace controllers;

class Controller
{
    public function __construct()
    {
        include 'config/conf.php';
        $this->config_flags = $config_flags;
        $this->template = $template;
    }

    protected function getTemplatePath($filename)
    {
        return explode('Controller', $filename);
    }

    protected function callTemplate($template, $out = array())
    {
        echo $this->template->render($template.'.html', $out);
    }

    protected function callFooter()
    {
        $footer = new SiteController();
        $footer->footer();
        exit;
    }
}
