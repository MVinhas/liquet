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

    protected function view($view, $out = array())
    {
        print_r($this->twig->render($view.'.html', $out));
    }
}
