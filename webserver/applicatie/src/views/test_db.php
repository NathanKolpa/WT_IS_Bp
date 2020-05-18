<?php

declare(strict_types = 1);

namespace fletnix\views\test_db;

require_once ROOT_DIR . '/src/data/db_verbinden.php';

use function fletnix\data\verbindDb;

error_reporting(E_ALL);

function leesDb()
{
    $buffer = "<h1>Vendors</h1>";
    try {
        $connection = verbindDb("AdventureWorks");
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
echo leesDb();
?>
    </article>
</body>

</html>
