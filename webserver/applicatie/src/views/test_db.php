<?php

declare(strict_types=1);

namespace fletnix\views\test_db;

use function fletnix\data\leesDb;

require_once 'src/data/db_lezen.php';

$data = leesDb();
?>
<!DOCTYPE html>
<html lang="nl">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Fletnix</title>
  </head>
  <body>
    <main>
    <?=$data?>
    </main>
  </body>
</html>
