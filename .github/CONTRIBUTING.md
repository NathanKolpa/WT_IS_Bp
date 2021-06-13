# Workflow en richtlijnen

## Workflow

## Team

[Sander Maijers](https://github.com/sanmai-NL) is de hoofdontwikkelaar, als onderdeel van het team van de course Web Technology: Implementation & Security.

## Methodiek

We gebruiken geen vaste methodiek.

## Logistiek

1. We houden de Git default branch (`master`) 'groen', werkend en in een QA-gecontroleerde staat.
1. Voor iedere bijdrage, bijvoorbeeld een feature, openen we een PR. Iedere feature ontwikkelen we volledig binnen die PR, dwz. incl. tests, docs, etc.
Als er na het mergen van de PR naar de default branch toch issues ontstaan, die je idealiter binnen de oude PR zou hebben opgelost, openen we daarvoor een nieuwe PR.
1. Voor een PR maken we een **branch op deze repository** aan, geen fork.
Dit bevordert de samenwerking. **Zo lang een PR nog niet klaar is voor review and mergen, maken/laten we die PR in [GitHub's _Draft_ status](https://github.blog/wp-content/uploads/2019/02/draft-pull-requests.png?w=1354)**. Als je dit nalaat, wordt je PR automatisch gemerget door [de Kodiak bot](#de-kodiak-bot)!
1. We doen altijd doen altijd alle QA-controles vóór we commits pushen.
De desbetreffende commando's staan in de [GitHub Actions configuratiebestanden](/.github/workflows/). Na het pushen worden deze controles opnieuw gedaan op GitHub door [GitHub Actions](https://github.com/features/actions) zelf, voor de zekerheid.
Maar dat kost geld, dus doe de controle eerst zelf.
1. Voor dat je de PR aanmerkt als 'klaar voor review' (door van Draft-status naar een normale status te gaan) zorgt de hoofdauteur ervoor dat de **titel en de tekst van het openingsbericht** de uiteindelijke stand van zaken goed beschrijft.
Evt. technische overwegingen die later relevant zouden kunnen worden kan je ook beschrijft die auteur ook.
Daarmee vormt het openingsbericht dus altijd een samenvatting van discussies in de PR-thread.
1. We squashen PR branches naar één enkele commit (de **squash-then-merge** strategie), zodat ontwikkelaars vrij kunnen werken in hun PR-branches, zonder dat tussenliggende versies de default branch vervuilen.

### De Kodiak bot

We gebruiken de [Kodiak](https://kodiakhq.com/) bot om deze logistiek in goede banen te leiden.
Kodiak doet de volgende dingen:

1. Houdt (evt. meerdere) openstaande PR branches up to date met de default branch.
2. Merget en wist gemergede PR branches.
3. Commit PRs met een enkele, samenhangende, rijke commit message die het werk documenteert, samen met een hyperlink naar de gerelateerde PR. Dit helpt ons om werk uit het verleden te herleiden tot de vroegere discussies op GitHub.

Deze taken laten we geheel over aan Kodiak.
M.a.w., we gaan niet handmatig Kodiak overstemmen, zelfs als admins, tenzij daar zeer zwaarwegende en uitzonderlijke redenen voor zijn.
Dit zorgt ervoor dat de logistiek goed verloopt door menselijke fouten terug te dringen.

## Inhoudelijke richtlijn

De VS Code-instellingen in dit project zijn al zo veel mogelijk in lijn met de kwaliteitscriteria opgezet.
Als je bijvoorbeeld een JSON of YAML-bestand wijzigt, wordt dat automatisch op een optimaal leesbare manier opgeslagen.
Soms zal je kringeltjes zien onder stukjes broncode, met waarschuwingen.
Alle waarschuwingen moeten worden opgelost voor je die bestanden pusht naar GitHub.

## Taal

We schrijven onze teksten in het Nederlands.
Dat geldt ook voor namen binnen broncode.

## Commentaren en to-do's

Plaats commentaren altijd direct voor de regel(s) waar ze betrekking op hebben.
Zet ze dus niet op dezelfde regel achteraan.
Mocht het commentaar iets aangeven om later op te lossen, schrijf dit dan precies zo:

```php
# TODO: Schrijf hier het commentaar ...
...
```
