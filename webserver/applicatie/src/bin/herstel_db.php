#!/usr/bin/php
<?php

declare(strict_types = 1);

use function fletnix\data\herstelDb;

if ($argc != 1) {
    ?>

Dit is een command line PHP-script dat de AdventureWorks database herstelt.

Usage:
    php ./<?php echo $argv[0]; ?>


<?php
} else {
        require_once __DIR__ . '/../../config/bootstrap.php';
        require_once ROOT_DIR . '/src/data/db_herstellen.php';
    
        fletnix\data\herstelDb();
    }
?>