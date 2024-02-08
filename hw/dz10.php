<?php

function genFibonacci(int $max): Generator {
    [$previousNumber, $currentNumber] =  [0, 1];
    while ($previousNumber < $max) {
        yield $previousNumber;
        [$previousNumber, $currentNumber] = [$currentNumber, $previousNumber + $currentNumber];
    }
}

echo '----------------------------------------------------------------------------' . PHP_EOL;
do {
    echo ">>> Введіть ціле(позитивне) число, по яке треба вивести числа Фібоначчі: ";
    $input = trim(fgets(STDIN));
} while (isValidInt($input));

$numbers = genFibonacci((int)$input);
foreach ($numbers as $i => $number) {
    echo $i === 0 ? $number : ", $number";

}

function isValidInt($int) {
    return $int === null || !intval($int) || $int <= 0;
};

echo PHP_EOL;
echo '----------------------------------------------------------------------------' . PHP_EOL;
