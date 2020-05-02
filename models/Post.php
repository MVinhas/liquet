<?php
    namespace models;

    use \engine\DbOperations as DbOperations;
    use \controllers\PostController as PostController;
    
class Post
{
    protected $db;
    public function __construct()
    {
        $this->db = new DbOperations;
    }

    public function getCurrentPosts($month = '1', $year = '1970')
    {
        $date = $month.','.$year;
        $posts = $this->db->select('posts', '*', 'DATE_FORMAT(date, "%m") LIKE ? AND DATE_FORMAT(date, "%Y") LIKE ?', $date);

        return $posts;   
    }
}