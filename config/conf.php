<?php
#Debug
error_reporting(E_ALL);
ini_set("display_errors","On");

require_once 'connector.php';
require_once 'autoloader.php';
spl_autoload_register('autoloader');

require_once 'vendor/autoload.php';
$loader = new Twig_Loader_Filesystem('views');
$twig = new Twig_Environment($loader);

include('models/head.php');


?>
