<?php

declare (strict_types = 1);

namespace fletnix\views\test_db;
use function fletnix\data\leesDb;

require_once ROOT_DIR . '/src/data/db_lezen.php';

error_reporting(E_ALL);

?>
<!doctype html>
<html lang="nl">

<head>
    <title>Fletnix</title>
</head>

<body>
    <article>
        <?php
        echo leesDb();
        ?>
    </article>
</body>

</html>
