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

    public function createPost(array $post)
    {
        $post['date'] = date('Y-m-d');
        $post['comments'] = 0;
        $post['likes'] = 0;
        $post['status'] = 1;
        $insert_id = $this->db->create('posts', 'title, category, author, short_content, content, featured, date, comments, likes, status', $post);
        if (isset($_FILES['avatar'])) {
            $directory = 'images/post';
            $img = explode('.', $_FILES['avatar']['name']);
            $name = 'post_'.$insert_id.'.'.$img[1];
            $tmp_name = $_FILES['avatar']['tmp_name'];
            move_uploaded_file($tmp_name, "$directory/$name");
            $data['banner'] = "$directory/$name";
            $this->db->update('posts', 'banner = ?', $data, 'id = ?', array($insert_id));
        }

    }
    
    public function editPost(int $id, array $post)
    {
        $data = array($id);
        if (isset($_FILES['avatar'])) {
            $directory = 'images/post';
            $img = explode('.', $_FILES['avatar']['name']);
            $name = 'post_'.$id.'.'.$img[1];
            $tmp_name = $_FILES['avatar']['tmp_name'];
            move_uploaded_file($tmp_name, "$directory/$name");
            $post['banner'] = "$directory/$name";
            $this->db->update('posts', 'title = ?, category = ?, author = ?, short_content = ?, content = ?, featured = ?, banner = ?', $post, 'id = ?', $data);
        } else {
            $this->db->update('posts', 'title = ?, category = ?, author = ?, short_content = ?, content = ?, featured = ?', $post, 'id = ?', $data);
        }
        
    }

    public function createCategory(array $post)
    {
        $this->db->create('categories', 'name', $post);
    }
    
    public function editCategory(int $id, array $post)
    {
        $data = array($id);
        $this->db->update('categories', 'name = ?', $post, 'id = ?', $data); 
    }

    public function editConfig(array $post)
    {
        $exists = $this->db->select('config', '*');

        if (!empty($exists)) {
            $data = array('1');
            $this->db->update('config', 'debugmode = ?, sitename = ?, email = ?, siteversion = ?, siteauthor = ?, launchyear = ?', $post, 'id = ?', $data);
        } else {
            $post['id'] = 1;
            $this->db->create('config', 'debugmode, sitename, email, siteversion, siteauthor, launchyear, id', $post); 
        }
        
    }

    public function deletePost(int $id)
    {
        $data = array($id);
        $this->db->delete('posts', 'id = ?', $data);
    }

    public function deleteCategory(int $id)
    {
        $data = array($id);
        $this->db->delete('categories', 'id = ?', $data);
    }

    public function getVisits()
    {      
        $data = array('1');
        $dates_query = $this->db->select('sessions', 'COUNT(session) AS session, firstvisit AS date', '1=? GROUP BY firstvisit', $data);
                       
        return $dates_query; 
    }
}