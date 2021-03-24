<?php
namespace controllers;

class Controller
{
    protected $config_flags;
    protected $twig;

    public function __construct()
    {
        global $config_flags;
        global $twig;
        $this->config_flags = $config_flags;
        $this->twig = $twig;
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

    public function migrations()
    {
        $migrations = new \migrations\Setup();
        $migrations->index();
        $home = $this->getFile($this->path, 'first_setup');
        echo $this->view($home);
    }

    protected function view($view, $out = array())
    {
        echo $this->twig->render($view.'.html', $out);
    }
}
