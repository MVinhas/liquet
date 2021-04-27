<?php
namespace Database;

use Database\Interfaces\QueryInterface;

class Select implements QueryInterface
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

    public function fields(...$fields)
    {
        foreach ($fields as &$field) {
            $field = "`".$field."`";
        }

        $this->fields = $fields;
        return $this;
    }

    public function queryBuilder()
    {
        $query = array();

        $fields = implode(', ', $this->fields) ?? '*';

        $query[] = "SELECT $fields FROM `$this->table`";
        
        if (!empty($this->where)) {
            $query[] = "WHERE ".implode(" AND ", $this->where);
        }

        return implode(' ', $query);
    }

    public function where(array $condition)
    {
        foreach ($condition as $k => $v) {
            $this->where[] = strpos('!', (string)$v) === false ?  "`$k` = '{$v}'" : "`$k` != '{$v}'";
            //PHP8 str_starts_with ( string $haystack , string $needle ) : bool

        }
        return $this;
    }

    public function raw()
    {
        return $this->queryBuilder();
    } 
    

}