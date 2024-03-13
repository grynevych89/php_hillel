<?php

interface SQLQueryBuilder
{
    public function insert(string $table, array|string $fields, array|string $values): SQLQueryBuilder;

    public function select(string $table, array|string $fields): SQLQueryBuilder;

    public function where(string $field, string $value, string $operator = '='): SQLQueryBuilder;

    public function limit(int $start, ?int $offset = null): SQLQueryBuilder;

    public function getSQL(): string;
}