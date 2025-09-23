<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Flood Control Project Data</title>
</head>
<body>
    <!-- 1. connection -->
    <?php
        $host = "localhost";
        $port = '5432';
        $db   = "floodcontrol";
        $user = "postgres";
        $pass = "123";

        $conn = pg_connect("host=$host port=$port dbname=$db user=$user password=$pass");
        if(!$conn){
            echo "Error : Unable to open database\n".pg_last_error();
        } else {
            echo "Connected to database successfully\n";
        }

        $query = "SELECT * FROM contractors";

        $result = pg_query($conn, $query);

        if(!$result){
            echo pg_last_error($conn);
            exit;
        }
    ?>   
    
    <h2>Flood Control Data</h2>

    <table>
        <tr>
            <th>ID</th>
            <th>Contractor Name</th>
            <th>Contact Person</th>
            <th>Contact Number</th>
            <th>Classification</th>
            <th>blacklisted</th>
        </tr>
        <?php
        while ($row = pg_fetch_assoc($result)) {
            $value = strtoupper($row['is_blacklisted']);
            echo "<tr>";
            echo "<td>" . htmlspecialchars($row['id']) . "</td>";
            echo "<td>" . htmlspecialchars($row['contractor_name']) . "</td>";
            echo "<td>" . htmlspecialchars($row['contact_person']) . "</td>";
            echo "<td>" . htmlspecialchars($row['contact_number']) . "</td>";
            echo "<td>" . htmlspecialchars($row['classification']) . "</td>";
            echo "<td>" . ($value === 'F' ? "<span style='color:red'>F</span>" : "<span style='color:green;'>T</span>" ). "</td>";
            echo "</tr>";
        }
        ?>
    </table>
</body>
</html>