<?php

namespace controllers;

use models\Home as Home;

class HomeController extends Controller
{

    public function index()
    {
        $model = new Home();
        if ($model->checkUsers() === false) {
            $this->setup();
        } else {
            echo $this->twig->render('main/home.html');
        }
    }

    public function setup()
    {
        $model = new Home();
        echo $this->twig->render('main/setup.html');
    }
}