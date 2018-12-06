<?php

namespace Controllers;

class HomeController
{
    public function index()
    {
        include 'Config/conf.php';

        echo $twig->render('home.html');
    }
}