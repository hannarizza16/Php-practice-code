<!-- unfinished -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Calculator</title>
</head>
<body>
    <main>
        <form action='<?php echo htmlspecialchars($_SERVER["$PHP_SELF"]); ?>' method="post">
            <label for="operator1">First Number</label>
            <input type="number" name="Operator1" step="any" value="">
            <button type="submit"> Submit</button>
        </form>

        <?php

        if (isset($err)){
            
        }
        
        ?>

        <?php 
        if ($_SERVER["REQUEST_METHOD"] == "POST"){

            //phpvariable=superglobal['form field name ']
            $name= $_POST['name'];

            //validation 
            if($name = "") {
                $err = "Please input name";
            }

        }
        ?>
    </main>
    
</body>
</html>