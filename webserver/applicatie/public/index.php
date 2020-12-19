<?php

declare(strict_types=1);

namespace fletnix\index;

require_once 'config/bootstrap.php';
require_once 'config/db.php';

/*
`$_SERVER['REQUEST_URI']` is de volledige URL die binnenkomt op de webserver bij het request, vanaf het pad.
Dus bij 'http://localhost/pad/naar/pagina?naam=Piet' is het `'/pad/naar/pagina?naam=Piet'`.
Met `parse_url` zoals hieronder aangeroepen pak je alleen het pad-gedeelte.
Dus dan wordt het `'/pad/naar/pagina'`.
*/
$urlPad = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

switch ($urlPad) {
  case '/':
  case '':
    require_once 'src/views/index.php';
        break;
  case '/over':
    require_once 'src/views/over.php';
        break;
  case '/test_db':
    require_once 'src/views/test_db.php';
        break;
  case '/verwerk_form_get':
    require_once 'src/views/form_test_get.php';
        break;
  case '/verwerk_form_post':
    require_once 'src/views/form_test_post.php';
        break;
  default:
    /*
    Er is geen pagina opgevraagd in het HTTP-request.
    Ga ervan uit dat een bestand (zoals een stylesheet) is opgevraagd.
    */
    $isBestand = preg_match(
      /*
      Als het pad eindigt met `.css` of één van de andere door `|` gescheiden bestandsnaamextensies, is een geldig bestandstype opgevraagd.
      */
        '/\.(?:css|png|jpg|jpeg|svg|woff|woff2|ttf|otf|html)$/',
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
        break;
}
