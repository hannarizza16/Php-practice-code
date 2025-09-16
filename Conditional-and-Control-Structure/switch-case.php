<!-- Print the corresponding date and week -->

<!-- using SWITCH CASE && match() -->

<!-- match() - is a strict condition -->


<?php 


// match() - is a strict condition

$grade = 49;

$gradeResult = match (true){
    $grade >= 90 && $grade <= 100 => "A",
    $grade >= 80 && $grade <= 89 => "B",
    $grade >= 70 && $grade <= 79 => "C",
    $grade >= 60 && $grade <= 69 => "D",
    $grade >= 50 => "F",
    default => "Talk to your teacher"
};

echo $gradeResult; // Talk to your teacher

// winter match()

$season = 1;

$whatIsTheSeason = match ($season) {
    1, 2, 3, 4, 5 => "Winter",
    6, 7, 8, 9 => "Summer",
    10, 11, 12 => "Autumn",
    default => "Not a valid month"
};

echo $whatIsTheSeason;


// Switch case

$dayOfTheWeek = 1;

switch ($dayOfTheWeek){
    case 1: 
        echo "Sunday";
        break;
    case 2:
        echo "Monday";
        break;
    case 3:
        echo "Tuesday";
        break;
    case 4:
        echo "Wednesday";
        break;
    case 5:
        echo "Thursday";
        break;
    case 6:
        echo "Friday";
        break;
    case 7:
        echo "Thursday";
        break;
    default:
        echo "Invalid Day";
}




?>
