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

    public function index()
    {
        $monthNum = $_GET['month'];
        $dateObj   = \DateTime::createFromFormat('!m', $monthNum);
        $monthName = $dateObj->format('F');
        $out = array();
        $out['posts'] = $this->model->getCurrentPosts($_GET['month'], $_GET['year']);
        $posts = $this->getFile($this->path, __FUNCTION__);
        echo $this->callTemplate($posts, $out);
    }

}