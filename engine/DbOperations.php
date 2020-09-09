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

    public function create($table, $fields, $data)
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

    public function select($table, $fields = '*', $filter = '', $field_values = array())
    {
        if (empty($filter)) {
            $sql = "SELECT $fields FROM $table";
            $sql_prepare = $this->db->prepare($sql);
            if ($sql_prepare === false) 
                return $this->db->connection->error;
        } else {
            $sql = "SELECT $fields FROM $table WHERE $filter";
        }

        if (!empty($field_values)) {
            $data_array = array_values($field_values); 
            $count_fields = substr_count($filter, '?');
            $data_array = $this->convertHtmlEntities($data_array);
            $sql_prepare = $this->preparedStatement($sql, $count_fields, $data_array);
        }
        
        if ($sql_prepare->execute()) {
            $result = $sql_prepare->get_result();
            $sql_fetch = $this->fetchQuery($result);
            $sql_fetch = $this->htmlentitiesToUTF8($sql_fetch);
            return $sql_fetch;
        } else {
            return $this->db->connection->error;
        }
    }

    public function update($table, $fields, $fields_value, $where, $where_value)
    {   
        $fields_value = $this->convertHtmlEntities($fields_value);
        $where_value = $this->convertHtmlEntities($where_value);
        $data_array = array_values($fields_value);

        if (is_array($where_value)) {
            $data_array_where = array_values($where_value);
        }

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

    public function delete($table, $condition = '1 = ?', $condition_values = '1')
    {
        $sql = "DELETE FROM $table WHERE $condition";
        $data_array = explode(',', $condition_values);
         
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

    public function checkTable($table)
    {
        $sql = "SELECT 1 FROM $table LIMIT 1";
        $sql = $this->db->real_escape_string($sql);
        $sql_query = $this->db->query($sql);
        if ($this->db->connection->error) {
            return $this->db->connection->error;
        }
        return true;
    }
    
    public function createTable($table, $fields)
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

    private function preparedStatement($sql, $count_fields, $data_array, $count_fields_where = '', $data_array_where = array())
    {
        $values = array();
        $values_types = array();
        for ($i=0; $i < $count_fields; $i++) {
            $field[$i] = ltrim($data_array[$i], ' ');
            
            $values_type[$i] = strtolower(substr(gettype($data_array[$i]), 0, 1));
            array_push($values, $field[$i]);
        }
        $values_type = implode('', $values_type);

        if (strlen($count_fields_where) > 0 ) {
            $values_where = array();
            $values_type_where = array();
            for ($i=0; $i < $count_fields_where; $i++) {
                $field[$i] = ltrim($data_array_where[$i], ' ');
                
                $values_type_where[$i] = strtolower(substr(gettype($data_array_where[$i]), 0, 1));
                array_push($values_where, $field[$i]);
            }
            $values_type_where = implode('', $values_type_where);
     
            $values_type = $values_type.$values_type_where;

            $sql = $this->db->prepare($sql);
        
            $sql->bind_param("$values_type", ...$values, ...$values_where);
        } else {
            $sql = $this->db->prepare($sql);
        
            $sql->bind_param("$values_type", ...$values);
        }

        return $sql;
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
