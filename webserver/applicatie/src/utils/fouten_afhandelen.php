<?php

declare(strict_types = 1);

namespace fletnix\utils;

use Throwable;

function errorHandler(int $foutNummer, string $foutBericht, string $bestandsnaam, int $regel)
{
    error_log("Fout #[$foutNummer] ontstaan in [$bestandsnaam] op regel [$regel]: [$foutBericht]");
}

function exceptionHandler(Throwable $fout)
{
    $backtrace = $fout->getTrace();
    // Verwijder argumenten, want die kunnen gevoelige info bevatten. (infosec)
    foreach ($backtrace as &$entry) {
        foreach ($entry as $key => $value) {
            if ($key == "args") {
                $value = null;
                $entry[$key] = null;
            }
        }
    }
    error_log("\nFout (op volgorde van eind naar begin): " .
        json_encode($backtrace, JSON_INVALID_UTF8_SUBSTITUTE | JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT));
    error_log($fout->getMessage());
    http_response_code(500);
    header('Content-type: text/plain;charset=utf-8');
    echo "Er is helaas een fatale fout opgetreden.";
}

set_error_handler('\fletnix\utils\errorHandler');
set_exception_handler('\fletnix\utils\exceptionHandler');
