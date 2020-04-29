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

    public function checkAdmin()
    {
        $admin_exists = $this->db->select('users','*','role = ?','admin');
        if (!empty($admin_exists))
            return '1';
        return '0';
    }

    public function createUser($table = 'users', $fields, $values)
    {
        $createUser = $this->db->create('users', $fields, $values);

        if ($createUser === true) {
            return "1";
        } else {
            return $createUser;
        }
    }

    public function getCategories()
    {
        $categories = $this->db->select('categories','*');
        return $categories;
    }

    public function getPosts()
    {
        $posts = $this->db->select('posts','*', 'status = ?','1');
        foreach ($posts as $k => $v) {
            $category = $this->db->select('categories','*','id = ?',$v['category']);
            $posts[$k]['category'] = $category[0]['name'];
        }
        return $posts;
    }
}
