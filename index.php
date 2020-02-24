<?php
//HTTPS: cookie_secure => true
session_start([
    'cookie_httponly' => true
]);

require_once 'config/conf.php';

$site = new \controllers\SiteController;
$site->index();
