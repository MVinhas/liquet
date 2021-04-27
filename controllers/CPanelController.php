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
        foreach ($visits as $visit) {
            // Today
            if ($visit['date'] == date('Y-m-d 00:00:00')) 
                $out['sessions']['today'] = $visit['session']; 
            // Week
            if ($visit['date'] <= date('Y-m-d 00:00:00') && $visit['date'] >= date('Y-m-d 00:00:00', strtotime('-7 days'))) 
                $out['sessions']['week'] += $visit['session'];
            // All time
            $out['sessions']['alltime'] += $visit['session'];
        }
        $cpanel = $this->getFile($this->path, __FUNCTION__);
        $this->view($cpanel, $out);
    }

    public function header()
    {
        $header = $this->getFile($this->path, __FUNCTION__);
        $siteInfo = new SiteInfo();
        $out = array();
        if (!isset($_GET['CPanel/index']))
            $out['searchable'] = 1;

        $out['sitename'] = $siteInfo->getName();
        $this->view($header, $out);
    }

    public function footer()
    {
        $footer = $this->getFile($this->path, __FUNCTION__);
        $out = array();
        $out['debugmode'] = $this->config_flags->debugmode;
        $this->view($footer, $out);
    }

    public function postsIndex()
    {
        $cpanel = $this->getFile($this->path, __FUNCTION__);
        $out = array();
        $out['post_list'] = $this->model->getPosts();
        $this->view($cpanel, $out);
    }

    public function categoriesIndex()
    {
        $cpanel = $this->getFile($this->path, __FUNCTION__);
        $out = array();
        $out['categories_list'] = $this->site->getCategories();
        $this->view($cpanel, $out);
    }

    public function configEditor()
    {
        $cpanel = $this->getFile($this->path, __FUNCTION__);
        $out = array();
        $out['config'] = $this->site->getConfig();
        $this->view($cpanel, $out);
    }

    public function postEditor()
    {
        $postCreate = $this->getFile($this->path, __FUNCTION__);
        $out = array();
        if (!empty($getid)) {
            $out['post']['id'] = $_GET['id'];
            $out['post'] = $this->site->getPost($getid);
        }
        $out['categories'] = $this->site->getCategories();
        $out['author'] = $_SESSION['users']['username'];
        $out['debugmode'] = $this->config_flags->debugmode;
        $this->view($postCreate, $out); 
    }

    public function categoryEditor()
    {
        $categoryCreate = $this->getFile($this->path, __FUNCTION__);
        $out = array();
        if (!empty($getid)) {
            $out['category_id'] = $getid;
            $out['category'] = $this->site->getCategory($getid);
        }
        $out['debugmode'] = $this->config_flags->debugmode;
        $this->view($categoryCreate, $out); 
    }

    public function postEditorSubmit()
    {
        $post = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
        !empty($getid) ? $this->model->editPost($getid, $post) : $this->model->createPost($post);
        
        $cpanel = $this->getFile($this->path, 'postsIndex');
        $out = array();
        $out['post_list'] = $this->model->getPosts();
        $this->view($cpanel, $out);
    }

    public function categoryEditorSubmit()
    {
        $post = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
        if (!empty($getid)) {
            $category = array();
            $category['name'] = $post['name'];
            $this->model->editCategory($getid, $category);
        } else {
            $this->model->createCategory($post);
        }
        
        $cpanel = $this->getFile($this->path, 'categoriesIndex');
        $out = array();
        $out['categories_list'] = $this->site->getCategories();
        $this->view($cpanel, $out);
    }

    public function configEditorSubmit()
    {
        $post = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
        $this->model->editConfig($post);
        header('Location: ?CPanel/index');
    }

    public function postDelete()
    {
        $post_id = filter_input(INPUT_GET, $_GET['id'], FILTER_VALIDADE_INT);
        $this->model->deletePost($post_id);
        $cpanel = $this->getFile($this->path, 'postsIndex');
        $out = array();
        $out['post_list'] = $this->model->getPosts();
        $this->view($cpanel, $out);
    }

    public function categoryDelete()
    {
        $category_id = filter_input(INPUT_GET, $_GET['id'], FILTER_VALIDADE_INT);
        $this->model->deleteCategory($category_id);
        $cpanel = $this->getFile($this->path, 'categoriesIndex');
        $out = array();
        $out['categories_list'] = $this->site->getCategories();
        $this->view($cpanel, $out);
    }
}