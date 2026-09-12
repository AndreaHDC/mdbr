# Correzioni navigazione e homepage — settembre 2026

Le modifiche sono nel tema e negli asset compilati, senza migrazioni del database.

- Acquisto: pulsante fisso mobile a larghezza piena; anche i pulsanti Gutenberg verso la biglietteria occupano tutta la larghezza disponibile sotto 768px.
- Popup homepage: chiusura con testo Chiudi/Close. L'interruttore condiviso precedente continua a valere per entrambe le lingue.
- Menu: il vecchio anchor Accessibilità viene risolto alla pagina dedicata nella lingua corrente; il collegamento alla biglietteria mostra Biglietti/Tickets.
- Slider eventi: larghezza massima 1024px e rapporto immagine 1200:430 definiti nel blocco, indipendentemente dai contenitori Gutenberg tradotti. Rimosso il padding doppio inglese.
- Titolo inglese: WHAT’S ON AT EXPLORA.
- Slider hero ed eventi: autoplay ogni 6 secondi, ritorno alla prima slide, pausa manuale e al passaggio del mouse. Il focus sui contenuti ferma lo scorrimento. Avvio automatico disabilitato con preferenza di movimento ridotto.
- Indicatori: diametro 16px, contrasto pieno, bordo e stato attivo rosso.
- Eventi homepage: ordine crescente della data evento `start_date`, a parità di data ID crescente. Le date banner continuano a determinare il periodo di visibilità, incluso l'ultimo giorno, usando data e fuso orario WordPress.
- Punti elenco: ripristinati sulle liste Gutenberg con classe `wp-block-list`, preservando menu e numerazioni personalizzate.
- Filtro categorie: Seleziona una categoria di interesse / Tutte / Filtra in italiano, con equivalenti inglesi. I nomi categorie restano quelli gestiti da WordPress/WPML.

## Verifica locale

Build Bud completata con le versioni esistenti; nessun aggiornamento PHP, WordPress o plugin. Il vecchio toolchain produce avvisi Sass/Node non bloccanti.

Verificati a 390×844 e 1440×1000: assenza di overflow mobile, pulsante fisso largo 390px, slider eventi desktop largo 1024px in entrambe le lingue, hero alto 800px in entrambe le lingue. Verificati avanzamento automatico, comando pausa, chiusura popup inglese, filtro Scienza con invio del parametro corretto, destinazioni Accessibilità IT/EN, punti elenco nel contenuto Visita.

Ordinamento verificato con tre eventi temporanei per lingua, creati fuori ordine e con promozioni in scadenza nel giorno del test. Risultato crescente corretto in italiano e inglese; tutti i sei eventi temporanei rimossi dopo il test. Popup ripristinato disattivato.

Il backup di luglio può non contenere eventi promossi alla data corrente: in questo caso lo slider eventi resta correttamente assente.
