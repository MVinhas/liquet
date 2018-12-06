<?php
//0.1.0 - 06/12/2018
require_once 'Config/conf.php';


include('Controllers/headController.php');
include('Controllers/headerController.php');

\Config\Dispatcher::dispatch();

include('Controllers/footerController.php');
