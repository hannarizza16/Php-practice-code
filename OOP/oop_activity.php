<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>OOP activity</title>
</head>
<body>
    <h1>OOP ACTIVITY</h1>

    <?php

    //OOP - Object Oriented Programming
       class Student { // Student is the name of the class
            public $name; // property
            public $grades = []; // property - array to hold grades
            public $gradesWithSubject = []; // property - associative array to hold grades with subject

            //Constructor
            public function __construct($name, $grades = [], $gradesWithSubject = []) { // __construct - magic method / $name - parameter
                $this->name = $name; // $this - refers to the current object / assigning the parameter to the property / $this->name - property
                $this->grades = $grades;
                $this->gradesWithSubject = $gradesWithSubject;
            }

            // Method - to show student info
            public function studentInfo() {
                return "$this->name has " . count($this->grades) . "in total grades.";
            }

            // Method - show grades in list format
            public function showGradesInList() {
                foreach($this->grades as $items => $grade) {
                    echo  ($items + 1) . ". " . $grade . "<br>";
                }
            }

            public function showGradesInListWithSubject() {
                $index = 1;
                foreach($this->gradesWithSubject as $subject => $grade) {
                    echo $index . ". ". ucfirst($subject) . ": " . $grade . "<br>";
                    $index++; //ucfirst() - built-in function to capitalize the first letter of a string
                }
            }

            //Method - show grades in a string format seperated by comma using implode() function
            public function showGrades() {
                return "Grades: " . implode(", ", $this->grades);
            }
 
            //Method - getting the average of the grades
            public function getAverage() {
                //if grades is empty return 0
                //count - built-in function for counting the number of elements in an array
                if(count($this->grades) === 0) {
                    return 0; 
                }

                $sum = array_sum($this->grades); // sum of all grade // array_sum() - built-in function for sum of array
                $average = $sum / count($this->grades); // count() - built-in function for counting the number of elements in an array
                return "Average Grade: $average"; // return the average - (85)
            } 
            

            
        }

        $grades = [85, 90, 95, 80, 75];
        $gradeswsubject = [
            "Math" => 85,
            "Science" => 90,
            "English" => 95,
            "History" => 80,
            "Art" => 75
        ];

        $student = new Student("Hanna Malana", $grades, $gradeswsubject);
        // $student = new Student("Hanna Malana", [85, 90, 95, 80, 75]);

        echo $student->studentInfo();
        echo "<br>";

        echo $student->showGradesInList();
        echo "<br>";

        echo $student->showGradesInListWithSubject();
        echo "<br>";

        echo $student->showGrades();
        echo "<br>";
        var_dump($student->showGrades()); // string(29) "Grades: 85, 90, 95, 80, 75"
        echo "<br>";
        echo "<br>";

        echo $student->getAverage();
        echo "<br";

        // print_r($student->grades); // to print an array
        // echo "<br>";
        // echo PHP_INT_MAX; // 2147483647
    ?>
    
</body>
</html>

