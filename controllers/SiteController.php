<?php

namespace controllers;

use \engine\SiteInfo;
use \config\Dispatcher;

class SiteController extends Controller
{
    protected $path;

    public function __construct()
    {
        parent::__construct();
        $file = pathinfo(__FILE__, PATHINFO_FILENAME);
        $this->path = $this->getDirectory($file);
    }

    public function index()
    {
        $this->head();
        $this->header();
        Dispatcher::dispatch();
        $this->footer();
    }

    private function head()
    {
        $out = array();
        $out['debug_mode'] = $this->config_flags->debug_mode;
        $head = $this->getFile($this->path, __FUNCTION__);
        echo $this->callTemplate($head, $out);
    }

    private function header()
    {
        $out = array();
        $site = new SiteInfo();
        $out['sitename'] = $site->getName();
        $header = $this->getFile($this->path, __FUNCTION__);
        echo $this->callTemplate($header, $out);
    }

    protected function footer()
    {
        $out = array();
        $site = new SiteInfo();
        $out['copyleft'] = $site->getCopyright();
        $out['siteversion'] = $site->getVersion();
        $footer = $this->getFile($this->path, __FUNCTION__);
        echo $this->callTemplate($footer, $out);
    }
}
