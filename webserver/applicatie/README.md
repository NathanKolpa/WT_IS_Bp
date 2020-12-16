# Broncode van Fletnix

Standaard is de broncode als volgt gestructureerd:

```text
├── config
│   ├── bootstrap.php
│   └── db.php
├── public
│   └── index.php
└── src
    ├── bin
    │   └── herstel_db.php
    ├── data
    │   ├── db_herstellen.php
    │   ├── db_lezen.php
    │   └── db_verbinden.php
    ├── utils
    │   └── fouten_afhandelen.php
    └── views
        ├── 404.php
        ├── index.php
        ├── over.php
        └── test_db.php
```

De bestanden onder `config/` en `src/{bin,data,utils}` hoef je niet aan te passen.
Liever niet zelfs.
Die onderdelen zijn voorgegeven als startpunt/*scaffold*.
Alleen `src/data/db_lezen.php` is daar een uitzondering op.
Daar zit nu alleen een voorbeeldquery in.

Op `public/index.php` onthaal je de bezoekers.
In de `switch`-`case` moet je alle URLs als geval toevoegen, en bij iedere URL de juiste pagina terugsturen.
Onder meer het geval voor de URL `/` (dus de homepage) is al uitgewerkt.
De pagina’s werk je uit onder `src/views/`.
Onder `public/` zet je ook je vaste bestanden (ook wel _static assets_ genoemd).
Denk daarbij aan je stylesheets, plaatjes, etc.
Houd je daarbij aan een goede mappenstructuur, zoals je leerde bij WTUX.
