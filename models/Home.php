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
        $tableExists = false;
            
        if ($getUsers === false) {
            $tableExists = $this->db->checkTable('users') ?? false;
        }

        if ($tableExists === true) {
            return false;
        } else {
            if (!empty($getUsers)) {
                return true;
            }
            return '-1';
        }
    }
}
