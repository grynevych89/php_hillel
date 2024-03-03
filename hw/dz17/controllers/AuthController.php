<?php

class AuthController {
    use Validator;

    public function register($data): void
    {
        $this->validate($data, AUTH_VALIDATION_SCHEMA);
    }

    public function login($data): void
    {
        $this->validate($data, AUTH_VALIDATION_SCHEMA);
    }

    public function logout($id): void
    {
        $this->validate(['id' => $id], ID_VALIDATION_SCHEMA);
    }
}