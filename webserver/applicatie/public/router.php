<?php

// Verdeelt HTTP requests naar de juiste PHP-views.

declare(strict_types=1);

require_once 'config/bootstrap.php';

/*
`$_SERVER['REQUEST_URI']` is de volledige URL die binnenkomt op de webserver bij het request, vanaf het pad.
Dus bij 'http://localhost/pad/naar/pagina?naam=Piet' is het `'/pad/naar/pagina?naam=Piet'`.
Met `parse_url` zoals hieronder aangeroepen pak je alleen het pad-gedeelte.
Dus dan wordt het `'/pad/naar/pagina'`.
*/
$urlPad = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
if ($urlPad === '' || $urlPad === '/') {
  require_once 'src/views/index.php';
} else {
  /*
  Er is geen pagina opgevraagd in het HTTP-request.
  Ga ervan uit dat een bestand (zoals een stylesheet) is opgevraagd.
  */
  $isBestand = preg_match(
  /*
  Als het pad eindigt met `.css` of één van de andere door `|` gescheiden bestandsnaamextensies,
  is een geldig bestandstype opgevraagd.
  */
      '/\.(?:css|png|jpg|jpeg|svg|woff|woff2|ttf|otf|html|mp4|webm|ogm|ogv|ogg|mp3)$/',
      $urlPad
  );
  if ($isBestand) {
    /*
    Geef PHP het signaal dat geen pagina maar een bestand opgevraagd is.
    PHP stuurt dan het bestand op naar de client.
    */
    return false;
  } else {
    // Het is een bekende pagina noch een geldig bestandstype.
    http_response_code(404);
    require_once 'src/views/404.php';
  }
}
