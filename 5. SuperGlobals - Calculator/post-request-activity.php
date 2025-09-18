<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>POST Problem Activity</title>
</head>
<body>
    
    <?php 
    $Error = ""; // Initialize error message variable
    $InfoResult = ""; // Initialize info result variable

    if($_SERVER['REQUEST_METHOD'] == "POST"){
        // Collect and sanitize input data
        // htmlspecialchars() - convert special characters to HTML entities for security
        //1.coolect the data from the form using $_POST superglobal array
        //2.sanitize the data using htmlspecialchars() and trim()
        $firstname = htmlspecialchars(trim($_POST['firstname'])) ;
        $lastname = htmlspecialchars(trim($_POST['lastname'])) ;
        $mail = htmlspecialchars(trim($_POST['mail']));

        // 3. Validate input data
        // if any of the fields are empty, set error message
        if(empty($firstname) || empty($lastname) || empty($mail)){
            $Error = "Fields cannot be empty";
        } else { // if all fields are filled, set info result message
            $InfoResult = "Thank You $firstname";
        }
    }
    
    
    ?>

    <main>
        <!-- <?php echo  $_SERVER['PHP_SELF']?> --> <!-- to avoid hardcoding the file name in the action attribute -->
        <!-- Superglobal variable that returns the filename of the currently executing script -->
        <!-- 1. Create a form with the following fields: First name, Last name, E-Mail and a submit button. -->
        <!-- 2. Use the POST method to submit the form data to the same PHP file. -->
        <!-- 3. Handle the form submission in PHP. -->
        <form action="<?php $_SERVER['PHP_SELF']?>" method="post">
            <label for="firstname">First name</label>
            <input type="text" name="firstname" value="<?php echo isset($firstname) ? $firstname : "" ?>">
            <label for="lastname">Last Name</label>
            <input type="text" name="lastname" value="<?php echo isset($lastname) ? $lastname : "" ?>">
            <label for="mail">E-Mail</label>
            <input type="email" name="mail" value="<?php echo isset($mail) ? $mail : "" ?>">
            <input type="submit">
        </form>

        <!-- empty() - checks if the variable is empty -->
        <!-- issset() - checks if the variable is set and is not NULL -->
        
        <!-- 4. after validating in PHP display the error message above the form if any field is empty -->
        <!-- 5. if all fields are filled display another message or validation that the form was submitted successfully -->

        <?php 
            if(!empty($Error)){ ?>
            <h1> <?php echo $Error ?></h1>
        <?php } ?>

        <?php 
            if(!empty($InfoResult)){ ?>
            <h1> <?php echo $InfoResult ?></h1>
        <?php } ?>
    </main>

    
</body>
</html>