<?php

namespace controllers;

use \models\Admin as Admin;

class AdminController extends Controller
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
        if (!isset($_SESSION['user'])) {
            $this->login();
        }
    }
    
    public function login()
    {
        $out = array();
        $out['debug_mode'] = $this->config_flags->debug_mode;
        $loginTemplate = $this->getFile($this->path, __FUNCTION__);
        echo $this->callTemplate($loginTemplate, $out);
    }

    public function createSession()
    {
        $admin = new Admin();
        $user = $admin->getUser($_POST['email']);
        if ($user === true) {
            $home = new HomeController;
            $home->login();
        }
        
    }
}
