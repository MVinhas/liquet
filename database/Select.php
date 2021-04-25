<?php
namespace database;

class Select
{
    public $table;

    public $fields;

    public function __construct($table)
    {
        $this->table = $table;    
    }

    public static function table(string $table)
    {
        return new Select($table);
    }

    public function select(...$fields)
    {
        $this->fields = $fields;
        return $this;
    }

    public function queryBuilder()
    {
        $query = array();

        $query[] = "SELECT ".implode(', ',$this->fields)." FROM ".$this->table;
        
        if (!empty($this->where)) {
            $query[] = "WHERE ".implode(" AND ", $this->where);
        }

        return implode(' ', $query);
    }

    public function where(array $condition)
    {
        foreach ($condition as $k => $v) {
            $this->where[] = strpos('!', (string)$v) === 0 ?  "$k = $v" : "$k != $v";
            //PHP8 str_starts_with ( string $haystack , string $needle ) : bool

        }
        return $this;
    }

    public function raw()
    {
        return $this->queryBuilder();
    } 
    

}