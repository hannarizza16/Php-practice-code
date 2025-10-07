<?php 

require_once 'vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

// echo 'hello world';
// echo phpinfo(); 

// view is a function from helper-view and with the help of autoad.php
//in composer json na cacall yung function without using requir_once
// view('bill.bill');

class DatabaseConnection {
    //properties

    protected $pdo;

    public function __construct(public $dbname, public $dbport, public $dbhost, public $dbusername, public $dbpassword = null){

        $dsn = sprintf('pgsql:host=%s;port=%s;dbname=%s', $dbhost, $dbport, $dbname);

        try {
            $this->pdo = new PDO($dsn, $dbusername, $dbpassword);
            // echo "Connected Successfullyeee";
        } catch (Exception $e) {
            exit("Connection Failed" . $e->getMessage());
        }
    }
}

//instantiate 

$connect = new DatabaseConnection($_ENV['DB_STUDENTDATABASE'],
    $_ENV['DB_PORT'],
    $_ENV['DB_HOST'],
    $_ENV['DB_USERNAME'],
    $_ENV['DB_PASSWORD']
);

// echo "<pre>";
// var_dump($connect);
// echo "</pre>";
?>