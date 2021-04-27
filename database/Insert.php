<?php
namespace Database;

use \Database\Interfaces\QueryInterface;

class Insert implements QueryInterface
{
    protected $fields = array();

    protected $values = array();

    protected $table;

    public function __construct($table)
    {
        $this->table = $table;    
    }

    public static function table(string $table)
    {
        return new Insert($table);
    }

    public function set($args)
    {
        foreach ($args as $k => $v) {
            if (empty($k) || empty($v)) continue;
            $this->fields[] = "`".$k."`";
            $this->values[] = "'{$v}'";
        }
        return $this;
    }

    public function queryBuilder()
    {
        $query = array();

        $fields = implode(', ', $this->fields);
        $values = implode(', ', $this->values);

        $query = "INSERT INTO `$this->table` ($fields) VALUES ($values)";
        
        return $query;
    }

    public function raw()
    {
        return $this->queryBuilder();
    }     

}