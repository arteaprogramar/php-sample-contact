<?php

namespace app\infrastructure;

use Exception;
use PDO;

class DatabaseConnection {

    public static ?DatabaseConnection $instance = null;
    private PDO $connection;

    public function __construct() {
        try {
            $param = require __DIR__ . '/../../config/database.php';
            $dsn = "{$param['driver']}:host={$param['host']};port={$param['port']};dbname={$param['dbname']}";

            $this -> connection = new PDO($dsn, $param['user'], $param['password']);
            $this -> connection -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (Exception $exception) {
            print_r("<b>Error al conectar a la base de datos </b> : {$exception->getMessage()}<br>");
        }
    }

    /**
     * Singleton
     * @return PDO
     */
    public static function getInstance(): PDO {
        if (self::$instance === null) {
            self::$instance = new DatabaseConnection();
        }
        return self::$instance->connection;
    }

}