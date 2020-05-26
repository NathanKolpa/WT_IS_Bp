<?php

declare (strict_types = 1);

namespace fletnix\data;

use fletnix\config\Db;
use function fletnix\data\printPdoError;
use PDO;
use PDOException;

require_once __DIR__ . '/../../config/bootstrap.php';
require_once ROOT_DIR . '/src/data/db_verbinden.php';

function leesDb()
{
    $buffer = "<h1>Vendors</h1>";
    $query = "SELECT TOP (100) [Name] FROM Purchasing.Vendor ORDER BY [Name];";
    $password = rtrim(file_get_contents('/run/secrets/password_rdbms_app', true));
    if (!$password) {
        throw new RuntimeException("Kon SA's wachtwoord (SQL Server) niet uitlezen. ");
    }
    try {
        $verbinding = verbindDb(Db::DATABASE, Db::LOGIN, $password);
    } finally {
        unset($password);
    }
    $pdostatement = $verbinding->prepare($query);
    try {
        if (!$pdostatement->execute()) {
            printPdoError($pdostatement);
            throw new RuntimeException("Uitvoering PDO-statement mislukt. ", 0);
        }
    } catch (PDOException $fout) {
        printPdoError($pdostatement);
        throw new RuntimeException("Kon PDO-statement niet uitvoeren. ", 0, $fout);
    }
    while ($rij = $pdostatement->fetch(PDO::FETCH_LAZY)) {
        $buffer .= $rij['Name'];
        $buffer .= "<br/>";
    }
    unset($pdostatement);
    return $buffer;
}
