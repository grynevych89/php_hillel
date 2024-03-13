<?php

class ProjectRepository extends Repository
{
    protected static string $table = 'projects';

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
                'user_id',
                'users',
                'id'
            )
            ->where(static::$table . '_' . static::$primaryKey, $id)
            ->getSQL();
        $connector = $this->connector;
        $stmt = $connector->prepare($sql);
        $stmt->execute($this->builder->getValues());

        return $stmt->fetch(PDO::FETCH_OBJ);
    }
}