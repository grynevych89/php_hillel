<?php

trait Validator
{
    private ?array $errors = null;

    public function validate(array $data, array $schema)
    {
        foreach ($schema as $field => $rules) {
            if (!isset($data[$field])) {
                if (str_contains($rules, 'required')) {
                    $this->errors[$field]['required'] = "Field $field is required!";
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
                    $this->errors[$field][$rule] = "Invalid validation rule!";
                }
            }
        }
        $this->checkErrors();
    }

    public function string($value)
    {
        if (gettype($value) !== 'string') {
            throw new Exception("The type of this field must be a string");
        }
    }

    public function int($value)
    {
        if (gettype($value) !== 'integer') {
            throw new Exception("The type of this field must be a integer");
        }
    }

    public function email(string $value): void
    {
        if (!filter_var($value, FILTER_VALIDATE_EMAIL)) {
            throw new Exception("Invalid email format");
        }
    }

    public function min(string $value, string $min): void
    {
        if (strlen($value) < (int)$min) {
            throw new Exception("Value must be at least " . $min . " characters long");
        }
    }

    public function max(string $value, string $max)
    {
        if (strlen($value) > (int)$max) {
            throw new Exception("Value must not exceed " . $max . " characters");
        }
    }

    public function required($value)
    {
        if (empty($value)) {
            throw new Exception("Value is required");
        }
    }

    public function password($password)
    {
        if (!preg_match(
            "/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/",
            $password
        )) {
            throw new Exception(
                "Password must contain at least one uppercase letter, one lowercase "
                . "letter, one digit, one special character, and be at least 8 characters long"
            );
        }
    }

    public function checkErrors(): void
    {
        if ($this->errors) {
            $message = "<div class='error'><b>ValidationError:</b>";
            foreach ($this->errors as $field => $rules) {
                $message .= "<i>$field: ";

                foreach ($rules as $rule => $msg) {
                    $message .= "$msg";
                }
                $message = rtrim($message) . ';</i>';
            }
            throw new Exception($message . "</div>");
        }
    }
}