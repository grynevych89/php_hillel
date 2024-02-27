<?php

require __DIR__ . '/constants.php';
require UTILS_DIR . 'functions.php';
require ENUMS_DIR . 'Status.php';
require CLASSES_DIR . 'File.php';
require CLASSES_DIR . 'Task.php';
require CLASSES_DIR . 'TaskList.php';
require __DIR__ . '/App.php';

function main(): void
{
    global $argv;
    $app = new App;
    $firstLoop = true;
    while (true) {
        if($firstLoop) {
            $app->help();
            $firstLoop = false;
        }

        $input = readline(">>> ");
        if (empty($input)) {
            break;
        }
        preg_match_all('/(\'[^\']*\'|"[^"]*"|\S+)/', $input, $matches);
        $arguments = $matches[0];
        $command = array_shift($arguments);

        try {
            validateCommand($command);
            $app->$command(...$arguments);
        } catch (Exception $error) {
            echo $error->getMessage();
        }
    }
}

main();