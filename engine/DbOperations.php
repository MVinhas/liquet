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
        $sql = "INSERT INTO $table ($fields) VALUES ($data)";
        $sql = $this->db->real_escape_string($sql);
        $sql_query = $this->db->query($sql);
        if ($this->db->errono != '') {
            return "Error: ".$this->db->error;
        } else {
            return true;
        }
    }

    public function select($table, $fields = '*', $filter = '')
    {
        if ($filter=='') {
            $sql = "SELECT $fields FROM $table";
        } else {
            $sql = "SELECT $fields FROM $table WHERE $filter";
        }
        $sql = $this->db->real_escape_string($sql);
        $sql_query = $this->db->query($sql);
        if (!$sql_query) {
            $errorCode = $this->db->connection->errno;
            return $errorCode != '' ? $errorCode : false;
        }
        $sql_fetch = $this->fetchQuery($sql_query);
        return $sql_fetch;
    }

    public function update($table, $data, $condition)
    {
        $sql = "UPDATE $table SET $data WHERE $condition";
        $sql = $this->db->real_escape_string($sql);
        $sql_query = $this->db->query($sql);
        if ($this->db->error) {
            return "Error: ".$this->db->error;
        } else {
            return true;
        }
    }

    public function delete($table, $condition = '1=1')
    {
        $sql = "DELETE * FROM $table WHERE $condition";
        $sql = $this->db->real_escape_string($sql);
        $sql_query = $this->db->query($sql);
        if ($this->db->connection->error) {
            return "Error: ".$this->db->error;
        } else {
            return true;
        }
    }

    public function createTable($table)
    {
        $sql = $this->db->real_escape_string($table);
        $sql_query = $this->db->query($sql);
        echo "<pre>" , print_r(get_object_vars($this->db)) , "</pre>";exit;
        if ($this->db->connection->errno) {
            return false;
        } else {
            return true;
        }
    }
}