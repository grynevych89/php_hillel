<?php

trait Validator
{
    private ?array $errors = null;

    public function validate(array $data, array $schema): void
    {
        foreach ($schema as $field => $rules) {
            if (!isset($data[$field])) {
                if (str_contains($rules, 'required')) {
                    $this->errors[$field]['required'] = "Поле $field є обов'язковим!";
                }
                continue;
            }

            $rules = explode('|', $rules);
            foreach ($rules as $rule) {
                if (str_contains($rule, ':')) {
                    list($rule, $parameter) = explode(':', $rule);
                } else {
                    $parameter = null;
                }

                if (method_exists($this, $rule)) {
                    try {
                        $this->$rule($data[$field], $parameter);
                    } catch (Exception $error) {
                        $this->errors[$field][$rule] = $error->getMessage();
                    }
                } else {
                    $this->errors[$field][$rule] = "Недійсне правило перевірки!";
                }
            }
        }
        $this->checkErrors();
    }

    public function string($value): void
    {
        if (gettype($value) !== 'string') {
            throw new Exception("Тип цього поля має бути рядком");
        }
    }

    public function int($value): void
    {
        if (gettype($value) !== 'integer') {
            throw new Exception("Тип цього поля має бути цілим числом");
        }
    }

    public function email(string $value): void
    {
        if (!filter_var($value, FILTER_VALIDATE_EMAIL)) {
            throw new Exception("Недійсний формат електронної пошти");
        }
    }

    public function min(string $value, string $min): void
    {
        if (strlen($value) < (int)$min) {
            throw new Exception("Значення має містити принаймні " . $min . " символів");
        }
    }

    public function max(string $value, string $max): void
    {
        if (strlen($value) > (int)$max) {
            throw new Exception("Значення не повинно перевищувати ". $max );
        }
    }

    public function required($value): void
    {
        if (empty($value)) {
            throw new Exception("Потрібно вказати значення");
        }
    }

    public function password($password): void
    {
        if (!preg_match(
            "/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/",
            $password
        )) {
            throw new Exception(
                "Пароль повинен містити принаймні одну велику літеру, 
                одну малу літеру, одну цифру, один спеціальний символ 
                і містити принаймні 8 символів"
            );
        }
    }

    public function checkErrors(): void
    {
        if ($this->errors) {
            $message = 'ValidationError:' . PHP_EOL;
            foreach ($this->errors as $field => $rules) {
                $message .= "$field: ";

                foreach ($rules as $rule => $msg) {
                    $message .= "$msg | ";
                }
                $message = rtrim($message, " |") . ';' . PHP_EOL;
            }
            throw new Exception($message);
        }
    }
}