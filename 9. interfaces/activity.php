<?php
// An interface is like a contract or a blueprint for classes.
// interface comes with implement keyword
///////////////////////////////////
// PAYMENT
//////////////////////////////////

Interface PaymentMethod {
    public function pay($amount);
}

class CreditCardPayment implements PaymentMethod {
    public function pay($amount) {
        echo "Paying $amount using Credit Card. <br>";
    }
}

class PayPalPayment implements PaymentMethod {
    public function pay($amount) {
        echo "Paying $amount using PayPal. <br>";
    }
}

function processPayment(PaymentMethod $payment, $amount){
    $payment->pay($amount);
}


$creditCardPayment = new CreditCardPayment();
$payPalPayment = new PayPalPayment();

processPayment($creditCardPayment, 100);
processPayment(new PayPalPayment(), 500);



///////////////////////////////////
// VEHICLE
//////////////////////////////////


Interface Vehicle {
    public function move($speed);
}

class Car implements Vehicle {
    public function move($speed) {
        echo "The car is moving at $speed km/h. <br>";
    }
}

class Bicycle implements Vehicle {
    public function move($speed) {
        echo "The Bicycle isn moving at $speed km/h. <br>";
    }
}

function startJourney(Vehicle $vehicle, $speed){
    $vehicle->move($speed);
}


$car  = new Car();
$bike = new Bicycle();

startJourney($car, 120);
startJourney($bike, 25);

///////////////////////////////////
// FILE EXPORT
//////////////////////////////////


interface Exporter{
    public function export($data);
}

class JsonExporter implements Exporter {
    public function export($data) {
        echo "Exporting data as JSON: " . json_encode($data) . "<br>";
    }
}

class CsVExporter implements Exporter {
    public function export($data) {
        echo "Exporting data as CSV: ";
        //array_keys gets the keys of the first array element to use as headers -> name, age

        $headers = array_keys($data[0]);
        echo implode(",", $headers) . "<br>";

        // Print rows
        foreach ($data as $row) {
            echo implode(",", $row) . "<br>";
        }
    }
}

function saveFile(Exporter $exporter, $data) {
    $exporter->export($data);
}

$data = [
    ["name" => "Alice", "age" => 25],
    ["name" => "Bob", "age" => 30],
];

saveFile(new JSonExporter(), $data);
saveFile(new CsVExporter(), $data);


interface PaymentInterface{
    public function payNow();
    public function paymentProcess();
}

interface LoginInterface {
    public function loginFirst();
}

class Paypal implements PaymentInterface, LoginInterface{
    public function loginFirst() {}
    public function payNow() {}
    public function paymentProcess() {
        //process payment
        $this->loginFirst();
        $this->payNow();
    }
}
class BankTransfer implements PaymentInterface, LoginInterface {
    public function loginFirst() {}
    public function payNow() {}
    public function paymentProcess() {
        //process payment
        $this->loginFirst();
        $this->payNow();
    }
}
class Visa implements PaymentInterface{
    public function payNow() {}
    public function paymentProcess() {
        //process payment
        $this->payNow();
    }
}
class Cash implements PaymentInterface{
    public function payNow() {}
    public function paymentProcess() {
        //process payment
        $this->payNow();
    }
}

class BuyProduct {
    public function pay(PaymentInterface $paymentMethod) {
        $paymentMethod->paymentProcess();
    }
    public function onlinePayment(PaymentInterface $paymentMethod) {
        $paymentMethod->paymentProcess();
    }
}


$paymentMethod = new Paypal();
$buyProduct = new BuyProduct();
$buyProduct->pay($paymentMethod);
?>