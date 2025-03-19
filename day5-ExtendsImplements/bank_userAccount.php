<?php

interface BankAccount {
    function getAccountBalance();
    function setAccountBalance(float $balance);
}

class Transactions {
    private float $transfer_amount;
    private string $t_iban;

    public function __construct(float $transactionAmount, string $transfer_iban) {
        $this->transfer_amount = $transactionAmount;
        $this->t_iban = $transfer_iban;
    }

    public function money_transfer() {
        echo $this->transfer_amount . " Euro has been successfully transferred to " . $this->t_iban . "\n";
    }
}

class User implements BankAccount {
    private string $bank_iban;
    private float $account_balance;
    private string $account_fullName;

    public function __construct(string $bank_number, float $balance, string $name) {
        $this->bank_iban = $bank_number;
        $this->account_balance = $balance;
        $this->account_fullName = $name;
    }

    public function getAccountBalance(): float {
        return $this->account_balance;
    }

    public function setAccountBalance(float $bal): void {
        $this->account_balance += $bal;
    }

    public function transferMoney(float $amount, string $iban): void {
       
		$this->account_balance -= $amount;
		$transaction = new Transactions($amount, $iban);
		$transaction->money_transfer();
 
    }
}

$myAccount = new User("DE6752374523745", 23.5, "Ali Hinnawe");

echo "<pre>";
$myAccount->setAccountBalance(10);
echo "my new account balance: " . $myAccount->getAccountBalance() . " Euro\n";
$myAccount->setAccountBalance(100);
echo "my new account balance: " . $myAccount->getAccountBalance() . " Euro\n";

$myAccount->transferMoney(40.5, "DE899899898888");
echo "my new account balance: " . $myAccount->getAccountBalance() . " Euro\n";
echo "</pre>";

?>
