<?php
session_start();

require_once 'config/conf.php';

$site = new \controllers\SiteController;
$site->index();

if ((int)$__CONFIG['debugmode'] === 1 || empty($__CONFIG))
    include 'debug.php';