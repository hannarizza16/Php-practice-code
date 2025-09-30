<?php

class BankAccount {
    protected float $balance = 100;
    protected float $deposit = 0;
    protected float $withdraw = 0;
    protected float $initialBalance;

    public function __construct($deposit, $withdraw) {
        $this->initialBalance = $this->balance;
        $this->deposit = $deposit;
        $this->withdraw = $withdraw;
    }

    // : float = is a return type declaration
    // it specifies that the method will return a value of type float
    public function getBalance(): float {
        return $this->balance;
    }

    public function deposit() {
        if ($this->deposit > 0) {
            $this->balance += $this->deposit;
        }
        return $this;
    }

    public function withdraw() {
        $amount = $this->withdraw;
        if ($amount <= 0) {
            throw new InvalidArgumentException("Withdraw amount must be > 0");
        }

        if ($amount > $this->balance) {
            echo "Insufficient funds. Current balance: " . $this->getBalance() . "<br>";
            return $this;
        }

        $this->balance -= $amount;
        return $this;
    }

    public function display() {
        echo "Available Balance: $this->initialBalance <br>";
        echo "Deposited: $this->deposit <br>";
        echo "Withdrawn: $this->withdraw <br>";
        echo "Final Balance: " . $this->getBalance() . "<br>";
    }
}

class SavingsAccount extends BankAccount{
    protected $interest = 0.05;

    public function addInterest() {
        $interest = $this->balance * $this->interest;
        $this->balance += $interest;
        echo "Interest Added: $interest <br>";
        return $this;

    }


}

$bank = new SavingsAccount(50, 50);
$bank->deposit()
->withdraw()
->addInterest()
->display();


// var_dump($bank->getBalance());
