<?php
    chdir('../..');
    require_once 'config/conf.php';

    use \engine\DbOperations as DbOperations;

class CheckLogin
{
        
    protected $db;
    public function __construct()
    {
        session_start();
        $this->db = new DbOperations;
    }


    public function username($username)
    {
        $getUsers = $this->db->select('users', 'username', "username = ?", $username);
 
        return $getUsers;
    }

    public function password($username)
    {
        $getUsers = $this->db->select('users', 'password', "username = ?", $username);
 
        return $getUsers;
    }
}

$check = new CheckLogin;
if (isset($_POST['username'])) {
    $username = $_POST['username'];
    $_SESSION['temp_username'] = $username;
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

    $password = $_POST['password'];
    $check->password($_SESSION['temp_username']);
    if (!empty($username_exists)) {
        foreach ($username_exists as $k => $v) {
            if (in_array($username, $v)) {
                echo $v;
                $password = password_verify($password, $v['password']);
                if ($password) {
                    $exists = 1;
                    echo 'true';
                }
            }
        }
    }
    if (!isset($exists)) {
        echo 'false';
    }
    unset($_SESSION['temp_username']);
}
