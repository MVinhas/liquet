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

    public function footer()
    {
        $footer = $this->getFile($this->path, __FUNCTION__);
        echo $this->callTemplate($footer);
    }

    public function postsIndex()
    {
        $cpanel = $this->getFile($this->path, __FUNCTION__);
        $out = array();
        $out['post_list'] = $this->model->getPosts();
        echo $this->callTemplate($cpanel, $out);
    }

    public function postEditor()
    {
        $postCreate = $this->getFile($this->path, __FUNCTION__);
        $out = array();
        $home = new \models\Home();
        if (!empty($_GET['id'])) {
            $out['post_id'] = $_GET['id'];
            $out['post'] = $home->getPost($_GET['id']);
        }
        $out['categories'] = $home->getCategories();
        $out['author'] = $_SESSION['users']['username'];
        $out['debug_mode'] = $this->config_flags->debug_mode;
        echo $this->callTemplate($postCreate, $out); 
    }

    public function postEditorSubmit()
    {
        if (!empty($_GET['id'])) {
            $post = array();
            $post['title'] = $_POST['title'];
            $post['category'] = $_POST['category'];
            $post['short_content'] = $_POST['short_content'];
            $post['content'] = $_POST['content'];
            $this->model->editPost($_GET['id'], $post);
        } else {
            $this->model->createPost($_POST);
        }
        
        $cpanel = $this->getFile($this->path, 'postsIndex');
        $out = array();
        $out['post_list'] = $this->model->getPosts();
        echo $this->callTemplate($cpanel, $out);
    }

    public function postDelete()
    {
        $post_id = $_GET['id'];
        $this->model->deletePost($post_id);
        $cpanel = $this->getFile($this->path, 'postsIndex');
        $out = array();
        $out['post_list'] = $this->model->getPosts();
        echo $this->callTemplate($cpanel, $out);
    }
}