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
        public function checkUserTable($code)
        {
            switch ($code) {
                case '1146': #Table does not exist
                    $fh = fopen('./scripts/createTableHome.txt','r');
                    $table = fgets($fh);
                    fclose($fh);
                    $this->db->createTable($table);
                    break;
            }
        }
        public function checkUsers()
        {
            $getUsers = $this->db->select('users');
            
            if ($getUsers === false) {
                return false;   
            } else if ((int)$getUsers > 0) {
                $this->checkUserTable($getUsers);
                return false;
            } else {
                return $getUsers;
            }
        }    
    }
    
    
