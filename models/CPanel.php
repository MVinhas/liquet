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

    public function getVisits()
    {

        $date1 = date('Y-m-d', strtotime('-1 week'));
        $date2 = date('Y-m-d');        
        $data = array($date1, $date2);
        $dates_query = $this->db->select('sessions', 'COUNT(session) AS session, firstvisit AS date', 'firstvisit BETWEEN ? AND ? GROUP BY firstvisit', $data);

        $date1 = strtotime($date1); 
        $date2 = strtotime($date2);
        for ($currentDate = $date1; $currentDate <= $date2;  $currentDate += (86400)) {
            $store = date('Y-m-d', $currentDate);
            if(array_search($store, array_column($dates_query, 'date')) === false) {
                $dates_query[] = array(
                    'session' => 0,
                    'date' => $store
                );
            }
  
        }
        usort($dates_query, function($a, $b) {
            return ($a['date'] < $b['date']) ? -1 : 1;
        });                           

        return $dates_query; 
    }
}