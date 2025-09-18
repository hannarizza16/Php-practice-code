<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Request</title>
</head>
<body>
    <main>
        <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post">
        <label for="name">name</label>
        <input type="text" name="name" value='<?php echo isset($name)? $name : "";?>'>
        <label for="lastname">last name</label>
        <input type="text" name="lastname" value='<?php echo isset($lastname)? $lastname : "";?>'>
        <input type="submit" name="" id="">
        </form>
    </main>



    <?php 
    if($_SERVER['REQUEST_METHOD'] == "POST"){
        $name = htmlspecialchars($_POST['name']);
        $lastname = htmlspecialchars($_POST['lastname']);

        if(empty($name) || empty($lastname)){
            echo $error = "Please fill up the form";
        }

        if(isset($name) || isset($lastname)){
            $full_name = ucwords(trim($name)) ." ". ucwords(trim($lastname));
            echo $full_name;
        }
    }
    ?>

</body>
</html>