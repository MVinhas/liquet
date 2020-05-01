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
}