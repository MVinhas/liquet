<?php

namespace controllers;

use models\Home as Home;

class HomeController extends Controller
{

    protected $path;

    public function __construct()
    {
        parent::__construct();
        $file = pathinfo(__FILE__, PATHINFO_FILENAME);
        $this->path = $this->getDirectory($file);
    }

    public function index()
    {
        $model = new Home();
        if ($model->checkUsers() === false) {
            $this->setup();
        } elseif ($model->checkUsers() === '-1') {
            $migrations = new \migrations\Setup();
            $migrations->index();
            $home = $this->getFile($this->path, 'first_setup');
            echo $this->callTemplate($home);
        } else {
            $home = $this->getFile($this->path, __FUNCTION__);
            echo $this->callTemplate($home);
        }
    }

    public function setup()
    {
        
        $out = array();
        $out['debug_mode'] = $this->config_flags->debug_mode;
        $model = new Home();
        if ($model->checkUsers() != 1) {
            $out['first_account'] = 1;
        }
        $setup = $this->getFile($this->path, __FUNCTION__);
        echo $this->callTemplate($setup, $out);
    }

    public function register()
    {
        $db = new \engine\DbOperations();
        $fields = 'email, username, password, role, active';
        $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
        $values = "%s, %s, %s, %s, %d";
        $values = sprintf($values, $_POST['email'], $_POST['username'], $password, 'admin', 1);
        $createUser = $db->create('users', $fields, $values);
        if ($createUser === true) {
            echo "Success!";
            if ($this->config_flags->debug_mode == 1) {
                //Something to write to txt log
                $log  = "User registered: ".$_POST['username'].' - '.date("F j, Y, g:i a").PHP_EOL;
                "-------------------------".PHP_EOL;
                //Save string to log, use FILE_APPEND to append.
                file_put_contents('../log_'.date("j.n.Y").'.log', $log, FILE_APPEND);
            } else {
                mail($_POST['email'],"Registered successfully","Hello, you've been registered successfuly on mvinhas-blog");
            }   
        } else {
            echo $createUser;
        }
    }
}
