<?php

declare(strict_types=1);

namespace fletnix\data;

use fletnix\config\Db;
use RuntimeException;

require_once 'src/data/db_verbinden.php';

function herstelDb(string $passwordRdbmsSuperuser)
{
  try {
    $verbinding = verbindDb('master', 'sa', $passwordRdbmsSuperuser);
  } finally {
    unset($passwordRdbmsSuperuser);
  }
  // TODO: Hardcode geen namen van logins, databases etc. Dit is nu helaas nodig omdat SQL Server driver voor PDO
  // onvoldoende variabelen accepteert.
  $query = 'DROP DATABASE IF EXISTS [FLETNIX], [' . Db::DATABASE . "];
    SET NOCOUNT ON;
    RESTORE DATABASE [FLETNIX]
    FROM DISK = N'/srv/rdbms/FLETNIX.bak'
    WITH MOVE 'FLETNIX'
    TO '/var/opt/mssql/data/FLETNIX.mdf',
    MOVE 'FLETNIX_log'
    TO '/var/opt/mssql/data/FLETNIX.ldf', REPLACE, RECOVERY, STATS = 10;
    ALTER DATABASE [FLETNIX] SET AUTO_UPDATE_STATISTICS_ASYNC OFF
    ALTER DATABASE [FLETNIX] SET SINGLE_USER WITH ROLLBACK IMMEDIATE;
    ALTER DATABASE [FLETNIX] MODIFY NAME = [" . Db::DATABASE . '];';
  $pdostatement = $verbinding->prepare($query);
  if (!$pdostatement->execute()) {
    throw new RuntimeException('Uitvoering PDO-statement mislukt. ', 0);
  }
  while ($pdostatement->nextRowset()) {
    error_log(json_encode($pdostatement->errorInfo(), JSON_INVALID_UTF8_SUBSTITUTE | JSON_UNESCAPED_SLASHES
    | JSON_PRETTY_PRINT));
  }
  unset($pdostatement);
  $passwordRdbmsApp = rtrim(file_get_contents('/run/secrets/password_rdbms_app', true));
  if (!$passwordRdbmsApp) {
    throw new RuntimeException('Kon app-wachtwoord (SQL Server) niet uitlezen. ');
  }
  $queryVoeggebruikertoe = 'USE [' . Db::DATABASE . '];
    CREATE LOGIN ' . Db::LOGIN . ' WITH PASSWORD = ' . $verbinding->quote($passwordRdbmsApp) . ';
    CREATE USER ' . Db::LOGIN . ';
    ALTER ROLE db_datareader ADD MEMBER ' . Db::LOGIN . ';
    ALTER ROLE db_datawriter ADD MEMBER ' . Db::LOGIN . ';
    ALTER DATABASE [' . Db::DATABASE . '] SET MULTI_USER;';
  unset($passwordRdbmsApp);
  $pdostatementVoeggebruikertoe = $verbinding->prepare($queryVoeggebruikertoe);
  if (!$pdostatementVoeggebruikertoe->execute()) {
    unset($queryVoeggebruikertoe);
    throw new RuntimeException('Uitvoering PDO-statement mislukt. ');
  }
}
