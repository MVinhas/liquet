<?php

namespace controllers;

use \engine\Site;
use \config\Dispatcher;

class SiteController extends Controller
{
    protected $path;

    public function __construct()
    {
        parent::__construct();
        $file = pathinfo(__FILE__, PATHINFO_FILENAME);
        $this->path = $this->getTemplatePath($file)[0];
        $this->path = strtolower($this->path).'/';

    }
    public function index()
    {
        $this->head();
        $this->header();
        Dispatcher::dispatch();
        $this->footer();
    }

    public function head()
    {
        $out = array();
        $out['debug_mode'] = $this->config_flags['debug_mode'];
        $head = $this->path.__FUNCTION__;
        echo $this->callTemplate($head, $out);
    }

    public function header()
    {
        $out = array();
        $site = new Site();
        $out['sitename'] = $site->getName();
        $header = $this->path.__FUNCTION__;
        echo $this->callTemplate($header, $out);
    }

    public function footer()
    {
        $out = array();
        $site = new Site();
        $out['copyleft'] = $site->getCopyright();
        $out['siteversion'] = $site->getVersion();
        $footer = $this->path.__FUNCTION__;
        echo $this->callTemplate($footer, $out);
    }
}
