<?php
    chdir('../..');
    require_once 'config/conf.php';

    use \engine\DbOperations as DbOperations;

class CheckLogin
{
        
    protected $db;
    public function __construct()
    {
        $this->db = new DbOperations;
    }


    public function username($username)
    {
        $data = array($username); 
        $getUsers = $this->db->select('users', 'username', "username = ?", $data);
 
        return $getUsers;
    }

    public function password($username)
    {
        $data = array($username); 
        $getUsers = $this->db->select('users', 'password', "username = ?", $data);
 
        return $getUsers;
    }
}

$check = new CheckLogin;
if (isset($_POST['username'])) {
    
    $username = $_POST['username'];
    $username_exists = $check->username($username);
    if (!empty($username_exists)) {
        foreach ($username_exists as $k => $v) {
            if (in_array($username, $v)) {
                $exists = 1;
                echo 'true';
            }
        }
    }
    if (!isset($exists)) {
        echo 'false';
    }
}

if (isset($_POST['password'])) {
    $password = explode('||',$_POST['password']);
    $username_exists = $check->password($password[0]);
    if (!empty($username_exists)) {
        $password = password_verify($password[1], $username_exists[0]['password']);
        if ($password) {
            $exists = 1;
            echo 'true';
        }
    }
    if (!isset($exists)) {
        echo 'false';
    }
    
}
