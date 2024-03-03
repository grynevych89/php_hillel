<?php

class UserController
{
    use Validator;

    public function update(array $data): void
    {
        $this->validate($data, USER_VALIDATION_SCHEMA);
    }

    public function delete(int $id): void
    {
        $schema = [
            'id' => 'int|required',
        ];
        $this->validate(['id' => $id], $schema);
    }
}