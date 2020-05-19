<?php

declare (strict_types = 1);

namespace fletnix\data;

use PDO;

use fletnix\config\Db;

require_once ROOT_DIR . '/config/db.php';

error_reporting(E_ALL);

function verbindDb(string $databaseNaam)
{
    try
    {
        $verbinding = new PDO("sqlsrv:server=" . Db::HOST . "; Database=$databaseNaam", Db::LOGIN, Db::PASSWORD);
        $verbinding->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (Exception $fout) {
        error_log(__FILE__ . ":" . __LINE__ . ": " . json_encode($fout) . "\n");
    }
    return $verbinding;
}
