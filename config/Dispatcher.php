<?php
namespace config;

class Dispatcher
{
    public static function dispatch()
    {
        $uri = self::processURI();
        if (class_exists($uri['controller'])) {
            $controller = $uri['controller'];
            $method = $uri['method'];
            $args = $uri['args'];
            //Now, the magic
            $args ? (new $controller)->{$method}(...$args) :
                (new $controller)->{$method}();
        }
        
    }

    public static function metadata()
    {
        $uri = self::processURI();
        $split = explode("\\", $uri['controller']);
        $controller = explode("Controller", $split[2]);

        $site = new \engine\SiteInfo();

        $_SESSION['page_title'] = $site->getName().' :: '.$controller[0];
    }

    private static function getURI()
    {
        return explode('/', $_SERVER['REQUEST_URI']);
    }

    private static function processURI() : array
    {
        $controllerPart = self::getURI()[1] ?? '';
        $methodPart = self::getURI()[2] ?? '';
        $numParts = count(self::getURI());
        $argsPart = [];
        for ($i = 3; $i < $numParts; $i++) {
            $argsPart[] = self::getURI()[$i] ?? '';
        }
        $controllerPart = str_replace('?', '', $controllerPart);
    
        //Let's create some defaults if the parts are not set
        $controller = !empty($controllerPart) ?
        '\controllers\\'.$controllerPart.'Controller' :
        '\controllers\HomeController';

        $method = !empty($methodPart) ?
            $methodPart :
            'index';

        $args = !empty($argsPart) ?
            $argsPart :
            [];
        return [
            'controller' => $controller,
            'method' => $method,
            'args' => $args
        ];
    }
}