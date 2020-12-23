<?php
session_start();

require_once 'config/conf.php';

$site = new \controllers\SiteController;
$site->index();

if ($config_flags->debug_mode === 1)
    include 'debug.php';