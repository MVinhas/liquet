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
            $getUsers = $this->db->select('users','email',"email = ?", $email);
            return $getUsers;

        }

        public function username($username)
        {
            $getUsers = $this->db->select('users','username',"username = ?", $username);
 
            return $getUsers;

        }
           
    }

    $check = new CheckFormData;
    if (isset($_POST['email'])) {
        $email = $_POST['email'];
        if (filter_var($email,FILTER_VALIDATE_EMAIL)) {
            $email_exists = $check->email($email);
        }
        if (!empty($email_exists)) {
            foreach ($email_exists as $k => $v) {
                if (in_array($email, $v)) {
                    $exists = 1;
                    echo 'false';
                }
            }
        }
        if (!isset($exists)) echo 'true';
    }

    if (isset($_POST['username'])) {
        $username = $_POST['username'];
        //$username = preg_replace('/[^\w]/','',$username);
        $username_exists = $check->username($username);
        if (!empty($username_exists)) {
            foreach ($username_exists as $k => $v) {
                if (in_array($username, $v)) {
                    $exists = 1;
                    echo 'false';
                }
            }
        }
        if (!isset($exists)) echo 'true';
    }
   
   