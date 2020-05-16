<?php
    namespace models;

    use \engine\DbOperations as DbOperations;
    use \controllers\CPanelController as CPanelController;
    
class CPanel
{
    protected $db;
    public function __construct()
    {
        $this->db = new DbOperations;
    }

    public function getPosts()
    {
        $posts = $this->db->select('posts', '*');

        return $posts;    
    }

    public function createPost($post)
    {
        $post['date'] = date('Y-m-d');
        $this->db->create('posts', 'title, category, author, short_content, content, date', $post);
    }
    
    public function editPost($id, $post)
    {
        $this->db->update('posts', 'title = ?, category = ?, short_content = ?, content = ?', $post, 'id = ?', $id);
        return;   
    }
}