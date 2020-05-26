<?php

declare (strict_types = 1);

namespace fletnix\data;

use PDOStatement;

function printPdoError(PDOStatement $pdostatement)
{
    error_log(
        json_encode($pdostatement->debugDumpParams(), JSON_INVALID_UTF8_SUBSTITUTE | JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT) . "\n" .
        json_encode($pdostatement->errorInfo(), JSON_INVALID_UTF8_SUBSTITUTE | JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT));
}
