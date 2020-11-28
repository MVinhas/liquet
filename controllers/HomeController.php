<?php

namespace controllers;

use models\Home as Home;

class HomeController extends Controller
{

    protected $path;
    protected $model;

    public function __construct()
    {
        parent::__construct();
        $file = pathinfo(__FILE__, PATHINFO_FILENAME);
        $this->path = $this->getDirectory($file);
        $this->model = new Home();
    }

    public function index()
    {
        if ($this->model->checkUsers() === false) {
            $migrations = new \migrations\Setup();
            $migrations->index();
            $home = $this->getFile($this->path, 'first_setup');
            echo $this->callView($home);
        } else {
            $out['categories'] = $this->model->getCategories();
            $offset = 0;
            if (isset($_GET['page'])) {
                $offset = $_GET['page'] * 5;
                $out['page'] = $_GET['page'];
            }
            $out['posts'] = $this->model->getPosts($offset);
            $out['about'] = $this->model->getAbout();
            $out['archives'] = $this->model->getArchives();
            $out['social'] = $this->model->getSocial();
            $home = $this->getFile($this->path, __FUNCTION__);
            echo $this->callView($home, $out);
        }
    }

    public function register()
    {
        $fields = 'email, username, password, role, active';
        $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
        $admin_exists = $this->model->checkAdmin();
        if ($admin_exists == 1) {
            $role = 'user';
        } else {
            $role = 'admin';
        }

        $values = array($_POST['email'], $_POST['username'], $password, $role, 1);
        $createUser = $this->model->createUser('users', $fields, $values);
        if ($createUser == '1') {
            $this->login();
        } else {
            $this->setup($createUser);
        }
    }

    public function login($email)
    {
        if (!isset($_SESSION['users']['email']) && $_POST['username']) {
            $_SESSION['users'] = array(
                'email' => $email,
                'username' => $_POST['username'],
                'role' => 'admin'
            );
        }
        header('Location: ?Home');

    }

    public function logout()
    {
        unset($_SESSION['users']);
        header('Location: ?Home');
    }

    public function search()
    {
        $out = array();
        $out['categories'] = $this->model->getCategories();
        $out['about'] = $this->model->getAbout();
        $out['archives'] = $this->model->getArchives();
        $out['social'] = $this->model->getSocial();
        if (!empty($_POST['search'])) {
            $search_terms = explode(" ", $_POST['search']);
            $out['posts'] = $this->model->getPostsBySearch($search_terms);
            if (empty($out['posts'])) {
                $out['header_results'] = -1;    
            } else {
                $out['number_results'] = count($out['posts']);
            }
            $search = $this->getFile($this->path, __FUNCTION__);
            echo $this->callView($search, $out); 
        } else{
            $this->index();
        } 
    }
}
