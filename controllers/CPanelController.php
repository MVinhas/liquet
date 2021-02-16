<?php

namespace controllers;

use \engine\SiteInfo;
use \models\CPanel as CPanel;
use \models\Site as Site;

class CPanelController extends Controller
{
    protected $path;
    protected $model;
    protected $site;
    
    public function __construct()
    {
        parent::__construct();
        $file = pathinfo(__FILE__, PATHINFO_FILENAME);
        $this->path = $this->getDirectory($file);
        $this->model = new CPanel();
        $this->site = new Site();
    }

    public function index()
    {
        $out['sessions'] = array();
        $out['sessions']['today'] = 0;
        $out['sessions']['week'] = 0;
        $out['sessions']['alltime'] = 0;
        $visits = $this->model->getVisits();
        foreach ($visits as $k => $v) {
            // Today
            if ($v['date'] == date('Y-m-d 00:00:00')) $out['sessions']['today'] = $v['session']; 
            // Week
            if ($v['date'] <= date('Y-m-d 00:00:00') && $v['date'] >= date('Y-m-d 00:00:00', strtotime('-7 days'))) $out['sessions']['week'] += $v['session'];
            // All time
            $out['sessions']['alltime'] += $v['session'];
        }
        $cpanel = $this->getFile($this->path, __FUNCTION__);
        echo $this->view($cpanel, $out);
    }

    public function header()
    {
        $header = $this->getFile($this->path, __FUNCTION__);
        $siteInfo = new SiteInfo();
        $out = array();
        if (!isset($_GET['CPanel/index'])) {
            $out['searchable'] = 1;
        }
        $out['sitename'] = $siteInfo->getName();
        echo $this->view($header, $out);
    }

    public function footer()
    {
        $footer = $this->getFile($this->path, __FUNCTION__);
        $out = array();
        $out['debug_mode'] = $this->config_flags->debug_mode;
        echo $this->view($footer, $out);
    }

    public function postsIndex()
    {
        $cpanel = $this->getFile($this->path, __FUNCTION__);
        $out = array();
        $out['post_list'] = $this->model->getPosts();
        echo $this->view($cpanel, $out);
    }

    public function categoriesIndex()
    {
        $cpanel = $this->getFile($this->path, __FUNCTION__);
        $out = array();
        $out['categories_list'] = $this->site->getCategories();
        echo $this->view($cpanel, $out);
    }

    public function configEditor()
    {
        $cpanel = $this->getFile($this->path, __FUNCTION__);
        $out = array();
        $out['config'] = $this->site->getConfig();
        echo $this->view($cpanel, $out);
    }

    public function postEditor()
    {
        $postCreate = $this->getFile($this->path, __FUNCTION__);
        $out = array();
        if (!empty($_GET['id'])) {
            $out['post']['id'] = $_GET['id'];
            $out['post'] = $this->site->getPost($_GET['id']);
        }
        $out['categories'] = $this->site->getCategories();
        $out['author'] = $_SESSION['users']['username'];
        $out['debug_mode'] = $this->config_flags->debug_mode;
        echo $this->view($postCreate, $out); 
    }

    public function categoryEditor()
    {
        $categoryCreate = $this->getFile($this->path, __FUNCTION__);
        $out = array();
        if (!empty($_GET['id'])) {
            $out['category_id'] = $_GET['id'];
            $out['category'] = $this->site->getCategory($_GET['id']);
        }
        $out['debug_mode'] = $this->config_flags->debug_mode;
        echo $this->view($categoryCreate, $out); 
    }

    public function postEditorSubmit()
    {
        if (!empty($_GET['id'])) {
            $this->model->editPost($_GET['id'], $_POST);
        } else {
            $this->model->createPost($_POST);
        }
        
        $cpanel = $this->getFile($this->path, 'postsIndex');
        $out = array();
        $out['post_list'] = $this->model->getPosts();
        echo $this->view($cpanel, $out);
    }

    public function categoryEditorSubmit()
    {
        if (!empty($_GET['id'])) {
            $category = array();
            $category['name'] = $_POST['name'];
            $this->model->editCategory($_GET['id'], $category);
        } else {
            $this->model->createCategory($_POST);
        }
        
        $cpanel = $this->getFile($this->path, 'categoriesIndex');
        $out = array();
        $out['categories_list'] = $this->site->getCategories();
        echo $this->view($cpanel, $out);
    }

    public function configEditorSubmit()
    {
        $this->model->editConfig($_POST);
        $this->index();
    }

    public function postDelete()
    {
        $post_id = $_GET['id'];
        $this->model->deletePost($post_id);
        $cpanel = $this->getFile($this->path, 'postsIndex');
        $out = array();
        $out['post_list'] = $this->model->getPosts();
        echo $this->view($cpanel, $out);
    }

    public function categoryDelete()
    {
        $category_id = $_GET['id'];
        $this->model->deleteCategory($category_id);
        $cpanel = $this->getFile($this->path, 'categoriesIndex');
        $out = array();
        $out['categories_list'] = $this->site->getCategories();
        echo $this->view($cpanel, $out);
    }
}