<?php 

// scope resolution operator ::
// parent, self, static - all used with scope resolution operator
// parent - refers to the parent class
// self - refers to the current class
// static - refers to the called class in a context of static inheritance


class FirstClass {
    // Properties
    const CONSTANT = 'A constant value';
    public static $staticProperty = 'A static property value';
    public $instanceProperty = 'An instance property value'; // non-static property

    public static function staticMethod() {
        $nonStatic = new self(); // creating an instance to access non-static property
        echo $nonStatic->instanceProperty . "\n" . 2 ; // accessing non-static property
        return 'A static method value';
    }
}

// $a = FirstClass::staticMethod();
// echo $a;

// inheritance
class SecondClass extends FirstClass {
    public static $staticSecond = 'Static property from SecondClass';

    //methods
    public static function anotherTest() {
        $instanceProperty = new FirstClass(); // creating an instance to access non-static property
        echo parent::CONSTANT . "\n"; // accessing constant from parent class
        echo parent::$staticProperty  . "\n";
        // echo parent::staticMethod() . "\n";
        echo $instanceProperty->instanceProperty . "\n"; // error, cannot access non-static property in static context
        echo parent::staticMethod() . "\n"; // accessing static method from parent class
    }

}

$b = SecondClass::anotherTest();
echo $b;

?>