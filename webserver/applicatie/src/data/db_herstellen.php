<?php

declare (strict_types = 1);

namespace fletnix\data;

require_once __DIR__ . '/../../config/bootstrap.php';
require_once ROOT_DIR . '/src/data/db_verbinden.php';

function herstelDb()
{
    try
    {
        $verbinding = verbindDb('master');
        $query = "SET NOCOUNT ON;
            RESTORE DATABASE [AdventureWorks]
            FROM DISK = N'/srv/rdbms/AdventureWorks2017.bak'
            WITH MOVE 'AdventureWorks2017'
            TO '/var/opt/mssql/data/AdventureWorks2017.mdf',
            MOVE 'AdventureWorks2017_log'
            TO '/var/opt/mssql/data/AdventureWorks2017.ldf', REPLACE, RECOVERY, STATS = 10;";
        $pdostatement = $verbinding->prepare($query);
        if (!$pdostatement->execute()) {
            error_log(__FILE__ . ":" . __LINE__ . ": " . json_encode($pdostatement->errorInfo()) . "\n");
            throw Exception("Kon PDO Statement niet uitvoeren. ");
        }
        while ($pdostatement->nextRowset()) {
            error_log(__FILE__ . ":" . __LINE__ . ": Status: " . json_encode($pdostatement->errorInfo()) . "\n");
        }
        $pdostatement = null;
    } catch (Exception $fout) {
        error_log(__FILE__ . ":" . __LINE__ . ": " . json_encode($fout) . "\n");
    }
}
