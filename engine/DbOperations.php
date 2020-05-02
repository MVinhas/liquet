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
        $sql_fetch=array();
        while ($sql_retrieve = $query_res->fetch_assoc()) {
            $sql_fetch[] = $sql_retrieve;
        }
        return $sql_fetch;
    }

    public function create($table, $fields, $data)
    {
        $data_array = explode(',', $data);
        $prepare_array = array();
        foreach ($data_array as $k => $v) {
            $prepare_array[$k] = str_replace($v, '?', $data_array[$k]);
        }
        $prepare = implode(',', $prepare_array);
        $sql = "INSERT INTO $table ($fields) VALUES ($prepare)";
        $count_fields = substr_count($prepare, '?');
        $values = array();
        $values_type = array();
        for ($i=0; $i < $count_fields; $i++) {
            $field{$i} = ltrim($data_array[$i], ' ');
            $values_type{$i} = substr(gettype($data_array[$i]), 0, 1);
            array_push($values, $field{$i});
        }
        $values_type = implode('', $values_type);
        $sql = $this->db->prepare($sql);
        $sql->bind_param("$values_type", ...$values);
        if ($sql->execute()) {
            return true;
        } else {
            return "Error: ".$this->db->connection->error;
        }
    }

    public function select($table, $fields = '*', $filter = '', $field_values = '')
    {
        $data_array = explode(',', $field_values);
        if ($filter == '') {
            $sql = "SELECT $fields FROM $table";
            $sql_query = $this->db->query($sql);
            if (!$sql_query->num_rows) {
                return false;
            }
            $sql_fetch = $this->fetchQuery($sql_query);
            return $sql_fetch;
        } else {
            $sql = "SELECT $fields FROM $table WHERE $filter";
        }
        if ($field_values != '') {
            $count_fields = substr_count($filter, '?');
            $values = array();
            $values_type = array();
            for ($i=0; $i < $count_fields; $i++) {
                $field{$i} = ltrim($data_array[$i], ' ');
                $values_type{$i} = strtolower(substr(gettype($data_array[$i]), 0, 1));
                array_push($values, $field{$i});
            }
            
            $values_type = implode('', $values_type);
        }
        $sql = $this->db->prepare($sql);
        $sql->bind_param($values_type, ...$values);
        
        if ($sql->execute()) {
            $result = $sql->get_result();
            $sql_fetch = $this->fetchQuery($result);
            return $sql_fetch;
        } else {
            return "Error: ".$this->db->connection->error;
        }
    }

    public function add($arg1, $arg2)
    {
        return $arg1+$arg2;
    }
    public function update($table, $fields, $fields_value, $where, $where_value)
    {
        $sql = "UPDATE $table SET $fields WHERE $condition";
        $data_array = explode(',', $fields_value);
        
        $count_fields = substr_count($fields, '?');
        $values = array();
        $values_type = array();
        for ($i=0; $i < $count_fields; $i++) {
            $field{$i} = ltrim($data_array[$i], ' ');
            
            $values_type{$i} = strtolower(substr(gettype($data_array[$i]), 0, 1));
            array_push($values, $field{$i});
        }
        $values_type = implode('', $values_type);
        
        $count_fields_where = substr_count($where, '?');
        $values_where = array();
        $values_type_where = array();
        for ($i=0; $i < $count_fields; $i++) {
            $field{$i} = ltrim($data_array[$i], ' ');
            
            $values_type_where{$i} = strtolower(substr(gettype($data_array[$i]), 0, 1));
            array_push($values_where, $field{$i});
        }
        $values_type_where = implode('', $values_type_where);

        $values_type = $values_type.$values_type_where;

        $sql = $this->db->prepare($sql);
        $sql->bind_param("$values_type", ...$values, ...$values_where);

        if ($sql->execute()) {
            return true;
        } else {
            return "Error: ".$this->db->connection->error;
        }
    }

    public function delete($table, $condition = '1=1', $condition_values = '')
    {
        $sql = "DELETE * FROM $table WHERE $condition";
        $data_array = explode(',', $condition_values);
         
        $count_fields = substr_count($condition, '?');
        $values = array();
        $values_type = array();
        for ($i=0; $i < $count_fields; $i++) {
            $field{$i} = ltrim($data_array[$i], ' ');
            
            $values_type{$i} = strtolower(substr(gettype($data_array[$i]), 0, 1));
            array_push($values, $field{$i});
        }
        $values_type = implode('', $values_type);
       
        $sql = $this->db->prepare($sql);
        
        $sql->bind_param("$values_type", ...$values);
        
        if ($sql->execute()) {
            return true;
        } else {
            return "Error: ".$this->db->connection->error;
        }
    }

    public function checkTable($table)
    {
        $sql = "SELECT 1 FROM $table LIMIT 1";
        $sql = $this->db->real_escape_string($sql);
        $sql_query = $this->db->query($sql);
        if ($this->db->connection->error) {
            return false;
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
}
