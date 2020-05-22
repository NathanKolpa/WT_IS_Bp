<?php

declare(strict_types = 1);

namespace fletnix\data;

use fletnix\config\Db;
use PDO;

require_once __DIR__ . '/../../config/bootstrap.php';
require_once ROOT_DIR . '/src/data/db_verbinden.php';

function leesDb()
{
    $buffer = "<h1>Vendors</h1>";
    $query = "SELECT TOP (100) [Name] FROM Purchasing.Vendor ORDER BY [Name];";
    try {
        $verbinding = verbindDb(Db::DATABASE);
        $pdostatement = $verbinding->prepare($query);
        $pdostatement->execute();
        while ($rij = $pdostatement->fetch(PDO::FETCH_LAZY)) {
            $buffer .= $rij['Name'];
            $buffer .= "<br/>";
        }
        $pdostatement = null;
    } catch (Exception $fout) {
        error_log(__FILE__ . ":" . __LINE__ . ": " . json_encode($fout) . "\n");
    }
    return $buffer;
}
