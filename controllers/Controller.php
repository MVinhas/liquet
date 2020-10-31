<?php
namespace controllers;

class Controller
{
    public function __construct()
    {
        include 'config/conf.php';
        $this->config_flags = $config_flags;
        $this->view = $view;
    }

    public function getDirectory($filename)
    {
        $pathExplode = explode('Controller', $filename);
        $directory = strtolower($pathExplode[0]);
        return $directory;
    }

    public function getFile($path, $file)
    {
        return $path.'/'.$file;
    }

    protected function callView($view, $out = array())
    {
        echo $this->view->render($view.'.html', $out);
    }

    protected function callFooter()
    {
        $footer = new SiteController();
        $footer->footer();
        exit;
    }
}
