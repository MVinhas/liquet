<?php
namespace config;

class Dispatcher
{
    public static function dispatch()
    {
        $uri = self::getURI();
        $cont = new $uri->controller;
        $method = $uri->method;
        $arg = $uri->arg;
        $cont->$method($arg);
    }
    public static function metadata()
    {
        $uri = self::getURI();
        $split = explode("\\", $uri->controller);
        $controller = explode("Controller", $split[2]);

        $site = new \engine\SiteInfo();

        $_SESSION['page_title'] = $site->getName().' :: '.$controller[0];
    }
    private static function getURI()
    {
        $url = explode('/', trim($_SERVER['REQUEST_URI'], '/'));
    
        $siteInfo = new \engine\SiteInfo();
        $name = array_search($siteInfo->getName(), $url);
        if (empty($name)) $name = -1;

        $ctrPos = isset($url[(int)$name+1]) ? $url[(int)$name+1] : null;
        $mtdPos = isset($url[(int)$name+2]) ? $url[(int)$name+2] : null;
        $argPos = isset($url[(int)$name+3]) ? $url[(int)$name+3] : null;
        
        isset($ctrPos) ? $ctrPos = preg_replace('/\?/', '', $ctrPos) : null;
        //check for controller
        $controller = !empty($ctrPos) ? "\controllers\\" . $ctrPos . 'Controller' : '\controllers\HomeController';
        //controller method
        $method = !empty($mtdPos) ? $mtdPos : 'index';

        //get argument
        $arg = !empty($argPos) ? $argPos : null;
        
        $uri = new \stdClass();
        $uri->controller = $controller;
        $uri->method = $method;
        $uri->arg = $arg;
        return $uri;
    }
}
