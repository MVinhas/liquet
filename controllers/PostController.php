<?php

namespace controllers;

use models\Post as Post;
use models\Site as Site;

class PostController extends Controller
{
    protected $path;
    protected $model;
    protected $site;

    public function __construct()
    {
        parent::__construct();
        $file = pathinfo(__FILE__, PATHINFO_FILENAME);
        $this->path = $this->getDirectory($file);
        $this->model = new Post();
        $this->site = new Site();
    }

    public function archive()
    {

        $monthNum = $_GET['month'];
        $year = $_GET['year'];
        $dateObj   = \DateTime::createFromFormat('!m', $monthNum);
        $monthName = $dateObj->format('F');
        $out = array();
        $out['posts'] = $this->model->getCurrentPosts($monthNum, $year);
        if (!isset($out['posts'][0])) {
            $temp = $out['posts'];
            unset($out['posts']);
            $out['posts'][0] = $temp;
        }
        $home = new \models\Home();
        $out['categories'] = $this->site->getCategories();
        $out['about'] = $home->getAbout();
        $out['archives'] = $home->getArchives();
        $out['social'] = $home->getSocial();
        $posts = $this->getFile($this->path, __FUNCTION__);
        echo $this->view($posts, $out);
    }

    public function detail()
    {
        $id = $_GET['id'];
        $out['post'] = $this->site->getPost($id);
        $home = new \models\Home();
        $out['categories'] = $this->site->getCategories();
        $out['about'] = $home->getAbout();
        $out['archives'] = $home->getArchives();
        $out['social'] = $home->getSocial();

        $posts = $this->getFile($this->path, __FUNCTION__);
        echo $this->view($posts, $out);
    }

    public function category()
    {
        $category = $_GET['category'];
        $out['posts'] = $this->model->getPostsByCategory($category);
        if (!isset($out['posts'][0]) && !empty($out['posts'])) {
            $temp = $out['posts'];
            unset($out['posts']);
            $out['posts'][0] = $temp;
        }
        $home = new \models\Home();
        $out['categories'] = $this->site->getCategories();
        $out['about'] = $home->getAbout();
        $out['archives'] = $home->getArchives();
        $out['social'] = $home->getSocial();
        
        $posts = $this->getFile($this->path, __FUNCTION__);
        echo $this->view($posts, $out);
    }

}