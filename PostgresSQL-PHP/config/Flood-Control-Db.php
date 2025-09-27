<!-- // database config
// connection to db -->

<?php

// Load Composer's autoloader
// import the autoload file from vendor directory
require '../vendor/autoload.php';

// Load .env file
// __DIR__ returns the directory of the current file
// dirname() returns the parent directory of the given path
// createImmutable() method creates a new Dotenv instance that loads environment variables from a .env file located in the specified directory
$dotenv = Dotenv\Dotenv::createImmutable(dirname(__DIR__));
//load() method loads the environment variables from the .env file into the $_ENV superglobal array
$dotenv->load();

// Database connection parameters

// Define Connection class - Class name should start with uppercase letter
class Connection
{
    // initialize property
    protected $pdo;
    protected $table;
    protected $limit = 5;
    protected $where = [];
    protected $orderDirection;
    protected $offset = 0;

    // constructor to initialize database connection
    public function __construct(public $database, public $host, public $port, public $username, public $password = null)
    {
        //$dsn - Data Source name where the database is located
        // sprintf(data source, host, port, database name, )
        // %s - string placeholder
        $dsn = sprintf('pgsql:host=%s;port=%s;dbname=%s', $host, $port, $database);

        // try catch block for error handling connection
        try {
            // create a new PDO instance
            $this->pdo = new PDO($dsn, $username, $password);
            // echo "Connected to database successfully\n";
        } catch (Exception $e) {
            exit('Connection failed' . $e->getMessage());
        }
    }
    // creating a method to set limit
    public function limit($limit)
    {
        $this->limit = $limit;
        return $this;
    }

    public function where($where)
    {
        $this->where = $where;
        return $this;
    }

    public function orderBy($direction = 'asc')
    {
        $this->orderDirection = $direction;
        return $this;
    }

    public function offset($offset)
    {
        $this->offset = $offset;
        return $this;
    }

    public function get($table)
    {
        // theres a pattern here SELECT ... FROM ... WHERE ... ORDER BY ... LIMIT ... OFFSET ...
        // order of SQL clauses matter
        $baseQuery = "SELECT * FROM $table";

        if ($this->where) {
            $baseQuery .= " WHERE $this->where";
        }

        // if ($this->orderDirection){
        //     $baseQuery .= " ORDER BY id $this->orderDirection";
        // }

        if ($this->limit) {
            if ($this->orderDirection === 'asc') {
                $baseQuery = " SELECT * FROM ($baseQuery LIMIT $this->limit) sub ORDER BY id DESC";
            } else {
                $baseQuery .= " LIMIT $this->limit";
            }
        }

        if ($this->offset) {
            $baseQuery .= " OFFSET $this->offset";
        }

        $stmt = $this->pdo->prepare($baseQuery);
        // execute table query
        $stmt->execute();


        return $stmt->fetchAll();
    }
}

$connection = new Connection($_ENV['DB_DATABASENAME'], $_ENV['DB_HOST'], $_ENV['DB_PORT'], $_ENV['DB_USERNAME'], $_ENV['DB_PASSWORD'] ?? null);


$floodControl = $connection
    ->limit(5)
    ->orderBy()
    // ->where('id=5')
    // ->offset(0)
    ->get('contractors');


// include the table.php file to display the data
require_once '../client/Flood-Control-Table.php';
