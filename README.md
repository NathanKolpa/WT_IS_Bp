<!-- omit in toc -->
# WTIS - Beroepsproduct

- [Inleiding](#inleiding)
  - [Legenda](#legenda)
- [Stappenplan voor de start](#stappenplan-voor-de-start)
  - [0. Vereisten](#0-vereisten)
    - [Docker Desktop](#docker-desktop)
      - [Problemen oplossen onder Windows](#problemen-oplossen-onder-windows)
        - [Te oude computer](#te-oude-computer)
        - [WSL 2](#wsl-2)
        - [Detailinstructies over virtualisatie](#detailinstructies-over-virtualisatie)
      - [Hoe Docker instellen?](#hoe-docker-instellen)
  - [1. GitHub - Haal een kopie van dit project binnen](#1-github---haal-een-kopie-van-dit-project-binnen)
  - [2. VS Code - Installeer de EditorConfig-extensie](#2-vs-code---installeer-de-editorconfig-extensie)
  - [3. VS Code - Maak de secrets aan](#3-vs-code---maak-de-secrets-aan)
  - [4. VS Code - Open een nieuw venster voor SQL Server 🛢️](#4-vs-code---open-een-nieuw-venster-voor-sql-server-️)
  - [5. VS Code - Open de folder `rdbms` in het venster voor SQL Server 🛢️](#5-vs-code---open-de-folder-rdbms-in-het-venster-voor-sql-server-️)
  - [6. VS Code - Installeer de benodigde extensies](#6-vs-code---installeer-de-benodigde-extensies)
  - [7. VS Code - Activeer de dev container voor SQL Server 🛢️](#7-vs-code---activeer-de-dev-container-voor-sql-server-️)
    - [Bijzonderheden bij Windows](#bijzonderheden-bij-windows)
      - [Sta Docker netwerkverkeer toe (Windows Firewall)](#sta-docker-netwerkverkeer-toe-windows-firewall)
      - [Geef de dev container toegang tot bestanden (Docker Desktop)](#geef-de-dev-container-toegang-tot-bestanden-docker-desktop)
  - [8. VS Code - Open een nieuw venster voor PHP 📦](#8-vs-code---open-een-nieuw-venster-voor-php-)
  - [9. VS Code - Open de folder `webserver` in het venster voor PHP 📦](#9-vs-code---open-de-folder-webserver-in-het-venster-voor-php-)
  - [10. VS Code - Activeer de dev container voor PHP 📦](#10-vs-code---activeer-de-dev-container-voor-php-)
  - [11. Browser - Bezoek de website](#11-browser---bezoek-de-website)
- [🧑‍🏫 Stappenplan voor doorontwikkeling](#-stappenplan-voor-doorontwikkeling)
  - [1. VS Code - Open de workspace in een nieuw venster](#1-vs-code---open-de-workspace-in-een-nieuw-venster)
  - [2. VS Code - Installeer de benodigde extensies](#2-vs-code---installeer-de-benodigde-extensies)
- [Vraag en antwoord](#vraag-en-antwoord)
  - [Hoe kan ik de database vullen?](#hoe-kan-ik-de-database-vullen)
    - [1. Browser - Download de databasebackup (eenmalig)](#1-browser---download-de-databasebackup-eenmalig)
    - [2. Herhaal het _stappenplan voor start_](#2-herhaal-het-stappenplan-voor-start)
    - [3. VS Code - Start de task _Herstel de Fletnix-database_ in de dev container voor PHP 📦](#3-vs-code---start-de-task-herstel-de-fletnix-database-in-de-dev-container-voor-php-)
  - [Kan ik SQL Server ook nog buiten Docker om draaien (op de Docker host)?](#kan-ik-sql-server-ook-nog-buiten-docker-om-draaien-op-de-docker-host)
  - [Kan ik ook verbinding maken met de RDBMS vanuit Azure Data Studio of SSMS buiten Docker om?](#kan-ik-ook-verbinding-maken-met-de-rdbms-vanuit-azure-data-studio-of-ssms-buiten-docker-om)
  - [Kan ik de poort waarop de RDBMS luistert op de Docker host veranderen?](#kan-ik-de-poort-waarop-de-rdbms-luistert-op-de-docker-host-veranderen)
  - [Hoe kan ik dingen uitproberen en uitzoeken aan de database buiten PHP om?](#hoe-kan-ik-dingen-uitproberen-en-uitzoeken-aan-de-database-buiten-php-om)
  - [Hoe bekijk ik de logboeken van de containers?](#hoe-bekijk-ik-de-logboeken-van-de-containers)
  - [🧑‍🏫 Hoe kan ik versiebeheer met Git gebruiken?](#-hoe-kan-ik-versiebeheer-met-git-gebruiken)
- [Ontwerp](#ontwerp)

- 🧑‍🏫 **Ontwikkel je mee aan dit project**?
Zie de [workflow en richtlijnen](/.github/CONTRIBUTING.md).
- 👩‍🎓 **Ben je student**?
Houd je uitwerking van het beroepsproduct strikt privé!
Gebruik zelf geen GitHub.
Als je zelf toch GitHub gebruikt moet je zeker weten dat je uitwerking helemaal afgeschermd is.

---

## Inleiding

Dit is een template voor de uitwerking van het beroepsproduct, een website gebaseerd op PHP en SQL Server.
Dit project gaat uit van [Visual Studio (VS) Code](https://code.visualstudio.com/docs/getstarted/userinterface).

### Legenda

🧑‍🏫: alleen voor gevorderden.

## Stappenplan voor de start

Het is belangrijk dat je deze stappen **exact in deze volgorde en volledig** uitvoert om te kunnen beginnen met programmeren.

Voor een beginner zou dit eenmalig tien minuten kunnen duren.
Vervolgens, als je alles weg zou gooien, maar met ervaring, twee minuten.

### 0. Vereisten

- Zorg gedurende dit hele proces voor een werkende, snelle en betrouwbare internetverbinding.
Hapert je internet ergens, dan kan je soms de pech hebben dat je vreemde foutmeldingen krijgt.
- Installeer [VS Code](https://code.visualstudio.com/).
- Installeer Docker van Docker Inc.
Dit project is getest met de variant [Docker Desktop](https://www.docker.com/products/docker-desktop).

#### Docker Desktop

##### Problemen oplossen onder Windows

###### Te oude computer

Heb je een te oude computer, dan kan je dit dialoogvenster krijgen:

![Docker Desktop - An error occurred - Hardware assisted virtualization ….](img/Docker_An_error_occurred_Hardware_assisted_virtualization.png)

*Fig. 1: Docker Desktop - An error occurred - Hardware assisted virtualization ….*

###### WSL 2

Je kan een dialoogvenster met een waarschuwing krijgen, zodra je Docker geïnstalleerd hebt.

> Please click the link and follow the instructions to install the kernel update: …

Installeer de kernel update zoals gevraagd.
Herstart je computer.

![Docker Desktop - Install WSL 2 kernel update](img/Waarschuwing_WSL_2.png)

*Fig. 2: Docker Desktop - Install WSL 2 kernel update.*

###### Detailinstructies over virtualisatie

Mocht je nog steeds problemen hebben tijdens of direct na de installatie van Docker Desktop, bestudeer dan de instructies van Docker Inc. onder het kopje [*Virtualization*](https://docs.docker.com/docker-for-windows/troubleshoot/#virtualization-must-be-enabled), alleen die onder de subkopjes *‘VIRTUALIZATION MUST BE ENABLED’* en *‘WSL 2 AND WINDOWS HOME’*.

##### Hoe Docker instellen?

Zorg onder [*Settings* - *Resources*](https://docs.docker.com/docker-for-windows/#resources) voor de volgende instellingen:

- Stel niet minder in dan de standaardwaarde aan RAM-geheugen: 2 GiB.
- Houd verder rekening met ca. 5 GiB aan benodigde opslagruimte.

### 1. GitHub - Haal een kopie van dit project binnen

Download dit project als een ZIP-archief.
Zie [_Cloning a repository using the command line_](https://help.github.com/en/github/creating-cloning-and-archiving-repositories/cloning-a-repository#cloning-a-repository-using-the-command-line), alleen stap 3.

### 2. VS Code - Installeer de EditorConfig-extensie

Doordat iedereen een verschillend besturingssysteem gebruikt kunnen er problemen met het opslaan van bestanden ontstaan.
EditorConfig is een standaard die bepaalt hoe bestanden moeten worden opgeslagen.

Installeer de [EditorConfig-extensie](https://marketplace.visualstudio.com/items?itemName=EditorConfig.EditorConfig) in VS Code.
Klik daarvoor op de groene knop ‘Install’ bovenaan de webpagina.

### 3. VS Code - Maak de secrets aan

Secrets, zoals database-wachtwoorden, worden in dit template veilig gebruikt.
Om dat mogelijk te maken is wel een handeling van jou vereist.

1. Maak in de hoofdmap van het project twee bestanden aan met VS Code:
    - `password_rdbms_app.txt` (*wachtwoord van `applicatie`-gebruiker*)
    - `password_rdbms_superuser.txt` (*wachtwoord van SA*)
2. Vul beide bestanden met [veilige wachtwoorden](https://docs.microsoft.com/nl-nl/sql/relational-databases/security/password-policy?view=sql-server-ver15).
⚠️ Als het wachtwoord niet voldoet aan deze vereisten zal de RDBMS niet starten en krijg je vreemde problemen.
3. Eindig beide bestanden met een witregel.

### 4. VS Code - Open een nieuw venster voor SQL Server 🛢️

Via de menubalk bovenaan: _File_ > _New Window_.

N.B.: Dit venster is en blijft specifiek om te ontwikkelen aan of te werken met SQL Server.

### 5. VS Code - Open de folder `rdbms` in het venster voor SQL Server 🛢️

Via de menubalk bovenaan: _File_ > _Open..._ (macOS) of _Open Folder_ (Windows).
Selecteer de map `rdbms`, dus niet een bestand erbinnen.

📙 Als het goed is ziet dit nieuwe venster er oranjebruin uit.

### 6. VS Code - Installeer de benodigde extensies

Op een gegeven moment krijg je mogelijk de vraag of je de door deze workspace aanbevolen extensies wilt installeren.

![This workspace has extension recommendations.](img/This_workspace_has_extension_recommendations.png)

*Fig. 3: This workspace has extension recommendations.*

Reageer in dat geval met _Install All_.

### 7. VS Code - Activeer de dev container voor SQL Server 🛢️

Op een gegeven moment krijg je de vraag of je de dev container binnen deze map wilt activeren.

![Folder containers a dev container configuration file.](img/Folder_contains_a_dev_configuration_file_Reopen_folder_to_develop_in_a_container.png)

*Fig. 4: Folder contains a dev container configuration file.*

Reageer met _Reopen in Container_.

Wacht rustig af tot VS Code in de blauwe balk onderaan geen activiteit meer vertoont.
Dit kan de eerste keer tot ca. vijf minuten duren, afhankelijk van hoe snel je internetverbinding en computer is.

#### Bijzonderheden bij Windows

Als je Windows gebruikt, kan je een aantal dialoogvensters krijgen.

##### Sta Docker netwerkverkeer toe (Windows Firewall)

Bij de vraag of je Docker netwerkverkeer wilt toestaan,

![Windows Defender has blocked some features of this app](img/Windows_Security_Alert.png)

*Fig. 5: Windows Defender has blocked some features of this app*

kies _Allow access_.

De suggestie dat Docker op publieke netwerken actief zou mogen worden komt door [een bekende beperking in Docker](https://github.com/docker/for-win/issues/367).

##### Geef de dev container toegang tot bestanden (Docker Desktop)

Bij de vraag of je de dev container toegang wilt geven tot bestanden,

![Docker Desktop - Filesharing](img/Docker_Desktop_-_Filesharing.png)

*Fig. 6: Docker Desktop - Filesharing*

kies telkens _Share it_.
Doe dit onmiddellijk, want als je te lang wacht kan het stappenplan mis gaan.

### 8. VS Code - Open een nieuw venster voor PHP 📦

Via de menubalk bovenaan: _File_ > _New Window_.

### 9. VS Code - Open de folder `webserver` in het venster voor PHP 📦

Via de menubalk bovenaan: _File_ > _Open..._ (macOS) of _Open Folder_ (Windows).
Selecteer de map `webserver`, dus niet een bestand erbinnen.

📗 Als het goed is ziet dit nieuwe venster er groen uit.

### 10. VS Code - Activeer de dev container voor PHP 📦

(Deze instructies zijn gelijk aan de vorige stap genaamd _VS Code: activeer de dev container ..._.)

### 11. Browser - Bezoek [de website](http://127.0.0.1/over)

Deze pagina werkt.
Sommige andere pagina's, die RDBMS gebruiken, mogelijk niet.
Daarvoor moet je eerst de stappen [Hoe kan ik de database vullen?](#hoe-kan-ik-de-database-vullen) uitvoeren.

## 🧑‍🏫 Stappenplan voor doorontwikkeling

Volg eerst het [stappenplan voor de start](#stappenplan-voor-de-start).
Volg vervolgens deze extra stappen.

### 1. VS Code - Open de workspace in een nieuw venster

Open het bestand [`/webapplicatie.code-workspace`](/webapplicatie.code-workspace) als workspace (in een nieuw venster).
Zie: [_Opening workspace files_](https://code.visualstudio.com/docs/editor/multi-root-workspaces#_opening-workspace-files).

### 2. VS Code - Installeer de benodigde extensies

Op een gegeven moment krijg je mogelijk de vraag of je de door deze workspace aanbevolen extensies wilt installeren.

![This workspace has extension recommendations](img/This_workspace_has_extension_recommendations.png)

*Fig. 7: This workspace has extension recommendations.*

Reageer in dat geval met _Install All_.

Zie verder [Hoe kan ik versiebeheer met Git gebruiken?](#hoe-kan-ik-versiebeheer-met-git-gebruiken).

## Vraag en antwoord

### Hoe kan ik de database vullen?

Getest is het herstellen van een `.bak`-bestand met een dump van de Fletnix-database.
Besef dat de database weer weg is als je alle Docker-containers weggooit (in ieder geval die van `rdbms`).
Dat kan al gebeuren als je Docker Desktop upgradet of reset.
Zorg ervoor dat al je wijzigingen/vulling van de database te herstellen is met een eigen PHP-script.
Werk niet met het invoeren van losse SQL-statements.
Dan is je werk niet goed reproduceerbaar!

#### 1. Browser - Download de databasebackup (eenmalig)

Download de [Fletnix-databasebackup vanaf GitHub](https://github.com/hanaim-webtech/webtech-is-env/releases/download/Fletnix/FLETNIX.bak.zip) naar de map [`rdbms/`](/rdbms).
Pak het bestand daar uit, en stel vast dat de naam inderdaad `FLETNIX.bak` is.

#### 2. Herhaal het _stappenplan voor start_

Sluit VS Code helemaal af, en herhaal het stappenplan.

(N.B.: Alleen zodra je gevorderd bent in het omgaan met VS Code en dev containers kan je zelf een kortere weg bedenken.)

#### 3. VS Code - Start de task _Herstel de Fletnix-database_ in de dev container voor PHP 📦

Zorg ervoor dat je in het venster voor PHP bezig bent.

Kies Menubalk > _Terminal_ > _Run Task…_.

![Menubalk > _Terminal_ > _Run Task…_.](img/Menu_Terminal_Run_Task.png)

*Fig. 8: Menubalk > _Terminal_ > _Run Task…_.*

Kies vervolgens _Herstel de Fletnix-database_.

### Kan ik SQL Server ook nog buiten Docker om draaien (op de Docker host)?

Ja, maar dit kan vreemde effecten geven als je op de Docker host zelf, buiten VS Code om, met bijv.
SQL Server Management Studio probeert te verbinden met de RDBMS-container.
Zie [`rdbms/docker-compose.yml`](rdbms/docker-compose.yml).
Het is meestal verstandig om alle overige SQL Server instanties te stoppen tijdens je werk aan dit project.

### Kan ik ook verbinding maken met de RDBMS vanuit Azure Data Studio of SSMS buiten Docker om?

Ja.
Gebruik als ‘Hostname’ `localhost,1433`.
Kies ‘SQL login’ als authenticatiemethode.

### Kan ik de poort waarop de RDBMS luistert op de Docker host veranderen?

Ja, maar dat is meestal onverstandig.
Zie het antwoord op de voorgaande vraag.
Je kan dit doen door de sleutel `published` te veranderen in [`rdbms/docker-compose.yml`](rdbms/docker-compose.yml).

### Hoe kan ik dingen uitproberen en uitzoeken aan de database buiten PHP om?

In de dev container [SQL Server 2019](/rdbms/) staat de [SQL Server-extensie voor VS Code](https://docs.microsoft.com/en-us/sql/visual-studio-code/sql-server-develop-use-vscode?view=sql-server-ver15) standaard geïnstalleerd.

Ook kan je [SQL Server Management Studio (SSMS)](https://docs.microsoft.com/en-us/sql/ssms/download-sql-server-management-studio-ssms?view=sql-server-ver15) gebruiken.

### Hoe bekijk ik de logboeken van de containers?

De logboeken van SQL Server en de PHP webserver zijn in te zien via Docker. Alleen het workspace-venster is daarvoor op dit moment speciaal uitgerust.

Kies de linker zijbalk > Docker-logo > _Containers_ > rechtsklik - _View Logs_.

![Kies de linker zijbalk > Docker-logo > Containers > rechtsklik - View Logs.](img/Docker-logboeken.png)

*Fig. 9: Kies de linker zijbalk > Docker-logo > Containers > rechtsklik - View Logs.*

### 🧑‍🏫 Hoe kan ik versiebeheer met Git gebruiken?

Alleen het workspace-venster is daarvoor op dit moment speciaal uitgerust (mits je zelf Git al op je computer hebt geïnstalleerd).
Ontwikkelen doe je dus in de dev containers oftewel de specifieke vensters, en Git-acties verrichten kan je tegelijkertijd vanuit het workspace-venster.

## Ontwerp

Dit template gebruikt [de ingebouwde webserver van PHP](https://www.php.net/manual/en/features.commandline.webserver.php), omdat dat (1) voor een minder ingewikkelde opzet zorgt en (2) voldoende is voor deze onderwijsopdracht.
