<?php

$debug_mode = 1; //0 - Production; 1- Development

if ($debug_mode===1) {
    error_reporting(E_ALL);
    ini_set("display_errors", "On");
}

require_once 'Connector.php';

require_once 'autoloader.php';

spl_autoload_register('autoload');

require_once 'vendor/autoload.php';

$loader = new Twig_Loader_Filesystem('views');

$twig = new Twig_Environment($loader);
