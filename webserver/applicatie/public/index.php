<?php

declare(strict_types = 1);

namespace fletnix\index;

require_once __DIR__ . '/../config/bootstrap.php';
require_once ROOT_DIR . '/config/db.php';

error_reporting(E_ALL);

$request = $_SERVER['REQUEST_URI'];

switch ($request) {
    case '/':
        include ROOT_DIR . '/src/views/index.php';
        break;
    case '':
        include ROOT_DIR . '/src/views/index.php';
        break;
    case '/over':
        require ROOT_DIR . '/src/views/over.php';
        break;
    case '/test_db':
        require ROOT_DIR . '/src/views/test_db.php';
        break;
    default:
        http_response_code(404);
        require ROOT_DIR . '/src/views/404.php';
        break;
}
