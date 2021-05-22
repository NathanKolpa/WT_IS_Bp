# Broncode van Fletnix

Standaard is de broncode als volgt gestructureerd:

```text
.
├── README.md
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
Onder `public/` zet je ook je vaste bestanden (ook wel _static assets_ genoemd).
Denk daarbij aan je stylesheets, plaatjes, etc.
Houd je daarbij aan een goede mappenstructuur, zoals je leerde bij WTUX.
