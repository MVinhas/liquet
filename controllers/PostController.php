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
        $this->site = new Site()
    }

    public function archive()
    {
        $get = filter_input_array(INPUT_GET, FILTER_VALIDATE_INT);
        $dateObj   = \DateTime::createFromFormat('!m', $get['month']);
        $out = array();
        $out['posts'] = $this->model->getCurrentPosts($get['month'], $get['year']);
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
        $this->view($posts, $out);
    }

    public function detail()
    {
        $out['post'] = $this->site->getPost(filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT));
        $home = new \models\Home();
        $out['categories'] = $this->site->getCategories();
        $out['about'] = $home->getAbout();
        $out['archives'] = $home->getArchives();
        $out['social'] = $home->getSocial();

        $posts = $this->getFile($this->path, __FUNCTION__);
        $this->view($posts, $out);
    }

    public function category()
    {
        $out['posts'] = $this->model->getPostsByCategory(filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT));
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
        $this->view($posts, $out);
    }
}