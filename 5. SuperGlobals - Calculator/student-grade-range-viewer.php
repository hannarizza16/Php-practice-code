<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student grade</title>
</head>

<style>
    .errors {
        color: red;
        font-weight: bold;
    }

</style>
<body>

    <main>
        <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF'])?>" method="post">
            <input type="text" name="student_name" placeholder="Student Name" value="<?php echo isset($student_name) ? $student_name : '' ;?>">
            <input type="number" step="any" name="grade" placeholder="Grade" value="<?php echo isset($grade) ? $grade : '' ;?>">
            <input type="submit" name="submit">
        </form>
    </main>

    <?php
        $student_name = "";
        $grade = $rating = 0;
        $errors = false;
        if(isset($_POST['submit'])){
            $student_name = htmlspecialchars(trim($_POST['student_name'] ?? ""));
            $grade = filter_input(INPUT_POST, 'grade', FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
        }

        if(empty($grade)){
            echo "<p class='errors'> Please enter grade.</p>";
            $errors = true;
        }

        if(!is_numeric($grade)){
            echo "<p class= 'errors'> Please enter a valid grade</p>";
            $errors = true;
        }

        if(empty($student_name)){
            echo "<p class='errors'> Please enter the student name.</p>";
            $errors = true;
        }

        if(is_numeric($student_name)){
            echo "<p class='errors'> Please enter a student name in a string format </p>";
            $errors = true;
        }

        if(!$errors){
            switch($grade){
                case ($grade >= 90 && $grade <= 100):
                    $rating = "A";
                    break;
                case ($grade >= 80 && $grade <= 89):
                    $rating = "B";
                    break;
                case ($grade >= 70 && $grade <= 79):
                    $rating = "C";
                    break;
                case ($grade >= 60 && $grade <= 69):
                    $rating = "D";
                    break;
                case ($grade <= 60):
                    $rating = "F";
                    break;
                default:
                echo "<p class='errors'> something went wrong! Please try again or refresh the page</p>";
                exit;
            }
            echo "<p class=''> $student_name 's  rating = $rating</p>";
        }

        

    ?>
    
</body>
</html>