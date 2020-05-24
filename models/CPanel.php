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

    public function getVisits($timelapse)
    {
        $month= date("m");

        $day= date("d");

        $year= date("Y");

        switch($timelapse) {
            case 'week':
                $date1 = date('Y-m-d', strtotime('-1 week'));
                $date2 = date('Y-m-d');
                $data = array($date1, $date2);
                $dates_query = $this->db->select('sessions', 'COUNT(session) AS session, firstvisit AS date', 'firstvisit BETWEEN ? AND ? GROUP BY firstvisit', $data);          
                break;
            case 'last_week':
        
                $date1 = date('Y-m-d', strtotime('-2 weeks'));
                $date2 = date('Y-m-d', strtotime('-1 week'));
                $data = array($date1, $date2);
                $dates_query = $this->db->select('sessions', 'COUNT(session) AS session, firstvisit AS date', 'firstvisit BETWEEN ? AND ? GROUP BY firstvisit', $data);          
                break;
            default:
                $date1 = date('Y-m-d', strtotime('-1 week'));
                $date2 = date('Y-m-d');
                $data = array($date1, $date2);
                $dates_query = $this->db->select('sessions', 'COUNT(session) AS session, firstvisit AS date', 'firstvisit BETWEEN ? AND ? GROUP BY firstvisit', $data);          
                break;
        }
        $date1 = strtotime($date1); 
        $date2 = strtotime($date2);
        for ($currentDate = $date1; $currentDate <= $date2;  $currentDate += (86400)) {                           
            $store = date('Y-m-d', $currentDate);
            if (!empty($dates_query)) {
                foreach ($dates_query as $k => $v) {
                    if ($v['date'] === $store) {
                        $dates[] = array(
                            'date' => $store,
                            'value' => $v['session']
                        );
                    } else {
                        $dates[] = array(
                            'date' => $store,
                            'value' => 0
                        );
                    }
                }
        } else {
            $dates[] = array(
                'date' => $store,
                'value' => 0
            );
        }
        }
        return $dates; 
    }
}