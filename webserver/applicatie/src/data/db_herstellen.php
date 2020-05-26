<?php

declare (strict_types = 1);

namespace fletnix\data;

use fletnix\config\Db;
use function fletnix\data\printPdoError;
use PDOException;
use RuntimeException;

require_once __DIR__ . '/../../config/bootstrap.php';
require_once ROOT_DIR . '/src/data/db_verbinden.php';

function herstelDb(string $passwordRdbmsSuperuser)
{
    try {
        $verbinding = verbindDb('master', 'sa', $passwordRdbmsSuperuser);
    } finally {
        unset($passwordRdbmsSuperuser);
    }
    // TODO: Hardcode geen namen van logins, databases etc. Dit is nu helaas nodig omdat SQL Server driver voor PDO onvoldoende variabelen accepteert.
    $query = "DROP DATABASE IF EXISTS [AdventureWorks], [" . Db::DATABASE . "];
        SET NOCOUNT ON;
        RESTORE DATABASE [AdventureWorks]
        FROM DISK = N'/srv/rdbms/AdventureWorks2017.bak'
        WITH MOVE 'AdventureWorks2017'
        TO '/var/opt/mssql/data/AdventureWorks2017.mdf',
        MOVE 'AdventureWorks2017_log'
        TO '/var/opt/mssql/data/AdventureWorks2017.ldf', REPLACE, RECOVERY, STATS = 10;
        ALTER DATABASE [AdventureWorks] SET AUTO_UPDATE_STATISTICS_ASYNC OFF
        ALTER DATABASE [AdventureWorks] SET SINGLE_USER WITH ROLLBACK IMMEDIATE;
        ALTER DATABASE [AdventureWorks] MODIFY NAME = [" . Db::DATABASE . "];";
    try {
        $pdostatement = $verbinding->prepare($query);
        if (!$pdostatement->execute()) {
            printPdoError($pdostatement);
            throw new RuntimeException("Uitvoering PDO-statement mislukt. ", 0);
        }
    } catch (PDOException $fout) {
        printPdoError($pdostatement);
        throw new RuntimeException("Kon PDO-statement niet uitvoeren. ", 0, $fout);
    }
    while ($pdostatement->nextRowset()) {
        error_log(json_encode($pdostatement->errorInfo(), JSON_INVALID_UTF8_SUBSTITUTE | JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT));
    }
    unset($pdostatement);
    $passwordRdbmsApp = rtrim(file_get_contents('/run/secrets/password_rdbms_app', true));
    if (!$passwordRdbmsApp) {
        throw new RuntimeException("Kon app-wachtwoord (SQL Server) niet uitlezen. ");
    }
    $queryVoeggebruikertoe = "USE [" . Db::DATABASE . "];
        CREATE LOGIN " . Db::LOGIN . " WITH PASSWORD = " . $verbinding->quote($passwordRdbmsApp) . ";
        CREATE USER " . Db::LOGIN . ";
        ALTER ROLE db_datareader ADD MEMBER " . Db::LOGIN . ";
        ALTER ROLE db_datawriter ADD MEMBER " . Db::LOGIN . ";
        ALTER DATABASE [" . Db::DATABASE . "] SET MULTI_USER;";
    unset($passwordRdbmsApp);
    try {
        $pdostatementVoeggebruikertoe = $verbinding->prepare($queryVoeggebruikertoe);
        if (!$pdostatementVoeggebruikertoe->execute()) {
            unset($queryVoeggebruikertoe);
            printPdoError($pdostatement);
            throw new RuntimeException("Uitvoering PDO-statement mislukt. ");
        }
    } catch (PDOException $fout) {
        printPdoError($pdostatement);
        throw new RuntimeException("Kon PDO-statement niet uitvoeren. ", 0, $fout);
    } finally {
        unset($queryVoeggebruikertoe);
    }
}
