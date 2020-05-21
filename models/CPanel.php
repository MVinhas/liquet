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

    public function getCategories()
    {
        $categories = $this->db->select('categories', '*');

        return $categories;    
    }

    public function createPost($post)
    {
        $post['date'] = date('Y-m-d');
    
        $this->db->create('posts', 'title, category, author, short_content, content, date', $post);
    }
    
    public function editPost($id, $post)
    {
        $data = array($id);
        $this->db->update('posts', 'title = ?, category = ?, short_content = ?, content = ?', $post, 'id = ?', $data); 
    }

    public function createCategory($post)
    {
        $this->db->create('categories', 'name', $post);
    }
    
    public function editCategory($id, $post)
    {
        $data = array($id);
        $this->db->update('categories', 'name = ?', $post, 'id = ?', $data); 
    }

    public function deletePost($id)
    {
        $data = array($id);
        $this->db->delete('posts', 'id = ?', $data);
    }

    public function deleteCategory($id)
    {
        $data = array($id);
        $this->db->delete('categories', 'id = ?', $data);
    }
}