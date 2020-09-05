<?php

declare(strict_types = 1);

namespace fletnix\data;

use fletnix\config\Db;
use PDO;
use RuntimeException;

require_once ROOT_DIR . '/config/db.php';

function verbindDb(string $databaseNaam, string $login, string $password)
{
    $verbinding = new PDO("sqlsrv:server=" . Db::HOST . "; Database=$databaseNaam", $login, $password);
    $verbinding->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    unset($password);
    return $verbinding;
}
