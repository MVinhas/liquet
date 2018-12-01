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
    $i=0;
    $sql_fetch=array();
    while($sql_retrieve = $query_res->fetch_assoc()){
      $sql_fetch[$i] = $sql_retrieve;
      $i++;
    }
    return $sql_fetch;
  }

  public function create($dbname,$fields,$data)
  {
    $sql = "INSERT INTO $dbname ($fields) VALUES ($data)";
    $sql_query = $this->db->query($sql);
    $sql_query!= '' ? $message = 'Insert successful' : $message = 'Insert error!';
    return $message;
  }

  public function selectAll($dbname)
  {
    $sql = "SELECT * FROM $dbname";
    $sql_query = $this->db->query($sql);
    $sql_fetch = $this->fetch_query($sql_query);
    return $sql_fetch;
  }

  public function select($dbname,$fields,$filter=''){
    if ($filter==''){
      $sql = "SELECT $fields FROM $dbname";
    } else {
      $sql = "SELECT $fields FROM $dbname WHERE $filter";
    }
    $sql_query = $this->db->query($sql);
    $sql_fetch = $this->fetch_query($sql_query);
    return $sql_fetch;
  }

  public function update($dbname,$data,$condition){
    $sql="UPDATE $dbname SET $data WHERE $condition";
    $sql_query = $this->db->query($sql);
    $sql_query!= '' ? $message = 'Update successful' : $message = 'Update error!';
    return $message;
  }

  public function delete($dbname,$condition=''){
    if ($condition==''){
      $sql="DELETE * FROM $dbname";
    } else {
      $sql="DELETE FROM $dbname WHERE $condition";
    }
    $sql_query = $this->db->query($sql);
    $sql_query!= '' ? $message = 'Delete successful' : $message = 'Delete error!';
    return $message;
  }

}
?>
