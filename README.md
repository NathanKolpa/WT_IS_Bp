# Web Technology: Implementation & Security - Beroepsproduct

- [Web Technology: Implementation & Security - Beroepsproduct](#web-technology-implementation--security---beroepsproduct)
  - [Inleiding](#inleiding)
    - [Legenda](#legenda)
  - [Stappenplan voor de start](#stappenplan-voor-de-start)
    - [0. Vereisten](#0-vereisten)
    - [1. GitHub: Haal een kopie van dit project binnen](#1-github-haal-een-kopie-van-dit-project-binnen)
    - [2: VS Code: maak de secrets aan](#2-vs-code-maak-de-secrets-aan)
    - [3. VS Code: open een nieuw venster voor SQL Server 🛢️](#3-vs-code-open-een-nieuw-venster-voor-sql-server-️)
    - [4. VS Code: open de folder `rdbms` in het venster voor SQL Server 🛢️](#4-vs-code-open-de-folder-rdbms-in-het-venster-voor-sql-server-️)
    - [5. VS Code: installeer de benodigde extensies](#5-vs-code-installeer-de-benodigde-extensies)
    - [6. VS Code: activeer de dev container voor SQL Server 🛢️](#6-vs-code-activeer-de-dev-container-voor-sql-server-️)
      - [Bijzonderheden bij Windows](#bijzonderheden-bij-windows)
        - [Sta Docker netwerkverkeer toe (Windows Firewall)](#sta-docker-netwerkverkeer-toe-windows-firewall)
        - [Geef de dev container toegang tot bestanden (Docker Desktop)](#geef-de-dev-container-toegang-tot-bestanden-docker-desktop)
    - [7. VS Code: open een nieuw venster voor PHP 📦](#7-vs-code-open-een-nieuw-venster-voor-php-)
    - [8. VS Code: open de folder `webserver` in het venster voor PHP 📦](#8-vs-code-open-de-folder-webserver-in-het-venster-voor-php-)
    - [9. VS Code: activeer de dev container voor PHP 📦](#9-vs-code-activeer-de-dev-container-voor-php-)
    - [10. Browser: bezoek nu de website](#10-browser-bezoek-nu-de-website)
  - [🧑‍🏫 Stappenplan voor doorontwikkeling](#-stappenplan-voor-doorontwikkeling)
    - [1. VS Code: open de workspace in een nieuw venster](#1-vs-code-open-de-workspace-in-een-nieuw-venster)
    - [2. VS Code: installeer de benodigde extensies](#2-vs-code-installeer-de-benodigde-extensies)
  - [Vraag en antwoord](#vraag-en-antwoord)
    - [Hoe kan ik de database vullen?](#hoe-kan-ik-de-database-vullen)
    - [1. Browser: download de databasebackup (eenmalig)](#1-browser-download-de-databasebackup-eenmalig)
    - [2. Herhaal het _stappenplan voor start_](#2-herhaal-het-stappenplan-voor-start)
    - [3. VS Code: start de task _Herstel de Fletnix-database_ in de dev container voor PHP 📦](#3-vs-code-start-de-task-herstel-de-fletnix-database-in-de-dev-container-voor-php-)
    - [Hoe kan ik dingen uitproberen en uitzoeken aan de database buiten PHP om?](#hoe-kan-ik-dingen-uitproberen-en-uitzoeken-aan-de-database-buiten-php-om)
    - [Hoe bekijk ik de logboeken van de containers?](#hoe-bekijk-ik-de-logboeken-van-de-containers)
    - [🧑‍🏫 Hoe kan ik versiebeheer met Git gebruiken?](#-hoe-kan-ik-versiebeheer-met-git-gebruiken)
  - [Ontwerp](#ontwerp)

🧑‍🏫 **Ontwikkel je mee aan dit project**? Zie de [workflow en richtlijnen](/.github/CONTRIBUTING.md).

## Inleiding

Dit is een template voor de uitwerking van het beroepsproduct, een website gebaseerd op PHP en SQL Server. Dit project gaat uit van [Visual Studio (VS) Code](https://code.visualstudio.com/docs/getstarted/userinterface).

### Legenda

🧑‍🏫: alleen voor gevorderden.

## Stappenplan voor de start

Het is belangrijk dat je deze stappen exact in deze volgorde uitvoert om te kunnen beginnen met programmeren.

Voor een beginner zou dit eenmalig tien minuten kunnen duren. Vervolgens, als je alles weg zou gooien, maar met ervaring, twee minuten.

### 0. Vereisten

-   Installeer [VS Code](https://code.visualstudio.com/).
-   Installeer Docker. Dit project is getest met de variant [Docker Desktop](https://www.docker.com/products/docker-desktop).
    -   Stel niet minder dan de standaardwaarde aan RAM-geheugen in: 2 GiB.
    -   Houd verder rekening met ca. 5 GiB aan benodigde opslagruimte.

### 1. GitHub: Haal een kopie van dit project binnen

Clone dit project via [deze link](vscode://vscode.git/clone?url=https%3A%2F%2Fgithub.com%2FHANICA%2FWT_IS_Bp). Je wordt gevraagd om een map te kiezen waarin je het project wilt bewaren.

Alternatief kan je dit project als een ZIP-archief downloaden. Zie [_Cloning a repository using the command line_](https://help.github.com/en/github/creating-cloning-and-archiving-repositories/cloning-a-repository#cloning-a-repository-using-the-command-line), alleen stap 3.

### 2: VS Code: maak de secrets aan

> Secrets, zoals database-wachtwoorden, worden in dit template veilig gebruikt. Om dat mogelijk te maken is wel een handeling van jou vereist.

1. Maak in de hoofdmap van het project twee bestanden aan met VS Code:
    - `password_rdbms_app.txt`
    - `password_rdbms_superuser.txt`
1. Vul beide bestanden met [veilige wachtwoorden](https://docs.microsoft.com/nl-nl/sql/relational-databases/security/password-policy?view=sql-server-ver15).
1. Eindig beide bestanden met een witregel.

### 3. VS Code: open een nieuw venster voor SQL Server 🛢️

Via de menubalk bovenaan: _File_ > _New Window_.

N.B.: Dit venster is en blijft specifiek om te ontwikkelen aan of te werken met SQL Server.

### 4. VS Code: open de folder `rdbms` in het venster voor SQL Server 🛢️

Via de menubalk bovenaan: _File_ > _Open..._ (macOS) of _Open Folder_ (Windows).
Selecteer de map `rdbms`, dus niet een bestand erbinnen.

📙 Als het goed is ziet dit nieuwe venster er oranjebruin uit.

### 5. VS Code: installeer de benodigde extensies

Op een gegeven moment krijg je mogelijk

![de vraag of je de door deze workspace aanbevolen extensies wilt installeren.](img/This_workspace_has_extension_recommendations.png)

Reageer in dat geval met _Install All_.

### 6. VS Code: activeer de dev container voor SQL Server 🛢️

Op een gegeven moment krijg je

![de vraag of je de dev container binnen deze map wilt activeren.](img/Folder_contains_a_dev_configuration_file_Reopen_folder_to_develop_in_a_container.png)

Reageer met _Reopen in Container_.

Wacht rustig af tot VS Code in de blauwe balk onderaan geen activiteit meer vertoont. Dit kan de eerste keer tot ca. vijf minuten duren, afhankelijk van hoe snel je internetverbinding en computer is.

#### Bijzonderheden bij Windows

Als je Windows gebruikt, kan je een aantal dialoogvensters krijgen.

##### Sta Docker netwerkverkeer toe (Windows Firewall)

![de vraag of je Docker netwerkverkeer wilt toestaan.](img/Windows_Security_Alert.png)
Kies _Allow access_.

De suggestie dat Docker op publieke netwerken actief zou mogen worden komt door [een bekende beperking in Docker](https://github.com/docker/for-win/issues/367).

##### Geef de dev container toegang tot bestanden (Docker Desktop)

![de vraag of je de dev container toegang wilt geven tot bestanden.](img/Docker_Desktop_-_Filesharing.png)
Kies telkens _Share it_. Doe dit onmiddellijk, want als je te lang wacht kan het stappenplan mis gaan.

### 7. VS Code: open een nieuw venster voor PHP 📦

Via de menubalk bovenaan: _File_ > _New Window_.

### 8. VS Code: open de folder `webserver` in het venster voor PHP 📦

Via de menubalk bovenaan: _File_ > _Open..._ (macOS) of _Open Folder_ (Windows).
Selecteer de map `webserver`, dus niet een bestand erbinnen.

📗 Als het goed is ziet dit nieuwe venster er groen uit.

### 9. VS Code: activeer de dev container voor PHP 📦

(Deze instructies zijn gelijk aan de vorige stap genaamd _VS Code: activeer de dev container ..._.)

### 10. Browser: bezoek nu [de website](http://127.0.0.1/over)

Deze pagina werkt. Sommige andere pagina's, die RDBMS gebruiken, mogelijk niet. Daarvoor moet je eerst de stappen [Hoe kan ik de database vullen?](#hoe-kan-ik-de-database-vullen) uitvoeren.

## 🧑‍🏫 Stappenplan voor doorontwikkeling

Volg eerst het [stappenplan voor de start](#stappenplan-voor-de-start). Volg vervolgens deze extra stappen.

### 1. VS Code: open de workspace in een nieuw venster

Open het bestand [`/webapplicatie.code-workspace`](/webapplicatie.code-workspace) als workspace (in een nieuw venster).
Zie: [_Opening workspace files_](https://code.visualstudio.com/docs/editor/multi-root-workspaces#_opening-workspace-files).

### 2. VS Code: installeer de benodigde extensies

Op een gegeven moment krijg je mogelijk

![de vraag of je de door deze workspace aanbevolen extensies wilt installeren.](img/This_workspace_has_extension_recommendations.png)

Reageer in dat geval met _Install All_.

Zie verder [Hoe kan ik versiebeheer met Git gebruiken?](#hoe-kan-ik-versiebeheer-met-git-gebruiken).

## Vraag en antwoord

### Hoe kan ik de database vullen?

Getest is het herstellen van een `.bak`-bestand met een dump van de Fletnix-database.

### 1. Browser: download de databasebackup (eenmalig)

Download de [Fletnix-databasebackup vanaf GitHub](https://github.com/HANICA/WT_IS_Bp/releases/download/0.1.0/FLETNIX.bak.zip) naar de map [`rdbms/`](/rdbms). Pak het bestand daar uit, en stel vast dat de naam inderdaad `FLETNIX.bak` is.

### 2. Herhaal het _stappenplan voor start_

Sluit VS Code helemaal af, en herhaal het stappenplan.

(N.B.: Alleen zodra je gevorderd bent in het omgaan met VS Code en dev containers kan je zelf een kortere weg bedenken.)

### 3. VS Code: start de task _Herstel de Fletnix-database_ in de dev container voor PHP 📦

Zorg ervoor dat je in het venster voor PHP bezig bent.

Kies Menubalk > _Terminal_ > _Run Task..._.

![Menubalk > _Terminal_ > _Run Task..._.](img/Menu_Terminal_Run_Task.png)

Kies vervolgens _Herstel de Fletnix-database_.

![_Herstel de Fletnix-database_](img/Herstel_Fletnix_database.png)

### Hoe kan ik dingen uitproberen en uitzoeken aan de database buiten PHP om?

In de dev container [SQL Server 2019](/rdbms/) staat de [SQL Server-extensie voor VS Code](https://docs.microsoft.com/en-us/sql/visual-studio-code/sql-server-develop-use-vscode?view=sql-server-ver15) standaard geïnstalleerd.

Ook kan je [SQL Server Management Studio (SSMS)](https://docs.microsoft.com/en-us/sql/ssms/download-sql-server-management-studio-ssms?view=sql-server-ver15) gebruiken.

### Hoe bekijk ik de logboeken van de containers?

De logboeken van SQL Server en de PHP webserver zijn in te zien via Docker. Alleen het workspace-venster is daarvoor op dit moment speciaal uitgerust.

Kies de linker zijbalk > Docker-logo > _Containers_ > Rechtsklik - _View Logs_.

![Kies de linker zijbalk > Docker-logo > _Containers_ > Rechtsklik - _View Logs_.](img/Docker-logboeken.png)

### 🧑‍🏫 Hoe kan ik versiebeheer met Git gebruiken?

Alleen het workspace-venster is daarvoor op dit moment speciaal uitgerust (mits je zelf Git al op je computer hebt geïnstalleerd). Ontwikkelen doe je dus in de dev containers oftewel de specifieke vensters, en Git-acties verrichten kan je tegelijkertijd vanuit het workspace-venster.

## Ontwerp

Dit template gebruikt [de ingebouwde webserver van PHP](https://www.php.net/manual/en/features.commandline.webserver.php), omdat dat (1) voor een minder ingewikkelde opzet zorgt en (2) voldoende is voor deze onderwijsopdracht.
