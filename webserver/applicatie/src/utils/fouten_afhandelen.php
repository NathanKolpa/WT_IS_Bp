<?php

declare(strict_types=1);

function errorHandler(int $foutNummer, string $foutBericht, string $bestandsnaam, int $regel)
{
  error_log("Fout #[$foutNummer] ontstaan in [$bestandsnaam] op regel [$regel]: [$foutBericht]");
  throw new ErrorException($foutBericht, 0, $foutNummer, $bestandsnaam, $regel);
}

function exceptionHandler(Throwable $fout)
{
  $backtrace = $fout->getTrace();
  // Verwijder argumenten, want die kunnen gevoelige info bevatten. (infosec)
  foreach ($backtrace as &$entry) {
    foreach ($entry as $key => $value) {
      if ($key === 'args') {
        $value = null;
        $entry[$key] = null;
      }
    }
  }
  $foutString = json_encode(['message' => $fout->getMessage(), 'file' => $fout->getFile(),
    'line' => $fout->getLine()], JSON_INVALID_UTF8_SUBSTITUTE | JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT);
  $backtraceString = json_encode($backtrace, JSON_INVALID_UTF8_SUBSTITUTE | JSON_UNESCAPED_SLASHES |
    JSON_PRETTY_PRINT);
  error_log("\nFout: " . $foutString . " \nOorzaakketen (op volgorde van eind naar begin): " . $backtraceString);
  http_response_code(500);
  header('Content-type: text/plain;charset=utf-8');
  echo 'Er is helaas een fatale fout opgetreden.';
}
