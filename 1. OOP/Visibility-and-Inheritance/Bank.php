<?php

class BankAccount {
    protected $balance = 100;
    protected $deposit = 0;
    protected $withdraw = 0;
    protected $initialBalance;

    public function __construct($deposit, $withdraw) {
        $this->initialBalance = $this->balance;
        $this->deposit = $deposit;
        $this->withdraw = $withdraw;
    }

    public function getBalance() {
        return $this->balance;
    }

    public function deposit() {
        if ($this->deposit > 0) {
            $this->balance += $this->deposit;
        }
        return $this;
    }

    public function withdraw() {
        if ($this->withdraw > $this->balance) {
            echo "Insufficient Funds<br>"; 
            $this->withdraw = 0; // no withdeaw will happen
        } else {
            $this->balance -= $this->withdraw;
        }
        return $this;
    }

    public function display() {
        echo "Available Balance: $this->initialBalance <br>";
        echo "Deposited: $this->deposit <br>";
        echo "Withdrawn: $this->withdraw <br>";
        echo "Final Balance: " . $this->getBalance() . "<br>";
    }
}

$bank = new BankAccount(50, 70);
$bank->deposit()
->withdraw()
->display();


// var_dump($bank->getBalance());
