<?php
namespace config;

define('DB_SERVER', '127.0.0.1');
define('DB_USERNAME', 'mvinhas');
define('DB_PASSWORD', 'mvinhas');
define('DB_DATABASE', 'liquet');

#Connection creation
class Connector
{
    private static $instance;
    private $link;
    public $connection;
    private function __construct()
    {
        try {  
            mysqli_report(MYSQLI_REPORT_ALL ^ MYSQLI_REPORT_INDEX); 
            $this->connection = new \mysqli(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_DATABASE);
        } catch (\mysqli_sql_exception $e) {
            $dbConf = new \controllers\DbConfController;
            $dbConf->index();
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
            die();
        }
    }
}
