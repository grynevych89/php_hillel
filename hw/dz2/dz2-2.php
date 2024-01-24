<?php

$numberOne = null;
$numberTwo = null;
$numberTree = null;

do {
    echo ">>> Введіть перше число: ";
    $numberOne = trim(fgets(STDIN));
} while (isValid($numberOne));

do {
    echo ">>> Введіть друге число: ";
    $numberTwo = trim(fgets(STDIN));
} while (isValid($numberTwo));

do {
    echo ">>> Введіть друге число: ";
    $numberTree = trim(fgets(STDIN));
} while (isValid($numberTree));

function isValid($int) {
    return $int === null || !intval($int);
};

$total = $numberOne + $numberTwo + $numberTree;
$totalAverage = ($numberOne + $numberTwo + $numberTree) / 3 ;

echo "---------------------" . PHP_EOL .
    "Введені числа $numberOne, $numberTwo та $numberTree:" . PHP_EOL .
    "Сума чисел: " . $total . "," . PHP_EOL .
    "Cередне арифметичне: " . $totalAverage . "." . PHP_EOL .
    "---------------------" . PHP_EOL;
