<?php

// 1. load the vendor autoload file

require '../vendor/autoload.php';

// 2. load the dotenv since we are going to use .env to store our important credentials

$dotenv = Dotenv\Dotenv::createImmutable(dirname(__DIR__));
$dotenv->load();

// 3. create a connection class to connect to the database

class Connection {
    // 4. make porerties

    protected $table;

    // 5. create constructor to initialize the connection
    public function  __construct(public $database, public $host, public $port, public $username, public $password = null )
    {
        // 6. create dsn - data source name containing the information required to connect to the database
        // sprintf() function is used to format a string 
        // it accepts string that contains placeholders and the values to replace those placeholders
        // sprintf('sting with format specifiers', $value1, $value2, ...)
        // $dsn tells the PDO which database driver to use, where the database is located, and which database to connect to
        $dsn = sprintf('pgsql:host=%s;port=%s;dbname=%s', $host, $port, $database);

        // 7. try catch block for error handling connection
        try {
            // 8. create a new PDO instance
            // PDO - PHP Data Object
            // It is a database access layer providing a uniform method of access to multiple databases
            // actual connection to the database is established when a new PDO instance is created
            $this->pdo = new PDO($dsn, $username, $password);
            // echo "Connected to database successfully\n";
        } catch (Exception $e) {
            // 9. if connection fails, catch the exception and display the error message
            exit('Connection failed' . $e->getMessage());
        }
    }
        // create a method to set the table name
        public function table($table){
            $this->table = $table;
            return $this;
        }

        // 10. create a method to get data from the table
        public function get($columns = ['*']){
            $identifier = implode(', ', $columns);
            $baseQuery = "SELECT $identifier FROM $this->table";
            
            $stmt = $this->pdo->prepare($baseQuery);
            $stmt->execute();
            
            return $stmt->fetchAll();
        }

    }


$connection = new Connection(
    $_ENV['DB_STUDENTDATABASE'], 
    $_ENV['DB_HOST'], 
    $_ENV['DB_PORT'], 
    $_ENV['DB_USERNAME'], 
    $_ENV['DB_PASSWORD']
);

$students = $connection
->table('students')
->get();

// var_dump($students);

include_once'../client/Student-Tabke.php';


?>