<?php
namespace Database;

use \Database\Interfaces\QueryInterface;

class Create implements QueryInterface
{
    protected $fields = array();

    protected $table;

    public function __construct($table)
    {
        $this->table = $table;    
    }

    public static function table(string $table)
    {
        return new Create($table);
    }

    public function set($args)
    {
        foreach ($args as $k => $v) {
            $this->fields[] = "`$k` $v";
        }
        return $this;
    }

    public function queryBuilder()
    {
        $query = array();

        $fields = implode(', ', $this->fields);

        $query = "CREATE TABLE `$this->table` ($fields)";
        
        return $query;
    }

    public function raw()
    {
        return $this->queryBuilder();
    }     

}