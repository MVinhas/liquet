<?php
    chdir('../..');
    require_once 'config/conf.php';

    use \engine\DbOperations as DbOperations;
    class CheckFormData
    {
        
        protected $db; 
        public function __construct()
        { 
        
            $this->db = new DbOperations;
        }
        
        public function email($email)
        {
            $getUsers = $this->db->select('users','email',"email = '$email'");
            return $getUsers;

        }

        public function username($username)
        {
            $getUsers = $this->db->select('users','username',"username = '$username'");
 
            return $getUsers;

        }
           
    }

    $check = new CheckFormData;
    if (isset($_POST['email'])) {
        $email = $_POST['email'];
        if (filter_var($email,FILTER_VALIDATE_EMAIL)) {
            $email_exists = $check->email($email);
        }

        if (in_array($email, $email_exists[0])) {
            echo 'false';
        } else {
            echo 'true';
        }
    }

    if (isset($_POST['username'])) {
        $username = $_POST['username'];
        $username = preg_replace('/[^\w]/','',$username);
        $username_exists = $check->username($username);
 
        if (in_array($username, $username_exists[0])) {
            echo 'false';
        } else {
            echo 'true';
        }
    }
   
   