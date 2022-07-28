## Codicefiscale ##

Classe utile per controllare il codice fiscale.


### Come Contribuire ###

Leggi [CONTRIBUTING](CONTRIBUTING.MD)


### Requisiti ###

PHP >= 7.1


### Installazione ###
Per installare la classe **Codicefiscale** esegui composer:

$ composer require wraps/codicefiscale


### Metodi ###

- checkSyntaxCodicefiscale: Controllo di sintassi basato su espressione regolare

- isCodiceFiscale: Utilizza un codice fiscale completo e ricalcola il carattere di controllo per verificare che il codice fiscale sia esatto.

- codiceControlloCodiceFiscale: Restituisce il carattere di controllo di un codice fiscale


### NOTE ###

Attenzione, è sconsigliabile "bocciare" il codice fiscale per questioni di omocodia. Possiamo controllare che la sintassi sia valida, possiamo generare il codice di controllo, ma non possiamo gestire due persone con problemi di omocodia. In questo caso il codice fiscale è generato manualmente dal ministero delle finanze sostituendo una cifra con una lettera. In Italia ogni anno ci sono circa 1.400 nuovi casi di omocodia. [Rif Wikipedia](https://it.wikipedia.org/wiki/Omocodia)