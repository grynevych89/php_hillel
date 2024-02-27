<?php

class File
{
    private string $filePath;

    public function __construct(string $fileName)
    {
        $this->setFilePath($fileName);
    }

    public function getFilePath(): string
    {
        return $this->filePath;
    }

    public function setFilePath(string $fileName): void
    {
        $this->filePath = TODO_LIST_DIR . $fileName . '.json';
    }

    public function save(array $data): void
    {
        file_put_contents($this->filePath, json_encode($data));
    }

    public function load(): array
    {
        if (!file_exists($this->filePath)) {
            return [];
        }

        $data = json_decode(file_get_contents($this->filePath), true);

        $tasks = [];
        foreach ($data as $item) {
            $task = new Task($item['name'], $item['priority']);
            $task->id = $item['id'];
            $task->status = $item['status'];
            $tasks[] = $task;
        }

        return $tasks;
    }
}