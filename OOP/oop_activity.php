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
       class Student {
            public $name;
            public $grades = []; //
            public function __construct($name) {
                $this->name = $name;
            }
            //Method
            public function addGrade($grade) {
                $this->grades[] = $grade;
            }  

            //Method
            public function getAverage() {
                if(count($this->grades) === 0) {
                    return 0; 
                }

                $sum = array_sum($this->grades); // sum of all grade // array_sum() - built-in function for sum of array
                $average = $sum / count($this->grades); // count() - built-in function for counting the number of elements in an array
                return "Student: ($this->name), Average Grade: ($average)";
            } 
            //Method
            public function showGrades() {
                return "Grades: " . implode(", ", $this->grades);
            }
        }

        $grades = [85, 90, 95, 80, 75];
        $student = new Student("Hanna Malana");
        
        foreach ($grades as $grade) {
            $student->addGrade($grade);
        }

        echo "The student has " . count($student->grades) . " in total grades"; // 5
        echo "<br>";

        print_r($student->grades);
        echo "<br>";

        echo $student->showGrades();
        echo "<br>";

        echo $student->getAverage();
    ?>
    
</body>
</html>