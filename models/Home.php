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
  
        if (is_array($getUsers)) {
            return true;
        } else {
            return false;
        }
    }

    public function checkAdmin()
    {
        $data = array('admin');
        $admin_exists = $this->db->select('users','id','role = ?', $data);
        if (!empty($admin_exists))
            return 1;
        return 0;
    }

    public function createUser(string $fields, array $values)
    {
        $createUser = $this->db->create('users', $fields, $values);

        if ($createUser === true) {
            return 1;
        } else {
            return $createUser;
        }
    }

    public function getPosts(int $offset = 0)
    {
        $data = array(1);
        $posts = $this->db->select('posts','*', 'status = ? ORDER BY id DESC LIMIT 5 OFFSET '.$offset, $data);
        foreach ($posts as $k => $v) {
            $data = array($v['category']);
            $category = $this->db->select('categories','*','id = ? ORDER BY id ASC', $data);
            !empty($category) ?? $posts[$k]['category_name'] = $category['name'] :: $posts[$k]['category_name'] = 'No Category';
        }
        return $posts;
    }

    public function getAbout()
    {   
        $data = array(1);
        $about = $this->db->select('about','*','id = ?', $data);
        return $about;
    }

    public function getArchives()
    {
        $data = array(1);
        $rows = $this->db->select('posts', 'COUNT(*) AS Total, DATE_FORMAT(date, "%M %Y") AS date, DATE_FORMAT(date, "%m") as month, DATE_FORMAT(date, "%Y") as year ', '1= ? GROUP BY DATE_FORMAT(date, "%M %Y"), DATE_FORMAT(date, "%m"), DATE_FORMAT(date, "%Y")', $data);
        $archives = array();
        array_key_exists('Total', $rows) ? $archives[0] = $rows : $archives = $rows;
        return $archives;
    }

    public function getSocial()
    {
        $data = array(1);
        $rows = $this->db->select('social', '*', 'visible = ?', $data);
        $social = array();
        array_key_exists('name', $rows) ? $social[0] = $rows : $social = $rows;
        return $social;
    }

    public function getPostsBySearch(array $search)
    {
        $sql = '';
        $data = array(1);
        foreach ($search as $k => $v) {
            if ($v !== "") {
                $sql .= " AND title LIKE CONCAT('%',?,'%') ";
                array_push($data, $v);
            }
        }
        $posts = $this->db->select('posts', '*', '1= ?'.$sql, $data);
        return $posts;
    }
}
