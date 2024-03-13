<?php

class Repository
{
    protected static string $table = '';

    protected static string $primaryKey = 'id';

    public function __construct(
        protected PDO             $connector,
        protected SQLQueryBuilder $builder
    )
    {
    }

    /**
     * @throws Exception
     */
    public function findById(int|string $id, array|string $fields = '*'): false|object
    {
        if (empty(static::$table)) {
            throw new Exception('Table is empty');
        }

        $sql = $this->builder->select(static::$table, $fields)
            ->where(static::$primaryKey, $id)
            ->getSQL();
        $connector = $this->connector;
        $stmt = $connector->prepare($sql);
        $stmt->execute($this->builder->getValues());

        return $stmt->fetch(PDO::FETCH_OBJ);
    }

    /**
     * @throws Exception
     */
    public function find(array|string $fields = '*'): false|array
    {
        if (empty(static::$table)) {
            throw new Exception('Table is empty');
        }

        $sql = $this->builder->select(static::$table, $fields)
            ->getSQL();
        $connector = $this->connector;
        $stmt = $connector->prepare($sql);
        $stmt->execute($this->builder->getValues());

        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }

    /**
     * @throws Exception
     */
    public function insert(array|string $fields, array|string $values): false|object
    {
        if (empty(static::$table)) {
            throw new Exception('Table is empty');
        }

        $sql = $this->builder->insert(static::$table, $fields, $values)
            ->getSQL();
        $connector = $this->connector;
        $stmt = $connector->prepare($sql);
        $stmt->execute($this->builder->getValues());

        return $stmt->fetch(PDO::FETCH_OBJ);
    }

    /**
     * @throws Exception
     */
    public function update(int $id, array $values)
    {
        if (empty(static::$table)) {
            throw new Exception('Table is empty');
        }

        $sql = $this->builder->update(static::$table, $values)
            ->where(static::$primaryKey, $id, 'LIKE')
            ->getSQL();
        $connector = $this->connector;
        $stmt = $connector->prepare($sql);
        $stmt->execute($this->builder->getValues());

        return $stmt->fetch(PDO::FETCH_OBJ);
    }


}