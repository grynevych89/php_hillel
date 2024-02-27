<?php

function logTasks($tasks): void
{
    foreach ($tasks as $task) {
        echo $task->id
            . ' | '
            . $task->name
            . ' | '
            . $task->priority
            . ' | '
            . $task->status
            . PHP_EOL;
    }
}

function validateCommand(string $command): void
{
    $isCommandValid = match ($command) {
        'read', 'record', 'done', 'remove', 'files', 'help', 'exit' => true,
        default => false
    };

    if(!$isCommandValid) {
        throw new Exception("Command $command not found!\nUse 'help' to get the list of commands." . PHP_EOL);
    }
}

