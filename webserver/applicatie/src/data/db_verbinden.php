<?php

declare(strict_types = 1);

namespace fletnix\data;

use fletnix\config\Db;

require_once ROOT_DIR . '/config/db.php';

error_reporting(E_ALL);

function verbindDb(string $databaseName)
{
    try {
        sqlsrv_configure("LogSeverity", SQLSRV_LOG_SEVERITY_ALL);
        sqlsrv_configure("LogSubsystems", SQLSRV_LOG_SYSTEM_CONN | SQLSRV_LOG_SYSTEM_STMT);
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
        error_log("Fout: " . json_encode($error) . "\n");
    }
    return $connection;
}
