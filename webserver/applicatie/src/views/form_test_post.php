<?php

declare(strict_types=1);

namespace fletnix\views\formTestPost;

use Exception;

$content = '';
if (isset($_POST['test_post']) && !empty($_POST['test_post'])) {
  $content = $_POST['test_post'];
} else {
  echo $_POST;
  //throw new Exception("Formulier niet goed ingevuld. ");
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
      <h1><code>POST</code></h1>
      <p>Dag <?=$content?>!</p>
    </article>
  </body>
</html>
