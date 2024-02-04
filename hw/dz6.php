<?php

declare(strict_types=1);
echo '-----------------------------------' . PHP_EOL;
// Завдання №1
$radius = 6;
$calcCircle = fn (int|float $radius): int|float => 2 * pi() * $radius ** 2;
echo 'Площа кола від ' . 'радіуса ' . '"' . $radius . '"' . ' дорівнює: ' . $calcCircle($radius) . PHP_EOL;


// Завдання №2
$numberToPow = 5;
$power = fn (int|float $number, int|float $pow): int|float => $number ** $pow;
echo 'Квадрат числа ' . $numberToPow . ' дорівнює: ' . $power($numberToPow, 2) . PHP_EOL;

// Завдання №3

$number = 3;
function power (int|float &$number, int|float $pow): void
{
    $number **= $pow;
};

power($number, 3);
echo "Результат: $number" . PHP_EOL;
echo '-----------------------------------' . PHP_EOL;
