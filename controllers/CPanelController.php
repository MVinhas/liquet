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

    public function postCreate()
    {
        $postCreate = $this->getFile($this->path, __FUNCTION__);
        $out = array();
        $home = new \models\Home();
        $out['categories'] = $home->getCategories();
        $out['author'] = $_SESSION['users']['username'];
        $out['debug_mode'] = $this->config_flags->debug_mode;
        echo $this->callTemplate($postCreate, $out); 
    }

    public function postCreateSubmit()
    {
        echo "<pre>";print_r($_POST);"</pre>";
    }
}