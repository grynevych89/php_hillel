<?php

class TaskList
{
    private array $tasks = [];
    private File $storage;

    public function __construct(File $storage)
    {
        $this->storage = $storage;
        $this->updateTasks();
    }

    public function getStorage(): File
    {
        return $this->storage;
    }

    public function changeStorage($fileName): void
    {
        $this->storage->setFilePath($fileName);
        $this->updateTasks();
    }

    public function addTask(string $taskText, int $priority): void
    {
        $this->updateTasks();
        $this->tasks[] = new Task(trim($taskText), $priority);
        $this->storage->save($this->tasks);
    }

    public function deleteTask(string $taskId): void
    {
        $this->tasks = array_filter($this->tasks, function ($task) use ($taskId) {
            return $task->id !== $taskId;
        });
        $this->storage->save($this->tasks);
    }

    public function getTasks(): array
    {
        $this->updateTasks();
        usort($this->tasks, function ($a, $b) {
            return $b->priority <=> $a->priority;
        });
        return $this->tasks;
    }

    public function completeTask(string $taskId): void
    {
        foreach ($this->tasks as $task) {
            if ($task->id === $taskId) {
                $task->status = Status::DONE->value;
                break;
            }
        }
        $this->storage->save($this->tasks);
    }

    private function updateTasks(): void
    {
        $this->tasks = $this->storage->load();
    }
}