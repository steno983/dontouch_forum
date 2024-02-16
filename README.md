# Test DonTouch

## Richiesta

L'obiettivo è quello di sviluppare un FORUM con una pagina con le discussioni che sia accessibile a tutti, ma
solo gli utenti registrati (e solo loro) possono creare nuove discussioni e/o commentare quelle esistenti.

I requisiti da rispettare sono i seguenti:

- Il framework da utilizzare è Laravel o Lumen;
- Devono essere realizzate delle API per le operazioni CRUD su database;
- Gli utenti anonimi possono solo visualizzare i topic;
- Gli utenti registrati possono aprire nuovi topic e commentare quelli esistenti;
- Il frontend può essere realizzato in qualunque modo;
- NON è necessario creare una pagina di registrazione per i nuovi utenti.

## Esecuzione

Ho scelto di utilizzare Laravel. Il frontend e' integrato nello stesso progetto e si basa su dei semplici componenti
Livewire.

Per i feature test ho utilizzato Pest.

## Note

- non ho modificato la struttura della tabella users, e ho basato tutti i link su id numerici per una questione di
  praticita' e velocita'
- ho creato un semplice seeder per popolare velocemente il database.
- La gestione dell'autenticazione l'ho fatta piu' semplice possibile, basandomi su jwt lato api, e una semplice sessione
  dove tenere il token lato frontend
- il frontend e' piuttosto spartano, non solo nello stile grafico ma anche nella gestione di eventuali errori e
  permessi, sempre per un discorso di velocita'

## Test

Per testare il progetto si puo' usare Docker:

- lanciare docker-compose build && docker-compose up -d
- lanciare docker exec -it dontouch_forum .docker/startup.sh &
- l'app puntera' a http://localhost:8000. Le api risponderanno a http://localhost:8001
