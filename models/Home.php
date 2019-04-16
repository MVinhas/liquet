<?php
    namespace models;

    use \engine\DbOperations as DbOperations;
    use \controllers\HomeController as HomeController;
    
    class Home
    {

        public function checkUsers()
        {
            $database = new DbOperations();
            $get_users = $database->select('users');
            if ($get_users === false) {
                return false;   
            }
        }    
    }
    
    
