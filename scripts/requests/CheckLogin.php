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
if (null !== ($username = filter_input(FILTER_POST, 'username', FILTER_SANITIZE_STRING))) {
    $username_exists = $check->username($username);
    if (!empty($username_exists)) {
        if (in_array($username, $username_exists)) {
            $exists = 1;
            ob_clean();
            print_r('true');
        }
    }
    if (!isset($exists)) {
        ob_clean();
        print_r('false');
    }
}

if (null !== ($userpass = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING))) {
    $password = explode('||', $userpass);
    $username_exists = $check->password($userpass[0]);
    if (!empty($username_exists)) {
        $password = password_verify($userpass[1], $username_exists['password']);
        if ($password) {
            $exists = 1;
            ob_clean();
            print_r('true');
        }
    }
    if (!isset($exists)) {
        ob_clean();
        print_r('false');
    }
    
}
