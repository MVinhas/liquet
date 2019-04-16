<?php

namespace controllers;

use \engine\Site as Site;

class FooterController extends Controller
{
    public function index()
    {
        $params = array();
        $site = new Site();
        $params['copyleft'] = $site->getLaunchYear() >= date('Y') ? 
                                $site->getLaunchYear().' '.$site->getAuthor() :
                                $site->getLaunchYear().' - '.date('Y').' '.$site->getAuthor();
        $params['siteversion'] = $site->getVersion();
        echo $this->twig->render('main/footer.html', $params);
    }
}
