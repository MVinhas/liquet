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
        $data = array($month, $year);
        $posts = $this->db->select('posts', '*', 'DATE_FORMAT(date, "%m") LIKE ? AND DATE_FORMAT(date, "%Y") LIKE ?', $data);

        return $posts;   
    }

    public function getPost(int $id)
    {
        $data = array($id);
        $post = $this->db->select('posts', '*', 'id = ?', $data);

        return $post;
    }

    public function getPostsByCategory(string $category)
    {
        $data = array(
            'category' => $category,
            'status'   => 1
        );

        $posts = $this->db->select('posts', '*', 'category = ? AND status = ?', $data);

        return $posts;
    }
}