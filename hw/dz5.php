<?php

echo ">>> Введіть речення: ";
$input = trim(fgets(STDIN));
$search = stripos($input, '.');
$length = strlen($input);

if ($length > 20) {
    echo ($search === $length - 1 || !$search ?
            ">>> Рядок складається з одного речення." :
            ">>> " . substr($input, 0, $search + 1)) . PHP_EOL;
} else {
    echo ">>> Рядок задовольняє умовам завдання." . PHP_EOL;
}
