<?php
namespace engine;

/**
 * DbOperations v2
 * Not used yet
 * Aim: Clean class, simplified querys
 */
class Query
{

    public $one;

    public $all;

    public $sql;

    public $setValues;

    public $whereValues;

    protected $db;

    public function __construct()
    {
        $this->db = \config\Connector::init();
    }

    private function initialize()
    {
        return $this->sql = array();
    }

    public function create($table)
    {
        $this->initialize();
        $this->sql[] = "CREATE TABLE $table";
        return $this;
    }
    public function select($columns)
    {
        $this->initialize();
        $this->sql[] = "SELECT $columns";
        return $this;
    }

    public function update($table)
    {
        $this->initialize();
        $this->sql[] = "UPDATE $table";
        return $this;
    }

    public function set($clause)
    {
        $this->sql[] = "SET $clause";
        return $this;   
    }

    public function setValues($val)
    {
        $this->setValues = $val;
        return $this;   
    }

    public function delete($table)
    {
        $this->initialize();
        $this->sql[] = "DELETE FROM $table";
        return $this;
    }

    public function from($table)
    {
        $this->sql[] = "FROM $table";
        return $this;
    }

    public function where($clause)
    {
        $this->sql[] = "WHERE $clause";
        return $this;
    }

    public function whereValues($val)
    {
        $this->whereValues = $val;
        return $this;
    }

    public function orderBy($columns)
    {
        foreach ($columns as $k => $v) {
            $order[] = "$k $v";
        }
        $this->sql[] = "ORDER BY ".implode(',', $order);
        return $this;
    }

    public function limit($limit)
    {
        $this->sql[] = "LIMIT $limit";
        return $this;
    }

    public function offset($offset)
    {
        $this->sql[] = "OFFSET $offset";
        return $this;
    }

    public function raw()
    {
        $sql = implode(" ", $this->sql);
        return $sql;
    }

    public function go()
    {
        return $this->treatData();    
    }

    private function isSelect()
    {
        $sql = $this->raw();
        $finalRoute = explode(' ',trim($sql));
        if ($finalRoute[0] !== "SELECT") return false;
        return true;
    }

    public function all()
    {
        if (!$this->isSelect()) return;  
        $result = $this->treatData->get_result();
        $sql_fetch = $this->fetchQuery($result);
        $sql_fetch = $this->htmlentitiesToUTF8($sql_fetch);
        return $sql_fetch;
    }

    public function one()
    {
        if (!$this->isSelect()) return;  
        $result = $this->treatData->get_result();
        return $result->fetch_assoc();
    }

    private function treatData()
    {
        $sql = $this->raw();
        $data = array_merge(array_values($this->setValues), array_values($this->whereValues));
        $field_count = substr_count($sql, '?');
        $data = $this->convertHtmlEntities($data);
        $sql_prepare = $this->preparedStatement($sql, $field_count, $data);
        if ($sql_prepare === false || $sql_prepare === null)
            return $this->db->connection->error;
        return $sql_prepare->execute();
    }
    
    private function preparedStatement($sql, $field_count, $data)
    {
        $fields = $this->getValueTypes($field_count, $data);
        $sql_prepare = $this->db->prepare($sql);
        $sql_prepare->bind_param($fields, ...$data);
        return $sql_prepare;
    }

    private function getValueTypes($field_count, $data)
    {
        $value_types = array();
        for ($i=0; $i < $field_count; $i++) {
            $value_types[$i] = strtolower(substr(gettype($data[$i]), 0, 1));
        }
        $value_types = implode('', $value_types);
        return $value_types;
    }

    private function fetchQuery($query_res)
    {
        $sql_fetch = array();
        if ($query_res->num_rows === 1)
            return $query_res->fetch_assoc();

        while ($sql_retrieve = $query_res->fetch_assoc())
            $sql_fetch[] = $sql_retrieve;

        return $sql_fetch;
    }

    private function convertHtmlEntities($input)
    {
        array_walk_recursive(
            $input, function (&$value) {
                    if (gettype($value) === 'string')
                        $value = htmlentities($value);
                }
        );
        return $input;
    }

    private function htmlEntitiesToUTF8($input)
    {
        array_walk_recursive(
            $input, function (&$value) {
                    if (gettype($value) === 'string')
                        $value = html_entity_decode($value);
                }
        );
        return $input;
    }

}
