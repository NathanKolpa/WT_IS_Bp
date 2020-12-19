<?php

declare(strict_types=1);

namespace fletnix\views\formTestGet;

use Exception;

$content = '';
if (isset($_GET['test_get']) && !empty($_GET['test_get'])) {
  $content = $_GET['test_get'];
} else {
  throw new Exception('Formulier niet goed ingevuld. ');
}
$content = htmlspecialchars($content);
?>
<!DOCTYPE html>
<html lang="nl">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Fletnix: form verwerkt</title>
  </head>
  <body>
    <article>
      <h1><code>GET</code></h1>
      <p>Dag <?=$content?>!</p>
    </article>
  </body>
</html>
