<?php

namespace controllers;

class FooterController
{
    public function index()
    {
        include 'config/conf.php';
        $x = array();
        $x['copyleft'] = date('Y')." - Micael Vinhas";
        echo $twig->render('footer.html', $x);
    }
}