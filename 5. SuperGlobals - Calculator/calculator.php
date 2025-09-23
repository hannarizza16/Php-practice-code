
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Calculator</title>
</head>
<style>
    .error{
        color: red;
        font-weight: bold;
    }
</style>
<body>
    

    <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="post">
        <input type="number" step="any" name="num1" placeholder="Number 1" required value="<?php echo isset($num1) ? $num1 : '' ;?>">
        <select name="operators" id="" value="<?php echo isset($operators) ? $operators : ''; ?>"> 
            <option value="" disabled selected>Choose operator</option>
            <option value="+">+</option>
            <option value="-">-</option>
            <option value="*">*</option>
            <option value="/">/</option>
        </select>
        <input type="number" step="any" name="num2" placeholder="Number 2" required value="<?php echo isset($num2) ? $num2 : '';?>">  
        <input type="submit" name="submit">
    </form>

    <!-- <h2> <?php echo isset($result) ? $result : "" ;?> </h2> -->
    <?php
        $num1 = $num2 = $result = 0;
        $operators = "";
        $errors = false;
        if(isset($_POST['submit'])){
            // filtering the input data
            // htmlspecialchars() - convert special characters to HTML entities for security
            // filter_var() - validate and sanitize data
            // $_POST['name'] - collect data from the form using the name attribute
            
            $num1 = filter_input(INPUT_POST, 'num1', FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
            $num2 = filter_input(INPUT_POST, 'num2', FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);

            // $num2 = filter_var((trim($_POST['num2'] ?? 0)), FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
            // $num1 = $_POST['num1'] ?? 0; 
            // $num1 = htmlspecialchars((trim($_POST['num1'] ?? 0)));
            // $num2 = htmlspecialchars((trim($_POST['num2'] ?? 0 )));
            $operators = $_POST['operators'];
            
            
            // if ($operators == "" || !isset($operators)){ 
            //empty() - is a shorthand for !isset() || $operators == false
            // checks if : 1. variable is not set 2. variable is null 3. " " (variable is an empty string) 4. variable is 0, "0", false, [].
            if (empty($operators)){
                echo "<p class='error'> Please select an operator. </p>";
                $errors = true;
                exit; // stop the entire script/program from running
                // return; // stop the current function from running
            }

            if (!is_numeric($num1) || !is_numeric($num2)){
                echo "<p class='error'> Please enter a valid number. </p>";
                $errors = true;
                exit;
            }

            if(!$errors){ // if condition is true, if there are no errors, perform the calculation
                switch($operators){
                    case "+":
                        $result = $num1 + $num2;
                        break;
                    case "-":
                        $result = $num1 - $num2;
                        break;
                    case "*":
                        $result = $num1 * $num2;
                        break;
                    case "/":
                        if($num2 == 0){
                            echo "Division by zero is not allowed.";
                            exit;
                        }
                        $result = $num1 / $num2;
                        break;
                    default:
                        echo "<p class='error'> Something went wrong. </p>";
                        exit;
                }
                echo "<h2>The result is: $result</h2>";
            } else {
                echo "Please enter valid numbers.";
            }
        }
    ?>
    
</body>
</html>

<!-- notes: POST vs GET  
// GET appends form data into the URL in name/value pairs in short it is visible to everyone
// POST sends the form data inside the body of the HTTP request in short it is not visible to others
// when to use GET:
// 1. when the form submission is not sensitive
// 2. when you want to bookmark the result page
// when to use POST:
// 1. when the form submission is sensitive
// 2. when you are uploading a file
// 3. when you are submitting a large amount of data
// 4. when you want to submit data that will change the server state (e.g., updating a database)
// superglobal variables: $_GET, $_POST, $_REQUEST, $_SERVER, $_SESSION, $_COOKIE, $_FILES, $_ENV
// $_GET - used to collect data sent in the URL
// $_POST - used to collect data sent in the HTTP request body
// $_REQUEST - used to collect data sent in both GET and POST methods
// $_SERVER - used to collect information about the server and execution environment
// $_SESSION - used to store data across multiple pages
// $_COOKIE - used to store data in the user's browser
// $_FILES - used to upload files
// $_ENV - used to collect environment variables
// superglobal variables are always accessible, regardless of scope -->