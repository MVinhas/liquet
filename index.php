<?php
require_once 'config/conf.php';
$config = isset($_GET['config']) ? (int)$_GET['config'] : 0;

include('controllers/headController.php');
include('controllers/headerController.php');

\config\Dispatcher::dispatch();

include('controllers/footerController.php');
