<!-- 1. sum of all even numbers -->
<!-- 2. reverse String -->
<!-- 3. Find the Largest number-->

<?php 

// 1. sum of all even numbers 

function sumOfEvenNumbers($numbers) {
    $sum = 0;

    foreach($numbers as $number) {
        if ($number % 2 == 0) {
            echo "$number" . "<br>";
            $sum += $number;
        }
    }
    return "The Sum of all even numbers is $sum ";
}

echo sumOfEvenNumbers([1,2,3,4,5,6]);

// 2. reverse string

function reverseString($string) {
    echo "<br> <br> reverse string"; 
    return "<br>" . strrev($string);
}
echo reverseString("Hanna");

// or

function reverseString2($string) {
    $reversedString = ""; // empty storage string  

    // for (initializatio ; condition; iterate/++ --)
    for ($i = strlen($string) -1 ; $i >= 0; $i-- ) {
        
        $reversedString .= $string[$i];

    }
    return "<br>" . $reversedString;
}

echo reverseString2("You are my sunshine");

// 3. Find the largest number

function largestNumber($numbers){
    $largest = 0;

    foreach($numbers as $number ){
        if ($number > $largest) {
            $largest = $number;
        }
    }
    return "<br> Largest: $largest";
}

echo largestNumber([10, -16, 200, 15, 18, 1]);



// OOP using public function 

class SumOffAllEvenNumbers {
    //properties of class
    public $numbers = [];
    public $reverseString;

    public function __construct($number, $reverseString){
        $this->numbers = $number;
        $this->reverseString = $reverseString;
    }

    public function getSumOfEvenNumbers() {
        $sum = 0;
        foreach($this->numbers as $number) {
            if($number % 2 == 0 ){
                $sum += $number;
            }
        }
        return "<br> $sum";
    }

    public function reverseString() {

        $reversedString = "";

        for($i = strlen($this->reverseString) -1; $i >= 0; $i--){
            $reversedString .= $this->reverseString[$i];
        }
        return "<br>" . $reversedString;
    }
}


$sumOfEvenNumbers = new SumOffAllEvenNumbers([1,2,3,4,5,6], "Reverse this STRING");

echo $sumOfEvenNumbers->getSumOfEvenNumbers(); // 12
echo $sumOfEvenNumbers->reverseString();
?>
