<?php

namespace controllers;

use models\Post as Post;

class PostController extends Controller
{
    protected $path;
    protected $model;

    public function __construct()
    {
        parent::__construct();
        $file = pathinfo(__FILE__, PATHINFO_FILENAME);
        $this->path = $this->getDirectory($file);
        $this->model = new Post();
    }

    public function archive()
    {

        $monthNum = $_GET['month'];
        $year = $_GET['year'];
        $dateObj   = \DateTime::createFromFormat('!m', $monthNum);
        $monthName = $dateObj->format('F');
        $out = array();
        $out['posts'] = $this->model->getCurrentPosts($monthNum, $year);

        $home = new \models\Home();
        $out['categories'] = $home->getCategories();
        $out['about'] = $home->getAbout();
        $out['archives'] = $home->getArchives();
        $out['social'] = $home->getSocial();

        $posts = $this->getFile($this->path, __FUNCTION__);
        echo $this->callView($posts, $out);
    }

    public function detail()
    {
        $id = $_GET['id'];
        $out['posts'] = $this->model->getPost($id);
        $home = new \models\Home();
        $out['categories'] = $home->getCategories();
        $out['about'] = $home->getAbout();
        $out['archives'] = $home->getArchives();
        $out['social'] = $home->getSocial();

        $posts = $this->getFile($this->path, __FUNCTION__);
        echo $this->callView($posts, $out);
    }

    public function category()
    {
        $category = $_GET['category'];
        $out['posts'] = $this->model->getPostsByCategory($category);
        if (empty($out['posts'])) {
            $out['header_results'] = -1;
        }
        $home = new \models\Home();
        $out['categories'] = $home->getCategories();
        $out['about'] = $home->getAbout();
        $out['archives'] = $home->getArchives();
        $out['social'] = $home->getSocial();
        
        $posts = $this->getFile($this->path, __FUNCTION__);
        echo $this->callView($posts, $out);
    }

}