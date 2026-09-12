# Kinsta — copia di prova Explora

Destinazione autorizzata: **Musei Bambini Roma**, account Viva sas, datacenter Milano.
URL: https://museibambiniroma.kinsta.cloud/
L'ambiente è denominato **Live** in MyKinsta ma viene usato come copia di prova. Non modificare DNS o il sito pubblico mdbr.it.

## Accesso e cartelle

```sh
ssh museibambiniroma@79.72.45.240 -p 25365
```

- Document root: `/www/museibambiniroma_564/public`
- Git directory: `/www/museibambiniroma_564/private/mdbr.git`
- Copia iniziale Kinsta (file e SQL): `/www/museibambiniroma_564/private/mdbr-initial`
- Repository sorgente: `git@github.com:AndreaHDC/mdbr.git`, ramo `main`

Git è conservato fuori dalla cartella pubblica. Non vengono salvati token GitHub sul server.
Per ispezionare la copia Git via SSH:

```sh
export GIT_DIR=/www/museibambiniroma_564/private/mdbr.git
export GIT_WORK_TREE=/www/museibambiniroma_564/public
git status
```

## Aggiornare il solo tema

Committare e caricare su GitHub sorgenti e asset compilati, quindi dalla copia locale:

```sh
bash wp-content/themes/explora-theme/scripts/deploy-kinsta.sh
```

Lo script verifica che la copia locale sia pulita e corrisponda a `origin/main`, trasferisce uno snapshot Git via SSH e applica solo un aggiornamento fast-forward. Si ferma se il tema remoto ha modifiche non committate. Non importa database e non modifica plugin, media, configurazioni o altri siti.
Le dipendenze PHP `vendor` sono state ripristinate inizialmente dal backup ma non sono versionate. Se in futuro cambia `composer.lock`, aggiornare separatamente le dipendenze con Composer usando il lockfile, senza `composer update`.

## Primo ripristino

Core WordPress 7.0 recuperato e verificato con checksum. Database dalla copia locale e URL convertiti con WP-CLI preservando i valori serializzati, esclusi i GUID. Tema con tutte le correzioni salvate nella repository; plugin, traduzioni, media e WebP dal ripristino locale.
Il `wp-config.php` Kinsta e il suo mu-plugin sono conservati. I mu-plugin Plesk e quello esclusivamente locale non sono trasferiti. Log, backup, cache di manutenzione e dipendenze Node non vengono pubblicati.
Ambiente WordPress impostato a `staging`, email WordPress e aggiornamenti automatici bloccati, cron disabilitato, indicizzazione disabilitata. Il mu-plugin specifico della copia di prova è `wp-content/mu-plugins/000-explora-staging.php` e resta fuori da Git.
Le integrazioni esterne della biglietteria restano esterne: questa copia serve alla verifica del sito, non alle transazioni reali.

## Runtime verificato

Il sito web usa **PHP 8.3.33 (FPM)** e **WordPress 7.0**. La CLI generica del container può risolvere un’altra versione PHP: il deploy usa esplicitamente `php8.3 /usr/local/bin/wp`.

## Verifica del ripristino

Conteggi coerenti con la copia locale: 8.174 contenuti e 3.159 allegati. Verificati 33 URL tra pagine e risorse con risposta HTTP 200, homepage italiana e inglese senza immagini mancanti e accesso amministrativo autenticato. Cache Kinsta svuotata completamente dopo il ripristino.
