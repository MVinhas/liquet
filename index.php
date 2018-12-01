<?php
set_include_path($_SERVER['DOCUMENT_ROOT'].'/MVinhasCMS/');
require_once('config/conf.php');
$config = isset($_GET['config']) ? (int)$_GET['config'] : 0;
?>
<?php
include('models/header.php');

#Content to start with
$config == 1 ? include('settings/setup.php') : include('models/home.php');

include('models/footer.php');
?>
