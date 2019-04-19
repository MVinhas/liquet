<?php
namespace controllers;

use \engine\Site as Site;

class HeaderController extends Controller
{
    public function index()
    {
        $params = array();
        $site = new Site();
        $params['sitename'] = $site->getName();

        echo $this->twig->render('main/header.html', $params);
    }
}