<?php
//HTTPS: cookie_secure => true
$lifetime=600;
session_start();
setcookie(session_name(),session_id(),time()+$lifetime);

require_once 'config/conf.php';

$site = new \controllers\SiteController;
$site->index();

if ($config_flags->debug_mode === 1)
    include 'debug.php';