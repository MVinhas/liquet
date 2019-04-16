<?php
    
    namespace controllers;

    Class Controller
    {
        public function __construct()
        {
            include 'config/conf.php';
            $this->debug_mode = $debug_mode;
            $this->twig = $twig;
        }
    }