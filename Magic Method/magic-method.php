
<?php

class Vehicle {

    protected $properties = [];
    // protected $acceptedProperties = ['plateNumber', 'model', 'value', 'brand'];
    // __set() - is a mgic method
    public function __set($property, $value) {
        $this->properties[$property] = $value;
    }
    

    public function __get($property) {
        if(!isset($this->properties[$property])) {
            throw new Exception("$property doesn't exist, ");
        }

        return $this->properties[$property];
    }

    public function getAllProperties() {
        return $this->properties;
    }
}

$vehicle = new Vehicle;
$vehicle->plateNumber ='NBA123';
$vehicle->model = 'Hilux';
$vehicle->brand = 'Toyota';
$vehicle->color = 'white';


class User {

    protected $attributes = [];
    protected $fillable = ['name', 'email', 'age', 'password'];

    public function __get($property){
        
        //in_array - checks if the value is in array
        if(!in_array($property, $this->fillable)) {
            throw new Exception("$property is not allowed");
        } 

        return $this->attributes[$property];
    }


    public function __set($property, $value) {

        if($property === 'email' && !filter_var($value, FILTER_VALIDATE_EMAIL)){
            throw new Exception("$value is not a valid email" );
        }

        if($property === 'age' && $value < 18) {
            throw new Exception("$value is not a legal age");
        }

        if($property === 'password') {
            if(strlen($value) < 6) {
                throw new Exception("Password must be minimum of 6");
            }
            $value = password_hash($value, PASSWORD_BCRYPT);
    }

    $this->attributes[$property] = $value;
    }
}

$user = new User();
$user->age = 18;
$user->password = "sdfasdfasfasd";
$user->emial = "hanna@email.com";

// echo '<pre>'; 
// var_dump($user);
// echo '</pre>';

var_dump($argv);
