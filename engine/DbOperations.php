<?php
namespace engine;

class DbOperations
{
    protected $db;
    
    public function __construct()
    {
        $this->db = \config\Connector::init();
    }

    protected function fetchQuery($query_res)
    {
        $sql_fetch = array();
        while ($sql_retrieve = $query_res->fetch_assoc()) {
            $sql_fetch[] = $sql_retrieve;
        }
        return $sql_fetch;
    }

    public function create(string $table, string $fields, array $data)
    {
        
        $data = $this->convertHtmlEntities($data); 
        $data_array = array_values($data);
        
        $prepare_array = array();

        foreach ($data_array as $k => $v) {
            $prepare_array[$k] = str_replace($v, '?', $data_array[$k]);
        }
        $prepare = implode(',', $prepare_array);
        $sql = "INSERT INTO $table ($fields) VALUES ($prepare)";
        $count_fields = substr_count($prepare, '?');
        $sql = $this->preparedStatement($sql, $count_fields, $data_array);
        
        if ($sql->execute()) {
            return true;
        } else {
            return $this->db->connection->error;
        }
    }

    public function select(string $table, string $fields = '*', string $filter = '', array $field_values = array())
    {
        if (empty($filter)) {
            $sql = "SELECT $fields FROM $table";
            $sql_prepare = $this->db->prepare($sql);
            if ($sql_prepare === false || $sql_prepare === null) 
                return $this->db->connection->error;
        } else {
            $sql = "SELECT $fields FROM $table WHERE $filter";
        }

        if (!empty($field_values)) {
            $data_array = array_values($field_values); 
            $count_fields = substr_count($filter, '?');
            $data_array = $this->convertHtmlEntities($data_array);
            $sql_prepare = $this->preparedStatement($sql, $count_fields, $data_array);
            if ($sql_prepare === false || $sql_prepare === null) 
                return $this->db->connection->error;
        }
        if ($sql_prepare->execute()) {
            $result = $sql_prepare->get_result();
            $sql_fetch = $this->fetchQuery($result);
            $sql_fetch = $this->htmlentitiesToUTF8($sql_fetch);
            if (count($sql_fetch) === 1) 
                return array_shift($sql_fetch);
            else
                return $sql_fetch;
        } else {
            return $this->db->connection->error;
        }
    }

    public function update(string $table, string $fields, array $fields_value,  string $where, array $where_value)
    {   
        $fields_value = $this->convertHtmlEntities($fields_value);
        $where_value = $this->convertHtmlEntities($where_value);
        $data_array = array_values($fields_value);

        $data_array_where = array_values($where_value);

        $sql = "UPDATE $table SET $fields WHERE $where";

        $count_fields = substr_count($fields, '?');
        $count_fields_where = substr_count($where, '?');

        $sql_prepare = $this->preparedStatement($sql, $count_fields, $data_array, $count_fields_where, $data_array_where);
        if ($sql_prepare === false)
            return $this->db->connection->error;
        if ($sql_prepare->execute()) {
            return true;
        } else {
            return $this->db->connection->error;
        }
    }

    public function delete(string $table, string $condition = '1 = ?', array $condition_values = ['1'])
    {
        $sql = "DELETE FROM $table WHERE $condition";
        $data_array = array_values($condition_values);
         
        $count_fields = substr_count($condition, '?');

        $sql_prepare = $this->preparedStatement($sql, $count_fields, $data_array);
        
        if ($sql_prepare === false)
            return $this->db->connection->error;
        if ($sql_prepare->execute()) {
            return true;
        } else {
            return $this->db->connection->error;
        }
    }

    public function checkTable(string $table)
    {
        $sql = "SELECT 1 FROM $table LIMIT 1";
        $sql = $this->db->real_escape_string($sql);
        $sql_query = $this->db->query($sql);
        if ($this->db->connection->error) {
            return $this->db->connection->error;
        }
        return true;
    }
    
    public function createTable(string $table, array $fields)
    {
        $numItems = count($fields);
        $i = 0;
        $values = '';
        foreach ($fields as $k => $v) {
            if (++$i !== $numItems) {
                $values .= $k.' '.$v.',';
            } else {
                $values .= $k.' '.$v;
            }
        }
        
        $sql = "CREATE TABLE $table ($values)";
        $sql = $this->db->real_escape_string($sql);
        $sql_query = $this->db->query($sql);
        if ($this->db->connection->errno) {
            return false;
        } else {
            return true;
        }
    }

    public function createIndex(string $table, string $constraint, string $value)
    {
        $sql = "ALTER TABLE $table ADD CONSTRAINT $constraint $value";
        $sql = $this->db->real_escape_string($sql);
        $sql_query = $this->db->query($sql);
        if ($this->db->connection->errno) {
            return false;
        } else {
            return true;
        }
    }

    private function preparedStatement($sql, $count_fields, $data_array, $count_fields_where = '', $data_array_where = array())
    {

        $fields = $this->processValuesType($count_fields, $data_array);
        
        if (strlen($count_fields_where) > 0 ) {
            $fields_where = $this->processValuesType($count_fields_where, $data_array_where);
     
            $values_type = $fields->values_type.$fields_where->values_type;

            $sql_prepare = $this->db->prepare($sql);
            
            $sql_prepare->bind_param("$values_type", ...$fields->values, ...$fields_where->values);
        } else {
            $sql_prepare = $this->db->prepare($sql);
        
            $sql_prepare->bind_param($fields->values_type, ...$fields->values);
        }

        return $sql_prepare;
    }

    private function processValuesType($count_fields, $data_array)
    {
        $values = array();
        $values_types = array();
        for ($i=0; $i < $count_fields; $i++) {

            $field[$i] = ltrim($data_array[$i], ' ');
            
            $values_type[$i] = strtolower(substr(gettype($data_array[$i]), 0, 1));
            array_push($values, $field[$i]);
        }
        $values_type = implode('', $values_type);
        
        $valuesClass = new \stdClass();
        $valuesClass->values = $values;
        $valuesClass->values_type = $values_type;
        
        return $valuesClass;
    }

    private function convertHtmlEntities($input)
    {
        array_walk_recursive(
            $input, function (&$value) {
                    $value = htmlentities($value);
                }
        );
        return $input;
    }

    private function htmlEntitiesToUTF8($input)
    {
        array_walk_recursive(
            $input, function (&$value) {
                    $value = html_entity_decode($value);
                }
        );
        return $input;
    }
}
