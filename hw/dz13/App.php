<?php

class App
{
    private ?TaskList $taskList = null;

    public function getTaskList(): TaskList|null
    {
        return $this->taskList;
    }

    public function setTaskList(TaskList $taskList): void
    {
        $this->taskList = $taskList;
    }

    public function record(string $fileName, string $text, string $priority): void
    {
        if(!isset($fileName,$text,$priority)) {
            throw new Exception(
                "To record a task, the arguments <fileName>, <text>, <priority> are required!"
            . PHP_EOL);
        }

        $this->checkTaskList($fileName);
        $this->taskList->addTask($text, (int)$priority);

        echo "The recording was successful!" . PHP_EOL;
    }

    public function read(string $fileName): void
    {
        if(!isset($fileName)) {
            throw new Exception(
                "To read a file, the argument <fileName> is required!"
                . PHP_EOL);
        }

        $this->checkTaskList($fileName);
        $tasks = $this->taskList->getTasks();

        logTasks($tasks);
    }

    public function done(string $fileName, string $id): void
    {
        if(!isset($fileName)) {
            throw new Exception(
                "To mark task as completed, the arguments <fileName> and <taskId> are required!"
                . PHP_EOL);
        }


        $this->checkTaskList($fileName);
        $this->checkTaskId($id);
        $this->taskList->completeTask($id);

        echo "Congratulations on completing the task!" . PHP_EOL;
    }

    public function remove(string $fileName, string $id): void
    {
        if(!isset($fileName)) {
            throw new Exception(
                "To remove a task, the arguments <fileName> and <taskId> are required!"
                . PHP_EOL);
        }

        $this->checkTaskList($fileName);
        $this->checkTaskId($id);
        $this->taskList->deleteTask($id);

        echo "The removing was successful!" . PHP_EOL;
    }

    public function files(): void
    {
        $fileNames = [];
        foreach (scandir(TODO_LIST_DIR) as $fileName) {
            if ($fileName === '..' || $fileName === '.') {
                continue;
            }
            $fileNames[] = basename($fileName, '.json');
        }
        if (count($fileNames) <= 0) {
            echo "No file has been created!" . PHP_EOL;
        }
        echo implode(', ', $fileNames) . PHP_EOL;
    }

    #[NoReturn] public function exit(): void
    {
        exit('The program is closed' . PHP_EOL);
    }

    public function help(): void
    {
        echo  PHP_EOL . COMMANDS . PHP_EOL;
    }

    private function checkTaskList($fileName): void
    {
        $taskList = $this->getTaskList();
        if (!isset($taskList)) {
            $this->setTaskList(new TaskList(new File($fileName)));
            return;
        }

        $storage = $this->taskList->getStorage();
        if (basename($storage->getFilePath(), '.json') === $fileName) {
            return;
        }

        $this->taskList->changeStorage($fileName);
    }

    private function checkTaskId(string $id): void
    {
        $isExist = false;
        foreach ($this->taskList->getTasks() as $task) {
            if ($task->id === $id) {
                $isExist = true;
                break;
            }
        }

        if (!$isExist) {
            throw new Exception("Task with id $id not found!" . PHP_EOL);
        }
    }
}