<?php

class Task
{
    public string $id;
    public string $name;
    public int $priority;
    public string $status;

    public function __construct(string $name, int $priority)
    {
        $this->id = uniqid();
        $this->name = $name;
        $this->priority = $priority;
        $this->status = Status::NOT_DONE->value;
    }
}