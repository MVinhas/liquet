<?php
    namespace models;

    use \engine\DbOperations as DbOperations;
    use \controllers\AdminController as AdminController;
    
class Admin
{
    protected $db;
    public function __construct()
    {
        $this->db = new DbOperations;
    }
        

    public function getUser($email)
    {
        $user = $this->db->select('users', 'id', 'email = '.$email);
        if (isset($user)) {
            return true;
        }
        return false;
    }
}
