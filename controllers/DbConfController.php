<?php

    namespace controllers;

class DbConfController extends Controller
{
    protected $path;

    public function index()
    {
        $this->path = 'dbconf/'.__FUNCTION__;
        $this->callTemplate($this->path);
        $this->callFooter();
    }
}
