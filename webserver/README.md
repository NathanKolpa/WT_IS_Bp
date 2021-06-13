# Fletnix

Standaard is de broncode onder [`applicatie/`](applicatie/) zo gestructureerd:

```text
applicatie
├── config
│   ├── bootstrap.php
│   └── db.php
├── public
│   ├── css
│   │   └── stylesheet.css
│   └── router.php
└── src
    ├── utils
    │   └── fouten_afhandelen.php
    └── views
        ├── 404.php
        └── index.php
```

De bestanden onder `config/` en `src/utils` kan je beter niet aanpassen.
Die onderdelen zijn voorgegeven als startpunt/*scaffold*.

Op `public/router.php` onthaal je de bezoekers.
In de `if {...} else` moet je alle geldige paden van de URL die de bezoeker gebruikt als geval toevoegen, en bij ieder pad de juiste pagina terugsturen.
Onder meer het geval voor het pad `/` (dus de homepage) is al uitgewerkt.

De pagina’s werk je uit onder `src/views/`.
Hier komen dus PHP-bestanden voor elke HTML-pagina die hebt naast de al aangemaakte `index.php`, bijvoorbeeld `contact.php`.
Nu staat daar al een `index.php` in die PHP-ontwikkelinformatie toont.

Alle PHP-bestanden die niet direct een HTML-pagina vertegenwoordigen, zet je onder `src/` volgens jouw eigen indeling/structuur, maar laat je buiten `src/views/`, in ieder geval.
Op die manier houd je een onderscheid tussen wat direct pagina’s zijn en alle ondersteunende broncode.

Onder `public/` voeg je je ‘vaste bestanden’ toe (ook wel _static assets_ genoemd).
Denk daarbij aan je stylesheets, plaatjes, etc.
Houd je daarbij aan een goede mappenstructuur, zoals je leerde bij WTUX.

Dit template volgt de multi-tier-architectuur waarover je in de reader hebt gelezen.
Van de presentatielaag (`src/views/`) en een deel van de applicatielaag (`src/`) is al een startpunt gemaakt.

## Voorbeeld van uitwerking pagina

Je gaat naar `router.php`.

Wat er al staat mag je zo laten.
Zoek de regels met:

```php
if ($urlPad === '' || $urlPad === '/') {
  require_once 'src/views/index.php';
```

Dit betekent dat wanneer de bezoeker geen pad opgeeft (`http://localhost/`), de homepage (`index.php`) wordt ingeladen.

Pas de pagina aan.
Haal de aanroep van `phpinfo` weg.

Plak de HTML-broncode van je homepage (vanuit WTUX) achteraan het bestand, direct achter een regel met `?>`.

Zoek hyperlinks op in je HTML-broncode.
De volgende pagina heb je bijvoorbeeld vast:

```html
<a href="contact.html">Contact</a>
```

In de router moet je nog aangeven dat dit adres een geldige pagina is, en wat er op die pagina moet komen.

Voeg daarom in `router.php` de volgende regels in:

```php
  # ...
} else if ($urlPad === '/contact') {
  require_once 'src/views/contact.php';
} else {
  # ...
```

Blijf zo doorgaan met het toevoegen van alle pagina’s.

Tijdens de lessen en uit de reader leer je verder om je website uit te bouwen.
