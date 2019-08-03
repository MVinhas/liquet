<?php
namespace controllers;

class Controller
{
    public function __construct()
    {
        include 'config/conf.php';
        $this->debug_mode = $debug_mode;
        $this->template = $template;
    }

    protected function callTemplate($template)
    {
        echo $this->template->render($template.'.html');
    }

    protected function callFooter()
    {
        $footer = new FooterController();
        $footer->index();
        exit;
    }
}
