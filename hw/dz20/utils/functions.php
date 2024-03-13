<?php

function isFieldValid($field): bool
{
    return gettype($field) === 'string';
}

function isScalarValueValid($value): bool
{
    return gettype($value) === 'string'
        || gettype($value) === "integer"
        || gettype($value) === "double";
}

function createValue(string|int|float $value): string|int|float
{
    if (gettype($value) === 'string') {
        return "'" . $value . "'";
    }
    return $value;
}

function mapValues(array $values): string
{
    return '(' . implode(', ', array_map('createValue', $values)) . ')';
}

function createQueryValues(array $values, string $fieldType): string
{
    if (is_array($values[0]) || ($fieldType === 'string' && !is_array($values[0]))) {
        return '(' . implode(', ', array_map('mapValues', $values)) . ')';
    }

    return mapValues($values);
}


/**
 * @throws Exception
 */
function validateFieldsAndValues(array|string $fields, array|string $values): void
{
    if (gettype($fields) === 'string' && !is_array($fields)) {
        throw new Exception(
            'Тип аргументу $fields має бути рядком або масивом'
        );
    }

    if (is_array($fields) && is_array($values)) {
        if (is_array($values[0])) {
            foreach ($values as $innerValues) {
                if (count($fields) !== count($innerValues)) {
                    throw new Exception(
                        'Кількість значень аргументу $fields має збігатися з кількістю внутрішніх значень аргументу $values'
                    );
                }
            }
        }

        if (count($fields) !== count($values)) {
            throw new Exception(
                'Кількість значень аргументу $fields має збігатися з кількістю значень аргументу $values'
            );
        }

        for ($i = 0; $i < count($fields); $i++) {
            if (!isFieldValid($fields[$i]) || !isScalarValueValid($values[$i])) {
                throw new Exception(
                    'Тип кожного значення $fields має бути рядком, тип кожного значення $values має бути рядком, int або float'
                );
            }
        }
    }
}

function createUpdateQueryString(string $key, string|int|float $value): string|int|float {
    return "$key = " . (gettype($value) === 'string' ? "'$value'" : $value);
}

function createJoinQueryString(string $key, string|int|float $value): string|int|float {
    return "$key = " . (gettype($value) === 'string' ? "'$value'" : $value);
}