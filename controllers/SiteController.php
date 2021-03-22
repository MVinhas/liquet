<?php

namespace controllers;

use \engine\SiteInfo;
use \config\Dispatcher;
use \models\Header as Header;
use \models\Footer as Footer;
use \models\Site as Site;
use \models\Home as Home;

class SiteController extends Controller
{
    protected $path, $home, $model;

    public function __construct()
    {
        parent::__construct();
        $file = pathinfo(__FILE__, PATHINFO_FILENAME);
        $this->path = $this->getDirectory($file);
        $this->model = new Site();
    }
    public function index()
    {
        $this->model->visitCounter();
        Dispatcher::metadata();
        $this->head();

        $getKeys = array_keys($_GET);
        
        $key_method = substr($getKeys[0], strpos($getKeys[0], "/") + 1);
        
        if ($key_method === 'createSession') 
            header('Location: ?CPanel/index');
        if ($key_method === 'logout') 
            header('Location: ?');

        $key_func = substr($getKeys[0], 0, strpos($getKeys[0], "/"));
        if ($key_func === 'CPanel') {
            $cpanelController = new \controllers\CPanelController;
            $cpanelController->header();
        } else {
            $this->header();    
        }
        Dispatcher::dispatch();
        $this->footer();   
    }

    private function head()
    {
        $out = array();
        $out['debug_mode'] = $this->config_flags->debugmode;
        $out['page_title'] = $_SESSION['page_title'];
        $headTemplate = $this->getFile($this->path, __FUNCTION__);
        echo $this->view($headTemplate, $out);
    }

    private function header()
    {
        $out = array();
        $siteInfo = new SiteInfo();
        $header = new Header();
        $out['sitename'] = $siteInfo->getName();
        $out['header'] = $header->getMenu();
        $out['categories'] = $this->model->getCategories();
        if (!empty($_SESSION['users']))
            $out['session'] = $_SESSION['users'];
        $headerTemplate = $this->getFile($this->path, __FUNCTION__);
        echo $this->view($headerTemplate, $out);
    }

    protected function footer()
    {
        $out = array();
        $site = new SiteInfo();
        $out['copyleft'] = $site->getCopyright();
        $out['siteversion'] = $site->getVersion();
        $out['debug_mode'] = $this->config_flags->debugmode;
        $footerTemplate = $this->getFile($this->path, __FUNCTION__);
        echo $this->view($footerTemplate, $out);
    }
    public function terms()
    {
        $out = array();
        $out['site_name'] = $this->config_flags->sitename;
        $out['email'] = $this->config_flags->email;
        $termsTemplate = $this->getFile($this->path, __FUNCTION__);
        echo $this->view($termsTemplate, $out);
    }

    public function subscribe()
    {
        $subscribe = $this->getFile($this->path, __FUNCTION__);
        echo $this->view($subscribe);
    }
}
