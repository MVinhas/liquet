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
        $this->methods();
        $this->tags();
        $this->about();
        $this->social();
        $this->sessions();
        $this->insertControllers();
        $this->insertMethods();
        $this->insertPages();
        $this->insertCategories();
        $this->insertPosts();
        $this->insertAbout();
        $this->insertAdmin();
        $this->insertSocial();
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

        $this->db->createIndex(__FUNCTION__, 'id_name', 'UNIQUE KEY(id, name)');
    }

    private function controllers()
    {
        $fields = array(
            'id' => 'INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY',
            'name' => 'VARCHAR(64) NOT NULL UNIQUE KEY'
        );
        $this->db->createTable(__FUNCTION__, $fields);
    }

    private function methods()
    {
        $fields = array(
            'id' => 'INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY',
            'name' => 'VARCHAR(64) NOT NULL UNIQUE KEY',
            'controller' => 'INT(3) NOT NULL DEFAULT 0'
        );
        $this->db->createTable(__FUNCTION__, $fields);
    }

    private function tags()
    {
        $fields = array(
            'id' => 'INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY',
            'name' => 'VARCHAR(64) NOT NULL UNIQUE KEY'
        );
        $this->db->createTable(__FUNCTION__, $fields);   
    }

    private function about()
    {
        $fields = array(
            'id' => 'INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY',
            'name' => 'TEXT NULL' 
        );
        $this->db->createTable(__FUNCTION__, $fields); 
    }

    private function social()
    {
        $fields = array(
            'id' => 'INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY',
            'name' => 'VARCHAR(64) NOT NULL UNIQUE KEY',
            'link' => 'VARCHAR(256) NOT NULL',
            'visible' => 'INT(1) NOT NULL DEFAULT 1'
        );
        $this->db->createTable(__FUNCTION__, $fields); 
    }

    private function sessions()
    {
        $fields = array(
            'id' => 'BIGINT(20) UNSIGNED AUTO_INCREMENT PRIMARY KEY',
            'session' => 'VARCHAR(32) NOT NULL',
            'firstvisit' => 'TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP'
        );
        $this->db->createTable(__FUNCTION__, $fields); 
    }

    private function insertControllers()
    {
        $table = 'controllers';
        $fields = 'name';
        $values_1 = array('Home');
        $values_2 = array('Admin');
        
        $this->db->create($table, $fields, $values_1);
        $this->db->create($table, $fields, $values_2);
    }

    private function insertMethods()
    {
        $table = 'methods';
        $fields = 'name, controller';
        $values_1 = array('setup', 1);
        $values_2 = array('login', 2);

        $this->db->create($table, $fields, $values_1);
        $this->db->create($table, $fields, $values_2);
    }

    private function insertPages()
    {
        $table = 'pages';
        $fields = '`name`, `method`, `active`, `header`, `menu`, `footer`';
        $values_1 = array('Register', 1, 1, 1, 1, 0);
        $values_2 = array('Login', 2, 1, 1, 1, 0);

        $this->db->create($table, $fields, $values_1);
        $this->db->create($table, $fields, $values_2);
    }

    private function insertCategories()
    {
        $table = 'categories';
        $fields = 'name';
        $values_1 = array('Programming');
        $values_2 = array('Hardware');
        $values_3 = array('Mobility');
        $values_4 = array('Software');
        $values_5 = array('Linux');
        $values_6 = array('macOS');
        $values_7 = array('Windows');
        $values_8 = array('Gaming');
        $values_9 = array('Music');
        $values_10 = array('Lifestyle');
        $values_11 = array('PC Buyers Guide');

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
        $fields = '`category`, `title`, `author`, `date`, `short_content`, `content`, `comments`, `likes`, `status`, `featured`, `other_featured`';
        $values_1 = array(1, 'Fusce sit amet consectetur risus.', 'Micael Vinhas', '2020-04-07', 'Integer consequat interdum egestas.', 'Integer consequat interdum egestas. Sed mollis ornare erat non varius. Mauris congue, nunc quis porta condimentum, ligula tellus commodo velit, at cursus diam arcu in odio. Cras nisl quam, aliquam sit amet aliquam a, fermentum sit amet arcu. Integer molestie at tortor vel malesuada.', 0, 0, 1, 1, 0);
        $values_2 = array(2, 'Vestibulum molestie efficitur facilisis.', 'Micael Vinhas', '2020-04-22', 'Sed enim justo, dapibus vel elementum quis, feugiat id elit.', 'Nunc non vestibulum ipsum, a vulputate enim.', 'Nulla hendrerit lacus at elit viverra malesuada. Aliquam ut mattis velit. Etiam consequat mattis dapibus. Etiam cursus arcu in sodales gravida. Lorem ipsum dolor sit amet, consectetur adipiscing elit.', 0, 0, 1, 0, 1);
        $values_3 = array(3, 'Praesent in pretium arcu.', 'Micael Vinhas', '2020-04-30', 'Aliquam erat volutpat.', 'Morbi maximus mauris sed dolor fringilla, in accumsan augue tempus. Ut pharetra tincidunt magna at imperdiet. Ut faucibus felis nulla, sit amet bibendum ex fermentum non. ', 0, 0, 1, 0, 1);
        $values_4 = array(4, 'Curabitur sit amet lobortis purus.', 'Micael Vinhas', '2020-04-19', 'Morbi non mattis nisi.', 'Vestibulum molestie efficitur facilisis. Sed finibus feugiat odio et blandit. Aenean at enim eget augue egestas pretium. Nunc eget tellus eget risus aliquam malesuada sed at turpis. Donec hendrerit ullamcorper mi, in rutrum tortor bibendum quis. Donec luctus consectetur turpis at sodales. Curabitur sit amet lobortis purus.',  0, 0, 1, 0, 0);
        $values_5 = array(5, 'Ut auctor consequat arcu, at accumsan sem semper quis.', 'Micael Vinhas', '2020-04-11', 'Nam vehicula blandit lorem, at gravida lorem rutrum sit amet.', 'Curabitur sit amet lobortis purus. Donec luctus, libero vitae faucibus dapibus, ante ligula iaculis libero, a ornare sapien urna at nunc.', 0, 0, 1, 0, 0);
        $values_6 = array(6, 'Aliquam pretium odio ac lorem mattis pellentesque.', 'Micael Vinhas', '2020-04-04', 'Donec tincidunt venenatis venenatis.', 'Ut sollicitudin, dolor in interdum cursus, felis ante suscipit ante, non laoreet ex velit ac ligula. Maecenas turpis enim, luctus nec eleifend a, consequat in orci. Maecenas egestas accumsan lacinia. Duis a elit eget justo finibus dapibus sed at augue. Fusce porttitor ut nisl eu posuere.',  0, 0, 1, 0, 0);
        
        $this->db->create($table, $fields, $values_1);
        $this->db->create($table, $fields, $values_2);
        $this->db->create($table, $fields, $values_3);
        $this->db->create($table, $fields, $values_4);
        $this->db->create($table, $fields, $values_5);
        $this->db->create($table, $fields, $values_6);
    }

    private function insertAbout()
    {
        $table = 'about';
        $fields = '`name`';
        $values = array('Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean at enim ut.');

        $this->db->create($table, $fields, $values);
    }

    private function insertAdmin()
    {
        $table = 'users';
        $fields = '`email`, `username`, `password`, `role`, `reg_date`, `active`';
        $values = array(OWNER, OWNER, password_hash(OWNER, PASSWORD_DEFAULT), 'admin', date('Y-m-d H:i:s'), 1);

        $this->db->create($table, $fields, $values);
    }

    private function insertSocial()
    {
        $table = 'social';
        $fields = '`name`, `link`, `visible`';
        $values = array('LinkedIn', 'https://www.linkedin.com/in/micael-vinhas-74bab1112', 1);
        $this->db->create($table, $fields, $values);
    }
}
