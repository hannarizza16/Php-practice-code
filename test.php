<?php 

//CONFIG
$host = "127.0.0.1";   

$port = "5432";      

$dbname = "postgres";     

$user = "postgres"; 

$pass = "123"; 

//CONNECTOR
session_start ();
//pgsql - driver 
// sprintf()
$dsn = "pgsql:host=$host;port=$port;dbname=$dbname";
$pdo = new PDO($dsn, $user, $pass);


// START 
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $first = $_POST['first_name'] ?? '';
    $middle = $_POST['middle_name'] ?? '';
    $last = $_POST['last_name'] ?? '';
    $age = (int)($_POST['age'] ?? 0);
    $created_at =  date("Y-m-d H:i:s");

    // CREATE
    if (isset($_POST['create'])) 
        if ($first && $last && $age > 0) {
        $stmt = $pdo->prepare("INSERT INTO students( 
        first_name, 
        middle_name, 
        last_name, 
        age, 
        created_at)
        VALUES (?, ?, ?, ?, ?)
        ");
        $stmt->execute([$first, $middle, $last, $age, $created_at]);
        header("Location: test.php");
        exit;
    }

    // UPDATE
    if (isset($_POST['update'])) {
        $stmt = $pdo->prepare("UPDATE students 
            SET 
            first_name= ?, 
            middle_name= ?, 
            last_name= ?, 
            age= ?
            WHERE 
            created_at = ?
        ");
       
            $stmt->execute([
            $first, $middle, $last, $age, $_POST['created_at']
        ]);
        header("Location: test.php");
        exit;
    }

    // DELETE
    if (isset($_POST['delete'])) {
        $dsql = "DELETE FROM students WHERE created_at = ?";
        
        $stmt = $pdo->prepare($dsql);

        $stmt->execute([$_POST['created_at']]);

        header("Location: test.php");
        exit;
    }
}

// READ 
$sql = "SELECT * FROM students";

$stmt = $pdo->prepare($sql);

$stmt->execute();

$students = $stmt->fetchAll(PDO::FETCH_ASSOC);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>PHP Task 4</title>
</head>
<body>
    <h1>CRUD</h1>

    <h2>Students List</h2>
    <table border="1" cellpadding="5" cellspacing="0" width="100%">
        <tr>
            <th>First Name</th>
            <th>Middle Name</th>
            <th>Last Name</th>
            <th>Age</th>
            <th>Date Created</th>
            <th>Update/Delete</th>
        </tr>
        <?php foreach ($students as $student): ?>
            <tr>
                <td><?php echo $student['first_name']; ?></td>
                <td><?php echo $student['middle_name']; ?></td>
                <td><?php echo $student['last_name']; ?></td>
                <td><?php echo $student['age']; ?></td>
                <td><?php echo $student['created_at']; ?></td>
                <td>
    
                    <form method="POST" style="display:inline;">
                        <input type="hidden" name="created_at" value="<?php echo $student['created_at']; ?>">
                        <input type="text" name="first_name" value="<?php echo $student['first_name']; ?>">
                        <input type="text" name="middle_name" value="<?php echo $student['middle_name']; ?>">
                        <input type="text" name="last_name" value="<?php echo $student['last_name']; ?>">
                        <input type="number" name="age" value="<?php echo $student['age']; ?>"><br></br>
                        <button type="submit" name="update">Update</button>
                    </form>

                    <form method="POST" style="display:inline;">
                        <input type="hidden" name="created_at" value="<?php echo $student['created_at']; ?>">
                        <button type="submit" name="delete">Delete</button>
                    </form>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>

    <h2>Add Student</h2>
    <form method="POST">
        First Name: <input type="text" name="first_name">
        Middle Name: <input type="text" name="middle_name">
        Last Name: <input type="text" name="last_name">
        Age: <input type="number" name="age">
        <button type="submit" name="create">Submit</button>
    </form>

</body>
</html>