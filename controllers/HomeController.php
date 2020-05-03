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
            $this->setup();
        } elseif ($this->model->checkUsers() === '-1') {
            $migrations = new \migrations\Setup();
            $migrations->index();
            $home = $this->getFile($this->path, 'first_setup');
            echo $this->callTemplate($home);
        } else {
            $out['categories'] = $this->model->getCategories();
            $out['posts'] = $this->model->getPosts();
            $out['about'] = $this->model->getAbout();
            $out['archives'] = $this->model->getArchives();
            $out['social'] = $this->model->getSocial();
            $home = $this->getFile($this->path, __FUNCTION__);
            echo $this->callTemplate($home, $out);
        }
    }

    public function setup()
    {
        
        $out = array();
        $out['debug_mode'] = $this->config_flags->debug_mode;
        if ($this->model->checkUsers() != 1) {
            $out['first_account'] = 1;
        }
        $setup = $this->getFile($this->path, __FUNCTION__);
        echo $this->callTemplate($setup, $out);
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
        $values = "%s, %s, %s, %s, %d";
        $values = sprintf($values, $_POST['email'], $_POST['username'], $password, $role, 1);
        $createUser = $this->model->createUser('users', $fields, $values);
        if ($createUser == '1') {
            echo "Success!";
            if ($this->config_flags->debug_mode == 0) {
                mail($_POST['email'], "Registered successfully", "Hello, you've been registered successfuly on mvinhas-blog");
            }
            $this->login();
        }
    }

    public function login()
    {
        if (!$_SESSION['users']['email'] && $_POST['username']) {
            $_SESSION['users'] = array(
                'email' => $_POST['email'],
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
}
