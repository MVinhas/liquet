<?php

class DBOperations
{
    protected $db;
    
    public function __construct()
    {
        $this->db = dbConnector::init();
    }

    protected function fetchQuery($query_res)
    {
        $sql_fetch=array();
        while($sql_retrieve = $query_res->fetch_assoc()){
            $sql_fetch[] = $sql_retrieve;
        }
        return $sql_fetch;
    }

    public function create($dbname,$fields,$data)
    {
        $sql = $this->db->real_escape_string($this->db,"INSERT INTO $dbname ($fields) VALUES ($data)");
        $sql_query = $this->db->query($sql);
        $sql_query!= '' ? $message = 'Insert successful' : $message = 'Insert error!';
        return $message;
    }

    public function selectAll($dbname)
    {
        $sql = $this->db->real_escape_string($this->db,"SELECT * FROM $dbname");
        $sql_query = $this->db->query($sql);
        $sql_fetch = $this->fetchQuery($sql_query);
        return $sql_fetch;
    }

    public function select($dbname,$fields,$filter=''){
        if ($filter==''){
            $sql = $this->db->real_escape_string($this->db,"SELECT $fields FROM $dbname");
        } else {
            $sql = $this->db->real_escape_string($this->db,"SELECT $fields FROM $dbname WHERE $filter");
        }
        $sql_query = $this->db->query($sql);
        $sql_fetch = $this->fetchQuery($sql_query);
        return $sql_fetch;
    }

    public function update($dbname,$data,$condition){
        $sql = $this->db->real_escape_string($this->db,"UPDATE $dbname SET $data WHERE $condition");
        $sql_query = $this->db->query($sql);
        $sql_query!= '' ? $message = 'Update successful' : $message = 'Update error!';
        return $message;
    }

    public function delete($dbname,$condition=''){
        if ($condition==''){
            $sql = $this->db->real_escape_string($this->db,"DELETE * FROM $dbname");
        } else {
            $sql = $this->db->real_escape_string($this->db,"DELETE FROM $dbname WHERE $condition");
        }
        $sql_query = $this->db->query($sql);
        $sql_query!= '' ? $message = 'Delete successful' : $message = 'Delete error!';
        return $message;
    }
}
