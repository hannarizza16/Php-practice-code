<!-- // database config
// connection to db -->

<?php

// Load Composer's autoloader
// import the autoload file from vendor directory
require '../vendor/autoload.php';

// Load .env file
// __DIR__ returns the directory of the current file
// dirname() returns the parent directory of the given path
$dotenv = Dotenv\Dotenv::createImmutable(dirname(__DIR__));
$dotenv->load();

// Database connection parameters

// Define Connection class - Class name should start with uppercase letter
class Connection {
    // initialize property
    protected $pdo;
    protected $table;
    protected $limit = 0;

    // constructor to initialize database connection
    public function __construct(public $database, public $host, public $port, public $username, public $password = null) {
        //$dsn - Data Source name where the database is located
        // sprintf(data source, host, port, database name, )
        // %s - string placeholder
        $dsn = sprintf('pgsql:host=%s;port=%s;dbname=%s', $host, $port, $database ); 

        // try catch block for error handling connection
        try {
            // create a new PDO instance
            $this->pdo = new PDO($dsn, $username, $password);
            echo "Connected to database successfully\n";
        } catch (Exception $e) {
            exit('Connection failed' . $e->getMessage());
        }
    }

    //fetch all records from a table
    public function fetchAll($table) {
        // prepare and execute SQL statement
        $stmt = $this->pdo->prepare("SELECT * FROM $table");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function limit($limit){
        $this->limit =(int)$limit;
        return $this;
    }

}

$connection = new Connection($_ENV['DB_DATABASENAME'], $_ENV['DB_HOST'], $_ENV['DB_PORT'], $_ENV['DB_USERNAME'], $_ENV['DB_PASSWORD'] ?? null);


$floodControl = $connection
->fetchAll('contractors')
;


