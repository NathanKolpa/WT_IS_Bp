<?php

declare(strict_types=1);

namespace fletnix\index;

require_once 'config/bootstrap.php';
require_once 'config/db.php';

switch ($_SERVER['REQUEST_URI']) {
  case '/':
    require_once 'src/views/index.php';
        break;
  case '':
    require_once 'src/views/index.php';
        break;
  case '/over':
    require_once 'src/views/over.php';
        break;
  case '/test_db':
    require_once 'src/views/test_db.php';
        break;
  default:
    http_response_code(404);
    require_once 'src/views/404.php';
        break;
}
