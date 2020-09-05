<?php

declare(strict_types = 1);

namespace fletnix\data;

use fletnix\config\Db;
use PDO;

require_once __DIR__ . '/../../config/bootstrap.php';
require_once ROOT_DIR . '/src/data/db_verbinden.php';

function leesDb()
{
    $buffer = "<h1>Movies</h1>";
    $query = "SELECT TOP (100) * FROM Movie WHERE [title] LIKE '%pink panther%' ORDER BY [publication_year];";
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
    if (!$pdostatement->execute()) {
        throw new RuntimeException("Uitvoering PDO-statement mislukt. ", 0);
    }
    while ($rij = $pdostatement->fetch(PDO::FETCH_LAZY)) {
        $buffer .= htmlentities($rij['publication_year']);
        $buffer .= ' - ';
        $buffer .= htmlentities($rij['title']);
        $buffer .= "<br/>";
    }
    unset($pdostatement);
    return $buffer;
}
