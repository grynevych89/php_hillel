<?php

class UserRepository extends Repository
{
    protected static string $table = 'users';

    /**
     * @throws Exception
     */
    public function findOneWithPopulate(int|string $id, array|string $fields = '*'): false|object
    {
        if (empty(static::$table)) {
            throw new Exception('Table is empty');
        }

        $sql = $this->builder->select(static::$table, $fields)
            ->join(
                static::$table,
                'project_id',
                'projects',
                'id'
            )
            ->join(
                static::$table,
                'role_id',
                'roles',
                'id')
            ->where(static::$table . '_' . static::$primaryKey, $id)
            ->getSQL();
        $connector = $this->connector;
        $stmt = $connector->prepare($sql);
        $stmt->execute($this->builder->getValues());

        return $stmt->fetch(PDO::FETCH_OBJ);
    }
}