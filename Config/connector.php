<?php
define('DB_SERVER', 'localhost');
define('DB_USERNAME', 'mvinhascms');
define('DB_PASSWORD', 'mvinhascms');
define('DB_DATABASE', 'mvinhascms');

#Connection creation
class DBConnector
{
    private static $instance;
    private $link;
    private function __construct()
    {
        $this->connection = new mysqli(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_DATABASE);
    }

    public static function init()
    {
        if(is_null(self::$instance)){
            self::$instance = new DBConnector();
        }
        return self::$instance;
    }

    public function __call($name, $args)
    {
        if(method_exists($this->connection, $name)){
            return call_user_func_array(array($this->connection,$name), $args);
        } else {
            trigger_error('Unknown Method ' . $name . '()', E_USER_WARNING);
            return false;
        }
    }

}
