<?php
    namespace models;

    use \engine\DbOperations as DbOperations;
    use \controllers\SiteController as SiteController;
    
class Site
{
    protected $db;
    public function __construct()
    {
        $this->db = new DbOperations;
    }

    public function visitCounter()
    {
        $data = array(session_id());
        $visit = $this->db->select('sessions', 'id', 'session = ?', $data);

        if (empty($visit)) {
            $this->db->create('sessions', 'session', $data);
        }
    }
}
