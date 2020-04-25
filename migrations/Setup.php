<?php
namespace migrations;

class Setup
{
    protected $db;
    public function __construct()
    {
        $this->db = new \engine\DbOperations;
    }

    public function index()
    {
        $this->users();
        $this->posts();
        $this->comments();
        $this->categories();
        $this->pages();
        $this->controllers();
        $this->insertControllers();
        $this->insertMethods();
        $this->insertPages();
        $this->insertCategories();
        $this->insertPosts();
    }

    private function users()
    {
        $fields = array(
            'id' => 'INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY',
            'email' => 'VARCHAR(50) NOT NULL UNIQUE KEY',
            'username' => 'VARCHAR(30) NOT NULL',
            'password' => 'VARCHAR(128) NOT NULL',
            'role' => 'VARCHAR(15) NOT NULL',
            'reg_date' => 'TIMESTAMP',
            'active' => 'INT(11) NOT NULL DEFAULT 0'
        );
        $this->db->createTable(__FUNCTION__, $fields);
    }

    private function posts()
    {
        $fields = array(
            'id' => 'INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY',
            'category' => 'INT(11) NOT NULL',
            'title' => 'VARCHAR(90) NOT NULL',
            'author' => 'VARCHAR(64) NOT NULL',
            'date' => 'DATE',
            'banner' => 'VARCHAR(60)',
            'short_content' => 'VARCHAR(100)',
            'content' => 'TEXT',
            'tags' => 'VARCHAR(255)',
            'comments' => 'INT(11) NOT NULL',
            'likes' => 'INT(11) NOT NULL',
            'status' => 'INT(1) NOT NULL',
            'featured' => 'INT(1) NOT NULL DEFAULT 0',
            'other_featured' => 'INT(1) NOT NULL DEFAULT 0'
        );
        $this->db->createTable(__FUNCTION__, $fields);
    }

    private function comments()
    {
        $fields = array(
            'id' => 'INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY',
            'author' => 'VARCHAR(64) NOT NULL',
            'date' => 'DATE',
            'content' => 'TEXT',
            'likes' => 'INT(11) NOT NULL',
            'status' => 'INT(1) NOT NULL'
        );
        $this->db->createTable(__FUNCTION__, $fields);
    }

    private function categories()
    {
        $fields = array(
            'id' => 'INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY',
            'name' => 'VARCHAR(64) NOT NULL UNIQUE KEY'
        );
        $this->db->createTable(__FUNCTION__, $fields);
    }

    private function pages()
    {
        $fields = array(
            'id' => 'INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY',
            'name' => 'VARCHAR(64) NOT NULL',
            'short_content' => 'VARCHAR(512) NULL',
            'content' => 'TEXT NULL',
            'method' => 'INT(11) NOT NULL',
            'active' => 'INT(1) NOT NULL DEFAULT 1',
            'header' => 'INT(1) NOT NULL DEFAULT 0',
            'menu' => 'INT(1) NOT NULL DEFAULT 0',
            'footer' => 'INT(1) NOT NULL DEFAULT 0'
        );
        $this->db->createTable(__FUNCTION__, $fields);
    }

    private function controllers()
    {
        $fields = array(
            'id' => 'INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY',
            'name' => 'VARCHAR(64) NOT NULL UNIQUE KEY'
        );
        $this->db->createTable(__FUNCTION__, $fields);
    }

    private function insertControllers()
    {
        $table = 'controllers';
        $fields = 'name';
        $values_1 = "'Admin'";
        $values_2 = "'Home'";

        $this->db->create($table, $fields, $values_1);
        $this->db->create($table, $fields, $values_2);
    }
    
    private function insertMethods()
    {
        $table = 'methods';
        $fields = 'name, controller';
        $values_1 = "'setup', 1";
        $values_2 = "'login', 2";

        $this->db->create($table, $fields, $values_1);
        $this->db->create($table, $fields, $values_2);
    }

    private function insertPages()
    {
        $table = 'pages';
        $fields = '`name`, `short_content`, `content`, `method`, `active`, `header`, `menu`, `footer`';
        $values_1 = "'Register', NULL, NULL, 1, 1, 1, 1, 0";
        $values_2 = "'Login', NULL, NULL, 2, 1, 1, 1, 0";

        $this->db->create($table, $fields, $values_1);
        $this->db->create($table, $fields, $values_2);
    }

    private function insertCategories()
    {
        $table = 'categories';
        $fields = 'name';
        $values_1 = "'Programming'";
        $values_2 = "'Hardware'";
        $values_3 = "'Mobility'";
        $values_4 = "'Software'";
        $values_5 = "'Linux'";
        $values_6 = "'macOS'";
        $values_7 = "'Windows'";
        $values_8 = "'Gaming'";
        $values_9 = "'Music'";
        $values_10 = "'Lifestyle'";
        $values_11 = "'PC Buyers Guide'";

        $this->db->create($table, $fields, $values_1);
        $this->db->create($table, $fields, $values_2);
        $this->db->create($table, $fields, $values_3);
        $this->db->create($table, $fields, $values_4);
        $this->db->create($table, $fields, $values_5);
        $this->db->create($table, $fields, $values_6);
        $this->db->create($table, $fields, $values_7);
        $this->db->create($table, $fields, $values_8);
        $this->db->create($table, $fields, $values_9);
        $this->db->create($table, $fields, $values_10);
        $this->db->create($table, $fields, $values_11);
    }

    private function insertPosts()
    {
        $table = 'posts';
        $fields = '`category`, `title`, `author`, `date`, `banner`, `short_content`, `content`, `tags`, `comments`, `likes`, `status`, `featured`, `other_featured`';
        $values_1 = "1, 'Fusce sit amet consectetur risus.', 'Micael Vinhas', '2020-04-07', NULL, '', 'Integer consequat interdum egestas. Sed mollis ornare erat non varius. Mauris congue, nunc quis porta condimentum, ligula tellus commodo velit, at cursus diam arcu in odio. Cras nisl quam, aliquam sit amet aliquam a, fermentum sit amet arcu. Integer molestie at tortor vel malesuada.', NULL, 0, 0, 1, 1, 0";
        $values_2 = "2, 'Vestibulum molestie efficitur facilisis.', 'Micael Vinhas', '2020-04-22', NULL, '', 'Nulla hendrerit lacus at elit viverra malesuada. Aliquam ut mattis velit. Etiam consequat mattis dapibus. Etiam cursus arcu in sodales gravida. Lorem ipsum dolor sit amet, consectetur adipiscing elit.', NULL, 0, 0, 1, 0, 1";
        $values_3 = "3, 'Praesent in pretium arcu.', 'Micael Vinhas', '2020-04-30', NULL, '', 'Morbi maximus mauris sed dolor fringilla, in accumsan augue tempus. Ut pharetra tincidunt magna at imperdiet. Ut faucibus felis nulla, sit amet bibendum ex fermentum non. ', NULL, 0, 0, 1, 0, 1";
        $values_4 = "4, 'Curabitur sit amet lobortis purus.', 'Micael Vinhas', '2020-04-19', NULL, '', 'Vestibulum molestie efficitur facilisis. Sed finibus feugiat odio et blandit. Aenean at enim eget augue egestas pretium. Nunc eget tellus eget risus aliquam malesuada sed at turpis. Donec hendrerit ullamcorper mi, in rutrum tortor bibendum quis. Donec luctus consectetur turpis at sodales. Curabitur sit amet lobortis purus.', NULL, 0, 0, 1, 0, 0)";
        $values_5 = "5, 'Ut auctor consequat arcu, at accumsan sem semper quis.', 'Micael Vinhas', '2020-04-11', NULL, '', 'Curabitur sit amet lobortis purus. Donec luctus, libero vitae faucibus dapibus, ante ligula iaculis libero, a ornare sapien urna at nunc.', NULL, 0, 0, 1, 0, 0)";
        $values_6 = "5, 'Aliquam pretium odio ac lorem mattis pellentesque.', 'Micael Vinhas', '2020-04-04', NULL, '', 'Ut sollicitudin, dolor in interdum cursus, felis ante suscipit ante, non laoreet ex velit ac ligula. Maecenas turpis enim, luctus nec eleifend a, consequat in orci. Maecenas egestas accumsan lacinia. Duis a elit eget justo finibus dapibus sed at augue. Fusce porttitor ut nisl eu posuere.', NULL, 0, 0, 1, 0, 0";
        
        $this->db->create($table, $fields, $values_1);
        $this->db->create($table, $fields, $values_2);
        $this->db->create($table, $fields, $values_3);
        $this->db->create($table, $fields, $values_4);
        $this->db->create($table, $fields, $values_5);
        $this->db->create($table, $fields, $values_6);
    }
}
