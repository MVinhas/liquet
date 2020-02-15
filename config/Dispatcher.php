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
        $controller = explode("Controller",$split[2]);

        $site = new \engine\SiteInfo();

        $_SESSION['page_title'] = $site->getName().' :: '.$controller[0];

    }
    private static function getURI()
    {
        $url = explode('/', trim($_SERVER['REQUEST_URI'], '/'));
        
        array_shift($url);
        $siteInfo = new \engine\SiteInfo();
       
        //if using Apache/NGINX HomeDir, the second position is the site name, not the controller name
        if ($url[0] == $siteInfo->getName()) {
            array_shift($url);
        }
        
        isset($url[0]) ? $url[0] = preg_replace('/\?/','',$url[0]) : null;
        //check for controller
        $controller = !empty($url[0]) ? "\controllers\\" . $url[0] . 'Controller' : '\controllers\HomeController';
        //controller method
        $method = !empty($url[1]) ? $url[1] : 'index';

        //get argument
        $arg = !empty($url[2]) ? $url[2] : null;
        
        $uri = new \stdClass();
        $uri->controller = $controller;
        $uri->method = $method;
        $uri->arg = $arg;
        return $uri;
    }
}
