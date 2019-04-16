<?php

namespace controllers;

class HeadController extends Controller
{
    public function index()
    {
        $params['dev_mode'] = $this->debug_mode;
        echo $this->twig->render('main/head.html', $params);
    }
}
