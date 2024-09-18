<?php

namespace app\infrastructure;

class BaseModel {

    protected \PDO $connection;

    public function __construct(){
        $this -> connection = DatabaseConnection::getInstance();
    }

    protected function query(string $sql, array $params = []) : array|bool {
        $query = $this -> connection -> prepare($sql);
        $query -> execute($params);
        return (stripos($sql, 'select') === 0) ? $query -> fetchAll(\PDO::FETCH_ASSOC) : $query -> rowCount() > 0;
    }

}