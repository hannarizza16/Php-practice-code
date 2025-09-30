<?php
class Person
{
    private $first = "Hanna";
    private $last = "Malana";
    private $age = 20;

    public function fullName()
    {
        return $this->first . " " . $this->last;
    }
}

class Flight
{
    protected $airline = "cebu pacific";
    protected $destination = "manila";
    protected $departure = "cebu";
    protected $flightNumber = "5J123";
    protected $gate = "A1";
    protected $seat = "12A";
}

class FlightDetails extends Flight
{
    public function getDetails(Person $person)
    {
        $person->fullName(); // accessing method from Person class

        $passengerInfo = "Passenger: " . $person->fullName() 
        . ", Airline: " . ucfirst($this->airline) 
        . ", Flight Number: " . $this->flightNumber 
        . ", From: " . ucfirst($this->departure) 
        . " To: " . ucfirst($this->destination) 
        . ", Gate: " . $this->gate 
        . ", Seat: " . $this->seat;

        return $passengerInfo;
    }
}

class Pet
{
    public function owner()
    {
        $a = "Hi there";
        return $a;
    }
}
