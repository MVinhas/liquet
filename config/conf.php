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

$config_flags->debugmode = $__CONFIG['debugmode'] ? $__CONFIG['debugmode'] : 1;
$config_flags->sitename = $__CONFIG['sitename'] ? $__CONFIG['sitename'] : '(no name found)';
$config_flags->email = $__CONFIG['email'] ? $__CONFIG['email'] : '(no email found)';
$config_flags->siteversion = $__CONFIG['siteversion'] ? $__CONFIG['siteversion'] : '(no version found)';
$config_flags->siteauthor = $__CONFIG['siteauthor'] ? $__CONFIG['siteversion'] : '(no author found)';
$config_flags->launchyear = $__CONFIG['launchyear'] ? $__CONFIG['launchyear'] : date('Y');

if ((int)$__CONFIG['debugmode'] === 1 || empty($__CONFIG)) {
    $time_start = microtime(true);
    ini_set("display_errors", "On");
    ini_set("error_prepend_string","<div class='debug-silent'>");
    ini_set("error_append_string","</div>");
    mysqli_report(MYSQLI_REPORT_ALL ^ MYSQLI_REPORT_STRICT); 
    error_reporting(E_ALL);   
}

$loader = new \Twig\Loader\FilesystemLoader('views');

$view = new \Twig\Environment($loader);
