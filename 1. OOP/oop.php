<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>OOP</title>
</head>
<body>
    <p>OOP</p>
    <?php
    class Car { 
        public $color; 
        public $model;
        public $count;
        //__construct(parameter1, parameter2)
        public function __construct($color, $model, $count){
            $this->color = $color;
            $this->model = $model;
            $this->count = $count;
        }

        public function message() {
            return "My car is $this->color, and the model is $this->model and I have $this->count pieces.";
        }
    }

    // converting one data type to another data type
    $pieces = (string) 4; 
     // modifying string
    $color = strtoupper("red");
    $model = strtolower("VOLVO");
    

    $myCar = new Car($color, $model , $pieces);
    var_dump($myCar);
    
    echo $myCar->message();

    var_dump($pieces); // string(1)"4"

    //explode() - split string into array

    $split = "splitting this string into array";
    $splitToArray = explode(" ", $split);
    
    $reverseArray = array_reverse($splitToArray);
    //print_r() function to display the result of explode() function
    print_r($reverseArray); // Array ( [0] => splitting [1] => this [2] => string [3] => into [4] => array )

    ?>
    
</body>
</html>