<?php 

require_once 'vendor/autoload.php';
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();


class Connection {

    //properties

    protected $pdo;

    // __construct() method
    public function __construct(public $dbname, public $dbport, public $dbhost, public $dbusername, public $dbpassword = null) {
        $dsn = sprintf('pgsql:host=%s;port=%s;dbname=%s', $dbhost, $dbport, $dbname);

        try {
            $this->pdo = new PDO($dsn, $dbusername, $dbpassword);
            echo "connected successfully";
        } catch (Exception $e) {
            exit('Connection failed' . $e->getMessage());
        }

    }

}

$connect = new Connection($_ENV['DB_STUDENTDATABASE'], 
$_ENV['DB_PORT'], 
$_ENV['DB_HOST'], 
$_ENV['DB_USERNAME'], 
$_ENV['DB_PASSWORD']
);

?>