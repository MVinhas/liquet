<?php

namespace controllers;

class HomeController
{
    public function index(){
        include 'config/conf.php';

        echo $twig->render('home.html');
    }
}