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
        foreach ($menu as $k => $v) {
            $controller = $this->db->select('controllers', 'name', 'id = ?', $v['controller']);
            $method = $this->db->select('methods', 'name', 'id = ?', $v['method']);
            $menu[$k]['class'] = $controller[0]['name'].'/'.$method[0]['name'];
        }
        if (!empty($menu)) {
            return $menu;
        }
        return 'Error';
    }
}
