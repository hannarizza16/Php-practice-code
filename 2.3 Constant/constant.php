<!-- constant -->
<!-- define() function -->

<?php 


// constant using define(name, value, case_insensitive(bool)?)
define("SCHOOL_NAME", "Green Valley Academy");

const MAX_STUDENTS = 40;

function displayConstants() {

    echo "School: " . SCHOOL_NAME;
    echo " Maximum students per class: " .   MAX_STUDENTS;  
}

displayConstants();


// using variable 
function displayValues() {
    $schoolName = "Green Valley";
    $maxStudents = 40;
    echo "<br>";
    echo "School: {$schoolName}";
    echo " Maximum students per class: {$maxStudents}";
}

displayValues();


?>
