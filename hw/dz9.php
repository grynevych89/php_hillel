<?php

#1
echo '-------------------------------------------------------------------------' . PHP_EOL;
$min = 1;
$max = 10;
function printRangeNumbers($min, $max): void {
    while ($min <= $max) {
        echo $min . ($min === $max ? PHP_EOL : ', ');
        $min++;
    }
}
echo ">>> Виведіть на екран всі числа від 1 до 10 використовуючи цикл while: " . PHP_EOL;
printRangeNumbers($min, $max);
echo '-------------------------------------------------------------------------' . PHP_EOL;

#2
$factorial = 5;
function factorial(): void
{
    $result = 1;
    $i = 1;
    while ($i <= 5){
        $result *= $i;
        $i++;

    }
    echo "Факторіал числа 5 = $result" . PHP_EOL;
}

echo ">>> Обчисліть факторіал числа 5 використовуючи цикл while: " . PHP_EOL;
factorial(5);
echo '-------------------------------------------------------------------------' . PHP_EOL;

#3
$minEven = 1;
$maxEven = 20;
function printEvenNumbers($minEven, $maxEven): void
{
    while ($minEven <= $maxEven) {
        if ($minEven % 2 === 0) {
            echo $minEven . ($minEven === $maxEven || $minEven === $maxEven - 1 ? PHP_EOL : ', ');
        }
        $minEven++;
    }
}

echo ">>> Виведіть на екран всі парні числа від 1 до 20 використовуючи цикл while:" . PHP_EOL;
printEvenNumbers($minEven, $maxEven);
echo '-------------------------------------------------------------------------' . PHP_EOL;
