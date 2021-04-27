<?php

namespace controllers;

use models\Post as Post;
use models\Site as Site;
use models\Home as Home;

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
        $get = filter_input_array(INPUT_GET, FILTER_VALIDATE_INT);
        $dateObj   = \DateTime::createFromFormat('!m', $get['month']);
        $out = array();
        $out['articles'] = $this->model->getCurrentPosts($get['month'], $get['year']);
        if (!isset($out['articles'][0])) {
            $temp = $out['articles'];
            unset($out['articles']);
            $out['articles'][0] = $temp;
        }
        $home = new Home();
        $out['categories'] = $this->site->getCategories();
        $out['about'] = $home->getAbout();
        $out['archives'] = $home->getArchives();
        $out['social'] = $home->getSocial();
        $articles = $this->getFile($this->path, __FUNCTION__);
        $this->view($articles, $out);
    }

    public function detail()
    {
        $out['article'] = $this->site->getArticle(filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT));
        $home = new Home();
        $out['categories'] = $this->site->getCategories();
        $out['about'] = $home->getAbout();
        $out['archives'] = $home->getArchives();
        $out['social'] = $home->getSocial();

        $articles = $this->getFile($this->path, __FUNCTION__);
        $this->view($articles, $out);
    }

    public function category()
    {
        $out['articles'] = $this->model->getArticlesByCategory(filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT));
        if (!isset($out['articles'][0]) && !empty($out['articles'])) {
            $temp = $out['articles'];
            unset($out['articles']);
            $out['articles'][0] = $temp;
        }
        $home = new Home();
        $out['categories'] = $this->site->getCategories();
        $out['about'] = $home->getAbout();
        $out['archives'] = $home->getArchives();
        $out['social'] = $home->getSocial();
        
        $articles = $this->getFile($this->path, __FUNCTION__);
        $this->view($articles, $out);
    }
}