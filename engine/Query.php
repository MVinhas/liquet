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

    public $one;

    public $sql;

    protected $db;
    
    public function __construct()
    {
        $this->db = \config\Connector::init();
    }

    public function select($columns)
    {
        $this->sql = "SELECT $columns";
        return $this;
    }

    public function from($table)
    {
        $this->sql .= "FROM $table";
        return $this;
    }

    public function where($clause)
    {
        $this->where = "WHERE $clause";
        return $this;
    }

    public function orderBy($columns)
    {
        foreach ($columns as $k => $v) {
            $order[] = "$k $v";
        }
        $this->orderBy = "ORDER BY ".implode(',', $order); 
        return $this;  
    }

    public function limit($limit)
    {
        $this->limit = "LIMIT $limit";  
        return $this;     
    }

    public function offset($offset)
    {
        $this->offset = "OFFSET $offset";
        return $this;
    }

    public function one()
    {
        echo "<pre>";print_r($this);"</pre>";
    }

}