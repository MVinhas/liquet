<?php
if (!defined('OWNER')) define('OWNER', 'dev.mvinhas@gmail.com');

$config_flags = new stdClass();
$config_flags->debug_mode = 1; #0 - Production; 1 - Development
$config_flags->sitename = 'mvinhas-blog';
$config_flags->email = 'dev.mvinhas@gmail.com';
$config_flags->siteversion = '0.1.0-alpha4';
$config_flags->siteauthor = 'Micael Vinhas';
$config_flags->launchyear = '2019';

if ($config_flags->debug_mode === 1) {
    ini_set("display_errors", "On");
    ini_set("error_prepend_string","<div class='debug-silent'>");
    ini_set("error_append_string","</div>");
    mysqli_report(MYSQLI_REPORT_ALL ^ MYSQLI_REPORT_STRICT); 
    error_reporting(E_ALL);   
}

require_once 'Connector.php';

require_once 'autoloader.php';

spl_autoload_register('autoload');

require_once 'vendor/autoload.php';

require_once 'engine/DbOperations.php';

$loader = new \Twig\Loader\FilesystemLoader('views');

$view = new \Twig\Environment($loader);
