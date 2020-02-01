<?php

namespace controllers;

use \engine\SiteInfo;
use \config\Dispatcher;
use \models\Header as Header;
use \models\Footer as Footer;

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
        
        $headTemplate = $this->getFile($this->path, __FUNCTION__);
        echo $this->callTemplate($headTemplate, $out);
    }

    private function header()
    {
        $out = array();
        $siteInfo = new SiteInfo();
        $header = new Header();
        $out['sitename'] = $siteInfo->getName();
        $out['menu'] = $header->getMenu();
        $headerTemplate = $this->getFile($this->path, __FUNCTION__);
        echo $this->callTemplate($headerTemplate, $out);
    }

    protected function footer()
    {
        $out = array();
        $site = new SiteInfo();
        $out['copyleft'] = $site->getCopyright();
        $out['siteversion'] = $site->getVersion();
        
        $footerTemplate = $this->getFile($this->path, __FUNCTION__);
        echo $this->callTemplate($footerTemplate, $out);
    }
}
