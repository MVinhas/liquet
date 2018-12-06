<?php
//0.1.0 - 06/12/2018
require_once 'Config/Conf.php';


include('Controllers/HeadController.php');
include('Controllers/HeaderController.php');

\Config\Dispatcher::dispatch();

include('Controllers/FooterController.php');
