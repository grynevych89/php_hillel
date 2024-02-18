<?php

require __DIR__ . '/personWorker.php';
echo "----------------------------------------------------------------------------------" . PHP_EOL;
try {
    $worker = new PersonWorker('Jim', 'manager');
    $worker->showWorkerInfo();
} catch (Exception $error) {
    echo $error->getMessage();
}

try {
    $worker2 = new PersonWorker('I', 'developer');
    $worker2->showWorkerInfo();
} catch (Exception $error) {
    echo $error->getMessage();
}

try {
    $worker3 = new PersonWorker('Nick', 'designer');
    $worker3->showWorkerInfo();
} catch (Exception $error) {
    echo $error->getMessage();
}
echo "----------------------------------------------------------------------------------" . PHP_EOL;
