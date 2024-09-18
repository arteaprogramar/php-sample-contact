<?php

return [
    'driver' => getenv('DB_CONNECTION') ?: 'pgsql',
    'host' => getenv('DB_HOST') ?: '127.0.0.1',
    'port' => getenv('DB_PORT') ?: '5432',
    'dbname' => getenv('DB_DATABASE') ?: 'mi_base_de_datos',
    'user' => getenv('DB_USERNAME') ?: 'usuario',
    'password' => getenv('DB_PASSWORD') ?: 'contraseña'
];