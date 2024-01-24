<?php

echo ">>> Enter your name: ";
$name = trim(fgets(STDIN));

do {
    echo ">>> Enter your age: ";
    $age = trim(fgets(STDIN));
} while (isValidInt($age));

function isValidInt($int) {
    echo ">>> Only integer! ";
    return $int === null || !intval($int);
};

echo "---------------------" . PHP_EOL .
    "Hi, $name!" . PHP_EOL .
    "You $age years old ;)" . PHP_EOL .
    "---------------------" . PHP_EOL;
