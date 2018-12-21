<?php

namespace controllers;

class HeaderController
{
    public function index()
    {
        include 'config/conf.php';
        echo $twig->render('header.html');
    }
}
