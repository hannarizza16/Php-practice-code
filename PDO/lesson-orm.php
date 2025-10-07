<?php

require_once('vendor/autoload.php');

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

// PDO
// $host = '127.0.0.1';
// $port = 5432;
// $dbname = 'internauts';
// $username = 'postgres';

class Connection
{
	//protected - accessible within the class and by inheriting and parent classes
	//public - accessible from anywhere
	//private - accessible only within the class
	protected $pdo; // PDO instance
	protected $table;
	protected $limit = 10;
	protected $orderColumn = 'id';
	protected $orderDirection = 'asc';
	protected $filterCondition;
	protected $filterValue;

	public function __construct(public $database, public $host, public $port, public $username, public $password = null)
	{
		$dsn = sprintf('pgsql:host=%s;port=%s;dbname=%s', $host, $port, $database);

		try {
			$this->pdo = new PDO($dsn, $username);
		} catch (Exception $e) {
			exit('Connection failed' . $e->getMessage());
		}
	}

	public function table($table)
	{
		$this->table = $table;

		return $this;
	}

	public function limit($limit)
	{
		$this->limit = $limit;

		return $this;
	}

	public function orderBy($column, $direction)
	{
		$this->orderColumn = $column;
		$this->orderDirection = $direction;

		return $this;
	}

	public function where($column, $value)
	{
		$this->filterCondition = $column;
		$this->filterValue = $value;

		return $this;
	}

	public function get($columns = ['*'])
	{
		$identifier = implode(', ', $columns);
		$baseQuery = "SELECT $identifier FROM $this->table";

		// if ($this->filterCondition && $this->filterValue) {
		if ($this->filterCondition && $this->filterValue) {
			$baseQuery .= " WHERE $this->filterCondition = '$this->filterValue'";
		}

		if ($this->orderColumn) {
			$baseQuery .= " ORDER BY $this->orderColumn $this->orderDirection";
		}

		if ($this->limit) {
			$baseQuery .= " LIMIT $this->limit";
		}


		$stmt = $this->pdo->query($baseQuery);

		// $stmt = $this->pdo->query(sprintf(
		// 	"SELECT * FROM %s ORDER BY %s %s LIMIT %d",
		// 	$this->table,
		// 	$this->orderColumn,
		// 	$this->orderDirection,
		// 	$this->limit,
		// ));
		//
		// echo $baseQuery; // echoing the query

		return $stmt->fetchAll();
	}
}


$connection = new Connection($_ENV['DB_NAME'], $_ENV['DB_HOST'], $_ENV['DB_PORT'], $_ENV['DB_USER']);

//method chaining
$users = $connection
// -> - 
	->table('users')
	->limit(5)
	// ->where('employee_number', '9320060090317')
	// ->where('employee_number', '7012466903309')
	// ->orderBy('first_name', 'desc')
	->get(); // default ['*'] 
// ->get(['employee_number', 'first_name', 'last_name', 'created_at']);
//
var_dump($users);
exit;
?>

<!-- HTML -->
<table style="border: 1px solid #000;width: 600px">
	<thead>
		<tr>
			<th>Employee #</th>
			<th>First Name</th>
			<th>Last Name</th>
			<th>Created</th>
		</tr>
	</thead>
	<tbody>
		<?php foreach ($users as $user): ?>
			<tr>
				<td><?= $user['employee_number']; ?></td>
				<td><?= $user['first_name']; ?></td>
				<td><?= $user['last_name']; ?></td>
				<td><?= $user['created_at']; ?></td>
			</tr>
		<?php endforeach; ?>
	</tbody>
</table>