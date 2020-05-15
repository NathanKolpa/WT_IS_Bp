<?php

declare (strict_types = 1);

namespace fletnix\index;

use fletnix\config\Db;

require ROOT_DIR . '/config/db.php';

error_reporting(E_ALL);

sqlsrv_configure("LogSeverity", SQLSRV_LOG_SEVERITY_ALL);
sqlsrv_configure("LogSubsystems", SQLSRV_LOG_SYSTEM_CONN | SQLSRV_LOG_SYSTEM_STMT);

function openConnection(string $databaseName)
{
    try {
        $connectionOptions = array(
            'CharacterSet' => 'UTF-8',
            "Database" => $databaseName,
            "Uid" => Db::rdbmsLogin, "PWD" => Db::rdbmsPassword,
        );
        $connection = sqlsrv_connect(Db::rdbmsHost, $connectionOptions);
        if (!$connection) {
            die(json_encode(sqlsrv_errors()));
        }
    } catch (Exception $error) {
        error_log("Error: " . json_encode($error) . "\n");
    }
    return $connection;
}

function restoreDb()
{
    try {
        $connection = openConnection("master");
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

function readData()
{
    $buffer = "<h1>Vendors</h1>";
    try {
        $connection = openConnection("AdventureWorks");
        $tsql = "SELECT TOP (100) [Name] FROM Purchasing.Vendor ORDER BY [Name];";
        $getProducts = sqlsrv_query($connection, $tsql);
        if (!$getProducts) {
            error_log(__FILE__ . ":" . __LINE__ . ": " . json_encode(sqlsrv_errors()) . "\n");
            return false;
        }
        $productCount = 0;
        $buffer = "<h1>Vendors</h1>";
        while ($row = sqlsrv_fetch_array($getProducts, SQLSRV_FETCH_ASSOC)) {
            $errors = sqlsrv_errors();
            if ($errors) {
                error_log(__FILE__ . ":" . __LINE__ . ": " . json_encode($errors) . "\n");
                if (sqlsrv_errors(SQLSRV_ERR_ERRORS)) {
                    error_log("Fatal.\n");
                    return false;
                }
            }
            $buffer .= $row['Name'];
            $buffer .= "<br/>";
            $productCount++;
        }
        sqlsrv_free_stmt($getProducts);
        sqlsrv_close($connection);
    } catch (Exception $error) {
        error_log(__FILE__ . ":" . __LINE__ . ": " . json_encode($error) . "\n");
        return false;
    }
    return $buffer;
}
?>
<!doctype html>
<html lang="nl">

<head>
    <title>Fletnix</title>
</head>

<body>
    <article>
        <?php
// phpinfo();
// TODO: use restoreDb from CLI only.
if (restoreDb()) {
    echo (readData());
}
?>
    </article>
</body>

</html>
