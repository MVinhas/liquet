<?php
namespace database;

class Select
{
    public $fields;

    public $table;

    private $where;

    public function __construct(array $fields, string $table)
    {
        $this->fields = implode(', ', $fields);

        $this->table = $table;
    }

    public function where(array $condition)
    {
        foreach ($condition as $k => $v) {
            $this->where[] = strpos('!', (string)$v) === 0 ?  "$k = $v" : "$k != $v";
            //PHP8 str_starts_with ( string $haystack , string $needle ) : bool

        }
        return $this;
    }

    public function queryBuilder()
    {
        $query[] = "SELECT ".$this->fields." FROM ".$this->table;
        
        if (!empty($this->where)) {
            $query[] = "WHERE ".implode(" AND ", $this->where);
        }

        return implode(' ', $query);
    }
    
    public function raw()
    {
        return $this->queryBuilder();
    } 

}