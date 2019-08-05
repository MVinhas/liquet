<?php

namespace controllers;

class SiteController extends Controller
{
    protected $path;

    public function __construct()
    {
        //Pelo que percebo este construtor faz override do construtor do Controller. Verdade?
        $file = pathinfo(__FILE__, PATHINFO_FILENAME);
        $this->path = $this->getTemplatePath($file)[0];
        $this->path = strtolower($this->path).'/';

    }
    public function index()
    {
        $this->head();
        //$this->header();
        //config\Dispatcher::dispatch();
        //$this->footer();
    }

    public function head()
    {
        $out = array();
        //$out['dev_mode'] = $this->config_flags['dev_mode'];
        $this->path .= __FUNCTION__;
        echo $this->callTemplate($this->path, $out);
    }

    public function header()
    {

    }

    public function footer()
    {
        $out = array();
        $site = new Site();
        $out['copyleft'] = $site->getLaunchYear() >= date('Y') ?
                                $site->getLaunchYear().' '.$site->getAuthor() :
                                $site->getLaunchYear().' - '.date('Y').' '.$site->getAuthor();
        $out['siteversion'] = $site->getVersion();
        echo $this->template->render('main/footer.html', $params);
    }
}
