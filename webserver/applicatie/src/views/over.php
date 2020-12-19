<?php

declare(strict_types=1);

namespace fletnix\views\over;

?>
<!DOCTYPE html>
<html lang="nl">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="/css/stylesheet.css">
    <title>Fletnix</title>
  </head>
  <body>
    <article>
      <h1>Over Fletnix</h1>
      <p>Druk op Enter om te versturen.</p>
      <h2>GET</h2>
      <form action="/verwerk_form_get" id="form_test_get">
        <label for="test_get">Naam:</label>
        <input name="test_get" id="test_get">
      </form>
      <h2>POST</h2>
      <form action="/verwerk_form_post" id="form_test_post" method="post">
        <label for="test_post">Naam:</label>
        <input name="test_post" id="test_post">
      </form>
    </article>
  </body>
</html>
