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
        $data = array('admin');
        $admin_exists = $this->db->select('users','*','role = ?', $data);
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

    public function getPosts($offset = '0')
    {
        $data = array('1');
        $posts = $this->db->select('posts','*', 'status = ? ORDER BY id DESC LIMIT 5 OFFSET '.$offset, $data);
        foreach ($posts as $k => $v) {
            $data = array($v['category']);
            $category = $this->db->select('categories','*','id = ?', $data);
            $posts[$k]['category_name'] = $category[0]['name'];
        }
        return $posts;
    }

    public function getPost($id)
    {
        $data = array($id);
        $post = $this->db->select('posts', '*', 'id = ?', $data);

        return $post;
    }

    public function getCategory($id)
    {
        $data = array($id);
        $category = $this->db->select('categories', '*', 'id = ?', $data);

        return $category;
    }

    public function getAbout()
    {   
        $data = array('1');
        $about = $this->db->select('about','*','id = ?', $data);
        return $about;
    }

    public function getArchives()
    {
        $data = array('1');
        $archives = $this->db->select('posts', 'COUNT(*) AS Total, DATE_FORMAT(date, "%M %Y") AS date, DATE_FORMAT(date, "%m") as month, DATE_FORMAT(date, "%Y") as year ', '1= ? GROUP BY DATE_FORMAT(date, "%M %Y"), DATE_FORMAT(date, "%m"), DATE_FORMAT(date, "%Y")', $data);
        return $archives;
    }

    public function getSocial()
    {
        $data = array('1');
        $social = $this->db->select('social', '*', 'visible = ?', $data);
        return $social;
    }

    public function getPostsBySearch($search)
    {
        $sql = '';
        $data = array('1');
        foreach ($search as $k => $v) {
            if ($v !== "") {
                $sql .= " AND title LIKE CONCAT('%',?,'%') ";
                array_push($data, $v);
            }
        }
        $field = rtrim($field, ',');
        $posts = $this->db->select('posts', '*', '1= ?'.$sql, $data);
        return $posts;
    }
}
