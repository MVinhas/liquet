<?php
$config_flags = new stdClass();
$config_flags->debug_mode = 1; #0 - Production; 1 - Development
$config_flags->sitename = 'Seamus';
$config_flags->siteversion = '0.2.0.'.date('ymd').'-dev';
$config_flags->siteauthor = 'Micael Vinhas';
$config_flags->launchyear = '2019';

if ($config_flags->debug_mode === 1) {
    error_reporting(E_ALL);
    ini_set("display_errors", "On");
}

require_once 'Connector.php';

require_once 'autoloader.php';

spl_autoload_register('autoload');

require_once 'vendor/autoload.php';

require_once 'engine/DbOperations.php';

$loader = new \Twig\Loader\FilesystemLoader('views');

$template = new \Twig\Environment($loader);
