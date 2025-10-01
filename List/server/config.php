<?php 

include_once '../vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable(dirname(__DIR__));
$dotenv->load();


class Connection {
    //properties
    protected $pdo;

    public function __construct(public $dbname, public $dbhost, public $dbport, public $dbusername, public $dbpassword = null) {

        $dsn = sprintf('pgsql:host=%s;port=%s;dbname=%s', $dbhost, $dbport, $dbname);

        try {

            $this->pdo = new PDO($dsn, $dbusername, $dbpassword);
            echo "connected successfully";
        }   catch (exception $e){
            exit('Connection failed' . $e->getMessage());
        }
    }

}


$connect = new Connection($_ENV['DB_DATABASENAME'], $_ENV['DB_HOST'], $_ENV['DB_PORT'], $_ENV['DB_USERNAME'], $_ENV['DB_PASSWORD']);