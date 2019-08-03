<?php

namespace controllers;

class HeadController extends Controller
{
    public function index()
    {
        $params['dev_mode'] = $this->debug_mode;
        echo $this->template->render('main/head.html', $params);
    }
}
