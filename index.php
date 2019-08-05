<?php
session_start([
    'cookie_httponly' => true,
    'cookie_secure' => true
]);

require_once 'config/conf.php';

$site = new \controllers\SiteController;
$site->index();
