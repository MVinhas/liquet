<?php
if (!defined('OWNER')) define('OWNER', 'dev.mvinhas@gmail.com');

require_once 'Connector.php';

require_once 'autoloader.php';

spl_autoload_register('autoload');

require_once 'vendor/autoload.php';

require_once 'engine/DbOperations.php';

$config_flags = new \engine\DbOperations();
$__CONFIG = $config_flags->select('config', '*');
if (empty($__CONFIG))
    trigger_error("No Config found. Please check your DB Connection");

$config_flags->debug_mode = $__CONFIG['debug_mode'];
$config_flags->sitename = $__CONFIG['sitename'];
$config_flags->email = $__CONFIG['email'];
$config_flags->siteversion = $__CONFIG['siteversion'];
$config_flags->siteauthor = $__CONFIG['siteauthor'];
$config_flags->launchyear = $__CONFIG['launchyear'];

if ((int)$__CONFIG['debug_mode'] === 1 || empty($__CONFIG)) {
    $time_start = microtime(true);
    ini_set("display_errors", "On");
    ini_set("error_prepend_string","<div class='debug-silent'>");
    ini_set("error_append_string","</div>");
    mysqli_report(MYSQLI_REPORT_ALL ^ MYSQLI_REPORT_STRICT); 
    error_reporting(E_ALL);   
}

$loader = new \Twig\Loader\FilesystemLoader('views');

$view = new \Twig\Environment($loader);
