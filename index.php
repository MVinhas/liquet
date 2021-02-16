<?php
session_start();

require_once 'config/conf.php';

$site = new \controllers\SiteController;
$site->index();

if ((int)$__CONFIG['debug_mode'] === 1 || empty($__CONFIG))
    include 'debug.php';