<?php

$route = $_GET['route'] ?? 'home';

switch ($route) {

    case 'home':
        require_once __DIR__ . '/../app/view/index.php';
        break;

    case 'sync' :
        require_once __DIR__ . '/../app/view/sync.php';
        break;

    case 'session_remove' :
        require_once __DIR__ . '/../app/view/session_remove.php';
        break;

    default:
        echo "404 - Página no encontrada";
        break;

}