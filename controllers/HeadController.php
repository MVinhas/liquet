<?php

namespace controllers;

class HeadController{
    public function index()
    {
        include 'config/conf.php';
        echo $twig->render('head.html');
    }
}