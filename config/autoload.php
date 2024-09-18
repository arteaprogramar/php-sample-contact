<?php

spl_autoload_register(function ($class) {
    // Reemplazar el namespace por la estructura de directorios
    $classPath = str_replace('\\', DIRECTORY_SEPARATOR, $class);

    // Definir el path base de las clases en app
    $file = __DIR__ . '/../' . $classPath . '.php';

    // Verificar si el archivo existe y cargarlo
    if (file_exists($file)) {
        require_once $file;
    } else {
        echo "No se pudo cargar la clase: $class";
    }
});