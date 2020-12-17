#!/usr/bin/php
<?php

declare(strict_types=1);

use function fletnix\data\herstelDb;

if ($argc != 1) {
  ?>

  Dit is een command line PHP-script dat de database herstelt.
  Het ontvangt het wachtwoord van de SA voor de SQL Server RDBMS via standard input.

  Aanroep:
  php ./<?php echo $argv[0]; ?>


  <?php
} else {
  require_once 'config/bootstrap.php';
  require_once 'src/data/db_herstellen.php';
  $passwordRdbmsSuperuser = rtrim(file_get_contents('php://stdin'));
  if (!$passwordRdbmsSuperuser) {
    throw new RuntimeException('Kon wachtwoord niet uitlezen. ');
  }
  try {
    herstelDb($passwordRdbmsSuperuser);
  } finally {
    unset($passwordRdbmsSuperuser);
  }
}
