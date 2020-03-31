<?php
    namespace models;

    use \engine\DbOperations as DbOperations;
    use \controllers\HeaderController as HeaderController;
    
class Header
{
    protected $db;
    public function __construct()
    {
        $this->db = new DbOperations;
    }
        
    public function checkUsers()
    {
        $getUsers = $this->db->select('users') ?? false;
        
        $tableExists = false;
            
        if ($getUsers === false) {
            $tableExists = $this->db->checkTable('users') ?? false;
        }

        if ($tableExists === true) {
            return false;
        } else {
            return '-1';
        }

        return true;
    }

    public function getMenu()
    {
        $menu = $this->db->select('pages', '*', 'header = ?', '1');
        
        if (!empty($menu['id'])) {
            $controller = $this->db->select('controllers', 'name', 'id = ?', $menu[0]['controller']);
            $menu[0]['class'] = $controller[0]['name'];
            return $menu;
        } else {
            return 'Error';
        }
    }
}
