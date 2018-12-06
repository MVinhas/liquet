<?php
require_once 'Config/conf.php';
$config = isset($_GET['config']) ? (int)$_GET['config'] : 0;

include('Controllers/headController.php');
include('Controllers/headerController.php');

\Config\Dispatcher::dispatch();

include('Controllers/footerController.php');
