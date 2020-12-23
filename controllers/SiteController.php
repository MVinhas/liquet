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
        $this->home = new Home();
    }
    public function index()
    {
        $cpanel = false;
        if ($this->home->checkUsers() === true) {
            $getKeys = array_keys($_GET);
            foreach ($getKeys as $key) {
                $key_func = substr($key, 0, strpos($key, "/"));
                if ($key_func === 'CPanel') {
                    $cpanel = true;
                }
                $key_method = substr($key, strpos($key, "/") + 1);
                if ($key_method === 'createSession' || $key_method === 'logout') {
                    header('Location: ?');
                } 
            }
            $this->registerVisit();
            $this->getMetadata();
            $this->head();

            if ($cpanel === true) {
                $cpanelController = new \controllers\CPanelController;
                $cpanelController->header();
            } else {
                $this->header();
            }
        }
        Dispatcher::dispatch();
        if ($this->home->checkUsers() === true) {
            if ($cpanel === true) {
                $cpanelController->footer();
            } else { 
                $this->footer();
            }
        } 
    }

    private function getMetadata()
    {
        $metadata = Dispatcher::metadata();
    }
    private function head()
    {
        $out = array();
        $out['debug_mode'] = $this->config_flags->debug_mode;
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
        $out['debug_mode'] = $this->config_flags->debug_mode;
        $footerTemplate = $this->getFile($this->path, __FUNCTION__);
        echo $this->view($footerTemplate, $out);
    }
    public function terms()
    {
        $termsTemplate = $this->getFile($this->path, __FUNCTION__);
        echo $this->view($termsTemplate);
    }

    public function subscribe()
    {
        $subscribe = $this->getFile($this->path, __FUNCTION__);
        echo $this->view($subscribe);
    }

    private function registerVisit()
    {
        $this->model->visitCounter();
    }
}
