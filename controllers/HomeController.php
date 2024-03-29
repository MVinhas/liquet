<?php

namespace controllers;

use models\Home as Home;
use models\Site as Site;

class HomeController extends Controller
{

    protected $path;
    protected $model;
    protected $site;
    public function __construct()
    {
        parent::__construct();
        $file = pathinfo(__FILE__, PATHINFO_FILENAME);
        $this->path = $this->getDirectory($file);
        $this->model = new Home();
        $this->site = new Site();
    }

    public function index()
    {
        $offset = 0;
        if (isset($_GET['page'])) {
            $offset += ($_GET['page'] * 5);
            $out['page'] = $_GET['page'];
        }

        $out['posts'] = $this->model->getPosts($offset);
        $out['about'] = $this->model->getAbout();
        $out['archives'] = $this->model->getArchives();
        $out['social'] = $this->model->getSocial();
        $home = $this->getFile($this->path, __FUNCTION__);
        echo $this->view($home, $out);
    }

    public function register()
    {
        $fields = 'email, username, password, role, active';
        $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
        $admin_exists = $this->model->checkAdmin();
        $admin_exists === 1 ? $role = 'user' : $role = 'admin'; 

        $values = array($_POST['email'], $_POST['username'], $password, $role, 1);
        $createUser = $this->model->createUser($fields, $values);
        $createUser === 1 ? $this->login($email, $role) : $this->setup($createUser);
    }

    public function login($email, $role)
    {
        if (!isset($_SESSION['users']['email']) && $_POST['username'])
            $_SESSION['users'] = array(
                'email' => $email,
                'username' => $_POST['username'],
                'role' => $role
            );
    }

    public function logout()
    {
        unset($_SESSION['users']);
    }

    public function search()
    {
        if (empty($_POST['search'])) 
            return $this->index();
        $out = array();
        $out['categories'] = $this->site->getCategories();
        $out['about'] = $this->model->getAbout();
        $out['archives'] = $this->model->getArchives();
        $out['social'] = $this->model->getSocial();
        $search_terms = explode(" ", $_POST['search']);
        $out['posts'] = $this->model->getPostsBySearch($search_terms);
        if (!isset($out['posts'][0]) && !empty($out['posts'])) {
            $temp = $out['posts'];
            unset($out['posts']);
            $out['posts'][0] = $temp;
            $out['number_results'] = count($out['posts']);
        } elseif (!empty($out['posts'])) {
            $out['number_results'] = count($out['posts']);
        }
        $search = $this->getFile($this->path, __FUNCTION__);
        echo $this->view($search, $out); 
    }

    public function setup($message = '')
    {
        
        $out = array();
        $out['debug_mode'] = $this->config_flags->debug_mode;
        $out['message'] = $message;
        if ($this->model->checkUsers() != 1) {
            $out['first_account'] = 1;
        }
        $setup = $this->getFile($this->path, __FUNCTION__);
        echo $this->view($setup, $out);
    }

}
