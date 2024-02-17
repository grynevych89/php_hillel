<?php

require __DIR__ . '/const.php';
require __DIR__ . '/app.php';

function main(): void
{
    $app = new App(new Reader, new Recorder);

    $firstLoop = true;
    while (true) {
        if($firstLoop) {
            echo COMMANDS;
            $firstLoop = false;
        } else {
            echo "Оберіть дію: ";
        }

        $action = trim(fgets(STDIN));
        switch ($action) {
            case  'read':
                try {
                    echo  $app->read();
                } catch (Exception $error) {
                    echo $error->getMessage();
                }
                break;

            case 'write':
                try {
                    $app->write();
                    echo "Запис зроблено!" . PHP_EOL;
                } catch (Exception $error) {
                    echo $error->getMessage();
                }
                break;

            case 'help':
                echo COMMANDS;
                break;

            case 'quit':
                exit('Програма вимкнена' . PHP_EOL);

            default:
                echo "Такої дії '$action' не існує" . PHP_EOL;
        }
    }
}

main();
