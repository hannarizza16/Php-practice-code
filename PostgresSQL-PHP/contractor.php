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
        // 2. create connection
        // pg_connect() function is used to open a connection to a PostgreSQL database
        $conn = pg_connect("host=$host port=$port dbname=$db user=$user password=$pass");
        // 3. check connection create error handling  
        // pg_last_error() function is used to get the last error message from a PostgreSQL connection
        if(!$conn){
            echo "Error : Unable to open database\n".pg_last_error();
        } else {
            echo "Connected to database successfully\n";
        }
        // 4. perform query and get result set
        $query = "SELECT * FROM contractors";
        // pg_query() function is used to execute a query on a PostgreSQL database connection
        // It returns a result resource on success or FALSE on failure
        $result = pg_query($conn, $query);

        // 5. check for query error handling
        // pg_last_error() function is used to get the last error message from a PostgreSQL connection
        if(!$result){
            echo pg_last_error($conn);
            exit;
        }
    ?>   
    
    <h2>Flood Control Data</h2>
        <!-- 6. display in your front end -->
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
        // pg_fetch_assoc() function is used to fetch a row from a result set as an associative array
        // It returns an associative array of strings that corresponds to the fetched row or FALSE if there are no more rows
        // Loop through each row in the result set and display the data in a table
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