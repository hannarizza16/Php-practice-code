<?php
namespace Core;

use Exception;
use PDO; // or \PDO

class Connection {
    //properties

    protected $pdo;
    //methods
    public function __construct(public $dbname, public $dbhost, public $dbport, public $dbusername, public $password = null)
    {
        // connect to database
        $dsn = sprintf('pgsql:host=%s;port=%s;dbname=%s', $dbhost, $dbport, $dbname);

        // try catch block to handle connection error
        try {
            $this->pdo = new PDO($dsn, $dbusername, $password);
            echo "Connected successfully";

            
        } catch (Exception $e) {
            exit("connection failed" . $e->getMessage());
        }
    }

    public function getPDO(): PDO {
        return $this->pdo;
    }
}