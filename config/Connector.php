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
        try {
            mysqli_report(MYSQLI_REPORT_STRICT);
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
            trigger_error('Unknown Method ' . $name . '()', E_USER_WARNING);
            return false;
        }
    }
}
