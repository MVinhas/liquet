<?php
    namespace models;

    use \engine\DbOperations as DbOperations;
    use \controllers\HomeController as HomeController;
    
    class Home
    {
        protected $db; 
        public function __construct()
        {
            $this->db = new DbOperations;
        }
        
        public function checkUsers()
        {
            $getUsers = $this->db->select('users');
            
            if ($getUsers === false) {
                $tableExists = $this->db->checkTable('users');  
            }

            if ($tableExists === true) {
                return false;
            } else {
                return '-1';
            }

            return true;

        }
           
    }
    
    
