<?php

error_reporting(E_ALL);
ini_set("display_errors","On");

require_once 'connector.php';
require_once 'autoloader.php';

require_once 'vendor/autoload.php';
$loader = new Twig_Loader_Filesystem('Views');

$twig = new Twig_Environment($loader);
