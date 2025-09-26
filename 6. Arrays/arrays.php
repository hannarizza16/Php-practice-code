<!-- kinds of arrays -->
<!-- 1. indexed 
2. associative
3.multidimensional x
sorting arrays x
-->

<!-- indexed array LOOP -->

<?php 
$cars = ['volvo', 'bmw', 'Toyota'];

// adding an item in the list of array
$cars[] = 'Nissan'; // short and faster, only adds 1 element
array_push($cars, 'Honda', 'Kawasaki'); // using a function can add multiple values at once


foreach ($cars as $x) {
    echo "$x <br>";
}



// associative array 

$bike = [
    'type' => 'Mountain Bike', 
    'brand' => 'Nissan',
    'year' => 1698];

    $bike['year'] = 1700; // replacing
    $bike['color'] = 'black'; // adding new key value pair in array
    $bike += ['location' => 'Cavite', 'price' => 4000]; // adding multiple items inside array

    foreach ($bike as $key => $value) {
        echo "$key : $value <br>";
    }

?>

<!-- removing array item
array_splice();
array_splice($cars, 1, 1)
unset();
unset($cars[1]);

remove multiple array 
array_splice($cars, 1, 2);
unset($cars[1], $cars[2]);

remove item from assocaitive array
unset($bike["brand"]);
array_diff()
array_diff($bike, [1700, 'black'])

array_pop() - remove last item in array
array_shift - remove first item in array -->