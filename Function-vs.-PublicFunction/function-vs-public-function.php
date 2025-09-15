<!-- Function - is a regular function / standlaon function that is not defined
inside a class -->

<!-- public function - is a method that is defined or used inside a class -->
<?php 

// using Function 

define("GROCERIES", ['Meat', 'Chicken', 'Pork']);

function listOfGrocery() {
    foreach (GROCERIES as $index => $items) {
        echo ($index + 1) . ". " . $items . "<br>";
    }
}

listOfGrocery();


// public function in class

class Groceries {
    public $items = []; // property is expecting an array
    public $name;

    public function __construct($name, $items = []){
        $this->items = $items;
        $this->name = $name;
    }

    public function showGroceryItems() {
        foreach ($this->items as $index => $item) {
            echo ($index + 1) . ". " . $item . "<br>";
        }
    }
}

$groceries = new Groceries("Grocery List", ["Meat", "Fish", "Chicken", "Pork"]);

echo $groceries->showGroceryItems();

?>