<?php
namespace engine;

/**
 * DbOperations v2
 * Not used yet
 * Aim: Clean class, simplified querys
 */
class Query
{
    public $select;

    public $from;

    public $where;

    public $orderBy;

    public $groupBy;

    public $limit;

    public $offset;

    protected $db;
    
    public function __construct()
    {
        $this->db = \config\Connector::init();
    }

    public function select($columns)
    {
        $select = "SELECT $columns";

        return $select;
    }

    public function from($table)
    {
        $from = "FROM $table";

        return $from;
    }

    public function where($clause)
    {
        $where = "WHERE $clause";

        return $where;
    }

    public function orderBy($columns, $sort)
    {
        
    }

}