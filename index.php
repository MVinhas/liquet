<?php
//HTTPS: cookie_secure => true
session_start([
    'cookie_httponly' => true
]);

require_once 'config/conf.php';

$site = new \controllers\SiteController;
$site->index();
if ($config_flags->debug_mode === 1) {
    echo "<pre>";
    echo "<b>SESSION:</b>";
    print_r($_SESSION);
    echo "<br><b>POST:</b>";
    print_r($_POST);
    echo "<br><b>GET:</b>";
    print_r($_GET);
    echo "<br><b>COOKIE:</b>";
    print_r($_COOKIE);
    echo "<br><b>SERVER:</b>";
    print_r($_SERVER);
    echo "</pre>";
}