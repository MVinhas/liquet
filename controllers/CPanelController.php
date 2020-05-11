<?php

namespace controllers;

use \engine\SiteInfo;
use \models\CPanel as CPanel;

class CPanelController extends Controller
{
    protected $path;
    
    public function __construct()
    {
        parent::__construct();
        $file = pathinfo(__FILE__, PATHINFO_FILENAME);
        $this->path = $this->getDirectory($file);
        $this->model = new CPanel();
    }

    public function index()
    {
        $cpanel = $this->getFile($this->path, __FUNCTION__);
        echo $this->callTemplate($cpanel);
    }

    public function header()
    {
        $header = $this->getFile($this->path, __FUNCTION__);
        $siteInfo = new SiteInfo();
        $out = array();
        $out['sitename'] = $siteInfo->getName();
        echo $this->callTemplate($header, $out);
    }

    public function postsIndex()
    {
        $cpanel = $this->getFile($this->path, __FUNCTION__);
        $out = array();
        $out['post_list'] = $this->model->getPosts();
        echo $this->callTemplate($cpanel, $out);
    }
}