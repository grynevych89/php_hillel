<?php

declare(strict_types=1);

$number1 = 5;
$number2 = 4;

echo '-----------------------------------' . PHP_EOL;
$result = myFunc($number1, $number2);
echo "Результат №1: $result" . PHP_EOL;

function myFunc(int|float $number1, int|float $number2, ?closure $func = null): int|float
{
    $result = $number1 * $number2;
    if (isset($func)) {
        $func($result);
    }
    return $result;
}

myFunc($number1, $number2, function (int|float $result) {
    echo "Результат №2: $result" . PHP_EOL;
});
echo '-----------------------------------' . PHP_EOL;
