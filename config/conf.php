<?php
#Debug
error_reporting(E_ALL);
ini_set("display_errors","On");

#Twig
require_once 'vendor/autoload.php';
$loader = new Twig_Loader_Filesystem('views');
$twig = new Twig_Environment($loader);

include('models/head.php');

#Database
require_once 'connector.php';

#Functions
function autoloader($functions)
{
  require_once 'engine/'.$functions.'.php';
}
spl_autoload_register('autoloader');
?>
