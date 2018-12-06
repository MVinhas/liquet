<?php

namespace Controllers;

class HomeController
{
    public function index()
    {
        include 'Config/Conf.php';

        echo $twig->render('home.html');
    }
}