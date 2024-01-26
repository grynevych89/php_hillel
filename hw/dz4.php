<?php

$value = 4;
# v.1
//switch ($value) {
//    case 1: echo ">>> Green" . PHP_EOL; break;
//    case 2: echo '>>> Red' . PHP_EOL; break;
//    case 3: echo '>>> Blue' . PHP_EOL; break;
//    case 4: echo '>>> Brown' . PHP_EOL; break;
//    case 5: echo '>>> Violet' . PHP_EOL; break;
//    case 6: echo '>>> Black' . PHP_EOL; break;
//    default: echo ">>> White" . PHP_EOL;
//};

# v.2
$result = match ($value) {
    1 =>  ">>> Green" . PHP_EOL,
    2 =>  '>>> Red' . PHP_EOL,
    3 =>  '>>> Blue' . PHP_EOL,
    4 =>  '>>> Brown' . PHP_EOL,
    5 =>  '>>> Violet' . PHP_EOL,
    6 =>  '>>> Black' . PHP_EOL,
    default => ">>> White" . PHP_EOL
};
echo $result;
