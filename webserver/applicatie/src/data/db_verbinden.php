<?php

declare (strict_types = 1);

namespace fletnix\data;

use fletnix\config\Db;
use PDO;
use PDOException;
use RuntimeException;

require_once ROOT_DIR . '/config/db.php';

function verbindDb(string $databaseNaam, string $login, string $password)
{
    try
    {
        $verbinding = new PDO("sqlsrv:server=" . Db::HOST . "; Database=$databaseNaam", $login, $password);
        $verbinding->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (PDOException $fout) {
        throw new RuntimeException("Kon geen verbinding maken met RDBMS. ", 0, $fout);
    } finally {
        unset($password);
    }
    return $verbinding;
}
