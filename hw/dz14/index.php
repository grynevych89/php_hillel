<?php

require __DIR__ . '/Actions.php';
require __DIR__ . '/Account.php';


function main(): void
{
    try {
        $account = new Account('1234 1234 1234 1234', 3000);
        echo '-----------------------------------------------------------------------' . PHP_EOL;
        actionAndLog($account, Actions::GET_BALANCE->value);
        echo '-----------------------------------------------------------------------' . PHP_EOL;
        actionAndLog($account, Actions::WITHDRAW->value,1000);
        actionAndLog($account, Actions::GET_BALANCE->value);
        echo '-----------------------------------------------------------------------' . PHP_EOL;
        actionAndLog($account, Actions::REPLENISH->value,200);
        actionAndLog($account, Actions::GET_BALANCE->value);
        echo '-----------------------------------------------------------------------' . PHP_EOL;
    } catch (Exception $error) {
        print $error->getMessage();
    }
}

function actionAndLog(Account $account, string $action, ?int $amount = null): void
{
    $account->$action($amount);
    echo match ($action) {
        'replenish' => "Рахунок успішно поповнено на 200." . PHP_EOL,
        'withdraw' => "Суму в розмірі $amount було успішно знято з рахунку." . PHP_EOL,
        'getBalance' => "Баланс вашої картки (" . $account->getCardNumber() . "): " . $account->getBalance() . PHP_EOL,
        default => "Дія $action заборонена!"
    };
}

main();