<?php

namespace controllers;

class DbConfController extends Controller
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
        
        $setup = $this->getFile($this->path, __FUNCTION__);
        echo $this->callTemplate($setup);
    }
}
