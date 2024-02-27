<?php

class Account
{
    private string $cardNumber;
    private int $balance;

    public function __construct(string $cardNumber, int $startBalance)
    {
        if ($startBalance < 0) {
            throw new Exception("Баланс на дебетовій картці не може бути меньше 0");
        }

        $this->setCardNumber($cardNumber);
        $this->setBalance($startBalance);
    }

    public function getBalance(): int
    {
        return $this->balance;
    }

    public function getCardNumber(): string
    {
        return $this->cardNumber;
    }

    public function replenish(int $amount):void
    {
        if ($amount <= 0) {
            throw new Exception("Для поповнення картки сума поповнення повинна бути більше 0");
        }

        $this->setBalance($this->balance + $amount);
    }

    public function withdraw(int $amount): void
    {
        $balance = $this->getBalance();
        if ( $balance < $amount) {
            throw new Exception(
                "Баланс вашого рахунку становить $balance."
                . PHP_EOL
                . "Ви не можете зняти більше, ніж маєте на своєму рахунку."
                .PHP_EOL
            );
        }

        $this->setBalance($balance - $amount);
    }

    protected function setBalance(int $balance): void
    {
        $this->balance = $balance;
    }

    private function setCardNumber(string $cardNumber): void
    {
        $this->cardNumber = $cardNumber;
    }
}