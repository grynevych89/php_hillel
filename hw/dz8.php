<?php

$length = 13;
$min = 7;
$max = 333;
$numbers = createArray($length, $min, $max);

function createArray ($length, $min, $max): array {
    $arr = [];

    for($i = 0; $i < $length; $i++)
    {
        $arr[$i] = rand($min, $max);
    }
    return  $arr;
}

function sortArray(array $array): array {
    $length = count($array);
    for ($i = 0; $i < $length; $i++) {
        for ($j = 0; $j < $length - $i - 1; $j++) {
            if ($array[$j] > $array[$j + 1]) {
                $var = $array[$j];
                $array[$j] = $array[$j + 1];
                $array[$j + 1] = $var;
            }
        }
    }
    return $array;
}

$sortingNumbers = sortArray($numbers);
echo '-----------------------------------' . PHP_EOL;
echo "Створюемо рандомно масив та сортеруємо: " . PHP_EOL;
print_r($sortingNumbers);

$firstKey = array_key_first($sortingNumbers);
$lastKey = array_key_last($sortingNumbers);
echo "Мінімельне рандомне значення: $sortingNumbers[$firstKey]" .
    PHP_EOL . "Максимальне рандомне значення: $sortingNumbers[$lastKey]" .
    PHP_EOL;
echo '-----------------------------------' . PHP_EOL;
