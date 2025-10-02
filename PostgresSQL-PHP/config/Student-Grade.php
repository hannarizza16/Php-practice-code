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

        //11. lets try inserting data
        // (typeDeclaration, $parameter): returnType
        public function insert(array $data){

            
            //13. check if student already exists
            if (isset($data['student'])){
                $checkingSql = "SELECT COUNT(*) FROM $this->table WHERE student = :student"; // SQL query to check for duplicate
                $checkingStmt = $this->pdo->prepare(($checkingSql));
                $checkingStmt->execute(['student' => $data['student']]);
            }

            if ($checkingStmt->fetchColumn() > 0) {
                echo "student {$data['student']} already exists";
                return false;
            }

            // inserting blank query is not acceptable
            if (empty($data['student']) || (empty($data['grade']) && $data['grade'] === 0 || (empty($data['subject'])))) {
                echo "Student name, grade and subject are required.";
                return false;
            }

            //14. if no duplicate found, proceed with insert
            $keys = array_keys($data); // ['student', 'grade']
            $fields = implode(', ', $keys); // student, grade
            $placeholders = implode(', ', array_map(fn($key) => ":$key", $keys)); // :student, :grade
            //$query "INSERT INTO students (student, grade) VALUES (:student, :grade);
            $query = "INSERT INTO $this->table ($fields) VALUES ($placeholders)";
            // prepare the query
            $stmt = $this->pdo->prepare($query);
            // var_dump($placeholders); //debugging 
            // execute the query with the data
            return $stmt->execute($data);
        }


        // 15. lets try deleting data
        public function delete($id){
            $keys = array_keys($id); // ['id']
            $conditions = implode(' AND ', array_map(fn($key) => "$key = :$key", $keys)); // id = :id
            $query = "DELETE FROM $this->table WHERE $conditions";
            $stmt = $this->pdo->prepare($query);
            return $stmt->execute($id);
        }

    }


$connection = new Connection(
    $_ENV['DB_STUDENTDATABASE'], 
    $_ENV['DB_HOST'], 
    $_ENV['DB_PORT'], 
    $_ENV['DB_USERNAME'], 
    $_ENV['DB_PASSWORD']
);

// fetching the data
$students = $connection
->table('students')
->get();

// var_dump($students);
// $insert = $connection 
// ->table('students')
// ->insert(['student' => 'Grace Doe', 'grade' => 86]);


// $delete = $connection 
// ->table('students')
// ->delete(['id' => 6]);

// var_dump($insert);

// this is to handle form submission for deleting a student record
// remove the record from the database and redirect back to the table page
// request method is GET because we are using a link to delete
// the link is in the client/Student-Table.php file
//request method from client/Student-Table.php
if(isset($_GET['delete'])) {
    // $connection->table('students')
    //->delete(['id' => (int)$_GET['delete]])
    $id = $_GET['delete'];
    $delete = $connection
    ->table('students')
    ->delete(['id' => $id]);

    if ($delete) {
        header('Location: ../client/Student-Table.php');
        exit();
    } else {
        echo "Error deleting record";
    }
}

if(isset($_POST['submit'])){
    $student = $_POST['student'];
    $grade = (int)$_POST['grade'];
    $subject = $_POST['subject'];

    $insert = $connection
    ->table('students')
    ->insert(['student' => $student, 'grade' => $grade, 'subject' => $subject]);

    if ($insert) {
        header('Location: ../client/Student-Table.php');
        exit();
    } else {
        echo "Error inserting record";
    }
}

include_once'../client/Student-Table.php';


?>