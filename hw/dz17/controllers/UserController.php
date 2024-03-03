<?php

class UserController
{
    use Validator;

    public function update(array $data): void
    {
        $schema = USER_VALIDATION_SCHEMA; // Використовуємо схему для оновлення користувача
        $this->validate($data, $schema);
    }

    public function delete(int $id): void
    {
        $schema = ID_VALIDATION_SCHEMA; // Використовуємо схему для видалення
        $this->validate(['id' => $id], $schema);
    }
}