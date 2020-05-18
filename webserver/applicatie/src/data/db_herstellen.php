<?php

declare(strict_types = 1);

namespace fletnix\data;

require_once __DIR__ . '/../../config/bootstrap.php';
require_once ROOT_DIR . '/src/data/db_verbinden.php';

error_reporting(E_ALL);

function herstelDb()
{
    try {
        $connection = verbindDb("master");
        $tsql = "SET NOCOUNT ON;
        RESTORE DATABASE [AdventureWorks]
        FROM DISK = N'/srv/rdbms/AdventureWorks2017.bak'
        WITH MOVE 'AdventureWorks2017'
        TO '/var/opt/mssql/data/AdventureWorks2017.mdf',
        MOVE 'AdventureWorks2017_log'
        TO '/var/opt/mssql/data/AdventureWorks2017.ldf', REPLACE, RECOVERY, STATS = 10;";
        sqlsrv_configure("WarningsReturnAsErrors", false);
        // TODO: check specific error status
        $response = sqlsrv_query($connection, $tsql);
        if (!$response) {
            error_log(__FILE__ . ":" . __LINE__ . ": " . json_encode(sqlsrv_errors()) . "\n");
            if (sqlsrv_errors(SQLSRV_ERR_ERRORS)) {
                error_log("Fatal.\n");
                return false;
            }
        }
        error_log("Database is being restored ...\n");
        while ($nextResult = sqlsrv_next_result($response)) {
            $errors = sqlsrv_errors();
            if ($errors) {
                error_log(__FILE__ . ":" . __LINE__ . ": " . json_encode($errors) . "\n");
                if (sqlsrv_errors(SQLSRV_ERR_ERRORS)) {
                    error_log("Fatal.\n");
                    return false;
                }
            }
            error_log("Next result: " . $nextResult . "\n");
        }
        sqlsrv_configure("WarningsReturnAsErrors", true);
        sqlsrv_free_stmt($response);
        sqlsrv_close($connection);
    } catch (Exception $error) {
        error_log("Error: " . json_encode($error) . "\n");
        return false;
    }
    return true;
}
