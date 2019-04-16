<?php
namespace config;

define('DB_SERVER', 'localhost');
define('DB_USERNAME', 'seamus');
define('DB_PASSWORD', 'seamus');
define('DB_DATABASE', 'seamus');

#Connection creation
class Connector
{
    private static $instance;
    private $link;
    private function __construct()
    {
        $this->connection = new \mysqli(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_DATABASE);
        if ($this->connection->connect_error) {
            die('Connect Error (' . $this->connection->connect_errno . ') '
            . $this->connection->connect_error);
        }
    }

    public static function init()
    {
        if (is_null(self::$instance)) {
            self::$instance = new Connector();
        }
        return self::$instance;
    }

    public function __call($name, $args)
    {
        if (method_exists($this->connection, $name)) {
            return call_user_func_array(array($this->connection,$name), $args);
        } else {
            trigger_error('Unknown Method ' . $name . '()', E_USER_WARNING);
            return false;
        }
    }
}
