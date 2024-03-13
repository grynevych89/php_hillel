<?php

class MySQLQueryBuilder implements SQLQueryBuilder
{
    private stdClass $query;


    private function reset(): void
    {
        $this->query = new stdClass();
    }

    /**
     * @throws Exception
     */
    public function insert(
        string       $table,
        array|string $fields,
        array|string $values
    ): SQLQueryBuilder
    {
        $this->reset();
        $fieldType = gettype($fields);
        validateFieldsAndValues($fields, $values);
        $fields = $fieldType === 'string'
            ? $fields
            : implode(', ', $fields);
        $values = isScalarValueValid($values)
            ? "('$values')"
            : createQueryValues($values, $fieldType);
        $this->query->base = "INSERT INTO $table($fields) VALUES $values";
        $this->query->type = 'insert';

        return $this;
    }

    public function select(string $table, array|string $fields): SQLQueryBuilder
    {
        $this->reset();
        $fields = $fields === '*' ? $fields : implode(', ', $fields);
        $this->query->base = "SELECT " . $fields . " FROM $table";
        $this->query->type = 'select';

        return $this;
    }

    public function update(string $table, array $values): MySQLQueryBuilder
    {
        $this->reset();
        $values = implode(
            ', ',
            array_map(
                'createUpdateQueryString',
                array_keys($values),
                array_values($values)
            )
        );

        $this->query->base = "UPDATE " . $table . " SET $values";
        $this->query->type = 'update';

        return $this;
    }

    /**
     * @throws Exception
     */
    public function join(
        string  $currentTable,
        string  $currentTableQueryParam,
        string  $secondaryTable,
        string  $secondaryTableQueryParam,
        ?string $joinType = 'LEFT'
    ): MySQLQueryBuilder
    {
        if ($this->query->type !== 'select') {
            throw new Exception('WHERE can only be added to SELECT');
        }

        $primaryParam = "$currentTable.$currentTableQueryParam";
        $secondaryParam = "$secondaryTable.$secondaryTableQueryParam";

        $this->query->join[] =
            " $joinType JOIN $secondaryTable ON $primaryParam = $secondaryParam";

        return $this;
    }

    /**
     * @throws Exception
     */
    public function where(
        string     $field,
        string|int $value,
        string     $operator = '='
    ): SQLQueryBuilder
    {
        if (!in_array($this->query->type, ['select', 'update', 'delete'])) {
            throw new Exception('WHERE can only be added to SELECT, UPDATE or DELETE');
        }

        $this->query->where[] = str_replace('_', '.', $field) . " $operator :$field";
        $this->query->values[$field] = $value;
        return $this;
    }

    /**
     * @throws Exception
     */
    public function limit(int $start, ?int $offset = null): SQLQueryBuilder
    {
        if ($this->query->type !== 'select') {
            throw new Exception('LIMIT ca only be added to SELECT');
        }

        $limit = " LIMIT $start";
        if (isset($offset)) {
            $limit .= ", $offset";
        }

        $this->query->limit = $limit;
        return $this;
    }

    public function getSQL(): string
    {
        $query = $this->query;
        $sql = $query->base;

        if (!empty($query->join)) {
            $sql .= implode("", $query->join);
        }

        if (!empty($query->where)) {
            $sql .= " WHERE " . implode(" AND ", $query->where);
        }

        if (isset($query->limit)) {
            $sql .= $query->limit;
        }

        return $sql . ';';
    }


    public function getValues(): array
    {
        if (!isset($this->query->values)) {
            return [];
        }

        return $this->query->values;
    }
}