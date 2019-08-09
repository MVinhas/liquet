<?php
namespace migrations;

class Setup
{
    protected $db; 
    public function __construct()
    {
        $this->db = new DbOperations;
    }

    public function index()
    {
        $this->users();
    }
    private function users()
    {
        $table = 'users';
        $fields = 'id';
        $dataType = 'INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY';
        return $this->db->createTable($fields,$dataType);
    }
}