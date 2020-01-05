<?php
namespace config;

class Dispatcher
{
    public static function dispatch()
    {
        $url = explode('/', trim($_SERVER['REQUEST_URI'], '/'));
        
        array_shift($url);
        $siteInfo = new \engine\SiteInfo();
        
        //if using HomeDir, the second position is the site name, not the controller name
        if ($url[0] == $siteInfo->getName()) {
            array_shift($url);
        }
         
        //check for controller
        $controller = !empty($url[0]) ? "\controllers\\" . $url[0] . 'Controller' : '\controllers\HomeController';

        //controller method
        $method = !empty($url[1]) ? $url[1] : 'index';

        //get argument
        $arg = !empty($url[2]) ? $url[2] : null;

        //controller instance
        $cont = new $controller;

        $cont->$method($arg);
    }
}
